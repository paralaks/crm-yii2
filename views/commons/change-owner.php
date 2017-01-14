<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\CrmBaseModel */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('main', 'Change Owner');

$this->params['breadcrumbs'][] = Yii::t('main', $model->modelClassName());
$this->params['breadcrumbs'][] = Yii::t('main', 'Change Owner');

$recordName=Html::encode(isset($model->name) ? $model->name : (isset($model->subject) ? $model->subject : $model->first_name.' '.$model->last_name));

$controller=strtolower($model->modelClassName());
?>

<?php $form = ActiveForm::begin(['options'=> ['class'=>'form-horizontal'], 'action'=>[$controller.'/saveowner', 'id'=>$model->id]] ); ?>

<?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

<div class="row">
  <label for="name" class="control-label text-nowrap col-xs-6">&nbsp;<?= Yii::t('main', 'Transfer this record') ?>:</label>
  <span class="form-control-static col-xs-6"> <?= $recordName ?></span>
</div>

<div class="row text-center">
  <?= $form->field($model, 'owner_id', $tt1ColInOwner)->dropDownList(Yii::$app->appHelper->getLookupData('users')) ?>
</div>

<br />

<div class="form-group text-center">
  <?= Html::submitButton(Yii::t('main', 'Update'), ['class' => 'btn btn-primary']) ?>
  <?= Html::a(Yii::t('main', 'Cancel'),  Url::to([$controller.'/view', 'id' => $model->id]), ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
