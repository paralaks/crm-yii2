<?php
namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Password reset request form
 */
class Report extends Model
{
  public $report_object=null;
  public $report_type=null;
  public $display_type=null;

  public $graphReports=null;

  /**
   * @inheritdoc
   */

  public function init()
  {
    $this->graphReports=[
      'leads'=>
      [
        'label'=>Yii::t('main', 'Lead'),
        'reports'=>
        [
          'lead_source_id'=>'lkp_lead_source',
          'status_id'=>'lkp_lead_status',
          'industry_id'=>'lkp_industry',
        ],
        'labels'=>
        [
          'lead_source_id'=>Yii::t('main', 'Lead Source'),
          'status_id'=>Yii::t('main', 'Lead Status'),
          'industry_id'=>Yii::t('main', 'Contact Type'),
        ],
      ],

      'contacts'=>
      [
        'label'=>Yii::t('main', 'Contact'),
        'reports'=>
        [
          'category_id'=>'lkp_contact_category',
          'lead_source_id'=>'lkp_lead_source',
          'type_id'=>'lkp_contact_type',
        ],
        'labels'=>
        [
          'category_id'=>Yii::t('main', 'Category'),
          'lead_source_id'=>Yii::t('main', 'Lead Source'),
          'type_id'=>Yii::t('main', 'Contact Type'),
        ],
      ],

      'opportunities'=>
      [
        'label'=>Yii::t('main', 'Opportunity'),
        'reports'=>
        [
          'stage_id'=>'lkp_opportunity_stage',
          'lead_source_id'=>'lkp_lead_source',
          'type_id'=>'lkp_opportunity_type',
          'probability'=>'',
        ],
        'labels'=>
        [
          'stage_id'=>Yii::t('main', 'Stage'),
          'lead_source_id'=>Yii::t('main', 'Lead Source'),
          'type_id'=>Yii::t('main', 'Opportunity Type'),
          'probability'=>Yii::t('main', 'Probability'),
        ],
      ]
    ];

    parent::init();
  }

  public function rules()
  {
    return [
        [['report_object', 'report_type', 'display_type'], 'string'],
        [['report_object', 'report_type', 'display_type'], 'required'],
    ];
  }

  /**
   *
   * @return array customized attribute labels
   */
  public function attributeLabels()
  {
    return [
      'report_object' => Yii::t('main', 'Object'),
      'report_type' => Yii::t('main', 'Report'),
      'display_type' => Yii::t('main', 'Display'),
    ];
  }
}
