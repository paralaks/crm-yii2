<?php
namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "activities".
 *
 * @property string $id
 * @property string $subject
 * @property string $location
 * @property string $start_date
 * @property string $end_date
 * @property string $description
 * @property integer $allday
 * @property string $remind_at
 * @property integer $type_id
 * @property integer $priority_id
 * @property integer $status_id
 * @property string $related_id
 * @property string $related_type
 * @property string $owner_id
 * @property string $adder_id
 * @property string $modifier_id
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 */
class Activity extends CrmModel
{
  const STATUS_COMPLETED = 99;

  public $related_type;
  public $related_id;
  public $idList;


  public function init()
  {
    if (Yii::$app->request->isGet)
    {
      $this->load(Yii::$app->request->get());

      $this->related_type=Yii::$app->request->get('related_type', '');
      $this->related_id=Yii::$app->request->get('related_id', '');
      $this->idList=Yii::$app->request->get('idList', '');
    }
    else
    if (Yii::$app->request->isPost)
    {
      $this->load(Yii::$app->request->post());

      $this->related_type=Yii::$app->request->post('related_type', '');
      $this->related_id=Yii::$app->request->post('related_id', '');
      $this->idList=Yii::$app->request->post('idList', '');
    }

    if (!in_array(strtolower($this->related_type), ['contact', 'account', 'opportunity']))
      $this->related_type='Contact';

    parent::init();
  }

  /** * @inheritdoc */
  public static  function tableName()
  {
    return 'activities';
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return
    [
      [['subject','location'], 'required', 'whenClient' => 'function(attribute, value) { return ($("#formSubmit").val()=="save") ? true : false; }'],
      [['remind_at'], 'safe'],
      [['description'], 'string'],
      [['allday','type_id','priority_id','status_id','owner_id','adder_id','modifier_id'], 'integer'],
      [['subject','location'], 'string','max' => 255],

      [['subject', 'location', 'description'], 'trim'],

      [['start_date', 'end_date'], 'date', 'format'=>'yyyy-MM-dd'],
      [['remind_at'], 'date', 'format'=>'yyyy-MM-dd HH:mm:ss'],
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'id' => Yii::t('main', 'ID'),
      'subject' => Yii::t('main', 'Subject'),
      'location' => Yii::t('main', 'Location'),
      'start_date' => Yii::t('main', 'Start Date'),
      'end_date' => Yii::t('main', 'End Date'),
      'description' => Yii::t('main', 'Description'),
      'allday' => Yii::t('main', 'Allday'),
      'remind_at' => Yii::t('main', 'Remind At'),
      'type_id' => Yii::t('main', 'Activity Type'),
      'priority_id' => Yii::t('main', 'Priority'),
      'status_id' => Yii::t('main', 'Status'),
      'owner_id' => Yii::t('main', 'Owner'),
      'adder_id' => Yii::t('main', 'Added By'),
      'modifier_id' => Yii::t('main', 'Modified By'),
      'deleted_at' => Yii::t('main', 'Deleted At'),
      'created_at' => Yii::t('main', 'Added At'),
      'updated_at' => Yii::t('main', 'Updated At')];
  }

  public function getContacts()
  {
    return $this->hasMany('app\models\Contact', ['id' => 'related_id'])->viaTable('rel_activity_morph', ['activity_id' => 'id'],
      function ($query)
      {
        return $query->where(['and', 'deleted_at is null', ['related_type_id' => Yii::$app->appHelper->getRelatedTypeId('contact')]]);
      }
    );
  }

  public function getAccounts()
  {
    return $this->hasMany('app\models\Account', ['id' => 'related_id'])->viaTable('rel_activity_morph', ['activity_id' => 'id'],
      function ($query)
      {
        return $query->where(['and', 'deleted_at is null', ['related_type_id' => Yii::$app->appHelper->getRelatedTypeId('account')]]);
      }
    );
  }

  public function getOpportunities()
  {
    return $this->hasMany('app\models\Opportunity', ['id' => 'related_id'])->viaTable('rel_activity_morph', ['activity_id' => 'id'],
      function ($query)
      {
        return $query->where(['and', 'deleted_at is null', ['related_type_id' => Yii::$app->appHelper->getRelatedTypeId('opportunity')]]);
      }
    );
  }
}
