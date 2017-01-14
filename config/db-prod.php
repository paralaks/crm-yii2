<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=crm_yii_prod',
    'username' => 'crm-yii-prod',
    'password' => 'crm-yii-prod-pass',
    'charset' => 'utf8',
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 600 * 24,
    'schemaCache' => 'cache',
];
