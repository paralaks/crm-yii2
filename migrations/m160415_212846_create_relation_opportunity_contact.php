<?php
use yii\db\Schema;
use yii\db\Migration;

class m160415_212846_create_relation_opportunity_contact extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyIsam';
    }

    $this->createTable("{{%rel_opportunity_contact}}", [
      "id" => Schema::TYPE_INTEGER . "(10) UNSIGNED NOT NULL AUTO_INCREMENT",
      "opportunity_id" => Schema::TYPE_INTEGER . "(10) unsigned NOT NULL",
      "contact_id" => Schema::TYPE_INTEGER . "(10) unsigned NOT NULL",
      "stage_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "adder_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "owner_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "modifier_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "deleted_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      "created_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      "updated_at" => Schema::TYPE_TIMESTAMP ." NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
      "PRIMARY KEY(id)",
    ], $tableOptions);

    if (YII_ENV!='prod')
    {
      $this->insert("{{%rel_opportunity_contact}}", ['id'=>'1','opportunity_id'=>'1','contact_id'=>'1', 'stage_id'=>'1', 'adder_id'=>'1', 'modifier_id'=>'2', 'owner_id'=>'2', 'deleted_at'=>'2015-10-31 17:01:21','created_at'=>'2015-10-31 16:38:10']);
      $this->insert("{{%rel_opportunity_contact}}", ['id'=>'2','opportunity_id'=>'1','contact_id'=>'2', 'stage_id'=>'2', 'adder_id'=>'1', 'modifier_id'=>'2', 'owner_id'=>'2', 'deleted_at'=>NULL,'created_at'=>'2015-11-01 10:12:01']);
      $this->insert("{{%rel_opportunity_contact}}", ['id'=>'3','opportunity_id'=>'1','contact_id'=>'3', 'stage_id'=>'3', 'adder_id'=>'1', 'modifier_id'=>'2', 'owner_id'=>'2', 'deleted_at'=>NULL,'created_at'=>'2015-11-01 10:12:01']);
      $this->insert("{{%rel_opportunity_contact}}", ['id'=>'4','opportunity_id'=>'1','contact_id'=>'4', 'stage_id'=>'4', 'adder_id'=>'1', 'modifier_id'=>'2', 'owner_id'=>'2', 'deleted_at'=>NULL,'created_at'=>'2015-11-01 10:12:01']);
      $this->insert("{{%rel_opportunity_contact}}", ['id'=>'5','opportunity_id'=>'1','contact_id'=>'5', 'stage_id'=>'5', 'adder_id'=>'1', 'modifier_id'=>'2', 'owner_id'=>'2', 'deleted_at'=>NULL,'created_at'=>'2015-11-01 10:12:01']);
      $this->insert("{{%rel_opportunity_contact}}", ['id'=>'6','opportunity_id'=>'1','contact_id'=>'6', 'stage_id'=>'1', 'adder_id'=>'1', 'modifier_id'=>'2', 'owner_id'=>'2', 'deleted_at'=>NULL,'created_at'=>'2015-11-01 10:12:01']);
      $this->insert("{{%rel_opportunity_contact}}", ['id'=>'7','opportunity_id'=>'1','contact_id'=>'7', 'stage_id'=>'2', 'adder_id'=>'1', 'modifier_id'=>'2', 'owner_id'=>'2', 'deleted_at'=>NULL,'created_at'=>'2015-11-01 10:12:01']);
      $this->insert("{{%rel_opportunity_contact}}", ['id'=>'8','opportunity_id'=>'1','contact_id'=>'8', 'stage_id'=>'3', 'adder_id'=>'1', 'modifier_id'=>'2', 'owner_id'=>'2', 'deleted_at'=>NULL,'created_at'=>'2015-11-01 10:12:01']);
      $this->insert("{{%rel_opportunity_contact}}", ['id'=>'9','opportunity_id'=>'1','contact_id'=>'9', 'stage_id'=>'4', 'adder_id'=>'1', 'modifier_id'=>'2', 'owner_id'=>'2', 'deleted_at'=>NULL,'created_at'=>'2015-11-01 10:12:01']);
      $this->insert("{{%rel_opportunity_contact}}", ['id'=>'10','opportunity_id'=>'1','contact_id'=>'10', 'stage_id'=>'5', 'adder_id'=>'1', 'modifier_id'=>'2', 'owner_id'=>'2', 'deleted_at'=>NULL,'created_at'=>'2015-11-01 10:12:01']);
      $this->insert("{{%rel_opportunity_contact}}", ['id'=>'11','opportunity_id'=>'1','contact_id'=>'11', 'stage_id'=>'1', 'adder_id'=>'1', 'modifier_id'=>'2', 'owner_id'=>'2', 'deleted_at'=>NULL,'created_at'=>'2015-11-01 10:12:01']);
    }
  }

  public function down()
  {
    if (YII_ENV=='dev')
      $this->dropTable('{{%rel_opportunity_contact}}');
    else
      echo '***** SKIPPED DROPPING {{%rel_opportunity_contact}} TABLE - NOT DEV SERVER *****';
  }
}
