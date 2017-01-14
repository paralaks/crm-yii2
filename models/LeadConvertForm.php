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

 * @property string $account_name
 * @property string $opportunity_name
 * @property string $convert_lead

 * @property date $close_date

 */
class LeadConvertForm extends Model
{
  public $new_opportunity;
  public $account_id;
  public $stage_id;

  public $account_name;
  public $opportunity_name;
  public $convert_lead=1;
  public $close_date;

  public function rules()
  {
    return [
             [['new_opportunity', 'account_id', 'stage_id'], 'number'],
             [['account_name', 'opportunity_name', 'convertLead'], 'string', 'max' => 255],
             ['close_date', 'date', 'format'=>'yyyy-MM-dd'],
    ];
  }

  /**
   *
   * @return array customized attribute labels
   */
  public function attributeLabels()
  {
    return [ 'stage_id' => Yii::t('main', 'Stage')
    ];
  }
}
