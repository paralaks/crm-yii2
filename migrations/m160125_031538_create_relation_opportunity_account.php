<?php
use yii\db\Schema;
use yii\db\Migration;

class m160125_031538_create_relation_opportunity_account extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyIsam';
    }

    $this->createTable("{{%rel_opportunity_account}}", [
      "id" => Schema::TYPE_INTEGER . "(10) UNSIGNED NOT NULL AUTO_INCREMENT",
      "opportunity_id" => Schema::TYPE_INTEGER . "(10) unsigned NOT NULL",
      "account_id" => Schema::TYPE_INTEGER . "(10) unsigned NOT NULL",
      "adder_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "owner_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "modifier_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "created_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      "updated_at" => Schema::TYPE_TIMESTAMP ." NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
      "deleted_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      "PRIMARY KEY(id)",
    ], $tableOptions);

    if (YII_ENV!='prod')
    {
      $this->insert("{{%rel_opportunity_account}}", ['id'=>'1','opportunity_id'=>'1','account_id'=>'2','deleted_at'=>'2015-10-31 17:01:21','created_at'=>'2015-10-31 16:38:10']);
      $this->insert("{{%rel_opportunity_account}}", ['id'=>'2','opportunity_id'=>'1','account_id'=>'2','deleted_at'=>NULL,'created_at'=>'2015-11-01 10:12:01']);
    }
  }

  public function down()
  {
    if (YII_ENV=='dev')
      $this->dropTable('{{%rel_opportunity_account}}');
    else
      echo '***** SKIPPED DROPPING {{%rel_opportunity_account}} TABLE - NOT DEV SERVER *****';
  }
}
