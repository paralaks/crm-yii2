<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=crm_yii_stage',
    'username' => 'crm-yii-stage',
    'password' => 'crm-yii-stage-pass',
    'charset' => 'utf8',
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 600 * 24,
    'schemaCache' => 'cache',
  ];
