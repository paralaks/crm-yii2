<?php
use yii\db\Schema;
use yii\db\Migration;

class m151122_044907_create_table_accounts extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyIsam';
    }

    $this->createTable("{{%accounts}}", [
      "id" => Schema::TYPE_INTEGER . "(11) UNSIGNED NOT NULL AUTO_INCREMENT",
      "name"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci NOT NULL",
      "number"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci NOT NULL",
      "phone"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "fax"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "annual_revenue" => Schema::TYPE_DECIMAL. "(14,0) DEFAULT NULL",
      "num_of_employees" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "website"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "description" => Schema::TYPE_TEXT . " COLLATE utf8_unicode_ci",
      "street"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "city"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "state"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "zip"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "country"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "street_other"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "city_other"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "state_other"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "zip_other"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "country_other"  => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "lead_source_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "lead_source_detail" => Schema::TYPE_STRING . "(255) COLLATE utf8_unicode_ci DEFAULT NULL",
      "industry_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "type_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "ownership_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "rating_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "owner_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "adder_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "modifier_id" => Schema::TYPE_INTEGER . "(10) unsigned DEFAULT NULL",
      "deleted_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      "created_at" => Schema::TYPE_DATETIME ." DEFAULT NULL",
      "updated_at" => Schema::TYPE_TIMESTAMP ." NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
      "PRIMARY KEY(id)",
    ], $tableOptions);


    if (YII_ENV!='prod')
    {
      $this->insert("{{%accounts}}", ['id'=>'1','name'=>'Samsung Electronics Co., Ltd.','number'=>'EL-SMSG','phone'=>'+1 425-614-1047','fax'=>'','annual_revenue'=>'20000000000','num_of_employees'=>'12000','website'=>'http://www.samsung.com','description'=>' South Korean multinational electronics company headquartered in Suwon, South Korea','street'=>'146th Place Southeast','city'=>'Bellevue','state'=>'WA','zip'=>'98007','country'=>'US','street_other'=>'','city_other'=>'','state_other'=>'','zip_other'=>'','country_other'=>'','lead_source_id'=>'2','industry_id'=>'1','type_id'=>'2','ownership_id'=>'1','rating_id'=>'1','owner_id'=>'1','adder_id'=>'1','modifier_id'=>'1','deleted_at'=>NULL,'created_at'=>'2015-05-05 11:27:02','updated_at'=>'2015-05-05 11:27:02']);
      $this->insert("{{%accounts}}", ['id'=>'2','name'=>'Microsoft Corporation','number'=>'IT-MSOF','phone'=>'+1 425-614-7109','fax'=>'','annual_revenue'=>'20000000000','num_of_employees'=>'15000','website'=>'http://www.microsoft.com','description'=>'American multinational corporation headquartered in Redmond, Washington, that develops, manufactures, licenses, supports and sells computer software, consumer electronics and personal computers and services.','street'=>'1399 124th Ave NE','city'=>'Bellevue','state'=>'WA','zip'=>'98007','country'=>'US','street_other'=>'','city_other'=>'','state_other'=>'','zip_other'=>'','country_other'=>'','lead_source_id'=>'2','industry_id'=>'1','type_id'=>'2','ownership_id'=>'1','rating_id'=>'1','owner_id'=>'1','adder_id'=>'1','modifier_id'=>'1','deleted_at'=>NULL,'created_at'=>'2015-05-05 11:27:02','updated_at'=>'2015-05-05 11:27:02']);
      $this->insert("{{%accounts}}", ['id'=>'3','name'=>'Walmart','number'=>'RET-WLMR','phone'=>'+1 425-614-8703','fax'=>'','annual_revenue'=>'2000000000','num_of_employees'=>'25000','website'=>'http://www.walmart.com','description'=>' American multinational retail corporation that operates a chain of discount department stores and warehouse stores. Headquartered in Bentonville, Arkansas, the company was founded by Sam Walton in 1962 and incorporated on October 31, 1969. It has over 11,000 stores in 27 countries, under a total 71 banners','street'=>'12620 SE 41st Pl','city'=>'Bellevue','state'=>'WA','zip'=>'98007','country'=>'US','street_other'=>'','city_other'=>'','state_other'=>'','zip_other'=>'','country_other'=>'','lead_source_id'=>'2','industry_id'=>'1','type_id'=>'1','ownership_id'=>'1','rating_id'=>'1','owner_id'=>'1','adder_id'=>'1','modifier_id'=>'1','deleted_at'=>NULL,'created_at'=>'2015-05-05 11:27:02','updated_at'=>'2015-05-05 11:27:02']);
    }
  }

  public function down()
  {
    if (YII_ENV=='dev')
      $this->dropTable('{{%accounts}}');
    else
      echo '***** SKIPPED DROPPING {{%accounts}} TABLE - NOT DEV SERVER *****';
  }
}
