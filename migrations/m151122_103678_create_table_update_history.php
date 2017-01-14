<?php
use yii\db\Schema;
use yii\db\Migration;

class m151122_103678_create_table_update_history extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyIsam';
    }

    $this->createTable("{{%_update_history_}}", [
      "id" => Schema::TYPE_BIGINT . "(20) UNSIGNED NOT NULL AUTO_INCREMENT",
      "model" => "CHAR(75) COLLATE utf8_unicode_ci NOT NULL",
      "model_id" => Schema::TYPE_BIGINT . "(20) NOT NULL",
      "user_id" => Schema::TYPE_BIGINT . "(20) NOT NULL",
      "fields" => Schema::TYPE_TEXT . " COLLATE utf8_unicode_ci NOT NULL",
      "created_at" => Schema::TYPE_TIMESTAMP ." NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
      "PRIMARY KEY(id)",
    ], $tableOptions);

    $this->createIndex("Index 2", "{{%_update_history_}}", "model_id,model", false);

    if (YII_ENV!='prod')
    {
      $this->insert("{{%_update_history_}}", ['id'=>'1','model'=>'Account','model_id'=>'1','user_id'=>'1','fields'=>'a:5:{s:11:"description";a:2:{i:0;s:84:" South Korean multinational electronics company headquartered in Suwon, South Korea.";i:1;s:90:" South Korean multinational electronics company headquartered in Suwon, South Korea, Asia.";}s:14:"lead_source_id";a:2:{i:0;s:1:"3";i:1;s:1:"4";}s:7:"type_id";a:2:{i:0;s:1:"5";i:1;s:1:"3";}s:9:"rating_id";a:2:{i:0;s:1:"1";i:1;s:1:"2";}s:8:"owner_id";a:2:{i:0;s:1:"2";i:1;s:1:"1";}}','created_at'=>'2015-11-22 12:50:37']);
    }
  }

  public function down()
  {
    if (YII_ENV=='dev')
      $this->dropTable('{{%_update_history_}}');
    else
      echo '***** SKIPPED DROPPING {{%_update_history_}} TABLE - NOT DEV SERVER *****';
  }
}
