<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'America/Los_Angeles',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=iflyfirstclass',
            'username' => 'root',
            'password' => 'rootroot',
            'charset' => 'utf8',
            'enableSchemaCache' => true,
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,            
            'transport' => [
                'scheme' => 'smtps',
                'host' => '',
                'username' => '',
                'password' => '',
                'port' => 465,
                'dsn' => 'native://default',
            ],
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],
        /*'request' => [
            'baseUrl' => '',
        ],*/
        /*'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => null,
            'rules' => require(__DIR__ . '/rules-url.php'),
        ],*/
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['admin', 'developer'],
        ],
    ],
];
