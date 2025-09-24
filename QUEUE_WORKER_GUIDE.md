# Queue Worker Management Guide for IFlyFirstClass

## Overview
The application uses Yii2 Queue with a database backend to handle asynchronous tasks like sending emails. This guide explains how to run and manage the queue worker.

## Queue System Architecture
- **Queue Component**: Configured in both `frontend/config/main.php` and `console/config/main.php`
- **Database Backend**: Uses MySQL table named `queue`
- **Job Classes**: Located in `common/queue/` (e.g., `SendEmail.php`)

## Running the Queue Worker

### 1. Basic Worker Commands

#### Start the worker (processes jobs and exits):
```bash
php yii queue/run
```

#### Listen for new jobs continuously (recommended for development):
```bash
php yii queue/listen
```

#### Listen with verbose output (useful for debugging):
```bash
php yii queue/listen --verbose=1
```

#### Listen with custom timeout (default is 3 seconds):
```bash
php yii queue/listen --timeout=10
```

### 2. Check Queue Status

#### View queue information:
```bash
php yii queue/info
```

#### Clear all jobs from queue:
```bash
php yii queue/clear
```

#### Remove a specific job:
```bash
php yii queue/remove [job-id]
```

## Production Deployment Options

### Option 1: Systemd Service (Recommended for Linux)

Create a systemd service file `/etc/systemd/system/iflyfirstclass-queue.service`:

```ini
[Unit]
Description=IFlyFirstClass Queue Worker
After=network.target mysql.service

[Service]
Type=simple
User=www-data
Group=www-data
WorkingDirectory=/path/to/your/project
ExecStart=/usr/bin/php /path/to/your/project/yii queue/listen --verbose=0
Restart=always
RestartSec=10
StandardOutput=append:/var/log/iflyfirstclass/queue.log
StandardError=append:/var/log/iflyfirstclass/queue-error.log

[Install]
WantedBy=multi-user.target
```

Enable and start the service:
```bash
sudo systemctl enable iflyfirstclass-queue
sudo systemctl start iflyfirstclass-queue
sudo systemctl status iflyfirstclass-queue
```

### Option 2: Supervisor (Alternative for Linux)

Create supervisor config `/etc/supervisor/conf.d/iflyfirstclass-queue.conf`:

```ini
[program:iflyfirstclass-queue]
process_name=%(program_name)s_%(process_num)02d
command=/usr/bin/php /path/to/your/project/yii queue/listen
autostart=true
autorestart=true
user=www-data
numprocs=1
redirect_stderr=true
stdout_logfile=/var/log/iflyfirstclass/queue.log
environment=HOME="/var/www",USER="www-data"
```

Update supervisor:
```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start iflyfirstclass-queue:*
```

### Option 3: Cron Job (Simple but less reliable)

Add to crontab (`crontab -e`):
```bash
* * * * * /usr/bin/php /path/to/your/project/yii queue/run
```

This runs every minute and processes any pending jobs.

### Option 4: Docker Container

If using Docker, add a queue worker service to `docker-compose.yml`:

```yaml
queue-worker:
  build: .
  command: php yii queue/listen
  volumes:
    - .:/app
  depends_on:
    - db
  restart: always
```

## Development Environment

### Using Screen (Quick development solution):
```bash
# Create a new screen session
screen -S queue-worker

# Run the queue listener
php yii queue/listen --verbose=1

# Detach from screen: Press Ctrl+A, then D

# Reattach to screen
screen -r queue-worker

# List all screens
screen -ls

# Kill a screen session
screen -X -S queue-worker quit
```

### Using tmux (Alternative to screen):
```bash
# Create a new tmux session
tmux new -s queue-worker

# Run the queue listener
php yii queue/listen --verbose=1

# Detach from tmux: Press Ctrl+B, then D

# Reattach to tmux
tmux attach -t queue-worker

# List all tmux sessions
tmux ls

# Kill a tmux session
tmux kill-session -t queue-worker
```

## Monitoring and Troubleshooting

### Check if worker is running:
```bash
ps aux | grep "queue/listen"
```

