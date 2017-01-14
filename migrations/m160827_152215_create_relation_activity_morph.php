<?php
use yii\db\Schema;
use yii\db\Migration;
use yii\helpers\Console;

class m160827_152215_create_relation_activity_morph extends Migration
{

  public function up()
  {
    $tableOptions=null;
    if ($this->db->driverName === 'mysql')
    {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions='CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyIsam';
    }

    $this->createTable("{{%rel_activity_morph}}",
    ["id" => Schema::TYPE_INTEGER . "(11) UNSIGNED NOT NULL AUTO_INCREMENT",
      "activity_id" => Schema::TYPE_INTEGER . "(10) unsigned NOT NULL",
      "related_type_id" => Schema::TYPE_SMALLINT . " unsigned NOT NULL default 0",
      "related_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "owner_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "adder_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "modifier_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "deleted_at" => Schema::TYPE_DATETIME . " DEFAULT NULL",
      "created_at" => Schema::TYPE_DATETIME . " DEFAULT NULL",
      "updated_at" => Schema::TYPE_TIMESTAMP . " NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
      "PRIMARY KEY(id)"], $tableOptions);

    $this->createIndex("Index 2", "{{%rel_activity_morph}}", "activity_id,related_type_id,related_id", false);

    // add some test data
    if (YII_ENV != 'prod')
    {
      $this->insert("{{%rel_activity_morph}}",
      ['activity_id' => '1',
       'related_id' => '1',
       'related_type_id' => '3',
       'adder_id' => '1',
       'owner_id' => '1',
       'modifier_id' => '1',
       'deleted_at' => NULL,
       'created_at' => '2015-10-18 11:13:06',
       'updated_at' => '2015-10-18 11:13:06']);

      $this->insert("{{%rel_activity_morph}}",
      ['activity_id' => '1',
       'related_id' => '1',
       'related_type_id' => '2',
       'adder_id' => '1',
       'owner_id' => '1',
       'modifier_id' => '1',
       'deleted_at' => NULL,
       'created_at' => '2015-10-18 11:13:06',
       'updated_at' => '2015-10-18 11:13:06']);
    }

    // migrate existing activities to new relations
    $query='';
    try
    {
      foreach (['contact', 'account', 'opportunity'] as $type)
      {
        $query="INSERT INTO {{%rel_activity_morph}}(activity_id, related_type_id, related_id, owner_id, adder_id, modifier_id, deleted_at, created_at, updated_at)
          SELECT id, '".Yii::$app->appHelper->getRelatedTypeId($type)."', related_id, owner_id, adder_id, modifier_id, deleted_at, created_at, updated_at
          FROM {{%activities}} WHERE related_type='$type'";
        $this->execute($query);
      }

      Console::stdout(Console::ansiFormat("SUCCESS Existing activities migrated to the new relation successfully\n", [Console::FG_GREEN]));
    }
    catch (\Exception $e)
    {
      Console::stdout(Console::ansiFormat("ERROR with query: $query\n".$e->getMessage()."\n".$e->getTraceAsString()."\n", [Console::FG_RED]));
    }
  }

  public function down()
  {
    if (YII_ENV=='dev')
      $this->dropTable('{{%rel_activity_morph}}');
    else
      echo '***** SKIPPED DROPPING {{%rel_activity_morph}} TABLE - NOT DEV SERVER *****';
  }
}