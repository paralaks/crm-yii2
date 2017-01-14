<?php

use yii\db\Schema;
use yii\db\Migration;

class m160207_190940_alter_table_all_lookups_add_description extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyIsam';
    }

    $this->addColumn("{{%lkp_account_ownership}}", "description" , Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL after idxpos");
    $this->addColumn("{{%lkp_account_type}}", "description" , Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL after idxpos");
    $this->addColumn("{{%lkp_activity_priority}}", "description" , Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL after idxpos");
    $this->addColumn("{{%lkp_activity_status}}", "description" , Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL after idxpos");
    $this->addColumn("{{%lkp_activity_type}}", "description" , Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL after idxpos");
    $this->addColumn("{{%lkp_contact_category}}", "description" , Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL after idxpos");
    $this->addColumn("{{%lkp_contact_type}}", "description" , Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL after idxpos");
    $this->addColumn("{{%lkp_industry}}", "description" , Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL after idxpos");
    $this->addColumn("{{%lkp_lead_source}}", "description" , Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL after idxpos");
    $this->addColumn("{{%lkp_lead_status}}", "description" , Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL after idxpos");
    $this->addColumn("{{%lkp_opportunity_stage}}", "description" , Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL after idxpos");
    $this->addColumn("{{%lkp_opportunity_type}}", "description" , Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL after idxpos");
    $this->addColumn("{{%lkp_rating}}", "description" , Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL after idxpos");
    $this->addColumn("{{%lkp_salutation}}", "description" , Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL after idxpos");
    $this->addColumn("{{%lkp_social_media}}", "description" , Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL after idxpos");

    $this->update("{{%lkp_account_type}}", ['description'=>'Prospects are contacts which you have not contacted yet'], ['value'=>'Prospect']);

    $this->update("{{%lkp_activity_priority}}", ['description'=>'This activity is top priority and needs to be completed ASAP'], ['value'=>'High']);
    $this->update("{{%lkp_activity_priority}}", ['description'=>'This activity can be completed at leasure time'], ['value'=>'Low']);

  }

  public function down()
  {
  }

  /*
   * // Use safeUp/safeDown to run migration code within a transaction
   * public function safeUp()
   * {
   * }
   *
   * public function safeDown()
   * {
   * }
   */
}
