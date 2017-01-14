<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Account */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accounts-form">

  <?php $form = ActiveForm::begin(['options'=> ['class'=>'form-horizontal']] ); ?>

  <?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

  <div class="form-group">
    <?= $form->field($model, 'name', $tt2ColIn)->textInput() ?>
    <?= $form->field($model, 'type_id', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('lkp_account_type')) ?>
  </div>

  <!--  <div class="form-group">
    <?= $form->field($model, 'number', $tt2ColIn)->textInput() ?>
    <?= $form->field($model, 'rating_id', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('lkp_rating')) ?>
  </div> -->

  <div class="form-group">
    <?= $form->field($model, 'phone', $tt2ColIn)->textInput() ?>
    <?= $form->field($model, 'fax', $tt2ColIn)->textInput() ?>
  </div>

  <div class="form-group">
    <?= $form->field($model, 'industry_id', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('lkp_industry')) ?>
    <?= $form->field($model, 'num_of_employees', $tt2ColIn)->textInput() ?>
  </div>

  <!--  <div class="form-group">
    <?= $form->field($model, 'annual_revenue', $tt2ColIn)->textInput() ?>
    <?= $form->field($model, 'ownership_id', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('lkp_account_ownership')) ?>
  </div> -->

  <div class="form-group">
    <?= $form->field($model, 'lead_source_id', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('lkp_lead_source')) ?>
    <?= $form->field($model, 'lead_source_detail', $tt2ColIn)->textInput() ?>
  </div>

  <div class="form-group">
    <?= $form->field($model, 'website', $tt2ColIn)->textInput() ?>
  </div>

  <hr class="soften hr-condensed" />

  <h4>Address:</h4>
  <div class="form-group">
    <?= $form->field($model, 'street', $tt1ColIn)->textInput() ?>
  </div>

  <div class="form-group">
    <?= $form->field($model, 'city', $tt2ColIn)->textInput() ?>
    <?= $form->field($model, 'state', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('states')) ?>
  </div>

  <div class="form-group">
    <?= $form->field($model, 'zip', $tt2ColIn)->textInput() ?>
    <?= $form->field($model, 'country', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('countries')) ?>
  </div>

  <!--  <hr class="soften hr-condensed" />

  <h4>Shipping Address:</h4>
  <div class="form-group">
    <?= $form->field($model, 'street_other', $tt1ColIn)->textInput() ?>
  </div>

  <div class="form-group">
    <?= $form->field($model, 'city_other', $tt2ColIn)->textInput() ?>
    <?= $form->field($model, 'state_other', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('states')) ?>
  </div>

  <div class="form-group">
    <?= $form->field($model, 'zip_other', $tt2ColIn)->textInput() ?>
    <?= $form->field($model, 'country_other', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('countries')) ?>
  </div> -->

  <hr class="soften hr-condensed" />

  <div class="form-group">
    <?= $form->field($model, 'description', $tt2ColIn)->textarea() ?>
    <?= $form->field($model, 'owner_id', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('users')) ?>
  </div>

  <div class="form-group text-center">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('main', 'Save') : Yii::t('main', 'Update'), ['class' => 'btn btn-primary']) ?>
    <?= Html::a(Yii::t('main', 'Cancel'), ($model->isNewRecord ? Url::to(['account/index']) : Url::to(['account/view', 'id' => $model->id])), ['class' => 'btn btn-success']) ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>
