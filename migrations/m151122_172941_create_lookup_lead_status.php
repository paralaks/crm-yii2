<?php
use yii\db\Schema;
use yii\db\Migration;

class m151122_172941_create_lookup_lead_status extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyIsam';
    }

    $this->createTable("{{%lkp_lead_status}}", [
      "id" => Schema::TYPE_INTEGER . "(10) UNSIGNED NOT NULL AUTO_INCREMENT",
      "value"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci NOT NULL",
      "idxpos" => Schema::TYPE_INTEGER . "(10) DEFAULT NULL",
      "editable" => Schema::TYPE_SMALLINT ." NOT NULL DEFAULT 1",
      "deleted_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      "created_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      "updated_at" => Schema::TYPE_TIMESTAMP ." NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
      "PRIMARY KEY(id)",
    ], $tableOptions);

    $this->createIndex("lkp_lead_status_value_unique", "{{%lkp_lead_status}}", "value", false);

    $this->insert("{{%lkp_lead_status}}", ['id'=>'1','value'=>'Open - Not Contacted','deleted_at'=>NULL,'created_at'=>'2015-05-05 11:27:02','updated_at'=>'2015-05-05 11:27:02']);
    $this->insert("{{%lkp_lead_status}}", ['id'=>'2','value'=>'Working - Contacted','deleted_at'=>NULL,'created_at'=>'2015-05-05 11:27:02','updated_at'=>'2015-05-05 11:27:02']);
    $this->insert("{{%lkp_lead_status}}", ['id'=>'3','value'=>'Closed - Converted','deleted_at'=>NULL,'created_at'=>'2015-05-05 11:27:02','updated_at'=>'2015-05-05 11:27:02']);
    $this->insert("{{%lkp_lead_status}}", ['id'=>'4','value'=>'Closed - Not Converted','deleted_at'=>NULL,'created_at'=>'2015-05-05 11:27:02','updated_at'=>'2015-05-05 11:27:02']);
  }

  public function down()
  {
    if (YII_ENV=='dev')
      $this->dropTable('{{%lkp_lead_status}}');
    else
      echo '***** SKIPPED DROPPING {{%lkp_lead_status}} TABLE - NOT DEV SERVER *****';
  }
}
