<?php
use yii\db\Schema;
use yii\db\Migration;

class m151122_170331_create_lookup_account_type extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyIsam';
    }

    $this->createTable("{{%lkp_account_type}}", [
      "id" => Schema::TYPE_INTEGER . "(10) UNSIGNED NOT NULL AUTO_INCREMENT",
      "value"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci NOT NULL",
      "idxpos" => Schema::TYPE_INTEGER . "(10) DEFAULT NULL",
      "editable" => Schema::TYPE_SMALLINT ." NOT NULL DEFAULT 1",
      "deleted_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      "created_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      "updated_at" => Schema::TYPE_TIMESTAMP ." NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
      "PRIMARY KEY(id)",
    ], $tableOptions);

    $this->createIndex("lkp_account_type_value_unique", "{{%lkp_account_type}}", "value", false);

    $this->insert("{{%lkp_account_type}}", ['id'=>'1','value'=>'Prospect','deleted_at'=>NULL,'created_at'=>'2015-05-05 11:27:02','updated_at'=>'2015-05-05 11:27:02']);
    $this->insert("{{%lkp_account_type}}", ['id'=>'2','value'=>'Active','deleted_at'=>NULL,'created_at'=>'2015-05-05 11:27:02','updated_at'=>'2015-05-05 11:27:02']);
    $this->insert("{{%lkp_account_type}}", ['id'=>'3','value'=>'Inactive','deleted_at'=>NULL,'created_at'=>'2015-05-05 11:27:02','updated_at'=>'2015-05-05 11:27:02']);
    $this->insert("{{%lkp_account_type}}", ['id'=>'4','value'=>'Expired','deleted_at'=>NULL,'created_at'=>'2015-05-05 11:27:02','updated_at'=>'2015-05-05 11:27:02']);
    $this->insert("{{%lkp_account_type}}", ['id'=>'5','value'=>'Reseller','deleted_at'=>NULL,'created_at'=>'2015-05-05 11:27:02','updated_at'=>'2015-05-05 11:27:02']);
    $this->insert("{{%lkp_account_type}}", ['id'=>'6','value'=>'Partner','deleted_at'=>NULL,'created_at'=>'2015-05-05 11:27:02','updated_at'=>'2015-05-05 11:27:02']);
    $this->insert("{{%lkp_account_type}}", ['id'=>'7','value'=>'Other','deleted_at'=>NULL,'created_at'=>'2015-05-05 11:27:02','updated_at'=>'2015-05-05 11:27:02']);
  }

  public function down()
  {
    if (YII_ENV=='dev')
      $this->dropTable('{{%lkp_account_type}}');
    else
      echo '***** SKIPPED DROPPING {{%lkp_account_type}} TABLE - NOT DEV SERVER *****';
  }
}
