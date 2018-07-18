<?php

use yii\db\Schema;
use yii\db\Migration;

class m171022_011750_alter_table_opportunities_remove_contactid extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyIsam';
    }

    $this->dropColumn("{{%opportunities}}", "contact_id");
  }

  public function down()
  {
  }
}
