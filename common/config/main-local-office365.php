<?php

return [
    'components' => [
        'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'scheme' => 'smtp',
                'host' => 'smtp.office365.com',
                'username' => 'info@iflyfirstclass.com',
                'password' => 'Iflyfirstclass#1',  // Replace with your actual password
                'port' => 587,
                'encryption' => 'tls',
            ],
        ],
    ],
];
