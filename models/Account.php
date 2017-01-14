<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "accounts".
 *
 * @property string $id
 * @property string $name
 * @property string $number
 * @property string $phone
 * @property string $fax
 * @property string $annual_revenue
 * @property string $num_of_employees
 * @property string $website
 * @property string $description
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
 * @property string $lead_source_id
 * @property string $industry_id
 * @property string $type_id
 * @property string $ownership_id
 * @property string $rating_id
 * @property string $owner_id
 * @property string $adder_id
 * @property string $modifier_id
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 */
class Account extends CrmModel
{
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
      return 'accounts';
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['name', 'lead_source_id'], 'required'],
      [['annual_revenue'], 'number'],
      [['num_of_employees', 'lead_source_id', 'industry_id', 'type_id', 'ownership_id', 'rating_id', 'owner_id', 'adder_id', 'modifier_id'], 'integer'],
      [['description'], 'string'],
      [['name', 'number', 'phone', 'fax', 'website', 'street', 'city', 'state', 'zip', 'country', 'street_other', 'city_other', 'state_other', 'zip_other', 'country_other', 'lead_source_detail'], 'string', 'max' => 255],

      [['website'], 'url', 'message' => Yii::t('main', 'Website is not a valid address')],

      [['description', 'name', 'number', 'phone', 'fax', 'website', 'street', 'city', 'state', 'zip', 'country', 'street_other', 'city_other', 'state_other', 'zip_other', 'country_other', 'website', 'lead_source_detail'], 'trim']
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'id' => Yii::t('main', 'ID'),
      'name' => Yii::t('main', 'Name'),
      'number' => Yii::t('main', 'Account Number'),
      'phone' => Yii::t('main', 'Phone'),
      'fax' => Yii::t('main', 'Fax'),
      'annual_revenue' => Yii::t('main', 'Annual Revenue'),
      'num_of_employees' => Yii::t('main', 'Num. Of Employees'),
      'website' => Yii::t('main', 'Website'),
      'description' => Yii::t('main', 'Description'),
      'street' => Yii::t('main', 'Street'),
      'city' => Yii::t('main', 'City'),
      'state' => Yii::t('main', 'State'),
      'zip' => Yii::t('main', 'Zip'),
      'country' => Yii::t('main', 'Country'),
      'street_other' => Yii::t('main', 'Street'),
      'city_other' => Yii::t('main', 'City'),
      'state_other' => Yii::t('main', 'State'),
      'zip_other' => Yii::t('main', 'Zip'),
      'country_other' => Yii::t('main', 'Country'),
      'lead_source_id' => Yii::t('main', 'Lead Source'),
      'lead_source_detail' => Yii::t('main', 'Lead Source Detail'),
      'industry_id' => Yii::t('main', 'Industry'),
      'type_id' => Yii::t('main', 'Account Type'),
      'ownership_id' => Yii::t('main', 'Ownership'),
      'rating_id' => Yii::t('main', 'Rating'),
      'owner_id' => Yii::t('main', 'Owner'),
      'adder_id' => Yii::t('main', 'Added By'),
      'modifier_id' => Yii::t('main', 'Modified By'),
      'deleted_at' => Yii::t('main', 'Deleted At'),
      'created_at' => Yii::t('main', 'Added At'),
      'updated_at' => Yii::t('main', 'Updated At'),
    ];
  }

  public function getContacts()
  {
    return $this->hasMany(Contact::className(), ['account_id' => 'id']);
  }

  public function getSocialmedia()
  {
    $query = new Query();
    $query->select('*')->from('rel_account_social_media')->where(['and', 'deleted_at is null',  ['=', 'account_id', $this->id]]);
    return $query->all();
  }
}
