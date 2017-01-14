<?php

namespace app\models;

use Yii;

class ActivityMorph extends CrmModel
{
  public static function tableName()
  {
    return 'rel_activity_morph';
  }

  public function rules()
  {
    return [ [['id', 'activity_id', 'related_id', 'related_type_id', 'owner_id', 'adder_id', 'modifier_id'], 'integer'] ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'id' => Yii::t('main', 'ID'),
      'activity_id' => Yii::t('main', 'Activity'),
      'related_id' => Yii::t('main', 'Relates To'),
      'related_type_id' => Yii::t('main', ''),
      'owner_id' => Yii::t('main', 'Owner'),
      'adder_id' => Yii::t('main', 'Added By'),
      'modifier_id' => Yii::t('main', 'Modified By'),
      'deleted_at' => Yii::t('main', 'Deleted At'),
      'created_at' => Yii::t('main', 'Added At'),
      'updated_at' => Yii::t('main', 'Updated At')];
  }
}
