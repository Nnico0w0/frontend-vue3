# Docker Build Network Connectivity Fix

## Problem Description

The Docker build was failing with network connectivity errors during `composer install`:
```
curl error 28 while downloading https://api.github.com/repos/lcobucci/clock/zipball/...
Resolving timed out after 10001 milliseconds
Could not resolve host: github.com
```

## Solutions Implemented

### 1. Created `.dockerignore` file
Added a `.dockerignore` file to exclude unnecessary files from the Docker build context, making builds faster and more efficient.

### 2. Optimized Dockerfile
Modified the Dockerfile to:
- Copy `composer.json` and `composer.lock` first
- Install dependencies in a separate layer (better caching)
- Copy application code after dependencies are installed
- Run `composer dump-autoload` separately

This approach leverages Docker's layer caching, so if dependencies don't change, Docker won't re-download them.

### 3. Added Network Configuration
In `docker-compose.yml`:
- Added `network: host` to the build configuration for better network access during build
- Added DNS configuration (`8.8.8.8` and `8.8.4.4`) to resolve DNS issues

## Alternative Solutions

If the above solutions don't fully resolve the issue, try these alternatives:

### Option A: Use Docker BuildKit with Network Mode
Run with BuildKit enabled:
```bash
DOCKER_BUILDKIT=1 docker-compose build backend
```

### Option B: Add Build Arguments for Composer
Modify Dockerfile to use Composer with specific options:
```dockerfile
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-autoloader --prefer-dist
```

### Option C: Use Composer Cache Mount
Modify Dockerfile to use cache mounts (requires BuildKit):
```dockerfile
RUN --mount=type=cache,target=/root/.composer \
    composer install --no-dev --optimize-autoloader
```

### Option D: Pre-install Dependencies Locally
If network issues persist during build:
1. Install dependencies locally first:
   ```bash
   cd backend
   composer install --no-dev
   ```
2. Modify `.dockerignore` to NOT exclude `vendor/`
3. Modify Dockerfile to skip `composer install` or use `--no-scripts --no-autoloader`

### Option E: Configure Docker Daemon DNS
Add DNS configuration to Docker daemon (`/etc/docker/daemon.json`):
```json
{
  "dns": ["8.8.8.8", "8.8.4.4"]
}
```

### Option F: Use Composer Mirror
Add to Dockerfile before composer install:
```dockerfile
RUN composer config -g repos.packagist composer https://mirrors.aliyun.com/composer/
```

## Testing the Fix

Run the following commands to test:

```bash
# Clean build
docker-compose down -v
docker-compose build --no-cache backend

# Or using the helper script
./docker.sh fresh
```

## Expected Behavior

After these fixes:
1. Docker build should complete without network timeouts
2. Composer dependencies should be cached in Docker layers
3. Subsequent builds should be faster
4. The application should run normally

## Troubleshooting

If issues persist:

1. **Check Docker Network**: Ensure Docker has internet access
   ```bash
   docker run --rm alpine ping -c 4 google.com
   ```

2. **Check DNS Resolution**: 
   ```bash
   docker run --rm alpine nslookup github.com
   ```

3. **Use Network Host Mode for Build**:
   ```bash
   docker build --network=host -t backend ./backend
   ```

4. **Increase Composer Timeout**:
   Add to Dockerfile before composer install:
   ```dockerfile
   ENV COMPOSER_PROCESS_TIMEOUT=600
   ```

5. **Disable IPv6** if causing issues:
   Add to `/etc/docker/daemon.json`:
   ```json
   {
     "ipv6": false
   }
   ```
