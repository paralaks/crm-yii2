<?php
use yii\db\Schema;
use yii\db\Migration;

class m151122_055445_create_table_opportunities extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyIsam';
    }

    $this->createTable("{{%opportunities}}", [
      "id" => Schema::TYPE_INTEGER . "(11) UNSIGNED NOT NULL AUTO_INCREMENT",
      "name"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci NOT NULL",
      "amount" => Schema::TYPE_DECIMAL. "(12,2) DEFAULT NULL",
      "close_date" => Schema::TYPE_DATE ." NOT NULL",
      "expected_revenue" => Schema::TYPE_DECIMAL. "(12,2) DEFAULT NULL",
      "next_step"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "probability" => Schema::TYPE_SMALLINT. "(6) NOT NULL",
      "competitors"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "description" => Schema::TYPE_TEXT . " COLLATE utf8_unicode_ci",
      "lead_source_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "stage_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "type_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "contact_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "owner_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "adder_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "modifier_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "deleted_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      "created_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      "updated_at" => Schema::TYPE_TIMESTAMP ." NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
      "PRIMARY KEY(id)",
    ], $tableOptions);


    if (YII_ENV!='prod')
    {
      $this->insert("{{%opportunities}}", ['id'=>'1','name'=>'7" Amoled Screen','amount'=>'250000.00','close_date'=>'2020-06-01','expected_revenue'=>'2000000.00','next_step'=>'Contact them to dicuss shipment requirements','probability'=>'75','competitors'=>'Sharp, Philips','description'=>'7" HD screens','lead_source_id'=>'3','stage_id'=>'1','type_id'=>'1','contact_id'=>'1','owner_id'=>'1','adder_id'=>'1','modifier_id'=>'1','deleted_at'=>NULL,'created_at'=>'2015-05-05 11:27:02','updated_at'=>'2015-05-05 11:27:02']);
      $this->insert("{{%opportunities}}", ['id'=>'2','name'=>'55" LED TV','amount'=>'10000.00','close_date'=>'2017-10-12','expected_revenue'=>'3000000.00','next_step'=>'','probability'=>'75','competitors'=>'LG, Vizio','description'=>'','lead_source_id'=>'2','stage_id'=>'2','type_id'=>'1','contact_id'=>'2','owner_id'=>'2','adder_id'=>'2','modifier_id'=>'2','deleted_at'=>NULL,'created_at'=>'2015-05-05 11:27:02','updated_at'=>'2015-05-05 11:27:02']);
      $this->insert("{{%opportunities}}", ['id'=>'3','name'=>'12" Touchscreen Display','amount'=>'25000.00','close_date'=>'2017-10-02','expected_revenue'=>'5000000.00','next_step'=>'','probability'=>'90','competitors'=>'Toshiba, Nec','description'=>'','lead_source_id'=>'1','stage_id'=>'2','type_id'=>'1','contact_id'=>'3','owner_id'=>'1','adder_id'=>'2','modifier_id'=>'1','deleted_at'=>NULL,'created_at'=>'2015-05-05 11:27:02','updated_at'=>'2015-05-05 11:27:02']);
    }
  }

  public function down()
  {
    if (YII_ENV=='dev')
      $this->dropTable('{{%opportunities}}');
    else
      echo '***** SKIPPED DROPPING {{%opportunities}} TABLE - NOT DEV SERVER *****';
  }
}
