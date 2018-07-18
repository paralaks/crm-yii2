<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "opportunities".
 *
 * @property string $id
 * @property string $name
 * @property string $amount
 * @property string $close_date
 * @property string $expected_revenue
 * @property string $next_step
 * @property integer $probability
 * @property string $competitors
 * @property string $description
 * @property string $lead_source_id
 * @property string $stage_id
 * @property string $type_id
 * @property string $owner_id
 * @property string $adder_id
 * @property string $modifier_id
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 */
class Opportunity extends CrmModel
{
  const STAGE_CLOSED = 99;

  public $relatedContacts;
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'opportunities';
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['name', 'lead_source_id', 'stage_id', 'close_date', 'probability', 'type_id'], 'required'],
      [['amount', 'expected_revenue'], 'number'],
      [['probability', 'lead_source_id', 'stage_id', 'probability', 'type_id', 'owner_id', 'adder_id', 'modifier_id'], 'integer'],
      [['description'], 'string'],
      [['name', 'next_step', 'competitors'], 'string', 'max' => 255],

      [['description', 'name', 'next_step', 'competitors'], 'trim'],

//      [['close_date'], 'date', 'format'=>'yyyy-MM-dd'],

      ['close_date', 'required', 'whenClient' => 'function(attribute, value)
        {
          if (value.trim()=="")
            return false;

          var temp = value.split("-");
          var d = new Date(temp[0] + "/" + temp[1] + "/" + temp[2]);

          if (isNaN(d.getTime()) || d.getTime() < 0)
          {
            $("#"+attribute.id).blur();
            $("#"+attribute.id).val("");
            $("#"+attribute.id).focus();
            return false;
          }

          return true;
        }
      '],
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'id' => Yii::t('main', 'ID'),
      'name' => Yii::t('main', 'Opportunity Name'),
      'amount' => Yii::t('main', 'Amount'),
      'close_date' => Yii::t('main', 'Close Date'),
      'expected_revenue' => Yii::t('main', 'Expected Revenue'),
      'next_step' => Yii::t('main', 'Next Step'),
      'probability' => Yii::t('main', 'Probability'),
      'competitors' => Yii::t('main', 'Competitors'),
      'description' => Yii::t('main', 'Description'),
      'lead_source_id' => Yii::t('main', 'Lead Source'),
      'stage_id' => Yii::t('main', 'Stage'),
      'type_id' => Yii::t('main', 'Opportunity Type'),
      'owner_id' => Yii::t('main', 'Owner'),
      'adder_id' => Yii::t('main', 'Added By'),
      'modifier_id' => Yii::t('main', 'Modified By'),
      'deleted_at' => Yii::t('main', 'Deleted At'),
      'created_at' => Yii::t('main', 'Added At'),
      'updated_at' => Yii::t('main', 'Updated At'),
    ];
  }

  public function getOpportunitycontacts()
  {
    //return $this->hasMany(OpportunityContact::className(), ['opportunity_id' => 'id'])->where('deleted_at is null')->with('owner')->with('contact');
    return $this->hasMany(OpportunityContact::className(), ['opportunity_id' => 'id'])->with('contact');
  }
}
