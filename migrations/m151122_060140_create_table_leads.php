<?php
use yii\db\Schema;
use yii\db\Migration;

class m151122_060140_create_table_leads extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyIsam';
    }

    $this->createTable("{{%leads}}", [
      "id" => Schema::TYPE_INTEGER . "(11) UNSIGNED NOT NULL AUTO_INCREMENT",
      "email"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci NOT NULL",
      "title"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "first_name"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci NOT NULL",
      "last_name"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci NOT NULL",
      "description" => Schema::TYPE_TEXT . " COLLATE utf8_unicode_ci",
      "company"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "num_of_employees" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "website"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "annual_revenue" => Schema::TYPE_DECIMAL. "(14,0) DEFAULT NULL",
      "phone"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "mobile_phone"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "fax"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "do_not_call" => "tinyint(1) DEFAULT NULL",
      "do_not_email" => "tinyint(1) DEFAULT NULL",
      "do_not_fax" => "tinyint(1) DEFAULT NULL",
      "email_opt_out" => "tinyint(1) DEFAULT NULL",
      "fax_opt_out" => "tinyint(1) DEFAULT NULL",
      "birthdate" => Schema::TYPE_DATE ." DEFAULT NULL",
      "street"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "city"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "state"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "zip"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "country"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "salutation_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "lead_source_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "status_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "industry_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "rating_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "converted_at" => Schema::TYPE_DATE ." DEFAULT NULL",
      "read_by_owner" => "tinyint(1) DEFAULT NULL",
      "owner_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "adder_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "modifier_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "deleted_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      "created_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      "updated_at" => Schema::TYPE_TIMESTAMP ." NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
      "PRIMARY KEY(id)",
    ], $tableOptions);

    $this->createIndex("leads_email_unique", "{{%leads}}", "email", false);

    if (YII_ENV!='prod')
    {
      $this->insert("{{%leads}}",
      ['id' => '1',
        'email' => 'bill@microsoft.com',
        'title' => 'Retired',
        'first_name' => 'Bill',
        'last_name' => 'Gates',
        'description' => 'Used to be CEO now doing charity work',
        'company' => 'Microsoft',
        'num_of_employees' => '35344',
        'website' => 'www.microsoft.com',
        'annual_revenue' => '6000000000',
        'phone' => '357-634-0488',
        'mobile_phone' => '',
        'fax' => '',
        'do_not_call' => '1',
        'do_not_email' => '1',
        'do_not_fax' => '0',
        'email_opt_out' => '0',
        'fax_opt_out' => '0',
        'birthdate' => '0000-00-00',
        'street' => '35 Software Ave',
        'city' => 'Seattle',
        'state' => 'WA',
        'zip' => '03884',
        'country' => 'US',
        'salutation_id' => '1',
        'lead_source_id' => '1',
        'status_id' => '1',
        'industry_id' => '1',
        'rating_id' => '1',
        'converted_at' => NULL,
        'read_by_owner' => '1',
        'owner_id' => '1',
        'adder_id' => '1',
        'modifier_id' => '1',
        'deleted_at' => NULL,
        'created_at' => '2015-05-05 11:27:02',
        'updated_at' => '2015-05-05 11:27:02']);
      $this->insert("{{%leads}}",
      ['id' => '2',
        'email' => 'paul@microsoft.com',
        'title' => 'Consultant',
        'first_name' => 'Paul',
        'last_name' => 'Allen',
        'description' => 'Consults as a senior strategy advisor to the company\'s executives and still owns a reported 100 million shares',
        'company' => 'Microsoft',
        'num_of_employees' => '35344',
        'website' => 'www.microsoft.com',
        'annual_revenue' => '6000000000',
        'phone' => '357-634-0488',
        'mobile_phone' => '',
        'fax' => '',
        'do_not_call' => '1',
        'do_not_email' => '1',
        'do_not_fax' => '0',
        'email_opt_out' => '0',
        'fax_opt_out' => '0',
        'birthdate' => '0000-00-00',
        'street' => '35 Software Ave',
        'city' => 'Seattle',
        'state' => 'WA',
        'zip' => '03884',
        'country' => 'US',
        'salutation_id' => '1',
        'lead_source_id' => '2',
        'status_id' => '1',
        'industry_id' => '1',
        'rating_id' => '1',
        'converted_at' => NULL,
        'read_by_owner' => '1',
        'owner_id' => '1',
        'adder_id' => '1',
        'modifier_id' => '1',
        'deleted_at' => NULL,
        'created_at' => '2015-05-05 11:27:02',
        'updated_at' => '2015-05-05 11:27:02']);
      $this->insert("{{%leads}}",
      ['id' => '3',
        'email' => 'larry@oraacle.com',
        'title' => 'CEO',
        'first_name' => 'Larry',
        'last_name' => 'Ellison',
        'description' => 'Loves Pharraree',
        'company' => 'Oracle',
        'num_of_employees' => '13344',
        'website' => 'http://www.oracle.com',
        'annual_revenue' => '200000000',
        'phone' => '564-634-0488',
        'mobile_phone' => '',
        'fax' => '',
        'do_not_call' => '1',
        'do_not_email' => '1',
        'do_not_fax' => '0',
        'email_opt_out' => '0',
        'fax_opt_out' => '0',
        'birthdate' => '0000-00-00',
        'street' => '666 Church St West',
        'city' => 'San Jose',
        'state' => 'CA',
        'zip' => '30484',
        'country' => 'US',
        'salutation_id' => '1',
        'lead_source_id' => '1',
        'status_id' => '1',
        'industry_id' => '1',
        'rating_id' => '1',
        'converted_at' => NULL,
        'read_by_owner' => '1',
        'owner_id' => '1',
        'adder_id' => '1',
        'modifier_id' => '1',
        'deleted_at' => NULL,
        'created_at' => '2015-05-05 11:27:02',
        'updated_at' => '2015-05-05 11:27:02']);
      $this->insert("{{%leads}}",
      ['id' => '4',
        'email' => 'marc@salesforce.com',
        'title' => 'CEO',
        'first_name' => 'Marc',
        'last_name' => 'Beniof',
        'description' => 'American internet entrepreneur, author and philanthropist.',
        'company' => 'Salesforce.com',
        'num_of_employees' => '19000',
        'website' => 'http://www.salesforce.com',
        'annual_revenue' => '6667000000',
        'phone' => '864-923-6471',
        'mobile_phone' => '',
        'fax' => '',
        'do_not_call' => '1',
        'do_not_email' => '1',
        'do_not_fax' => '0',
        'email_opt_out' => '0',
        'fax_opt_out' => '0',
        'birthdate' => '0000-00-00',
        'street' => 'The Landmark at One Market, Suite 300',
        'city' => 'San Francisco',
        'state' => 'CA',
        'zip' => '94105',
        'country' => 'US',
        'salutation_id' => '1',
        'lead_source_id' => '3',
        'status_id' => '1',
        'industry_id' => '1',
        'rating_id' => '1',
        'converted_at' => NULL,
        'read_by_owner' => '1',
        'owner_id' => '1',
        'adder_id' => '1',
        'modifier_id' => '1',
        'deleted_at' => NULL,
        'created_at' => '2015-05-05 11:27:02',
        'updated_at' => '2015-05-05 11:27:02']);
    }
  }

  public function down()
  {
    if (YII_ENV=='dev')
      $this->dropTable('{{%leads}}');
    else
      echo '***** SKIPPED DROPPING {{%leads}} TABLE - NOT DEV SERVER *****';
  }
}
