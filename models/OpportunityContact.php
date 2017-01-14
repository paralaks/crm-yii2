<?php
namespace app\models;

use Yii;

class OpportunityContact extends CrmModel
{
  public $contact_name;

  public static function tableName()
  {
    return 'rel_opportunity_contact';
  }

  public function rules()
  {
    return [['opportunity_id', 'required'],
      ['contact_name', 'safe'],
      [['id', 'opportunity_id', 'contact_id', 'stage_id', 'owner_id', 'adder_id', 'modifier_id'], 'integer'],
      [['contact_id'], 'required', 'whenClient' => 'function(attribute, value) { return ($("#formSubmit").val()=="save") ? true : false; }']];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return ['id' => Yii::t('main', 'ID'),
      'opportunity_id' => Yii::t('main', 'Opportunity'),
      'contact_id' => Yii::t('main', 'Related Contact'),
      'stage_id' => Yii::t('main', 'Stage'),
      'owner_id' => Yii::t('main', 'Owner'),
      'adder_id' => Yii::t('main', 'Added By'),
      'modifier_id' => Yii::t('main', 'Modified By'),
      'deleted_at' => Yii::t('main', 'Deleted At'),
      'created_at' => Yii::t('main', 'Added At'),
      'updated_at' => Yii::t('main', 'Updated At')];
  }

  public function getOpportunity()
  {
    return $this->hasOne('app\models\Opportunity', ['id' => 'opportunity_id'])->where('deleted_at is null');
  }

  public function getContact()
  {
    return $this->hasOne('app\models\Contact', ['id' => 'contact_id'])->where('deleted_at is null');
  }
}
