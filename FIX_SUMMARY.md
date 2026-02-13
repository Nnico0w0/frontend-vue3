# Fix Summary: Docker Build Network Connectivity Issue

## Problem
Docker build was failing with network connectivity errors:
```
curl error 28 while downloading https://api.github.com/repos/lcobucci/clock/zipball/...
Could not resolve host: github.com
Resolving timed out after 10001 milliseconds
```

## Root Cause
- DNS resolution failures during Docker build
- Network timeouts when downloading Composer dependencies
- Inefficient Dockerfile causing repeated downloads

## Solutions Applied

### 1. Created `.dockerignore` File
**Location**: `backend/.dockerignore`

Excludes unnecessary files from Docker build context:
- Git files
- Environment files
- IDE files
- Tests
- Documentation
- Storage/cache files (mounted as volumes)

**Benefit**: Faster builds, smaller context

### 2. Optimized Dockerfile
**Location**: `backend/Dockerfile`

**Changes**:
- Copy `composer.json` and `composer.lock` first (lines 36-37)
- Set Composer environment variables (lines 39-41):
  - `COMPOSER_PROCESS_TIMEOUT=600` - Increases timeout to 10 minutes
  - `COMPOSER_MEMORY_LIMIT=-1` - Removes memory limit
- Install dependencies with optimized flags (line 44):
  - `--prefer-dist` - Download zip archives instead of cloning git repos
  - `--no-scripts` - Skip post-install scripts initially
  - `--no-autoloader` - Skip autoloader generation initially
- Copy application code (line 47)
- Generate optimized autoloader (line 50)

**Benefit**: 
- Better Docker layer caching
- Faster downloads (zip vs git)
- Only re-downloads if composer.json/lock changes

### 3. Updated docker-compose.yml
**Location**: `docker-compose.yml`

**Changes**:
- Added `network: host` to build configuration (line 24)
  - Allows build to use host's network stack
  - Better DNS resolution
- Added DNS servers (lines 27-29):
  - `8.8.8.8` - Google DNS Primary
  - `8.8.4.4` - Google DNS Secondary
  - Used at runtime for DNS resolution

**Benefit**: Better network connectivity during build and runtime

### 4. Documentation
**Files Created**:
- `DOCKER_BUILD_FIX.md` - Comprehensive troubleshooting guide
- Updated `README.md` - Added troubleshooting section

## How to Use

### Standard Build
```bash
# Clean previous builds
docker-compose down -v

# Build with new configuration
docker-compose build backend

# Start services
docker-compose up -d
```

### Alternative: Using BuildKit
```bash
DOCKER_BUILDKIT=1 docker-compose build backend
```

### Alternative: With Host Network
```bash
docker build --network=host -t backend ./backend
```

### If Issues Persist: Pre-install Dependencies
```bash
# Install dependencies locally first
cd backend
composer install --no-dev

# Then build (will use local vendor/)
docker-compose build backend
```

## Testing the Fix

1. **Clean build test**:
   ```bash
   docker-compose down -v
   docker-compose build --no-cache backend
   ```

2. **Check if it works**:
   ```bash
   docker-compose up -d
   docker-compose logs backend
   ```

3. **Verify DNS resolution**:
   ```bash
   docker run --rm alpine nslookup github.com
   ```

## Expected Results

✅ Build completes without timeout errors
✅ Dependencies download successfully
✅ Subsequent builds are faster (cached layers)
✅ Application runs normally

## Key Improvements

1. **Build Speed**: 
   - First build: ~2-5 minutes (depending on network)
   - Subsequent builds: ~30 seconds (if no dependency changes)

2. **Reliability**:
   - Increased timeout reduces timeout errors
   - `--prefer-dist` is more reliable than git clones
   - DNS configuration handles resolution issues

3. **Efficiency**:
   - Docker layer caching prevents unnecessary re-downloads
   - Smaller build context (via .dockerignore)
   - Optimized dependency installation

## Additional Notes

- The `vendor/` directory (43MB) is now excluded from build context
- Dependencies are installed fresh during build
- Runtime volumes still mount the application code for development
- DNS configuration (8.8.8.8, 8.8.4.4) helps with resolution issues

## Rollback Instructions

If you need to rollback these changes:

```bash
# Checkout previous version
git checkout HEAD~2

# Rebuild
docker-compose build backend
```

## Need More Help?

See `DOCKER_BUILD_FIX.md` for:
- Alternative solutions
- Advanced troubleshooting
- Docker network diagnostics
- Composer configuration options
