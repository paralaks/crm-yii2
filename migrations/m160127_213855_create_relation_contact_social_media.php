<?php
use yii\db\Schema;
use yii\db\Migration;

class m160127_213855_create_relation_contact_social_media extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyIsam';
    }

    $this->createTable("{{%rel_contact_social_media}}", [
      "id" => Schema::TYPE_INTEGER . "(10) UNSIGNED NOT NULL AUTO_INCREMENT",
      "contact_id" => Schema::TYPE_INTEGER . "(10) unsigned NOT NULL",
      "social_media_id" => Schema::TYPE_INTEGER . "(10) unsigned NOT NULL",
      "value"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci NOT NULL",
      "adder_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "deleted_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      "created_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      "PRIMARY KEY(id)",
    ], $tableOptions);


    if (YII_ENV!='prod')
    {
      $this->insert("{{%rel_contact_social_media}}", ['id'=>'1','contact_id'=>'1','social_media_id'=>'1','value'=>'https://www.youtube.com/','adder_id'=>'1','deleted_at'=>NULL,'created_at'=>'2016-01-25 17:35:15']);
      $this->insert("{{%rel_contact_social_media}}", ['id'=>'2','contact_id'=>'1','social_media_id'=>'3','value'=>'https://www.youtube.com/','adder_id'=>'2','deleted_at'=>NULL,'created_at'=>'2016-01-25 17:35:55']);
      $this->insert("{{%rel_contact_social_media}}", ['id'=>'3','contact_id'=>'1','social_media_id'=>'5','value'=>'https://www.youtube.com/','adder_id'=>'3','deleted_at'=>NULL,'created_at'=>'2016-01-25 19:00:25']);
    }
  }

  public function down()
  {
    if (YII_ENV=='dev')
      $this->dropTable('{{%rel_contact_social_media}}');
    else
      echo '***** SKIPPED DROPPING {{%rel_contact_social_media}} TABLE - NOT DEV SERVER *****';
  }
}
