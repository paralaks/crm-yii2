<?php

Yii::setAlias('@tests', dirname(__DIR__) . '/tests');

$params = require(__DIR__ . '/params.php');
$db = require(DB_CONFIG);

return [
  'id' => 'basic-console',
  'basePath' => dirname(__DIR__),
  'bootstrap' => ['log', 'gii'],
  'controllerNamespace' => 'app\commands',
  'modules' => [
    'gii' => 'yii\gii\Module',
  ],
  'components' => [
    'cache' => [
      'class' => 'yii\caching\FileCache',
    ],
    'log' => [
      'targets' => [
        [
          'class' => 'yii\log\FileTarget',
          'levels' => ['error', 'warning'],
        ],
      ],
    ],
    'db' => $db,
    'authManager' => ['class' => 'yii\rbac\DbManager'],
    'appHelper' => [
      'class' => 'app\helpers\AppHelper'
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
