<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=crm_yii',
    'username' => 'crm-yii',
    'password' => 'crm-yii-pass',
    'charset' => 'utf8',
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 600 * 24,
    'schemaCache' => 'cache',
];
