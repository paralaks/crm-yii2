<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

use yii\base\InvalidConfigException;
use yii\rbac\DbManager;

/**
 * Initializes RBAC tables
 *
 * @author Alexander Kochetov <creocoder@gmail.com>
 * @since 2.0
 */
class m151102_102106_rbac_init extends \yii\db\Migration
{
    /**
     * @throws yii\base\InvalidConfigException
     * @return DbManager
     */
    protected function getAuthManager()
    {
        $authManager = Yii::$app->getAuthManager();
        if (!$authManager instanceof DbManager) {
            throw new InvalidConfigException('You should configure "authManager" component to use database before executing this migration.');
        }
        return $authManager;
    }

    public function safeUp()
    {
        $authManager = $this->getAuthManager();
        $this->db = $authManager->db;

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyIsam';
        }

        $this->createTable($authManager->ruleTable, [
            'name' => $this->string(64)->notNull(),
            'data' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'PRIMARY KEY (name)',
        ], $tableOptions);

        $this->createTable($authManager->itemTable, [
            'name' => $this->string(64)->notNull(),
            'type' => $this->integer()->notNull(),
            'description' => $this->text(),
            'rule_name' => $this->string(64),
            'data' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'PRIMARY KEY (name)',
            'FOREIGN KEY (rule_name) REFERENCES ' . $authManager->ruleTable . ' (name) ON DELETE SET NULL ON UPDATE CASCADE',
        ], $tableOptions);
        $this->createIndex('idx-auth_item-type', $authManager->itemTable, 'type');

