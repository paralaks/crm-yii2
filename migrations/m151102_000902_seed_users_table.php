<?php
use yii\db\Migration;

class m151102_000902_seed_users_table extends Migration
{

  public function up()
  {
    $this->insert("{{%users}}",
    ['id' => '1',
      'username' => 'admin@crm-yii.com',
      'name' => 'Admin User',
      'auth_key' => Yii::$app->security->generateRandomString(),
      'password_hash' => Yii::$app->security->generatePasswordHash('admin123'),
      'password_reset_token' => NULL,
      'email' => 'admin@crm-yii.com',
      'status' => '1',
      'deleted_at' => NULL,
      'created_at' => '2016-11-21 16:53:15',
      'updated_at' => '2016-11-21 16:59:39']);

    if (YII_ENV != 'prod')
    {
      $this->insert("{{%users}}",
      ['id' => '2',
        'username' => 'manager@crm-yii.com',
        'name' => 'Manager User',
        'auth_key' => Yii::$app->security->generateRandomString(),
        'password_hash' => Yii::$app->security->generatePasswordHash('manager123'),
        'password_reset_token' => NULL,
        'email' => 'manager@crm-yii.com',
        'status' => '1',
        'deleted_at' => NULL,
        'created_at' => '2016-11-21 16:53:15',
        'updated_at' => '2016-11-21 16:59:41']);

      $this->insert("{{%users}}",
      ['id' => '3',
        'username' => 'user@crm-yii.com',
        'name' => 'Basic User',
        'auth_key' => Yii::$app->security->generateRandomString(),
        'password_hash' => Yii::$app->security->generatePasswordHash('user123'),
        'password_reset_token' => NULL,
        'email' => 'user@crm-yii.com',
        'status' => '1',
        'deleted_at' => NULL,
        'created_at' => '2016-11-21 16:53:15',
        'updated_at' => '2016-11-21 16:59:41']);
    }
  }

  public function down()
  {
  }
}

