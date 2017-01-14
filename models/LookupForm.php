<?php
namespace app\models;

use Yii;
use yii\base\Model;

class LookupForm extends Model
{
  public $tableName;
  public $id;
  public $value;
  public $idxpos;
  public $description;
  public $action;

  public function rules()
  {
    return [
      [['id', 'action'], 'safe'],
      [['tableName', 'value'], 'required'],
      [['value', 'description'], 'string', 'max'=>255],
      [['id', 'idxpos'], 'integer']];
  }

  public function attributeLabels()
  {
    return [
      'tableName'=>Yii::t('main', 'Dropdown Name'),
      'value'=>Yii::t('main', 'Value'),
      'idxpos'=>Yii::t('main', 'Ordering'),
      'description'=>Yii::t('main', 'Tooltip'),
    ];
  }
}
