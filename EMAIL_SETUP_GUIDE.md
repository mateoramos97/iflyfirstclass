# Email Configuration Guide for IFlyFirstClass

## Overview
This guide explains how to set up and test email functionality for the IFlyFirstClass website, both on localhost and production (GoDaddy hosting).

## Current Setup Summary

### Email Configuration Files Created:
1. **Native Mail (Default)**: `common/config/main-local.php`
2. **Office365 SMTP**: `common/config/main-local-office365.php`
3. **Production (GoDaddy)**: `common/config/main-local-production.php`

### Updated Files:
- `common/config/params.php` - Email addresses configured
- `common/sys/models/request/FlightRequestMax.php` - Added BCC for testing
- `frontend/web/test-email.php` - Email testing script

## Testing on Localhost

### Step 1: Start the Server
```bash
# Make the script executable (already done)
chmod +x run-localhost-email-test.sh

# Run the server
./run-localhost-email-test.sh

# Or manually:
php -S localhost:8080 -t frontend/web/
```

### Step 2: Test Email Functionality
1. Open browser and go to: `http://localhost:8080/test-email.php`
2. The page will attempt to send 3 test emails:
   - Simple text email
   - HTML email with BCC
   - Flight request simulation

### Step 3: Check Results
- **Success**: You'll see green checkmarks (✅) for each test
- **Check your email** at `mateoramos97@gmail.com`
- **Important**: Check SPAM/JUNK folders!

## If Native Mail Doesn't Work on Localhost

### Option 1: Use Office365 SMTP Configuration
```bash
# Copy the Office365 config
cp common/config/main-local-office365.php common/config/main-local.php

# Edit the password if needed
# Then restart the server and test again
```

### Option 2: Use Docker (if available)
```bash
docker-compose up
```

## Production Deployment (GoDaddy)

### Step 1: Upload Configuration
1. Upload `common/config/main-local-production.php` to your GoDaddy server
2. Rename it to `main-local.php` on the server
3. Ensure database credentials are correct

### Step 2: Verify Files on Production
Make sure these files are updated on production:
- `common/config/params.php`
- `common/sys/models/request/FlightRequestMax.php`

### Step 3: Test on Production
1. Visit: `https://www.iflyfirstclass.com/test-email.php`
2. Submit a flight request form
3. Check emails at `mateoramos97@gmail.com` (BCC copy)

## Email Flow Explanation

When a flight request is submitted:

1. **Admin Email**: Sent to `info@iflyfirstclass.com`
2. **Customer Email**: Sent to the email they entered
3. **BCC Copy**: Hidden copy to `mateoramos97@gmail.com` (for testing)

## Troubleshooting

### Emails Not Sending (Localhost)

1. **Check PHP mail configuration**:
   ```bash
   php -i | grep mail
   ```

2. **On Mac**: Install and configure postfix
   ```bash
   sudo postfix start
   ```

3. **On Windows**: Configure SMTP in php.ini

4. **Try Office365 SMTP** instead of native mail

### Emails Not Sending (Production)

1. **Verify SPF records** for your domain
2. **Check GoDaddy email logs** in cPanel
3. **Ensure sendmail is enabled** on your hosting plan
4. **Contact GoDaddy support** if needed

### Emails Going to Spam

1. **Add SPF record** to DNS:
   ```
   v=spf1 include:secureserver.net ~all
   ```

2. **Use proper From address** matching your domain
3. **Avoid spam trigger words** in subject/content

## Configuration Options

### Native Mail (Simplest)
```php
'transport' => [
    'dsn' => 'native://default',
]
```

### Sendmail (Production)
```php
'transport' => [
    'dsn' => 'sendmail://default',
]
```

### Office365 SMTP
```php
'transport' => [
    'scheme' => 'smtp',
    'host' => 'smtp.office365.com',
    'username' => 'info@iflyfirstclass.com',
    'password' => 'YOUR_PASSWORD',
    'port' => 587,
    'encryption' => 'tls',
]
```

## Important Notes

1. **BCC for Testing**: All emails will BCC to `mateoramos97@gmail.com` - remove this in production after testing
2. **Check Spam**: Always check spam/junk folders first
3. **Email Limits**: GoDaddy may have daily email sending limits
4. **Password Security**: Never commit passwords to git

## Quick Commands

```bash
# Start localhost server
./run-localhost-email-test.sh

# Test email page
open http://localhost:8080/test-email.php

# View saved emails (if using file transport)
open http://localhost:8080/view-emails.php

# Check mail logs (Mac/Linux)
tail -f /var/log/mail.log
```

## Support

If emails are still not working after following this guide:
1. Check the error messages in test-email.php
2. Review server logs
3. Contact GoDaddy support for hosting-specific issues
4. Ensure your email account (info@iflyfirstclass.com) is properly configured

---
Last Updated: January 9, 2025
