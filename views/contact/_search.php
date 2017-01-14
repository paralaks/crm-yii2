<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ContactsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

<div class="contacts-search">
  <?php $form=ActiveForm::begin(['action' => ['index'], 'method' => 'get', 'options' => ['class' => 'form-horizontal form-one-half']]); ?>

  <h4 class="text-center"><?= Yii::t('main', 'Search for').' '.Yii::t('main', 'Contacts')?></h4>

	<div class="form-group">
    <?= $form->field($model, 'contact_name', $tt1ColInSm)->textInput()?>
  </div>

	<div class="form-group">
    <?= $form->field($model, 'account_name', $tt1ColInSm)->textInput()?>
  </div>

	<div class="form-group">
    <?= $form->field($model, 'category_id', $tt1ColInSm)->dropDownList(Yii::$app->appHelper->getLookupData('lkp_contact_category'))?>
  </div>

	<div class="form-group text-center">
    <?= Html::submitButton(Yii::t('main', 'Search'), ['class' => 'btn btn-primary'])?>
    <?php // Html::resetButton(Yii::t('main', 'Reset'), ['class' => 'btn btn-default']) ?>
  </div>

  <?php ActiveForm::end(); ?>
</div>
