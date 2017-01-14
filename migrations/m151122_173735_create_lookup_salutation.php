<?php
use yii\db\Schema;
use yii\db\Migration;

class m151122_173735_create_lookup_salutation extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyIsam';
    }

    $this->createTable("{{%lkp_salutation}}", [
      "id" => Schema::TYPE_INTEGER . "(10) UNSIGNED NOT NULL AUTO_INCREMENT",
      "value"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci NOT NULL",
      "idxpos" => Schema::TYPE_INTEGER . "(10) DEFAULT NULL",
      "editable" => Schema::TYPE_SMALLINT ." NOT NULL DEFAULT 1",
      "deleted_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      "created_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      "updated_at" => Schema::TYPE_TIMESTAMP ." NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
      "PRIMARY KEY(id)",
    ], $tableOptions);

    $this->createIndex("lkp_salutation_value_unique", "{{%lkp_salutation}}", "value", false);

    $this->insert("{{%lkp_salutation}}", ['id'=>'1','value'=>'Mr.','deleted_at'=>NULL,'created_at'=>'2015-05-05 11:27:02','updated_at'=>'2015-05-05 11:27:02']);
    $this->insert("{{%lkp_salutation}}", ['id'=>'2','value'=>'Ms.','deleted_at'=>NULL,'created_at'=>'2015-05-05 11:27:02','updated_at'=>'2015-05-05 11:27:02']);
    $this->insert("{{%lkp_salutation}}", ['id'=>'3','value'=>'Miss','deleted_at'=>NULL,'created_at'=>'2015-05-05 11:27:02','updated_at'=>'2015-05-05 11:27:02']);
    $this->insert("{{%lkp_salutation}}", ['id'=>'4','value'=>'Mrs.','deleted_at'=>NULL,'created_at'=>'2015-05-05 11:27:02','updated_at'=>'2015-05-05 11:27:02']);
    $this->insert("{{%lkp_salutation}}", ['id'=>'5','value'=>'Dr.','deleted_at'=>NULL,'created_at'=>'2015-05-05 11:27:02','updated_at'=>'2015-05-05 11:27:02']);
    $this->insert("{{%lkp_salutation}}", ['id'=>'6','value'=>'Prof.','deleted_at'=>NULL,'created_at'=>'2015-05-05 11:27:02','updated_at'=>'2015-05-05 11:27:02']);
  }

  public function down()
  {
    if (YII_ENV=='dev')
      $this->dropTable('{{%lkp_salutation}}');
    else
      echo '***** SKIPPED DROPPING {{%lkp_salutation}} TABLE - NOT DEV SERVER *****';
  }
}
