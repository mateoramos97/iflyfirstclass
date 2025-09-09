<?php
// Simple email viewer for localhost testing
$mailDir = '../runtime/mail/';
$emails = [];

if (is_dir($mailDir)) {
    $files = scandir($mailDir);
    foreach ($files as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'eml') {
            $emails[] = [
                'file' => $file,
                'time' => filemtime($mailDir . $file),
                'content' => file_get_contents($mailDir . $file)
            ];
        }
    }
}

// Sort by newest first
usort($emails, function($a, $b) {
    return $b['time'] - $a['time'];
});
?>
<!DOCTYPE html>
<html>
<head>
    <title>Email Viewer - IFlyFirstClass</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .email { border: 1px solid #ddd; margin: 20px 0; padding: 15px; }
        .email-header { background: #f5f5f5; padding: 10px; margin: -15px -15px 15px -15px; }
        .email-content { white-space: pre-wrap; }
        h1 { color: #333; }
    </style>
</head>
<body>
    <h1>📧 Email Viewer - IFlyFirstClass</h1>
    <p>Showing emails saved to files (localhost testing mode)</p>
    
    <?php if (empty($emails)): ?>
        <p>No emails found. Submit a flight request to generate emails.</p>
    <?php else: ?>
        <?php foreach ($emails as $email): ?>
            <div class="email">
                <div class="email-header">
                    <strong>File:</strong> <?= htmlspecialchars($email['file']) ?><br>
                    <strong>Time:</strong> <?= date('Y-m-d H:i:s', $email['time']) ?>
                </div>
                <div class="email-content"><?= htmlspecialchars($email['content']) ?></div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <hr>
    <p><a href="/">← Back to Homepage</a></p>
</body>
</html>