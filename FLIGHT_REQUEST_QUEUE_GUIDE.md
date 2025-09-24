# Flight Request Email Queue System Guide

## How It Works

When a user submits a flight request, the system follows this flow:

1. **User submits flight request form** → Form is validated
2. **Request is saved to database** → User gets a request ID
3. **Email jobs are pushed to queue** → Two jobs are created:
   - One email to admin
   - One email to the user
4. **User is immediately redirected** → Shows thank you page with request number
5. **Queue worker processes emails** → Sends emails asynchronously in the background

## Current Implementation

The flight request flow in `frontend/controllers/RequestController.php` already uses the queue system:

```php
// Push email jobs to queue instead of sending immediately
// Send to admin
Yii::$app->queue->push(new SendEmail([
    'email' => Yii::$app->params['adminEmail'],
    'flightRequest' => $flightRequestMax,
    'trips' => $trips,
    'lastInsertId' => $lastInsertID,
]));

// Send to user
Yii::$app->queue->push(new SendEmail([
    'email' => $flight_request_max_model->email,
    'flightRequest' => $flightRequestMax,
    'trips' => $trips,
    'lastInsertId' => $lastInsertID,
]));
```

## Running the Queue Worker

### Quick Start - Development

To process emails from the queue, you need to run the queue worker:

```bash
# Process all pending jobs and exit
php yii queue/run

# OR - Keep listening for new jobs (recommended)
php yii queue/listen --verbose=1
```

### Step-by-Step Instructions

1. **Check queue status** (see how many jobs are waiting):
   ```bash
   php yii queue/info
   ```
   Output example:
   ```
   Jobs
   - waiting: 5
   - delayed: 0
   - reserved: 0
   - done: 0
   ```

2. **Start the queue worker** to process emails:
   ```bash
   # Option A: Process once and exit
   php yii queue/run
   
   # Option B: Keep running and process new jobs as they come
   php yii queue/listen --verbose=1
   ```

3. **Monitor the processing**:
   - With `--verbose=1`, you'll see each job being processed
   - Emails will be sent in the background
   - Users don't have to wait for email sending

## Keeping the Worker Running

### For Development (Local Machine)

#### Option 1: Terminal Window
Simply keep a terminal window open:
```bash
php yii queue/listen --verbose=1
```

#### Option 2: Screen Session (Linux/Mac)
```bash
# Create a new screen session
screen -S queue-worker

# Run the queue listener
php yii queue/listen --verbose=1

# Detach from screen: Press Ctrl+A, then D

# To reattach later:
screen -r queue-worker
```

#### Option 3: Background Process
```bash
# Run in background
nohup php yii queue/listen > queue.log 2>&1 &

# Check if it's running
ps aux | grep "queue/listen"

# Stop it
pkill -f "queue/listen"
```

### For Production (Server)

#### Option 1: Systemd Service (Recommended)

1. Create service file `/etc/systemd/system/iflyfirstclass-queue.service`:
```ini
[Unit]
Description=IFlyFirstClass Queue Worker
After=network.target mysql.service

[Service]
Type=simple
User=www-data
Group=www-data
WorkingDirectory=/path/to/iflyfirstclass
ExecStart=/usr/bin/php /path/to/iflyfirstclass/yii queue/listen
Restart=always
RestartSec=10

[Install]
WantedBy=multi-user.target
```

2. Enable and start:
```bash
sudo systemctl enable iflyfirstclass-queue
sudo systemctl start iflyfirstclass-queue
sudo systemctl status iflyfirstclass-queue
```

#### Option 2: Supervisor
```ini
[program:iflyfirstclass-queue]
command=/usr/bin/php /path/to/iflyfirstclass/yii queue/listen
autostart=true
autorestart=true
user=www-data
redirect_stderr=true
stdout_logfile=/var/log/iflyfirstclass-queue.log
```

#### Option 3: Simple Cron (processes every minute)
```bash
# Add to crontab
* * * * * /usr/bin/php /path/to/iflyfirstclass/yii queue/run
```

## Testing the System

### 1. Test Email Endpoint
Visit or curl the test endpoint:
```bash
curl http://your-domain/request/test-email
```

### 2. Manual Test from Console
```bash
# Push a test job to queue
php yii eval "Yii::\$app->queue->push(new \common\queue\SendEmail([
    'email' => 'your-email@example.com',
    'flightRequest' => ['name' => 'Test User', 'email' => 'test@example.com'],
    'trips' => [['from' => 'NYC', 'to' => 'LAX', 'dep_date' => '2025-01-15']],
    'lastInsertId' => 999
]));"

# Then run the worker to process it
php yii queue/run
```

## Troubleshooting

### Jobs Not Processing?

1. **Check queue status**:
   ```bash
   php yii queue/info
   ```

2. **Check for errors**:
   ```bash
   # Run with verbose output
   php yii queue/listen --verbose=1
   ```

3. **Check database directly**:
   ```sql
   -- See pending jobs
   SELECT * FROM queue WHERE reserved_at IS NULL;
   
   -- See failed jobs (attempted 3+ times)
   SELECT * FROM queue WHERE attempt >= 3;
   ```

4. **Clear stuck jobs** (if needed):
   ```bash
   php yii queue/clear
   ```

### Email Configuration Issues?

Check your email configuration in `common/config/main-local.php`:
```php
'mailer' => [
    'class' => \yii\symfonymailer\Mailer::class,
    'viewPath' => '@common/mail',
    'useFileTransport' => false, // Should be false for real emails
    'transport' => [
        'dsn' => 'native://default', // Or your SMTP settings
    ],
],
```

## Benefits of Queue System

1. **Better User Experience**: Users see the thank you page immediately
2. **Reliability**: Failed emails can be retried automatically
3. **Scalability**: Can handle many requests without slowing down
4. **Monitoring**: Track email status in the database
5. **Flexibility**: Can add delays, priorities, or process in batches

## Queue Management Commands

```bash
# View queue status
php yii queue/info

# Process all pending jobs
php yii queue/run

# Listen for new jobs continuously
php yii queue/listen

# Listen with verbose output
php yii queue/listen --verbose=1

# Clear all jobs
php yii queue/clear

# Remove a specific job
php yii queue/remove [job-id]
```

## Important Notes

1. **The queue worker must be running** for emails to be sent
2. **In production**, use systemd or supervisor to keep it running
3. **For development**, just run `php yii queue/listen --verbose=1` in a terminal
4. **Monitor the queue** regularly to ensure jobs are processing
5. **Check logs** if emails aren't being sent

## Quick Commands to Get Started

```bash
# 1. Check if there are jobs waiting
php yii queue/info

# 2. Start processing emails
php yii queue/listen --verbose=1

# 3. Keep this running while your application creates new flight requests
```

That's it! The emails will be sent automatically as users submit flight requests.
