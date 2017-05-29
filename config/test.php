<?php
$params = require(__DIR__ . '/params.php');
$dbParams = require(__DIR__ . '/db.php');

/**
 * Application configuration shared by all test types
 */
return [
    'id' => 'basic-tests',
    'basePath' => dirname(__DIR__),
    'language' => 'en-US',
    'components' => [
        'cache' => [
          'class' => 'yii\caching\FileCache',
        ],
        'db' => $dbParams,
        'mailer' => [
            'useFileTransport' => true,
        ],
        'assetManager' => [
            'basePath' => __DIR__ . '/../web/assets',
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
        'appHelper' => [
          'class' => 'app\helpers\AppHelper'
        ],
        'user' => [
            'identityClass' => 'app\models\User',
        ],
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
            // but if you absolutely need it set cookie domain to localhost
            /*
            'csrfCookie' => [
                'domain' => 'localhost',
            ],
            */
        ],
        'i18n' => [
        'translations' => [
          'main' => [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@app/translations', // if advanced application, set @frontend/messages
            'sourceLanguage' => 'en',
            'fileMap' => [
              'main' => 'main.php'
            ]
          ]
        ]
      ],
    ],
    'params' => $params,
];
