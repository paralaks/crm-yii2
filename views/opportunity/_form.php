<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Opportunity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="opportunities-form">

  <?php $form = ActiveForm::begin(['options'=> ['class'=>'form-horizontal']] ); ?>

  <?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

	<input type="hidden" name="contact_id" value="<?= $contact_id ?>" />

  <div class="form-group">
    <?= $form->field($model, 'type_id', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('lkp_opportunity_type'))?>
    <?= $form->field($model, 'name', $tt2ColIn)->textInput()?>
  </div>

	<div class="form-group">
    <?= $form->field($model, 'stage_id', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('lkp_opportunity_stage'))?>
    <?= $form->field($model, 'close_date', $tt2ColIn)->textInput()?>
  </div>

	<div class="form-group">
    <?= $form->field($model, 'probability', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('probabilities'))?>
    <?= $form->field($model, 'next_step', $tt2ColIn)->textInput()?>
  </div>

	<div class="form-group">
    <?= $form->field($model, 'lead_source_id', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('lkp_lead_source'))?>
  </div>

	<div class="form-group">
    <?= $form->field($model, 'competitors', $tt1ColIn)->textInput()?>
  </div>

	<div class="form-group">
    <?= $form->field($model, 'description', $tt2ColIn)->textarea()?>
    <?= $form->field($model, 'owner_id', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('users'))?>
  </div>

	<div class="form-group text-center">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('main', 'Save') : Yii::t('main', 'Update'), ['class' => 'btn btn-primary'])?>
    <?= Html::a(Yii::t('main', 'Cancel'), ($model->isNewRecord ? Url::to(['opportunity/index']) : Url::to(['opportunity/view', 'id' => $model->id])), ['class' => 'btn btn-success'])?>
  </div>

  <?php ActiveForm::end(); ?>

</div>
