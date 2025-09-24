# HTTP Fire-and-Forget Email Implementation

## Overview
This implementation replaces the queue-based email system with an HTTP fire-and-forget approach that works perfectly on GoDaddy shared hosting and other limited hosting environments.

## How It Works

1. **User submits flight request** → Form is validated and saved to database
2. **Fire-and-forget HTTP requests are triggered** → Two ultra-fast HTTP requests (50ms timeout)
3. **User is immediately redirected** → Shows thank you page (no waiting)
4. **Email endpoint processes in background** → Sends emails while user sees confirmation

## Implementation Details

### Files Modified

1. **`frontend/controllers/RequestController.php`**
   - Added `actionSendEmailAsync()` - The email processing endpoint
   - Added `fireAndForgetRequest()` - Helper method for fire-and-forget requests
   - Modified `actionFlight()` - Now uses fire-and-forget instead of queue
   - Updated `actionTestEmail()` - Test endpoint for the new system

2. **`frontend/config/params.php`**
   - Added `emailAsyncToken` - Security token for internal API calls

### Key Features

#### Fire-and-Forget Method
```php
private function fireAndForgetRequest($emailData)
{
    // Ultra-short 50ms timeout
    curl_setopt($ch, CURLOPT_TIMEOUT_MS, 50);
    
    // Don't wait for response
    @curl_exec($ch);
    
    // Continue immediately
    return true;
}
```

#### Security
- Uses a secret token to prevent unauthorized access
- Token stored in configuration, not hardcoded
- CSRF validation disabled for internal endpoint

#### Performance
- 50ms timeout - just enough to initiate the request
- No connection reuse for faster processing
- SSL verification can be disabled for local development

## Testing

### Test the Implementation
```bash
# Start local server
php yii serve --docroot=frontend/web --port=8080

# Test fire-and-forget emails
curl http://localhost:8080/request/test-email
```

### Expected Result
```
Fire-and-forget email requests initiated for: [email] and admin. Check emails in a few seconds.
```

## Deployment to GoDaddy

### 1. Upload Files
Upload the modified files to your GoDaddy hosting:
- `frontend/controllers/RequestController.php`
- `frontend/config/params.php`

### 2. Update Security Token
In `frontend/config/params.php`, change the token to something secure:
```php
'emailAsyncToken' => 'your-very-secure-random-string-here',
```

### 3. Configure Email Settings
Ensure your email configuration in `common/config/main-local.php` is correct for GoDaddy.

### 4. Test
Submit a flight request form and verify emails are sent.

## Advantages Over Queue System

1. **No Worker Required** - No need for cron jobs or background processes
2. **Works on Any Hosting** - Including GoDaddy shared hosting
3. **Immediate Response** - Users don't wait for email sending
4. **Simple Implementation** - No database tables or complex setup
5. **Self-Contained** - Everything runs within your PHP application

## How It Compares

| Feature | Queue System | Fire-and-Forget |
|---------|--------------|-----------------|
| Worker Required | Yes | No |
| Cron Job | Yes | No |
| Database Table | Yes | No |
| Works on Shared Hosting | Limited | Yes |
| Email Retry | Yes | No |
| Email Status Tracking | Yes | Limited |
| Implementation Complexity | High | Low |
| Response Time | Instant | Instant |

## Troubleshooting

### Emails Not Sending?

1. **Check the token** - Ensure `emailAsyncToken` matches in both places
2. **Check URL generation** - The absolute URL must be correct
3. **Check email configuration** - Verify SMTP settings
4. **Check PHP timeout** - Ensure `set_time_limit(120)` is allowed
5. **Check logs** - Look in `frontend/runtime/logs/`

### Testing Locally

```bash
# Check if endpoint is accessible
curl -X POST http://localhost:8080/request/send-email-async \
  -d "token=your-token-here" \
  -d "emailData[adminEmail]=admin@example.com"
```

## Important Notes

1. **No retry mechanism** - If email fails, it won't retry automatically
2. **No queue monitoring** - Can't track email status in database
3. **Timeout is critical** - 50ms works well, adjust if needed
4. **Security token is essential** - Always use a strong, unique token
5. **Works best with reliable email service** - Consider using SendGrid/Mailgun API

## Alternative: Use Email Service API

For even better reliability on GoDaddy, consider using an email service API:
- SendGrid
- Mailgun
- Amazon SES
- Postmark

These services handle all async processing on their end, so you just make an API call and return immediately.

## Summary

This HTTP fire-and-forget implementation provides a simple, effective solution for async email sending that works on any hosting environment, including GoDaddy shared hosting. While it lacks some features of a full queue system (like retry and monitoring), it's perfect for situations where you need async email without the complexity of queue workers.
