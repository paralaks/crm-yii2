<?php

use yii\db\Schema;
use yii\db\Migration;

class m151102_000902_create_users_table extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyIsam';
    }

    $this->createTable('{{%users}}', [
      'id' => Schema::TYPE_PK,
      'username' => Schema::TYPE_STRING . '(255) NOT NULL',
      'name' => Schema::TYPE_STRING . '(75) NOT NULL',
      'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
      'password_hash' => Schema::TYPE_STRING . '(60) NOT NULL',
      'password_reset_token' => Schema::TYPE_STRING.'(60)',
      'email' => Schema::TYPE_STRING . '(255) NOT NULL',
      'access_token' => Schema::TYPE_STRING . '(60) NOT NULL', // REST API access
      'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
      "owner_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "adder_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "modifier_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "login_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      'deleted_at' => Schema::TYPE_DATETIME . ' NULL DEFAULT NULL',
      'created_at' => Schema::TYPE_DATETIME . ' NULL DEFAULT NULL',
      'updated_at' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
    ], $tableOptions);

  }

  public function down()
  {
    if (YII_ENV=='dev')
      $this->dropTable('{{%users}}');
    else
      echo '***** SKIPPED DROPPING {{%users}} TABLE - NOT DEV SERVER *****';
  }
}

