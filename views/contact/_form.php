<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Contacts */
/* @var $form yii\widgets\ActiveForm */

if (empty($model->account_id))
  $model->account_id=0;

if (empty($model->account2_id))
  $model->account2_id=0;

if (empty($model->account3_id))
  $model->account3_id=0;

?>
<div class="contacts-form">

  <?php $form = ActiveForm::begin(['options'=> ['class'=>'form-horizontal', 'enctype'=>'multipart/form-data']] ); ?>

  <?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

  <div class="form-group">
    <?= $form->field($model, 'first_name', $ttNameSal)->textInput() ?>
    <?= $form->field($model, 'last_name', $tt2ColIn)->textInput() ?>
  </div>

  <div class="form-group">
    <?= $form->field($model, 'type_id', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('lkp_contact_type')) ?>
  </div>

  <div class="form-group">
    <?= $form->field($model, 'category_id', $tt1ColCat3)->dropDownList(Yii::$app->appHelper->getLookupData('lkp_contact_category'))->label(Yii::t('main', 'Categories')) ?>
  </div>

  <div class="form-group">
    <?= $form->field($model, 'account_id', $tt1ColAcc3)->input('hidden')->label(Yii::t('main', 'Accounts')) ?>
  </div>

  <div class="form-group">
    <?= $form->field($model, 'title', $tt1ColTtl3)->textInput()->label(Yii::t('main', 'Titles')) ?>
  </div>

  <div class="form-group">
    <?= $form->field($model, 'department', $tt2ColIn)->textInput() ?>
  </div>

  <div class="form-group">
    <?= $form->field($model, 'email', $tt2ColIn)->textInput() ?>
    <?= $form->field($model, 'phone', $tt2ColIn)->textInput() ?>
  </div>

  <div class="form-group">
    <?= $form->field($model, 'mobile_phone', $tt2ColIn)->textInput() ?>
    <?= $form->field($model, 'home_phone', $tt2ColIn)->textInput() ?>
  </div>

  <div class="form-group">
    <?= $form->field($model, 'other_phone', $tt2ColIn)->textInput() ?>
    <?= $form->field($model, 'birthdate', $tt2ColIn)->textInput() ?>
    <!-- <?= $form->field($model, 'fax', $tt2ColIn)->textInput() ?> -->
  </div>

  <div class="form-group">
    <?= $form->field($model, 'assistant', $tt2ColIn)->textInput() ?>
    <?= $form->field($model, 'assistant_phone', $tt2ColIn)->textInput() ?>
  </div>

  <div class="form-group">
    <?= $form->field($model, 'interests', $tt1ColIn)->textInput() ?>
  </div>

  <div class="form-group">
    <?= $form->field($model, 'lead_source_id', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('lkp_lead_source')) ?>
    <?= $form->field($model, 'lead_source_detail', $tt2ColIn)->textInput() ?>
  </div>

  <div class="form-group">
    <?= $form->field($model, 'pictureFile', $tt1ColIn)->fileInput() ?>
  </div>

  <hr class="soften hr-condensed" />

  <div class="form-group text-center">
    <?= $form->field($model, 'do_not_call', $tt1ColCbox)->checkbox(null, false) ?>
    <?= $form->field($model, 'do_not_email', $tt1ColCbox)->checkbox(null, false) ?>
    <!-- <?= $form->field($model, 'do_not_fax', $tt1ColCbox)->checkbox(null, false) ?> -->
    <?= $form->field($model, 'email_opt_out', $tt1ColCbox)->checkbox(null, false) ?>
    <!-- <?= $form->field($model, 'fax_opt_out', $tt1ColCbox)->checkbox(null, false) ?> -->
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

  <!-- >h4>Other Address:</h4>
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
  </div -->

  <hr class="soften hr-condensed" />

  <div class="form-group">
    <?= $form->field($model, 'description', $tt2ColIn)->textarea()?>
    <?= $form->field($model, 'owner_id', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('users')) ?>
  </div>

  <hr class="soften hr-condensed" />

  <div class="form-group text-center">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('main', 'Save') : Yii::t('main', 'Update'), ['class' => 'btn btn-primary']) ?>
    <?= Html::a(Yii::t('main', 'Cancel'),
              ($model->isNewRecord
            ? ($model->account_id ?  Url::to(['account/view', 'id' => $model->account_id]) : Url::to(['contact/index']))
            : Url::to(['contact/view', 'id' => $model->id])), ['class' => 'btn btn-success']) ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>
