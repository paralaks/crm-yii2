<?php
namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Lead conversion form
 *
 * @property integer $new_opportunity
 * @property integer $account_id
 * @property integer $stage_id
 * @property integer $probability
 * @property string $account_name
 * @property string $opportunity_name
 * @property string $convert_lead
 *
 * @property date $close_date
 *
 */
class LeadConvertForm extends Model
{
  public $new_opportunity;
  public $account_id;
  public $stage_id;
  public $probability;
  public $account_name;
  public $opportunity_name;
  public $close_date;

  public function rules()
  {
    return [[['new_opportunity', 'stage_id', 'probability'], 'number'],
      [['account_name', 'opportunity_name', 'convertLead'], 'string', 'max' => 255],
      ['close_date', 'date', 'format' => 'yyyy-MM-dd'],

      ['account_id',
        'required',
        'when' => function ($model)
        {
          return trim($model->account_name) == "" ? true : false;
        },
        'whenClient' => 'function(attribute, value)
        {
          var other=$("#leadconvertform-account_name").val();
          return (((other!==undefined && other.trim().length==0) || other===undefined) && value.trim().length==0) ? true : false;
        }'],

      ['opportunity_name',
        'required',
        'when' => function ($model)
        {
          return $model->new_opportunity == 1 && trim($model->opportunity_name) == "" ? true : false;
        },
        'whenClient' => 'function(attribute, value)
         {
           if ($("input:radio[name=\'LeadConvertForm[new_opportunity]\']:checked").val()==1 && value.trim().length==0)
            return true;
         }
       '],

      ['probability',
        'required',
        'when' => function ($model)
        {
          return $model->new_opportunity == 1 && $model->probability <= 0 ? true : false;
        },
        'whenClient' => 'function(attribute, value)
         {
           if ($("input:radio[name=\'LeadConvertForm[new_opportunity]\']:checked").val()==1 && value.trim().length==0)
            return true;
         }
       '],

      ['stage_id',
        'required',
        'when' => function ($model)
        {
          return $model->new_opportunity == 1 && $model->stage_id == 0 ? true : false;
        },
        'whenClient' => 'function(attribute, value)
         {
           if ($("input:radio[name=\'LeadConvertForm[new_opportunity]\']:checked").val()==1 && value.trim().length==0)
            return true;
         }
       '],

      ['close_date',
        'required',
        'when' => function ($model)
        {
          return $model->new_opportunity == 1 && trim($model->close_date) == "" ? true : false;
        },
        'whenClient' => 'function(attribute, value)
         {
           if ($("input:radio[name=\'LeadConvertForm[new_opportunity]\']:checked").val()==1 && value.trim().length==0)
            return true;
         }
       ']];
  }

  /**
   *
   * @return array customized attribute labels
   */
  public function attributeLabels()
  {
    return ['stage_id' => Yii::t('main', 'Stage'), 'account_id' => Yii::t('main', 'Account')];
  }
}
