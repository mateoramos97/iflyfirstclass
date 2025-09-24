<?php
// Production configuration for GoDaddy hosting
// This file should be renamed to main-local.php on the production server

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=gineex',
            'username' => 'gineex',
            'password' => 'Ax4N+30e]66)',
            'charset' => 'utf8',
            'enableSchemaCache' => true,
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'dsn' => 'sendmail://default',
            ],
            'messageConfig' => [
                'charset' => 'UTF-8',
                'from' => ['info@iflyfirstclass.com' => 'IFlyFirstClass'],
            ],
        ],
    ],
];
