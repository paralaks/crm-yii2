<?php

use yii\helpers\Html;
use yii\helpers\Url;

$className=$model->modelClassName();
$classNameLower=strtolower($className);

?>

<div class="row">
  <div class="col-sm-6">
    <div class="row">
      <label for="description" class="text-right col-xs-4">&nbsp;<?= Yii::t('main', 'Description') ?>:</label>
      <div class="col-xs-8"><?= Html::encode($model->description) ?></div>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="row">
      <label for="owner" class="text-right col-xs-4">&nbsp;<?= Yii::t('main', 'Owner') ?>:</label>
      <div class="col-xs-4"><?= ($model->owner ? $model->owner->name : '') ?> </div>
      <div class="col-xs-4">[<a href="<?= Url::to([$classNameLower.'/editowner', 'id' => $model->id])?>"><?= Yii::t('main', 'Change') ?></a>]</div>
    </div>
  </div>
</div>

<?= ($className=='Contact' || $className=='Account' ? $this->render('social-media-links', ['model' => $model, 'className'=>$className, 'classNameLower'=>$classNameLower]) : '') ?>

<div class="row">
  <div class="col-xs-4 text-right">
      <label for="adder">&nbsp;<?= Yii::t('main', 'Added By') ?>:</label>&nbsp;&nbsp;&nbsp;
      <?= Html::encode($model->adder ? $model->adder->name : '') ?>&nbsp;&nbsp;&nbsp;
      <?= $model->created_at ?>
  </div>
  <div class="col-xs-5 text-center">
      <label for="modifier">&nbsp;<?= Yii::t('main', 'Modified By') ?>:</label>&nbsp;&nbsp;&nbsp;
      <?= Html::encode($model->modifier ? $model->modifier->name : '') ?>&nbsp;&nbsp;&nbsp;
      <?= $model->updated_at ?>
  </div>
  <div class="col-xs-3 text-left">
      <a href="<?= Url::to([$classNameLower.'/showupdatehistory', 'id' => $model->id])?>" target="_blank"><?= Yii::t('main', 'View update history') ?></a>
  </div>
</div>
