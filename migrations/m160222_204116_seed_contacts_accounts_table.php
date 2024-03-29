<?php
use yii\db\Migration;

class m160222_204116_seed_contacts_accounts_table extends Migration
{

  public function up()
  {
    if (YII_ENV != 'prod')
    {
      $this->insert("{{%contacts}}",
      ['id' => '4',
        'email' => 'albert@einstein.com',
        'title' => 'Nobel winner',
        'first_name' => 'Albert',
        'last_name' => 'Einstein',
        'department' => 'Physics',
        'picture' => 'einstein.jpg',
        'interests' => 'Relativity and Gravity',
        'phone' => '1-345-843-8477',
        'state' => '',
        'zip' => '',
        'country' => '',
        'salutation_id' => '1',
        'lead_source_id' => '2',
        'type_id' => '1',
        'category_id' => '2',
        'converted_lead_id' => NULL,
        'account_id' => '4',
        'owner_id' => '1',
        'adder_id' => '1',
        'modifier_id' => NULL,
        'deleted_at' => NULL,
        'created_at' => '2015-05-05 11:27:02',
        'updated_at' => date("Y-m-d H:i:s")]);
      $this->insert("{{%contacts}}",
      ['id' => '5',
        'email' => 'isac@newton.com',
        'title' => 'Professor',
        'first_name' => 'Isaac',
        'last_name' => 'Newton',
        'department' => 'Nature',
        'picture' => 'newton.jpg',
        'interests' => 'Optics, Laws of Motion, Gravity',
        'phone' => '1-567-124-7649',
        'state' => '',
        'zip' => '',
        'country' => '',
        'salutation_id' => '1',
        'lead_source_id' => '3',
        'type_id' => '1',
        'category_id' => '2',
        'converted_lead_id' => NULL,
        'account_id' => '5',
        'owner_id' => '1',
        'adder_id' => '1',
        'modifier_id' => NULL,
        'deleted_at' => NULL,
        'created_at' => '2015-05-05 11:27:02',
        'updated_at' => date("Y-m-d H:i:s")]);
      $this->insert("{{%contacts}}",
      ['id' => '6',
        'email' => 'jamex@maxwell.com',
        'title' => 'Electrician',
        'first_name' => 'James',
        'last_name' => 'Clerk Maxwell',
        'department' => 'Electrics and Electronics',
        'picture' => 'maxwell.jpg',
        'interests' => 'Electromagnetism',
        'phone' => '54-496-179-6573',
        'state' => '',
        'zip' => '',
        'country' => '',
        'salutation_id' => '1',
        'lead_source_id' => '4',
        'type_id' => '1',
        'category_id' => '2',
        'converted_lead_id' => NULL,
        'account_id' => '6',
        'owner_id' => '2',
        'adder_id' => '2',
        'modifier_id' => NULL,
        'deleted_at' => NULL,
        'created_at' => '2015-05-05 11:27:02',
        'updated_at' => date("Y-m-d H:i:s")]);
      $this->insert("{{%contacts}}",
      ['id' => '7',
        'email' => 'irwin@cat.com',
        'title' => 'Cat Master',
        'first_name' => 'Irwin',
        'last_name' => 'Schröedinger',
        'department' => 'Philosophy',
        'picture' => 'schroedinger.jpg',
        'interests' => 'Quantum physics lab',
        'phone' => '6-794-346-3215',
        'state' => '',
        'zip' => '',
        'country' => '',
        'salutation_id' => '1',
        'lead_source_id' => '4',
        'type_id' => '2',
        'category_id' => '3',
        'converted_lead_id' => NULL,
        'account_id' => '4',
        'owner_id' => '3',
        'adder_id' => '3',
        'modifier_id' => NULL,
        'deleted_at' => NULL,
        'created_at' => '2015-05-05 11:27:02',
        'updated_at' => date("Y-m-d H:i:s")]);
      $this->insert("{{%contacts}}",
      ['id' => '8',
        'email' => 'neils@bohr.com',
        'title' => 'Mr. Probable',
        'first_name' => 'Neils',
        'last_name' => 'Bohr',
        'department' => 'Hydrogen',
        'picture' => 'bohr.jpg',
        'interests' => 'Atoms; lots of them',
        'phone' => '25-864-128-1764',
        'state' => '',
        'zip' => '',
        'country' => '',
        'salutation_id' => '1',
        'lead_source_id' => '4',
        'type_id' => '2',
        'category_id' => '3',
        'converted_lead_id' => NULL,
        'account_id' => '6',
        'owner_id' => '3',
        'adder_id' => '3',
        'modifier_id' => NULL,
        'deleted_at' => NULL,
        'created_at' => '2015-05-05 11:27:02',
        'updated_at' => date("Y-m-d H:i:s")]);
      $this->insert("{{%contacts}}",
      ['id' => '9',
        'email' => 'max@planck.com',
        'title' => 'Professor',
        'first_name' => 'Max',
        'last_name' => 'Planck',
        'department' => 'Physics',
        'picture' => 'planck.jpg',
        'interests' => 'Subatomic world',
        'phone' => '9-984-319-5792',
        'state' => '',
        'zip' => '',
        'country' => '',
        'salutation_id' => '1',
        'lead_source_id' => '4',
        'type_id' => '2',
        'category_id' => '3',
        'converted_lead_id' => NULL,
        'account_id' => '6',
        'owner_id' => '2',
        'adder_id' => '2',
        'modifier_id' => NULL,
        'deleted_at' => NULL,
        'created_at' => '2015-05-05 11:27:02',
        'updated_at' => date("Y-m-d H:i:s")]);
      $this->insert("{{%contacts}}",
      ['id' => '10',
        'email' => 'al@haytam.com',
        'title' => 'Polymath',
        'first_name' => 'Ibn Al-Haytham',
        'last_name' => '(Alhazen)',
        'department' => 'Nature',
        'picture' => 'alhazen.jpg',
        'interests' => 'Being father of modern scientific method, astronmy and mathematics',
        'phone' => NULL,
        'state' => '',
        'zip' => '',
        'country' => '',
        'salutation_id' => '1',
        'lead_source_id' => '4',
        'type_id' => '2',
        'category_id' => '3',
        'converted_lead_id' => NULL,
        'account_id' => '7',
        'owner_id' => '1',
        'adder_id' => '1',
        'modifier_id' => NULL,
        'deleted_at' => NULL,
        'created_at' => '2015-05-05 11:27:02',
        'updated_at' => date("Y-m-d H:i:s")]);
      $this->insert("{{%contacts}}",
      ['id' => '11',
        'email' => 'ibn@khaldun.com',
        'title' => 'Histographer and historian',
        'first_name' => 'Ibn',
        'last_name' => 'Khaldun',
        'department' => 'History',
        'picture' => 'khaldun.jpg',
        'interests' => 'One of the forerunners of modern historiography, sociology and economics',
        'phone' => NULL,
        'state' => '',
        'zip' => '',
        'country' => '',
        'salutation_id' => '1',
        'lead_source_id' => '4',
        'type_id' => '2',
        'category_id' => '3',
        'converted_lead_id' => NULL,
        'account_id' => '7',
        'owner_id' => '1',
        'adder_id' => '1',
        'modifier_id' => NULL,
        'deleted_at' => NULL,
        'created_at' => '2015-05-05 11:27:02',
        'updated_at' => date("Y-m-d H:i:s")]);
      $this->insert("{{%contacts}}",
      ['id' => '12',
        'email' => 'al@razi.com',
        'title' => 'Physician',
        'first_name' => 'Abu Bakr Al-Razi',
        'last_name' => '(Rhazes)',
        'department' => 'Chemistry and Philosophy',
        'picture' => 'razi.jpg',
        'interests' => 'Alchemist and philosopher, one of the greatest physicians in history.',
        'phone' => NULL,
        'state' => '',
        'zip' => '',
        'country' => '',
        'salutation_id' => '1',
        'lead_source_id' => '3',
        'type_id' => '3',
        'category_id' => '2',
        'converted_lead_id' => NULL,
        'account_id' => '7',
        'owner_id' => '2',
        'adder_id' => '2',
        'modifier_id' => NULL,
        'deleted_at' => NULL,
        'created_at' => '2015-05-05 11:27:02',
        'updated_at' => date("Y-m-d H:i:s")]);
      $this->insert("{{%contacts}}",
      ['id' => '13',
        'email' => 'thabit@qurra.com',
        'title' => 'Mathematician',
        'first_name' => 'Thabit ibn Qurra',
        'last_name' => '(Thebit)',
        'department' => 'Physics, Astronomy',
        'picture' => 'qurra.jpg',
        'interests' => 'Mathematician, physician and astronomer; was the first reformer of the Ptolemaic system; founder of statics',
        'phone' => NULL,
        'state' => '',
        'zip' => '',
        'country' => '',
        'salutation_id' => '1',
        'lead_source_id' => '2',
        'type_id' => '3',
        'category_id' => '2',
        'converted_lead_id' => NULL,
        'account_id' => '8',
        'owner_id' => '1',
        'adder_id' => '1',
        'modifier_id' => NULL,
        'deleted_at' => NULL,
        'created_at' => '2015-05-05 11:27:02',
        'updated_at' => date("Y-m-d H:i:s")]);
      $this->insert("{{%contacts}}",
      ['id' => '14',
        'email' => 'musa@khwarizmi.com',
        'title' => 'Algebra expert',
        'first_name' => 'Muhammad ibn Musa Al-Khwarizmi',
        'last_name' => '(Algoritmi)',
        'department' => 'Algebra',
        'picture' => 'khwarizmi.jpg',
        'interests' => 'His works introduced Hindu-Arabic numerals and the concepts of algebra into European mathematics',
        'phone' => NULL,
        'state' => '',
        'zip' => '',
        'country' => '',
        'salutation_id' => '1',
        'lead_source_id' => '3',
        'type_id' => '2',
        'category_id' => '4',
        'converted_lead_id' => NULL,
        'account_id' => '8',
        'owner_id' => '1',
        'adder_id' => '1',
        'modifier_id' => NULL,
        'deleted_at' => NULL,
        'created_at' => '2015-05-05 11:27:02',
        'updated_at' => date("Y-m-d H:i:s")]);

      $this->update("{{%contacts}}", ['picture' => '1155ecee4aa6cc6b9333e1a6c8c5a4b94.jpg'], 'id=1');

      $this->insert("{{%accounts}}",
      ['id' => '4',
        'name' => 'State University of New York',
        'number' => 'UT-NYST',
        'website' => 'http://www.suny.com',
        'description' => 'Public University\nApproximate Cost: $32,850.00\nInternational Students: 200',
        'street' => '',
        'city' => 'BrockPort',
        'state' => 'NY',
        'zip' => '58007',
        'country' => 'US',
        'lead_source_id' => '2',
        'industry_id' => '9',
        'type_id' => '2',
        'ownership_id' => '1',
        'rating_id' => '1',
        'owner_id' => '1',
        'adder_id' => '1',
        'modifier_id' => '1',
        'deleted_at' => NULL,
        'created_at' => '2015-05-05 11:27:02',
        'updated_at' => '2015-05-05 11:27:02']);
      $this->insert("{{%accounts}}",
      ['id' => '5',
        'name' => 'University of Toronto',
        'number' => 'UT-TOR',
        'website' => 'http://www.uotoronto.edu',
        'description' => 'University of Toronto',
        'street' => '',
        'city' => 'Toronto',
        'state' => 'ON',
        'zip' => 'N2A-4E8',
        'country' => 'CA',
        'lead_source_id' => '2',
        'industry_id' => '9',
        'type_id' => '2',
        'ownership_id' => '1',
        'rating_id' => '1',
        'owner_id' => '1',
        'adder_id' => '1',
        'modifier_id' => '1',
        'deleted_at' => NULL,
        'created_at' => '2015-05-05 11:27:02',
        'updated_at' => '2015-05-05 11:27:02']);
      $this->insert("{{%accounts}}",
      ['id' => '6',
        'name' => 'UC Berkeley',
        'number' => 'UC-BER',
        'website' => 'http://ucberkeley.edu',
        'description' => 'University of California Berkeley',
        'street' => '',
        'city' => 'Berkeley',
        'state' => 'California',
        'zip' => '84569',
        'country' => 'US',
        'lead_source_id' => '2',
        'industry_id' => '9',
        'type_id' => '2',
        'ownership_id' => '1',
        'rating_id' => '1',
        'owner_id' => '1',
        'adder_id' => '1',
        'modifier_id' => '1',
        'deleted_at' => NULL,
        'created_at' => '2015-05-05 11:27:02',
        'updated_at' => '2015-05-05 11:27:02']);
      $this->insert("{{%accounts}}",
      ['id' => '7',
        'name' => 'Baghdad University',
        'number' => 'UT-BAGH',
        'website' => 'http://baghdad.edu',
        'description' => 'House of Wisdom',
        'street' => '',
        'city' => 'Baghdad',
        'state' => '',
        'zip' => '45-987',
        'country' => 'IQ',
        'lead_source_id' => '2',
        'industry_id' => '9',
        'type_id' => '2',
        'ownership_id' => '1',
        'rating_id' => '1',
        'owner_id' => '1',
        'adder_id' => '1',
        'modifier_id' => '1',
        'deleted_at' => NULL,
        'created_at' => '2015-05-05 11:27:02',
        'updated_at' => '2015-05-05 11:27:02']);
      $this->insert("{{%accounts}}",
      ['id' => '8',
        'name' => 'University of Ispahan',
        'number' => 'UT-ISP',
        'website' => 'http://www.ispahan.edu',
        'description' => 'House of Wisdom',
        'street' => '',
        'city' => 'Ispahan',
        'state' => 'Greater Khorasan',
        'zip' => '69874-78',
        'country' => 'IR',
        'lead_source_id' => '2',
        'industry_id' => '9',
        'type_id' => '2',
        'ownership_id' => '1',
        'rating_id' => '1',
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
    return null;
  }
}
