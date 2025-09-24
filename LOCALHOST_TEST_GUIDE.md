# Testing Background Email Implementation on Localhost

## The servers are already running!

### Access Points:
- **Frontend**: http://localhost:8080
- **Backend**: http://localhost:8081

## Testing Steps

### 1. Test the Background Email System
Open your browser and go to:
```
http://localhost:8080/test-background-email.php
```
This will simulate the email sending process and show you the results.

### 2. Test the Actual Flight Request Form

#### Option A: Homepage
1. Go to http://localhost:8080
2. You should see the flight request form on the homepage
3. Fill out the form with test data:
   - From: Type "JFK" or "New York"
   - To: Type "LHR" or "London"
   - Select departure and return dates
   - Enter your name, phone, and email
   - Submit the form

#### Option B: Direct Test Pages
- Business Class page: http://localhost:8080/service/business-class
- First Class page: http://localhost:8080/service/first-class

### 3. What to Expect

When you submit the form:
1. **Immediate redirect** - You'll be taken to the success page instantly
2. **Success page shows** - You'll see your flight request confirmation with a reference number
3. **Background email sending** - Check the browser console (F12) to see the AJAX call for email sending
4. **Email delivery** - If email is configured correctly, you'll receive emails

### 4. Check Browser Console

Press F12 to open Developer Tools and look at:
- **Console tab**: You should see "Emails sent successfully" message
- **Network tab**: You should see the AJAX request to `send-pending-flight-emails`

### 5. Verify Email Configuration

Check if emails are actually being sent by looking at:
```
http://localhost:8080/test-email.php
```

### 6. Debug Mode

If emails aren't sending, check your configuration:
1. Open `common/config/main-local.php`
2. Look for the `mailer` configuration
3. If `useFileTransport` is `true`, emails are saved to files instead of being sent
4. Check `frontend/runtime/mail/` folder for saved email files

## Quick Test URLs

1. **Test Background Email System**: 
   http://localhost:8080/test-background-email.php

2. **Test Email Configuration**: 
   http://localhost:8080/test-email.php

3. **Main Site (with form)**: 
   http://localhost:8080

4. **Business Class Page**: 
   http://localhost:8080/service/business-class

5. **First Class Page**: 
   http://localhost:8080/service/first-class

## Monitoring the Process

### In Browser Console (F12):
You should see these messages:
- When form submits: Network request to `/request/flight`
- On success page: Network request to `/request/send-pending-flight-emails`
- Console log: "Emails sent successfully"

### In PHP Logs:
Check for any errors in:
- `frontend/runtime/logs/app.log`
- System PHP error log

## Troubleshooting

### If the form doesn't submit via AJAX:
1. Check if JavaScript file is loaded: View page source and look for `flight-request-ajax.js`
2. Check browser console for JavaScript errors
3. Ensure jQuery is loaded

### If emails don't send:
1. Check email configuration in `common/config/main-local.php`
2. Verify SMTP settings if using real email
3. Check if `useFileTransport` is set to `false` for real emails
4. Look in `frontend/runtime/mail/` if using file transport

### If page doesn't redirect:
1. Check browser console for errors
2. Verify the response from `/request/flight` includes `redirectUrl`
3. Check network tab for the AJAX response

## Stop the Servers

To stop the servers when done testing:
```bash
# Find the process IDs
lsof -i :8080 -i :8081

# Kill the processes
kill [PID1] [PID2]
```

Or simply close the terminal window where the servers are running.
