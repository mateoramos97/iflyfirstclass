<?php
return [
    'adminEmail' => 'dmitry@flyfirst.com',
    'emailFrom' => 'info@flyfirst.com',
    'docRoot' => realpath(dirname(__FILE__).'/../'),
    'emailAsyncToken' => 'iflyfirstclass-async-email-2025-secret-' . uniqid(), // Change this to a secure random string
];
