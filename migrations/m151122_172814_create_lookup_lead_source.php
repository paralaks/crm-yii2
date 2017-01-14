<?php
use yii\db\Schema;
use yii\db\Migration;

class m151122_172814_create_lookup_lead_source extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyIsam';
    }

    $this->createTable("{{%lkp_lead_source}}", [
      "id" => Schema::TYPE_INTEGER . "(10) UNSIGNED NOT NULL AUTO_INCREMENT",
      "value"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci NOT NULL",
      "idxpos" => Schema::TYPE_INTEGER . "(10) DEFAULT NULL",
      "editable" => Schema::TYPE_SMALLINT ." NOT NULL DEFAULT 1",
      "deleted_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      "created_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      "updated_at" => Schema::TYPE_TIMESTAMP ." NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
      "PRIMARY KEY(id)",
    ], $tableOptions);

    $this->createIndex("lkp_lead_source_value_unique", "{{%lkp_lead_source}}", "value", false);

    $this->insert("{{%lkp_lead_source}}", ['id'=>'1','value'=>'Web','deleted_at'=>NULL,'created_at'=>'2015-10-18 14:17:00','updated_at'=>'2015-10-18 14:17:00']);
    $this->insert("{{%lkp_lead_source}}", ['id'=>'2','value'=>'Phone Inquiry','deleted_at'=>NULL,'created_at'=>'2015-10-18 14:17:00','updated_at'=>'2015-10-18 14:17:00']);
    $this->insert("{{%lkp_lead_source}}", ['id'=>'3','value'=>'Activity Signup','deleted_at'=>NULL,'created_at'=>'2015-10-18 14:17:00','updated_at'=>'2015-10-18 14:17:00']);
    $this->insert("{{%lkp_lead_source}}", ['id'=>'4','value'=>'Partner Referral','deleted_at'=>NULL,'created_at'=>'2015-10-18 14:17:00','updated_at'=>'2015-10-18 14:17:00']);
    $this->insert("{{%lkp_lead_source}}", ['id'=>'5','value'=>'Product Purchase','deleted_at'=>NULL,'created_at'=>'2015-10-18 14:17:00','updated_at'=>'2015-10-18 14:17:00']);
    $this->insert("{{%lkp_lead_source}}", ['id'=>'6','value'=>'Purchased List','deleted_at'=>NULL,'created_at'=>'2015-10-18 14:17:00','updated_at'=>'2015-10-18 14:17:00']);
    $this->insert("{{%lkp_lead_source}}", ['id'=>'7','value'=>'Other','deleted_at'=>NULL,'created_at'=>'2015-10-18 14:17:00','updated_at'=>'2015-10-18 14:17:00']);
  }

  public function down()
  {
    if (YII_ENV=='dev')
      $this->dropTable('{{%lkp_lead_source}}');
    else
      echo '***** SKIPPED DROPPING {{%lkp_lead_source}} TABLE - NOT DEV SERVER *****';
  }
}