        $this->createTable($authManager->itemChildTable, [
            'parent' => $this->string(64)->notNull(),
            'child' => $this->string(64)->notNull(),
            'PRIMARY KEY (parent, child)',
            'FOREIGN KEY (parent) REFERENCES ' . $authManager->itemTable . ' (name) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY (child) REFERENCES ' . $authManager->itemTable . ' (name) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);

        $this->createTable($authManager->assignmentTable, [
            'item_name' => $this->string(64)->notNull(),
            'user_id' => $this->string(64)->notNull(),
            'created_at' => $this->integer(),
            'PRIMARY KEY (item_name, user_id)',
            'FOREIGN KEY (item_name) REFERENCES ' . $authManager->itemTable . ' (name) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);



        $this->insert("{{%auth_rule}}", ['name'=>'Same Owner','data'=>'O:25:"app\helpers\SameOwnerRule":3:{s:4:"name";s:10:"Same Owner";s:9:"createdAt";i:1446995428;s:9:"updatedAt";i:1446995607;}','created_at'=>'1446995428','updated_at'=>'1446996567']);


        $this->insert("{{%auth_item}}", ['name'=>'/*','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446913837','updated_at'=>'1446913837']);
        $this->insert("{{%auth_item}}", ['name'=>'/site/*','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446914096','updated_at'=>'1446914096']);
        $this->insert("{{%auth_item}}", ['name'=>'/site/index','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446914096','updated_at'=>'1446914096']);
        $this->insert("{{%auth_item}}", ['name'=>'/site/login','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446914096','updated_at'=>'1446914096']);
        $this->insert("{{%auth_item}}", ['name'=>'/site/logout','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446914096','updated_at'=>'1446914096']);
        $this->insert("{{%auth_item}}", ['name'=>'/site/identitymanage','type'=>'2','description'=>'Allows users to update their identity information (ie. password)','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1458448381','updated_at'=>'1458448381']);
        $this->insert("{{%auth_item}}", ['name'=>'Administrator','type'=>'1','description'=>'Can make any change in the system.','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446912292','updated_at'=>'1446912292']);
        $this->insert("{{%auth_item}}", ['name'=>'Manager','type'=>'1','description'=>'Can create/update basic users, view deleted records and everything users can do','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446912344','updated_at'=>'1446912344']);
        $this->insert("{{%auth_item}}", ['name'=>'User','type'=>'1','description'=>'Regular user with basic functionality','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446912367','updated_at'=>'1446912383']);
        $this->insert("{{%auth_item}}", ['name'=>'Create User','type'=>'2','description'=>'Allows creating a user in the system','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446913107','updated_at'=>'1446913107']);
        $this->insert("{{%auth_item}}", ['name'=>'Update User','type'=>'2','description'=>'Allows updating any user in the system','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446913146','updated_at'=>'1446913146']);
        $this->insert("{{%auth_item}}", ['name'=>'Delete User','type'=>'2','description'=>'Allows deleting any user in the system.','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446913188','updated_at'=>'1446913188']);
        $this->insert("{{%auth_item}}", ['name'=>'/lead/*','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446914096','updated_at'=>'1446914096']);
        $this->insert("{{%auth_item}}", ['name'=>'Create Lead','type'=>'2','description'=>'Allows adding a new lead to the system','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446912414','updated_at'=>'1446912414']);
        $this->insert("{{%auth_item}}", ['name'=>'Update Lead','type'=>'2','description'=>'Allows updating an existing lead','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446912442','updated_at'=>'1446912442']);
        $this->insert("{{%auth_item}}", ['name'=>'Update Owned Lead','type'=>'2','description'=>'Allows updating lead if owned by user','rule_name'=>'Same Owner','data'=>NULL,'created_at'=>'1446912517','updated_at'=>'1446995731']);
        $this->insert("{{%auth_item}}", ['name'=>'Delete Lead','type'=>'2','description'=>'Allows deleting a lead','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446912541','updated_at'=>'1446912541']);
        $this->insert("{{%auth_item}}", ['name'=>'Delete Owned Lead','type'=>'2','description'=>'Allows deleting lead if owned by user','rule_name'=>'Same Owner','data'=>NULL,'created_at'=>'1446912541','updated_at'=>'1446912541']);
        $this->insert("{{%auth_item}}", ['name'=>'/contact/*','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446914096','updated_at'=>'1446914096']);
        $this->insert("{{%auth_item}}", ['name'=>'Create Contact','type'=>'2','description'=>'Allows adding a new contact to the system','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446912414','updated_at'=>'1446912414']);
        $this->insert("{{%auth_item}}", ['name'=>'Update Contact','type'=>'2','description'=>'Allows updating an existing contact','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446912442','updated_at'=>'1446912442']);
        $this->insert("{{%auth_item}}", ['name'=>'Update Owned Contact','type'=>'2','description'=>'Allows updating contact if owned by user','rule_name'=>'Same Owner','data'=>NULL,'created_at'=>'1446912517','updated_at'=>'1446995731']);
        $this->insert("{{%auth_item}}", ['name'=>'Delete Contact','type'=>'2','description'=>'Allows deleting a contact','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446912541','updated_at'=>'1446912541']);
        $this->insert("{{%auth_item}}", ['name'=>'Delete Owned Contact','type'=>'2','description'=>'Allows deleting contact if owned by user','rule_name'=>'Same Owner','data'=>NULL,'created_at'=>'1446912541','updated_at'=>'1446912541']);
        $this->insert("{{%auth_item}}", ['name'=>'/account/*','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446914096','updated_at'=>'1446914096']);
        $this->insert("{{%auth_item}}", ['name'=>'Create Account','type'=>'2','description'=>'Allows adding a new Account to the system','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446912414','updated_at'=>'1446912414']);
        $this->insert("{{%auth_item}}", ['name'=>'Update Account','type'=>'2','description'=>'Allows updating an existing Account','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446912442','updated_at'=>'1446912442']);
        $this->insert("{{%auth_item}}", ['name'=>'Update Owned Account','type'=>'2','description'=>'Allows updating Account if owned by user','rule_name'=>'Same Owner','data'=>NULL,'created_at'=>'1446912517','updated_at'=>'1446995731']);
        $this->insert("{{%auth_item}}", ['name'=>'Delete Account','type'=>'2','description'=>'Allows deleting a Account','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446912541','updated_at'=>'1446912541']);
        $this->insert("{{%auth_item}}", ['name'=>'Delete Owned Account','type'=>'2','description'=>'Allows deleting Account if owned by user','rule_name'=>'Same Owner','data'=>NULL,'created_at'=>'1446912541','updated_at'=>'1446912541']);
        $this->insert("{{%auth_item}}", ['name'=>'/opportunity/*','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446914096','updated_at'=>'1446914096']);
        $this->insert("{{%auth_item}}", ['name'=>'Create Opportunity','type'=>'2','description'=>'Allows adding a new Opportunity to the system','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446912414','updated_at'=>'1446912414']);
        $this->insert("{{%auth_item}}", ['name'=>'Update Opportunity','type'=>'2','description'=>'Allows updating an existing Opportunity','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446912442','updated_at'=>'1446912442']);
        $this->insert("{{%auth_item}}", ['name'=>'Update Owned Opportunity','type'=>'2','description'=>'Allows updating Opportunity if owned by user','rule_name'=>'Same Owner','data'=>NULL,'created_at'=>'1446912517','updated_at'=>'1446995731']);
        $this->insert("{{%auth_item}}", ['name'=>'Delete Opportunity','type'=>'2','description'=>'Allows deleting a Opportunity','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446912541','updated_at'=>'1446912541']);
        $this->insert("{{%auth_item}}", ['name'=>'Delete Owned Opportunity','type'=>'2','description'=>'Allows deleting Opportunity if owned by user','rule_name'=>'Same Owner','data'=>NULL,'created_at'=>'1446912541','updated_at'=>'1446912541']);
        $this->insert("{{%auth_item}}", ['name'=>'/activity/*','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446914096','updated_at'=>'1446914096']);
        $this->insert("{{%auth_item}}", ['name'=>'Create Activity','type'=>'2','description'=>'Allows adding a new Activity to the system','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446912414','updated_at'=>'1446912414']);
        $this->insert("{{%auth_item}}", ['name'=>'Update Activity','type'=>'2','description'=>'Allows updating an existing Activity','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446912442','updated_at'=>'1446912442']);
        $this->insert("{{%auth_item}}", ['name'=>'Update Owned Activity','type'=>'2','description'=>'Allows updating Activity if owned by user','rule_name'=>'Same Owner','data'=>NULL,'created_at'=>'1446912517','updated_at'=>'1446995731']);
        $this->insert("{{%auth_item}}", ['name'=>'Delete Activity','type'=>'2','description'=>'Allows deleting a Activity','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446912541','updated_at'=>'1446912541']);
        $this->insert("{{%auth_item}}", ['name'=>'Delete Owned Activity','type'=>'2','description'=>'Allows deleting Activity if owned by user','rule_name'=>'Same Owner','data'=>NULL,'created_at'=>'1446912541','updated_at'=>'1446912541']);
        $this->insert("{{%auth_item}}", ['name'=>'/report/*','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1446914096','updated_at'=>'1446914096']);

        $this->insert("{{%auth_item_child}}", ['parent'=>'Administrator','child'=>'/*']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'Administrator','child'=>'Delete User']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'Administrator','child'=>'Manager']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'Manager','child'=>'Create User']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'Manager','child'=>'Update User']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'Delete Owned Lead','child'=>'Delete Lead']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'Delete Owned Contact','child'=>'Delete Contact']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'Delete Owned Account','child'=>'Delete Account']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'Delete Owned Activity','child'=>'Delete Activity']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'Delete Owned Opportunity','child'=>'Delete Opportunity']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'Manager','child'=>'Delete Lead']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'Manager','child'=>'Delete Contact']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'Manager','child'=>'Delete Account']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'Manager','child'=>'Delete Activity']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'Manager','child'=>'Delete Opportunity']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'Manager','child'=>'Update Lead']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'Manager','child'=>'Update Contact']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'Manager','child'=>'Update Account']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'Manager','child'=>'Update Activity']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'Manager','child'=>'Update Opportunity']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'Manager','child'=>'/site/*']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'Manager','child'=>'/report/*']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'Manager','child'=>'User']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'Update Owned Lead','child'=>'Update Lead']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'Update Owned Contact','child'=>'Update Contact']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'Update Owned Account','child'=>'Update Account']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'Update Owned Activity','child'=>'Update Activity']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'Update Owned Opportunity','child'=>'Update Opportunity']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'User','child'=>'/lead/*']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'User','child'=>'/contact/*']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'User','child'=>'/account/*']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'User','child'=>'/activity/*']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'User','child'=>'/opportunity/*']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'User','child'=>'/site/index']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'User','child'=>'/site/login']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'User','child'=>'/site/logout']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'User','child'=>'Create Lead']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'User','child'=>'Create Contact']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'User','child'=>'Create Account']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'User','child'=>'Create Activity']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'User','child'=>'Create Opportunity']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'User','child'=>'Delete Owned Lead']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'User','child'=>'Delete Owned Contact']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'User','child'=>'Delete Owned Account']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'User','child'=>'Delete Owned Activity']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'User','child'=>'Delete Owned Opportunity']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'User','child'=>'Update Owned Lead']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'User','child'=>'Update Owned Contact']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'User','child'=>'Update Owned Account']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'User','child'=>'Update Owned Activity']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'User','child'=>'Update Owned Opportunity']);
        $this->insert("{{%auth_item_child}}", ['parent'=>'User','child'=>'/site/identitymanage']);

        $this->insert("{{%auth_assignment}}", ['item_name'=>'Administrator','user_id'=>'1','created_at'=>'1446913033']);


        if (YII_ENV!='prod')
        {
          $this->insert("{{%auth_assignment}}", ['item_name'=>'Manager','user_id'=>'2','created_at'=>'1446914405']);
          $this->insert("{{%auth_assignment}}", ['item_name'=>'User','user_id'=>'3','created_at'=>'1446914429']);
        }
    }

    public function safeDown()
    {
        $authManager = $this->getAuthManager();
        $this->db = $authManager->db;

        if (YII_ENV=='dev')
        {
            $this->dropTable($authManager->assignmentTable);
            $this->dropTable($authManager->itemChildTable);
            $this->dropTable($authManager->itemTable);
            $this->dropTable($authManager->ruleTable);
        }
        else
          echo '***** SKIPPED DROPPING RBAC TABLES - NOT DEV SERVER *****';
    }
}
