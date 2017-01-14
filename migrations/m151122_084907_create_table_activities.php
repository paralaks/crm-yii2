<?php
use yii\db\Schema;
use yii\db\Migration;

class m151122_084907_create_table_activities extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyIsam';
    }

    $this->createTable("{{%activities}}", [
      "id" => Schema::TYPE_BIGINT . "(20) UNSIGNED NOT NULL AUTO_INCREMENT",
      "subject"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci NOT NULL",
      "location"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci NOT NULL",
      "start_date" => Schema::TYPE_DATE ." DEFAULT NULL",
      "end_date" => Schema::TYPE_DATE ." DEFAULT NULL",
      "description" => Schema::TYPE_TEXT . " COLLATE utf8_unicode_ci",
      "allday" => Schema::TYPE_SMALLINT. "(5) unsigned DEFAULT NULL",
      "remind_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      "type_id" => Schema::TYPE_SMALLINT. "(5) unsigned DEFAULT NULL",
      "priority_id" => Schema::TYPE_SMALLINT. "(5) unsigned DEFAULT NULL",
      "status_id" => Schema::TYPE_SMALLINT. "(5) unsigned DEFAULT NULL",
      "related_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "related_type"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "owner_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "adder_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "modifier_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "deleted_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      "created_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      "updated_at" => Schema::TYPE_TIMESTAMP ." NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
      "PRIMARY KEY(id)",
    ], $tableOptions);

    $this->createIndex("Index 2", "{{%activities}}", "related_id,related_type", false);
  }

  public function down()
  {
    if (YII_ENV=='dev')
      $this->dropTable('{{%activities}}');
    else
      echo '***** SKIPPED DROPPING {{%activities}} TABLE - NOT DEV SERVER *****';
  }
}