### Monitor queue table directly:
```sql
-- Check pending jobs
SELECT * FROM queue WHERE reserved_at IS NULL ORDER BY id DESC;

-- Check failed jobs
SELECT * FROM queue WHERE attempt > 3;

-- Count jobs by status
SELECT 
    CASE 
        WHEN reserved_at IS NULL THEN 'pending'
        WHEN done_at IS NOT NULL THEN 'completed'
        ELSE 'processing'
    END as status,
    COUNT(*) as count
FROM queue 
GROUP BY status;
```

### View logs (if using systemd):
```bash
sudo journalctl -u iflyfirstclass-queue -f
```

### Common Issues and Solutions:

1. **Worker stops unexpectedly**
   - Check memory limits in PHP configuration
   - Review error logs for fatal errors
   - Ensure database connection is stable

2. **Jobs not processing**
   - Verify worker is running: `ps aux | grep queue`
   - Check database connection in config
   - Review job implementation for errors

3. **Slow processing**
   - Consider running multiple workers
   - Optimize job code
   - Check database performance

## Testing the Queue System

### Test email queue:
```bash
# Visit the test endpoint (already implemented)
curl http://your-domain/request/test-email
```

### Manual job push from console:
```bash
php yii eval "Yii::\$app->queue->push(new \common\queue\SendEmail([
    'email' => 'test@example.com',
    'flightRequest' => ['name' => 'Test'],
    'trips' => [],
    'lastInsertId' => 1
]));"
```

## Best Practices

1. **Always use queue for time-consuming tasks** like sending emails, generating reports, or API calls
2. **Monitor queue size** to prevent backlog
3. **Set up alerts** for failed jobs
4. **Use different queue channels** for different priority tasks if needed
5. **Implement retry logic** with exponential backoff for transient failures
6. **Log important events** within job execution
7. **Keep jobs idempotent** - running the same job twice shouldn't cause issues

## Configuration Options

Edit `console/config/main.php` to adjust queue settings:

```php
'queue' => [
    'class' => \yii\queue\db\Queue::class,
    'db' => 'db',
    'tableName' => 'queue',
    'channel' => 'default',
    'mutex' => \yii\mutex\MysqlMutex::class,
    'attempts' => 3,  // Number of retry attempts
    'ttr' => 300,     // Time to reserve in seconds
],
```

## Security Considerations

1. Run worker with limited user privileges
2. Ensure queue table is not publicly accessible
3. Validate and sanitize all job data
4. Monitor for unusual queue activity
5. Implement rate limiting if needed

## Performance Optimization

1. **Index the queue table properly**:
```sql
ALTER TABLE queue ADD INDEX idx_channel_reserved_at (channel, reserved_at);
ALTER TABLE queue ADD INDEX idx_priority_reserved_at (priority, reserved_at);
```

2. **Clean old completed jobs regularly**:
```bash
# Add to cron (runs daily at 2 AM)
0 2 * * * /usr/bin/php /path/to/project/yii queue/clear --completed
```

3. **Use multiple workers for high volume**:
```bash
# Start 3 workers
for i in {1..3}; do
    php yii queue/listen &
done
```

## Integration with Your Flight Request Flow

The flight request flow now uses the queue system:

1. User submits flight request form
2. Request is validated and saved to database
3. Email jobs are pushed to queue (admin + user notifications)
4. User is redirected to confirmation page immediately
5. Queue worker processes email jobs asynchronously

This approach provides:
- Better user experience (no waiting for email sending)
- Resilience (failed emails can be retried)
- Scalability (can process many requests simultaneously)
- Monitoring capabilities (track job status in database)

## Quick Start Commands

```bash
# Development - Start worker with output
php yii queue/listen --verbose=1

# Production - Using systemd
sudo systemctl start iflyfirstclass-queue
sudo systemctl status iflyfirstclass-queue

# Check queue status
php yii queue/info

# Monitor in real-time
watch -n 1 'php yii queue/info'
```

## Support

For issues or questions about the queue system:
1. Check the logs first
2. Verify database connectivity
3. Ensure worker is running
4. Review job implementation for errors
