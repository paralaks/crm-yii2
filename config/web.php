<?php
$params=require (__DIR__ . '/params.php');

$config=[
  'id' => 'basic',
  'name' => 'CRM',
  'basePath' => dirname(__DIR__),
  'bootstrap' => [
    'log'
  ],
  'components' => [
    'db' => require (DB_CONFIG),
    'request' => [
      // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
      'cookieValidationKey' => 'put_a_random_string_here',
      'parsers' => [
        'application/json' => 'yii\web\JsonParser',
      ]
    ],
    'assetManager' => [
      'appendTimestamp' => true,
    ],
    'cache' => [
      'class' => 'yii\caching\FileCache',
      //'class' => 'yii\caching\DbCache',
      // 'db' => 'db',
      // 'cacheTable' => 'yii_cache',
    ],
    'user' => [
      'identityClass' => 'app\models\User',
      'enableAutoLogin' => false,
      'authTimeout' => 3600,
      'absoluteAuthTimeoutParam' => '_identity',
    ],
    'errorHandler' => [
      'errorAction' => 'site/error'
    ],
    'mailer' => [
      // send all mails to a file by default. You have to set 'useFileTransport' to false and configure a transport for the mailer to send real emails.
      'class' => 'yii\swiftmailer\Mailer',
      'useFileTransport' => YII_ENV=='dev' ? true : false,
    ],
    'log' => [
      'traceLevel' => YII_DEBUG ? 3 : 0,
      'targets' => [
        [
          'class' => 'yii\log\FileTarget',
          'levels' => [
            'error',
            'warning'
          ]
        ]
      ]
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
    'urlManager' => [
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      'enableStrictParsing' => false,
      'rules' => [
          // REST rules
          ['class' => 'yii\rest\UrlRule', 'pluralize'=>false, 'controller' => 'restv1/leads'],
          ['class' => 'yii\rest\UrlRule', 'pluralize'=>false, 'controller' => 'restv1/contacts'],

          // HTML rules
          '<controller:\w+>/<id:\d+>' => '<controller>/view',
          '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
          '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
          // if strict parsing is true; uncomment below
          // '<controller:\w+>' => '<controller>/index',
          // '/' => '/site/login',
      ]
    ],
    'authManager' => [
      // 'class' => 'yii\rbac\DbManager',
      // superchaching below: 60 second timeout + per request caching
      'class' => 'app\helpers\AppDbManager',
      'cache' => 'yii\caching\FileCache'
    ],
    'appHelper' => [
      'class' => 'app\helpers\AppHelper'
    ]
  ]
  ,
  'params' => $params,
  'modules' => [
    'admin' => [
      'class' => 'mdm\admin\Module',
      'layout' => '@app/views/layouts/admin'
    ]
  ],
  'as access' => [
    'class' => 'mdm\admin\components\AccessControl',
    'allowActions' => [
      'site/login',
      'site/reset-password-request',
      'site/reset-password',
      'restv1/*',
    ]
  ]
];

if (YII_ENV=='dev')
{
  // configuration adjustments for 'dev' environment
  $config['bootstrap'][]='debug';
  $config['modules']['debug']='yii\debug\Module';

  $config['bootstrap'][]='gii';
  $config['modules']['gii']='yii\gii\Module';
}

return $config;
