# JWT Authentication Testing Guide

## Overview
The backend now has complete JWT authentication implemented using tymon/jwt-auth package.

## Available Endpoints

### Public Endpoints

#### 1. Health Check
```bash
curl http://localhost:8000/api/health
```

#### 2. Register User
```bash
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{
    "first_name": "John",
    "last_name": "Doe",
    "email": "john.doe@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }'
```

**Response:**
```json
{
  "success": true,
  "message": "User registered successfully",
  "user": { ... },
  "token": "eyJ0eXAiOiJKV1QiLCJhbGci..."
}
```

#### 3. Login
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "john.doe@example.com",
    "password": "password123"
  }'
```

**Response:**
```json
{
  "success": true,
  "message": "Login successful",
  "user": { ... },
  "token": "eyJ0eXAiOiJKV1QiLCJhbGci..."
}
```

### Protected Endpoints (Require JWT Token)

#### 4. Get Current User
```bash
TOKEN="your-jwt-token-here"

curl -X GET http://localhost:8000/api/me \
  -H "Authorization: Bearer $TOKEN"
```

**Response:**
```json
{
  "success": true,
  "user": {
    "id": 1,
    "first_name": "John",
    "last_name": "Doe",
    "email": "john.doe@example.com",
    ...
  }
}
```

#### 5. Refresh Token
```bash
curl -X POST http://localhost:8000/api/refresh \
  -H "Authorization: Bearer $TOKEN"
```

**Response:**
```json
{
  "success": true,
  "token": "new-jwt-token..."
}
```

#### 6. Logout
```bash
curl -X POST http://localhost:8000/api/logout \
  -H "Authorization: Bearer $TOKEN"
```

**Response:**
```json
{
  "success": true,
  "message": "Logged out successfully"
}
```

## Validation Rules

### Registration
- `first_name`: required, string, max 255 characters
- `last_name`: required, string, max 255 characters
- `email`: required, valid email, unique
- `password`: required, min 8 characters, must match confirmation
- `phone`: optional, string, max 20 characters
- `address`: optional, string, max 500 characters
- `city`: optional, string, max 100 characters
- `country`: optional, string, max 100 characters

### Login
- `email`: required, valid email
- `password`: required, string

## Error Responses

### Validation Error (422)
```json
{
  "success": false,
  "message": "Validation error",
  "errors": {
    "email": ["The email has already been taken."],
    "password": ["The password field must be at least 8 characters."]
  }
}
```

### Authentication Error (401)
```json
{
  "success": false,
  "message": "Invalid email or password"
}
```

### Unauthorized (401)
```json
{
  "success": false,
  "message": "User not found"
}
```

## Token Configuration
- **Token TTL**: 60 minutes
- **Refresh TTL**: 2 weeks (20160 minutes)
- **Algorithm**: HS256
- **Blacklist**: Enabled (tokens are invalidated on logout)

## Docker Commands

### Start Services
```bash
docker compose up -d
```

### Check Status
```bash
docker compose ps
```

### View Logs
```bash
docker compose logs -f backend
```

### Stop Services
```bash
docker compose down
```

### Rebuild
```bash
docker compose up -d --build
```

## Testing the Complete Flow

1. **Register a new user:**
```bash
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{
    "first_name": "Test",
    "last_name": "User",
    "email": "test@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }'
```

2. **Save the token from the response**

3. **Access protected endpoint:**
```bash
TOKEN="your-token-here"
curl -X GET http://localhost:8000/api/me \
  -H "Authorization: Bearer $TOKEN"
```

4. **Logout:**
```bash
curl -X POST http://localhost:8000/api/logout \
  -H "Authorization: Bearer $TOKEN"
```

5. **Try to access protected endpoint again (should fail):**
```bash
curl -X GET http://localhost:8000/api/me \
  -H "Authorization: Bearer $TOKEN"
```

## Notes
- All tokens are stored in a blacklist when users logout
- Tokens expire after 60 minutes by default
- CORS is configured to accept requests from any origin (for development)
- Storage permissions are set to 777 for development (should be more restrictive in production)
