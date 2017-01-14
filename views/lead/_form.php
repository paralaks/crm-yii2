<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Lead */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lead-form">

  <?php $form = ActiveForm::begin(['options'=> ['class'=>'form-horizontal']] ); ?>

  <?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

  <div class="form-group">
    <?= $form->field($model, 'first_name', $ttNameSal)->textInput() ?>
    <?= $form->field($model, 'last_name', $tt2ColIn)->textInput() ?>
  </div>

  <div class="form-group">
    <?= $form->field($model, 'company', $tt2ColIn)->textInput() ?>
    <?= $form->field($model, 'title', $tt2ColIn)->textInput() ?>
  </div>

  <div class="form-group">
    <?= $form->field($model, 'industry_id', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('lkp_industry')) ?>
    <?= $form->field($model, 'email', $tt2ColIn)->textInput() ?>
  </div>

  <div class="form-group">
    <?= $form->field($model, 'phone', $tt2ColIn)->textInput() ?>
    <?= $form->field($model, 'mobile_phone', $tt2ColIn)->textInput() ?>
  </div>

  <div class="form-group">
    <?= $form->field($model, 'fax', $tt2ColIn)->textInput() ?>
    <?= $form->field($model, 'rating_id', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('lkp_rating')) ?>
  </div>

  <div class="form-group">
    <?= $form->field($model, 'annual_revenue', $tt2ColIn)->textInput() ?>
    <?= $form->field($model, 'num_of_employees', $tt2ColIn)->textInput() ?>
  </div>

  <div class="form-group">
    <?= $form->field($model, 'website', $tt2ColIn)->textInput() ?>
    <?= $form->field($model, 'birthdate', $tt2ColIn)->textInput() ?>
  </div>

  <div class="form-group">
    <?= $form->field($model, 'lead_source_id', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('lkp_lead_source')) ?>
    <?= $form->field($model, 'status_id', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('lkp_lead_status')) ?>
  </div>

  <hr class="soften" />

  <div class="form-group">
    <?= $form->field($model, 'do_not_call', $tt1ColCbox)->checkbox(null, false) ?>
    <?= $form->field($model, 'do_not_email', $tt1ColCbox)->checkbox(null, false) ?>
    <?= $form->field($model, 'do_not_fax', $tt1ColCbox)->checkbox(null, false) ?>
    <?= $form->field($model, 'email_opt_out', $tt1ColCbox)->checkbox(null, false) ?>
    <?= $form->field($model, 'fax_opt_out', $tt1ColCbox)->checkbox(null, false) ?>
  </div>

  <hr class="soften" />

  <h4>Address:</h4>
  <div class="form-group">
    <?= $form->field($model, 'street', $tt1ColIn)->textInput() ?>
  </div>

  <div class="form-group">
    <?= $form->field($model, 'city', $tt2ColIn)->textInput() ?>
    <?= $form->field($model, 'state', $tt2ColIn)->textInput() ?>
  </div>

  <div class="form-group">
    <?= $form->field($model, 'zip', $tt2ColIn)->textInput() ?>
    <?= $form->field($model, 'country', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('countries')) ?>
  </div>

  <hr class="soften" />

  <div class="form-group">
    <?= $form->field($model, 'description', $tt2ColIn)->textarea() ?>
    <?= $form->field($model, 'owner_id', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('users')) ?>
  </div>

  <hr class="soften" />

  <div class="form-group text-center">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('main', 'Save') : Yii::t('main', 'Update'), ['class' => 'btn btn-primary']) ?>
    <?= Html::a(Yii::t('main', 'Cancel'), ($model->isNewRecord ? Url::to(['lead/index']) : Url::to(['lead/view', 'id' => $model->id])), ['class' => 'btn btn-success']) ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>
