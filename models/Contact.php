<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "contacts".
 *
 * @property string $id
 * @property string $email
 * @property string $title
 * @property string $first_name
 * @property string $last_name
 * @property string $department
 * @property string $description
 * @property string $birthdate
 * @property string $interests
 * @property string $phone
 * @property string $mobile_phone
 * @property string $home_phone
 * @property string $other_phone
 * @property string $fax
 * @property string $assistant
 * @property string $assistant_phone
 * @property integer $do_not_call
 * @property integer $do_not_email
 * @property integer $do_not_fax
 * @property integer $email_opt_out
 * @property integer $fax_opt_out
 * @property string $street
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $country
 * @property string $street_other
 * @property string $city_other
 * @property string $state_other
 * @property string $zip_other
 * @property string $country_other
 * @property string $salutation_id
 * @property string $lead_source_id
 * @property string $type_id
 * @property string $converted_lead_id
 * @property string $account_id
 * @property string $owner_id
 * @property string $adder_id
 * @property string $modifier_id
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 */
class Contact extends CrmModel
{
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'contacts';
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['email', 'first_name', 'last_name', 'lead_source_id'], 'required'],
      [['description'], 'string'],
      [['do_not_call', 'do_not_email', 'do_not_fax', 'email_opt_out', 'fax_opt_out', 'salutation_id', 'lead_source_id', 'type_id', 'converted_lead_id', 'owner_id', 'adder_id', 'modifier_id',
        'account_id', 'category_id', 'account2_id', 'category2_id', 'account3_id', 'category3_id',
       ], 'integer'
      ],
      [['email', 'title', 'first_name', 'last_name', 'department', 'interests', 'phone', 'mobile_phone', 'home_phone', 'other_phone', 'fax', 'assistant', 'assistant_phone', 'street', 'city', 'state', 'zip', 'country', 'street_other', 'city_other', 'state_other', 'zip_other', 'country_other', 'title2', 'title3', 'picture', 'lead_source_detail'], 'string', 'max' => 255],

      [['description', 'email', 'title', 'first_name', 'last_name', 'department', 'interests', 'phone', 'mobile_phone', 'home_phone', 'other_phone', 'fax', 'assistant', 'assistant_phone', 'street', 'city', 'state', 'zip', 'country', 'street_other', 'city_other', 'state_other', 'zip_other', 'country_other', 'title2', 'title3', 'picture', 'lead_source_detail'], 'trim'],

      [['birthdate'], 'date', 'format'=>'yyyy-MM-dd'],
      [['email'], 'unique'],
      [['email'], 'email'],
      [['pictureFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, png, gif', 'mimeTypes' => 'image/jpeg, image/png, image/gif'] ,
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'id' => Yii::t('main', 'ID'),
      'email' => Yii::t('main', 'Email'),
      'title' => Yii::t('main', 'Title'),
      'first_name' => Yii::t('main', 'First Name'),
      'last_name' => Yii::t('main', 'Last Name'),
      'department' => Yii::t('main', 'Department'),
      'description' => Yii::t('main', 'Description'),
      'birthdate' => Yii::t('main', 'Birthdate'),
      'interests' => Yii::t('main', 'Interests'),
      'phone' => Yii::t('main', 'Phone'),
      'mobile_phone' => Yii::t('main', 'Mobile Phone'),
      'home_phone' => Yii::t('main', 'Home Phone'),
      'other_phone' => Yii::t('main', 'Other Phone'),
      'fax' => Yii::t('main', 'Fax'),
      'assistant' => Yii::t('main', 'Assistant'),
      'assistant_phone' => Yii::t('main', 'Assistant Phone'),
      'do_not_call' => Yii::t('main', 'Do Not Call'),
      'do_not_email' => Yii::t('main', 'Do Not Email'),
      'do_not_fax' => Yii::t('main', 'Do Not Fax'),
      'email_opt_out' => Yii::t('main', 'Email Opt Out'),
      'fax_opt_out' => Yii::t('main', 'Fax Opt Out'),
      'street' => Yii::t('main', 'Street'),
      'city' => Yii::t('main', 'City'),
      'state' => Yii::t('main', 'State'),
      'zip' => Yii::t('main', 'Zip'),
      'country' => Yii::t('main', 'Country'),
      'street_other' => Yii::t('main', 'Street Other'),
      'city_other' => Yii::t('main', 'City Other'),
      'state_other' => Yii::t('main', 'State Other'),
      'zip_other' => Yii::t('main', 'Zip Other'),
      'country_other' => Yii::t('main', 'Country Other'),
      'salutation_id' => Yii::t('main', 'Salutation'),
      'lead_source_id' => Yii::t('main', 'Lead Source'),
      'type_id' => Yii::t('main', 'Contact Type'),
      'converted_lead_id' => Yii::t('main', 'Converted Lead ID'),
      'account_id' => Yii::t('main', 'Account'),
      'category_id' => Yii::t('main', 'Category'),
      'account2_id' => Yii::t('main', 'Account').' 2',
      'category2_id' => Yii::t('main', 'Category').' 2',
      'account3_id' => Yii::t('main', 'Account').' 2',
      'category3_id' => Yii::t('main', 'Category').' 3',
      'title2' => Yii::t('main', 'Title').' 2',
      'title3' => Yii::t('main', 'Title').' 3',
      'picture' => Yii::t('main', 'Picture'),
      'pictureFile' => Yii::t('main', 'Picture'),
      'lead_source_detail' => Yii::t('main', 'Lead Source Detail'),
      'owner_id' => Yii::t('main', 'Owner'),
      'adder_id' => Yii::t('main', 'Added By'),
      'modifier_id' => Yii::t('main', 'Modified By'),
      'deleted_at' => Yii::t('main', 'Deleted At'),
      'created_at' => Yii::t('main', 'Added At'),
      'updated_at' => Yii::t('main', 'Updated At'),
    ];
  }

  public function attributeHints()
  {
    return [];
  }

  public function getAccount()
  {
    return $this->hasOne(Account::className(), ['id' => 'account_id']);
  }

  public function getAccount2()
  {
    return $this->hasOne(Account::className(), ['id' => 'account2_id']);
  }

  public function getAccount3()
  {
    return $this->hasOne(Account::className(), ['id' => 'account3_id']);
  }

  public function getOpportunitycontacts()
  {
    return $this->hasMany(OpportunityContact::className(), ['contact_id' => 'id'])->with('opportunity');
  }

  public function getSocialmedia()
  {
    $query = new Query();
    $query->select('*')->from('rel_contact_social_media')->where(['and', 'deleted_at is null',  ['=', 'contact_id', $this->id]]);
    return $query->all();
  }
}
