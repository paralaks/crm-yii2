<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\web\UploadedFile;
use app\helpers\AppHelper;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class CrmModel extends ActiveRecord
{
  protected $modelClassName=null;
  protected $modelClassNameFull=null;

  public $pictureFile=null;

  public function __construct($config = [])
  {
    $this->modelClassNameFull=get_called_class();
    $this->modelClassName=str_replace('app\models\\', '', $this->modelClassNameFull);

    $this->owner_id= $this->modelClassName=='User' ? 0 : Yii::$app->user->identity->id;

    parent::__construct($config);
  }

  public function modelClassNameFull()
  {
    return $this->modelClassNameFull;
  }

  public function modelClassName()
  {
    return $this->modelClassName;
  }

  public function behaviors()
  {
    return [[ 'class'=>'yii\behaviors\TimestampBehavior',
              'createdAtAttribute' => 'created_at',
              'updatedAtAttribute' => 'updated_at',
              'value' => new Expression('NOW()'),
            ]
    ];
  }

  public function savePicture()
  {
    try
    {
      $currentUser=Yii::$app->user->identity;

      $this->pictureFile=UploadedFile::getInstance($this, 'pictureFile');

      if ($this->pictureFile)
      {
        // $this->pictureFile->baseName actual image name
        $this->picture=$this->id . md5($this->email) . '.' . $this->pictureFile->extension;
        $this->pictureFile->saveAs('images/' . strtolower($this->modelClassName) . '/' . $this->picture);

        $this->pictureFile=null;

        return $this->update();
      }
    }
    catch (\Exception $e)
    {
      return false;
    }

    return true;
  }

  public function save($runValidation=true, $attributeNames=null)
  {
    $fields=[];
    $isUpdate=empty($this->id) ? false : true;

    $currentUser=Yii::$app->user->identity;

    $this->modifier_id=$currentUser->id;

    // only save updated fields to history
    if ($isUpdate)
    {
      $skipAttributes=['id', 'created_at', 'updated_at', 'adder_id', 'modifier_id'];

      if ($this->modelClassName=='User')
        $skipAttributes=array_merge($skipAttributes, ['auth_key', 'access_token', 'password_hash', 'recent_items']);

      foreach ($this->attributes as $k=>$v2)
        if (in_array($k, $skipAttributes))
          continue;
        else
        if (($v=$this->oldAttributes[$k])!=$v2)
          $fields[$k]=[$v, $v2];

        if ($this->modelClassName=='User' && $this->attributes['password_hash']!=$this->oldAttributes['password_hash'])
          $fields['password']=['********', '********'];
    }
    else
    {
      $this->owner_id=$currentUser->id;
      $this->adder_id=$currentUser->id;
    }

    $resultSave=parent::save($runValidation, $attributeNames);

    if ($resultSave && $isUpdate && count($fields))
    {
      $fields=serialize($fields);
      $this->db->createCommand()->insert('_update_history_', ['user_id'=>Yii::$app->user->identity->id, 'model'=>$this->modelClassName, 'model_id'=>$this->id, 'fields'=>$fields])->execute();
    }

    if ($resultSave)
      Yii::$app->session->setFlash('pageSuccess', Yii::t('main', 'SAVE_SUCCEEDED'));
    else
    {
      Yii::$app->session->setFlash('pageError', Yii::t('main', 'SAVE_FAILED'));
      Yii::$app->session->setFlash('pageErrors', $this->errors);
    }

    return $resultSave;
  }

  public function getOwner()
  {
    //return $this->hasOne(User::className(), ['id' => 'owner_id']);
    return Yii::$app->appHelper->getCachedUser($this->owner_id);
  }

  public function getAdder()
  {
    //return $this->hasOne(User::className(), ['id' => 'adder_id']);
    return Yii::$app->appHelper->getCachedUser($this->adder_id);
  }

  public function getModifier()
  {
    //return $this->hasOne(User::className(), ['id' => 'modifier_id']);
    return Yii::$app->appHelper->getCachedUser($this->modifier_id);
  }

  public function getActivities() {
    return $this->hasMany('app\models\Activity', ['id' => 'activity_id'])->viaTable('rel_activity_morph', ['related_id'=>'id'],
      function ($query)
      {
        $relatedTypeId=Yii::$app->appHelper->getRelatedTypeId($modelName=str_replace('app\models\\', '', get_called_class()));
        return $query->where(['and', 'deleted_at is null', ['related_type_id'=>$relatedTypeId]]);
      }
    );
  }

  public function getUpdateHistory()
  {
    $query=new Query();
    $updates=$query->select('user_id, model, fields, created_at')->from('_update_history_')->where('model="'.$this->modelClassName.'" and model_id="'.$this->id.'"')
                   ->orderBy(['created_at'=>SORT_DESC])->all();

    return $updates;
  }
}