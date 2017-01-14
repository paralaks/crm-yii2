<?php

use yii\db\Schema;
use yii\db\Migration;

class m151122_174422_create_lookup_social_media extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyIsam';
    }

    $this->createTable("{{%lkp_social_media}}", [
      "id" => Schema::TYPE_INTEGER . "(10) UNSIGNED NOT NULL AUTO_INCREMENT",
      "value"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci NOT NULL",
      "idxpos" => Schema::TYPE_INTEGER . "(10) DEFAULT NULL",
      "editable" => Schema::TYPE_SMALLINT ." NOT NULL DEFAULT 1",
      "deleted_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      "created_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      "updated_at" => Schema::TYPE_TIMESTAMP ." NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
      "PRIMARY KEY(id)",
    ], $tableOptions);

    $this->createIndex("lkp_social_media_value_unique", "{{%lkp_social_media}}", "value", false);

    $this->insert("{{%lkp_social_media}}", ['id'=>'1','value'=>'facebook', 'editable'=>0, 'deleted_at'=>NULL,'created_at'=>'2016-01-24 11:27:02','updated_at'=>'2016-01-24 11:27:02']);
    $this->insert("{{%lkp_social_media}}", ['id'=>'2','value'=>'twitter', 'editable'=>0,'deleted_at'=>NULL,'created_at'=>'2016-01-24 11:27:02','updated_at'=>'2016-01-24 11:27:02']);
    $this->insert("{{%lkp_social_media}}", ['id'=>'3','value'=>'linkedin', 'editable'=>0,'deleted_at'=>NULL,'created_at'=>'2016-01-24 11:27:02','updated_at'=>'2016-01-24 11:27:02']);
    $this->insert("{{%lkp_social_media}}", ['id'=>'4','value'=>'instagram', 'editable'=>0,'deleted_at'=>NULL,'created_at'=>'2016-01-24 11:27:02','updated_at'=>'2016-01-24 11:27:02']);
    $this->insert("{{%lkp_social_media}}", ['id'=>'5','value'=>'pinterest', 'editable'=>0,'deleted_at'=>NULL,'created_at'=>'2016-01-24 11:27:02','updated_at'=>'2016-01-24 11:27:02']);
    $this->insert("{{%lkp_social_media}}", ['id'=>'6','value'=>'youtube', 'editable'=>0,'deleted_at'=>NULL,'created_at'=>'2016-01-24 11:27:02','updated_at'=>'2016-01-24 11:27:02']);
    $this->insert("{{%lkp_social_media}}", ['id'=>'7','value'=>'vine', 'editable'=>0,'deleted_at'=>NULL,'created_at'=>'2016-01-24 11:27:02','updated_at'=>'2016-01-24 11:27:02']);
    $this->insert("{{%lkp_social_media}}", ['id'=>'8','value'=>'googleplus', 'editable'=>0,'deleted_at'=>NULL,'created_at'=>'2016-01-24 11:27:02','updated_at'=>'2016-01-24 11:27:02']);
  }

  public function down()
  {
    if (YII_ENV=='dev')
      $this->dropTable('{{%lkp_social_media}}');
    else
      echo '***** SKIPPED DROPPING {{%lkp_social_media}} TABLE - NOT DEV SERVER *****';
  }
}
