<?php
use yii\db\Schema;
use yii\db\Migration;

class m151122_054617_create_table_contacts extends Migration
{

  public function up()
  {
    $tableOptions=null;
    if ($this->db->driverName === 'mysql')
    {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions='CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyIsam';
    }

    $this->createTable("{{%contacts}}",
    ["id" => Schema::TYPE_INTEGER . "(11) UNSIGNED NOT NULL AUTO_INCREMENT",
      "email" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci NOT NULL",
      "title" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "first_name" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci NOT NULL",
      "last_name" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci NOT NULL",
      "department" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "description" => Schema::TYPE_TEXT . " COLLATE utf8_unicode_ci",
      "birthdate" => Schema::TYPE_DATE . " DEFAULT NULL",
      "interests" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "phone" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "mobile_phone" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "home_phone" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "other_phone" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "fax" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "assistant" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "assistant_phone" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "do_not_call" => "tinyint(1) DEFAULT NULL",
      "do_not_email" => "tinyint(1) DEFAULT NULL",
      "do_not_fax" => "tinyint(1) DEFAULT NULL",
      "email_opt_out" => "tinyint(1) DEFAULT NULL",
      "fax_opt_out" => "tinyint(1) DEFAULT NULL",
      "street" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "city" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "state" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "zip" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "country" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "street_other" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "city_other" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "state_other" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "zip_other" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "country_other" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "salutation_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "lead_source_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "lead_source_detail" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "type_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "converted_lead_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "account_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "account2_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "account3_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "title2" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "title3" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "category_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "category2_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "category3_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "picture" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT 'blank.jpg'",
      "owner_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "adder_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "modifier_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "deleted_at" => Schema::TYPE_DATETIME . " DEFAULT NULL",
      "created_at" => Schema::TYPE_DATETIME . " DEFAULT NULL",
      "updated_at" => Schema::TYPE_TIMESTAMP . " NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
      "PRIMARY KEY(id)"], $tableOptions);

    $this->createIndex("contacts_email_unique", "{{%contacts}}", "email", false);

    if (YII_ENV != 'prod')
    {
      $this->insert("{{%contacts}}",
      ['id' => '1',
        'email' => 'satya@microsoft.com',
        'title' => 'CEO',
        'first_name' => 'Satya',
        'last_name' => 'Nadella',
        'department' => 'Upper Management',
        'description' => '',
        'birthdate' => NULL,
        'interests' => 'mobile technologies, aerospace technologies, software engineering methodologies',
        'phone' => '1-222-333-3333',
        'mobile_phone' => '1-111-222-2222',
        'home_phone' => '',
        'other_phone' => '',
        'fax' => '',
        'assistant' => 'Inspector Gadget',
        'assistant_phone' => '1-999-999-9999',
        'do_not_call' => '1',
        'do_not_email' => '1',
        'do_not_fax' => '1',
        'email_opt_out' => '1',
        'fax_opt_out' => '1',
        'street' => '1399 124th Ave NE',
        'city' => 'Bellevue',
        'state' => 'WA',
        'zip' => '98007',
        'country' => 'US',
        'street_other' => '',
        'city_other' => '',
        'state_other' => '',
        'zip_other' => '',
        'country_other' => 'CA',
        'salutation_id' => '1',
        'lead_source_id' => '1',
        'type_id' => '1',
        'category_id' => '2',
        'converted_lead_id' => NULL,
        'account_id' => '2',
        'owner_id' => '3',
        'adder_id' => '1',
        'modifier_id' => '1',
        'deleted_at' => NULL,
        'created_at' => '2015-05-05 11:27:02',
        'updated_at' => '2015-11-08 10:58:51']);
      $this->insert("{{%contacts}}",
      ['id' => '2',
        'email' => 'dougm@walmart.com',
        'title' => 'President & CEO',
        'first_name' => 'Doub',
        'last_name' => 'McMillon',
        'department' => 'Upper Management',
        'description' => 'President and Chief Executive Officer of Walmart Stores, Inc. (NYSE: WMT). McMillon was promoted to succeed Mike Duke, 63, as President and Chief Executive Officer of Walmart on November 25, 2013 and assumed the role on February 1, 2014. McMillon also sits on the company’s board of directors.',
        'birthdate' => NULL,
        'interests' => 'server management, search engines',
        'phone' => '1-666-555-5555',
        'mobile_phone' => '1-888-444-4444',
        'home_phone' => '',
        'other_phone' => '',
        'fax' => '',
        'assistant' => 'Beetlejuice',
        'assistant_phone' => '1-666-666-6666',
        'do_not_call' => '1',
        'do_not_email' => '1',
        'do_not_fax' => '1',
        'email_opt_out' => '1',
        'fax_opt_out' => '1',
        'street' => '1399 124th Ave NE',
        'city' => 'Bellevue',
        'state' => 'WA',
        'zip' => '98007',
        'country' => 'US',
        'street_other' => '',
        'city_other' => '',
        'state_other' => '',
        'zip_other' => '',
        'country_other' => 'CA',
        'salutation_id' => '1',
        'lead_source_id' => '1',
        'type_id' => '1',
        'category_id' => '8',
        'converted_lead_id' => NULL,
        'account_id' => '3',
        'owner_id' => '1',
        'adder_id' => '2',
        'modifier_id' => '2',
        'deleted_at' => NULL,
        'created_at' => '2015-05-05 11:27:02',
        'updated_at' => '2015-11-08 10:58:55']);
      $this->insert("{{%contacts}}",
      ['id' => '3',
        'email' => 'lkh@samsung.com',
        'title' => 'President & CEO',
        'first_name' => 'Lee',
        'last_name' => 'Kun-hee',
        'department' => 'Upper Management',
        'description' => 'South Korean business magnate and the chairman of Samsung Group. He had resigned in April 2008, owing to a Samsung slush funds scandal, but returned on March 24, 2010.',
        'birthdate' => NULL,
        'interests' => NULL,
        'phone' => '1-777-222-2222',
        'mobile_phone' => '1-999-777-7777',
        'home_phone' => '',
        'other_phone' => '',
        'fax' => '',
        'assistant' => 'Chucky',
        'assistant_phone' => '1-666-666-9999',
        'do_not_call' => '1',
        'do_not_email' => '1',
        'do_not_fax' => '1',
        'email_opt_out' => '1',
        'fax_opt_out' => '1',
        'street' => '146th Place Southeast',
        'city' => 'Bellevue',
        'state' => 'WA',
        'zip' => '98007',
        'country' => 'US',
        'street_other' => '',
        'city_other' => '',
        'state_other' => '',
        'zip_other' => '',
        'country_other' => '',
        'salutation_id' => '1',
        'lead_source_id' => '1',
        'type_id' => '1',
        'category_id' => NULL,
        'converted_lead_id' => NULL,
        'account_id' => '1',
        'owner_id' => '2',
        'adder_id' => '2',
        'modifier_id' => '2',
        'deleted_at' => NULL,
        'created_at' => '2015-05-05 11:27:02',
        'updated_at' => '2015-05-05 11:27:02']);
    }
  }

  public function down()
  {
    if (YII_ENV=='dev')
      $this->dropTable('{{%contacts}}');
    else
      echo '***** SKIPPED DROPPING {{%contacts}} TABLE - NOT DEV SERVER *****';
  }
}
