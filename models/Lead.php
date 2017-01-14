<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "leads".
 *
 * @property string $id
 * @property string $email
 * @property string $title
 * @property string $first_name
 * @property string $last_name
 * @property string $description
 * @property string $company
 * @property string $num_of_employees
 * @property string $website
 * @property string $annual_revenue
 * @property string $phone
 * @property string $mobile_phone
 * @property string $fax
 * @property integer $do_not_call
 * @property integer $do_not_email
 * @property integer $do_not_fax
 * @property integer $email_opt_out
 * @property integer $fax_opt_out
 * @property string $birthdate
 * @property string $street
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $country
 * @property string $salutation_id
 * @property string $lead_source_id
 * @property string $status_id
 * @property string $industry_id
 * @property string $rating_id
 * @property string $converted_at
 * @property integer $read_by_owner
 * @property string $owner_id
 * @property string $adder_id
 * @property string $modifier_id
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 */
class Lead extends CrmModel
{
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'leads';
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['first_name', 'last_name', 'company', 'email', 'lead_source_id'], 'required'],
      [['description'], 'string'],
      [['num_of_employees', 'do_not_call', 'do_not_email', 'do_not_fax', 'email_opt_out', 'fax_opt_out', 'salutation_id', 'lead_source_id', 'status_id', 'industry_id', 'rating_id', 'read_by_owner', 'owner_id', 'adder_id', 'modifier_id'], 'integer'],
      [['annual_revenue'], 'number'],
      [['email', 'title', 'first_name', 'last_name', 'company', 'website', 'phone', 'mobile_phone', 'fax', 'street', 'city', 'state', 'zip', 'country'], 'string', 'max' => 255],

      [['birthdate'], 'date', 'format'=>'yyyy-MM-dd'],
      [['email'], 'unique'],
      [['email'], 'email'],
      [['website'], 'url'],
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
      'description' => Yii::t('main', 'Description'),
      'company' => Yii::t('main', 'Company'),
      'num_of_employees' => Yii::t('main', 'Num. Of Employees'),
      'website' => Yii::t('main', 'Website'),
      'annual_revenue' => Yii::t('main', 'Annual Revenue'),
      'phone' => Yii::t('main', 'Phone'),
      'mobile_phone' => Yii::t('main', 'Mobile Phone'),
      'fax' => Yii::t('main', 'Fax'),
      'do_not_call' => Yii::t('main', 'Do Not Call'),
      'do_not_email' => Yii::t('main', 'Do Not Email'),
      'do_not_fax' => Yii::t('main', 'Do Not Fax'),
      'email_opt_out' => Yii::t('main', 'Email Opt Out'),
      'fax_opt_out' => Yii::t('main', 'Fax Opt Out'),
      'birthdate' => Yii::t('main', 'Birthdate'),
      'street' => Yii::t('main', 'Street'),
      'city' => Yii::t('main', 'City'),
      'state' => Yii::t('main', 'State'),
      'zip' => Yii::t('main', 'Zip'),
      'country' => Yii::t('main', 'Country'),
      'salutation_id' => Yii::t('main', ''),
      'lead_source_id' => Yii::t('main', 'Lead Source'),
      'status_id' => Yii::t('main', 'Lead Status'),
      'industry_id' => Yii::t('main', 'Industry'),
      'rating_id' => Yii::t('main', 'Rating'),
      'converted_at' => Yii::t('main', 'Converted At'),
      'read_by_owner' => Yii::t('main', 'Read By Owner'),
      'owner_id' => Yii::t('main', 'Owner'),
      'adder_id' => Yii::t('main', 'Added By'),
      'modifier_id' => Yii::t('main', 'Modified By'),
      'deleted_at' => Yii::t('main', 'Deleted At'),
      'created_at' => Yii::t('main', 'Added At'),
      'updated_at' => Yii::t('main', 'Updated At'),
    ];
  }

}
