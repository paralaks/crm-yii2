<?php
use yii\db\Migration;

class m160827_141025_seed_activity_table extends Migration
{

  public function up()
  {
    if (YII_ENV != 'prod')
    {
      $this->insert("{{%activities}}",
      ['id' => '1',
        'subject' => 'Call to discuss new MySQL engine',
        'location' => 'Meeting room MySQL North',
        'start_date' => '2015-10-24',
        'end_date' => '2015-10-24',
        'description' => '',
        'allday' => '0',
        'remind_at' => NULL,
        'type_id' => '1',
        'priority_id' => '1',
        'status_id' => '1',
        'related_id' => '2',
        'related_type' => 'contact',
        'owner_id' => '1',
        'adder_id' => '1',
        'modifier_id' => '1',
        'deleted_at' => NULL,
        'created_at' => '2015-10-18 11:13:06',
        'updated_at' => '2015-10-18 11:13:06']);
      $this->insert("{{%activities}}",
      ['id' => '2',
        'subject' => 'Email Satya',
        'location' => '',
        'start_date' => '2016-10-24',
        'end_date' => '2016-10-28',
        'description' => 'Email Satya about license distribution changes',
        'allday' => '0',
        'remind_at' => NULL,
        'type_id' => '2',
        'priority_id' => '3',
        'status_id' => '1',
        'related_id' => '1',
        'related_type' => 'contact',
        'owner_id' => '1',
        'adder_id' => '1',
        'modifier_id' => '1',
        'deleted_at' => NULL,
        'created_at' => '2015-10-18 11:13:06',
        'updated_at' => '2015-10-18 11:13:06']);
      $this->insert("{{%activities}}",
      ['id' => '3',
        'subject' => 'Meeting <strong>to discuss</strong> quarterly revenue',
        'location' => 'Site Forum',
        'start_date' => '2015-10-24',
        'end_date' => '2015-10-24',
        'description' => '',
        'allday' => '0',
        'remind_at' => NULL,
        'type_id' => '1',
        'priority_id' => '1',
        'status_id' => '1',
        'related_id' => '3',
        'related_type' => 'contact',
        'owner_id' => '1',
        'adder_id' => '1',
        'modifier_id' => '1',
        'deleted_at' => NULL,
        'created_at' => '2015-10-18 11:13:06',
        'updated_at' => '2015-10-18 11:13:06']);
      $this->insert("{{%activities}}",
      ['id' => '4',
        'subject' => 'Interview for ABC',
        'location' => 'Fairfax - VA',
        'start_date' => '2015-11-16',
        'end_date' => '2016-02-11',
        'description' => 'Need:
  Extra storage
  New Digital Camera
  ',
        'allday' => '1',
        'remind_at' => NULL,
        'type_id' => '6',
        'priority_id' => '2',
        'status_id' => '1',
        'related_id' => '2',
        'related_type' => 'contact',
        'owner_id' => '1',
        'adder_id' => '1',
        'modifier_id' => '1',
        'deleted_at' => NULL,
        'created_at' => '2015-10-18 11:14:58',
        'updated_at' => '2015-10-18 11:14:58']);
      $this->insert("{{%activities}}",
      ['subject' => 'Requirements sign off meeting',
        'location' => 'Meeting room - Great Plains - Vancouver',
        'start_date' => '2015-10-24',
        'end_date' => '2015-10-24',
        'description' => '',
        'allday' => '0',
        'remind_at' => NULL,
        'type_id' => '1',
        'priority_id' => '1',
        'status_id' => '1',
        'related_id' => '1',
        'related_type' => 'account',
        'owner_id' => '1',
        'adder_id' => '1',
        'modifier_id' => '1',
        'deleted_at' => NULL,
        'created_at' => '2015-10-18 11:13:06',
        'updated_at' => '2015-10-18 11:13:06']);
      $this->insert("{{%activities}}",
      ['subject' => 'Arrange a meeting',
        'location' => '',
        'start_date' => '2016-10-24',
        'end_date' => '2016-10-28',
        'description' => 'Email Satya about license distribution changes',
        'allday' => '0',
        'remind_at' => NULL,
        'type_id' => '2',
        'priority_id' => '3',
        'status_id' => '1',
        'related_id' => '1',
        'related_type' => 'account',
        'owner_id' => '1',
        'adder_id' => '1',
        'modifier_id' => '1',
        'deleted_at' => NULL,
        'created_at' => '2015-10-18 11:13:06',
        'updated_at' => '2015-10-18 11:13:06']);
      $this->insert("{{%activities}}",
      ['subject' => 'Opportunity activitiy Number 1',
        'location' => 'Site Forum',
        'start_date' => '2016-10-24',
        'end_date' => '2016-10-24',
        'description' => '',
        'allday' => '0',
        'remind_at' => NULL,
        'type_id' => '1',
        'priority_id' => '1',
        'status_id' => '1',
        'related_id' => '1',
        'related_type' => 'opportunity',
        'owner_id' => '1',
        'adder_id' => '1',
        'modifier_id' => '1',
        'deleted_at' => NULL,
        'created_at' => '2015-10-18 11:13:06',
        'updated_at' => '2015-10-18 11:13:06']);
      $this->insert("{{%activities}}",
      ['subject' => 'Opportunity activitiy Number Two',
        'location' => 'Toronto',
        'start_date' => '2016-11-16',
        'end_date' => '2016-12-11',
        'description' => 'Lots of monies',
        'allday' => '1',
        'remind_at' => NULL,
        'type_id' => '6',
        'priority_id' => '2',
        'status_id' => '1',
        'related_id' => '2',
        'related_type' => 'opportunity',
        'owner_id' => '1',
        'adder_id' => '1',
        'modifier_id' => '1',
        'deleted_at' => NULL,
        'created_at' => '2015-10-18 11:14:58',
        'updated_at' => '2015-10-18 11:14:58']);
    }
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
