<?php
use yii\db\Schema;
use yii\db\Migration;

class m151122_171416_create_lookup_contact_category extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyIsam';
    }

    $this->createTable("{{%lkp_contact_category}}", [
      "id" => Schema::TYPE_INTEGER . "(10) UNSIGNED NOT NULL AUTO_INCREMENT",
      "value"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci NOT NULL",
      "idxpos" => Schema::TYPE_INTEGER . "(10) DEFAULT NULL",
      "editable" => Schema::TYPE_SMALLINT ." NOT NULL DEFAULT 1",
      "deleted_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      "created_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      "updated_at" => Schema::TYPE_TIMESTAMP ." NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
      "PRIMARY KEY(id)",
    ], $tableOptions);

    $this->createIndex("lkp_contact_category_value_unique", "{{%lkp_contact_category}}", "value", false);

    $this->insert("{{%lkp_contact_category}}", ['id'=>'1','value'=>'Academics','deleted_at'=>NULL,'created_at'=>'2015-10-18 11:57:04','updated_at'=>'2015-10-18 11:57:04']);
    $this->insert("{{%lkp_contact_category}}", ['id'=>'2','value'=>'Clergy','deleted_at'=>NULL,'created_at'=>'2015-10-18 11:57:04','updated_at'=>'2015-10-18 11:57:04']);
    $this->insert("{{%lkp_contact_category}}", ['id'=>'3','value'=>'NGO/Community Leader','deleted_at'=>NULL,'created_at'=>'2015-10-18 11:57:04','updated_at'=>'2015-10-18 11:57:04']);
    $this->insert("{{%lkp_contact_category}}", ['id'=>'4','value'=>'Judiciary/ Lawyer','deleted_at'=>NULL,'created_at'=>'2015-10-18 11:57:04','updated_at'=>'2015-10-18 11:57:04']);
    $this->insert("{{%lkp_contact_category}}", ['id'=>'5','value'=>'Law Enforcement','deleted_at'=>NULL,'created_at'=>'2015-10-18 11:57:04','updated_at'=>'2015-10-18 11:57:04']);
    $this->insert("{{%lkp_contact_category}}", ['id'=>'6','value'=>'Media','deleted_at'=>NULL,'created_at'=>'2015-10-18 11:57:04','updated_at'=>'2015-10-18 11:57:04']);
    $this->insert("{{%lkp_contact_category}}", ['id'=>'7','value'=>'Student (Master/Grad/Undergrad)','deleted_at'=>NULL,'created_at'=>'2015-10-18 11:57:04','updated_at'=>'2015-10-18 11:57:04']);
    $this->insert("{{%lkp_contact_category}}", ['id'=>'8','value'=>'Other','deleted_at'=>NULL,'created_at'=>'2015-10-18 11:57:04','updated_at'=>'2015-10-18 11:57:04']);
    $this->insert("{{%lkp_contact_category}}", ['id'=>'9','value'=>'Education','deleted_at'=>NULL,'created_at'=>'2015-10-18 11:57:04','updated_at'=>'2015-10-18 11:57:04']);
    $this->insert("{{%lkp_contact_category}}", ['id'=>'10','value'=>'Art/Sports','deleted_at'=>NULL,'created_at'=>'2015-10-18 11:57:04','updated_at'=>'2015-10-18 11:57:04']);
  }

  public function down()
  {
    if (YII_ENV=='dev')
      $this->dropTable('{{%lkp_contact_category}}');
    else
      echo '***** SKIPPED DROPPING {{%lkp_contact_category}} TABLE - NOT DEV SERVER *****';
  }
}
