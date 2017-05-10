<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LeadsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

<div class="leads-search">
  <?php $form=ActiveForm::begin(['action' => ['index'], 'method' => 'get', 'options' => ['class' => 'form-horizontal form-one-half']]); ?>

  <h4 class="text-center"><?= Yii::t('main', 'Search for').' '.Yii::t('main', 'Leads')?></h4>

	<div class="form-group">
    <?= $form->field($model, 'name', $tt1ColInSm)->textInput()?>
  </div>

	<div class="form-group">
    <?= $form->field($model, 'email', $tt1ColInSm)->textInput()?>
  </div>

	<div class="form-group">
    <?= $form->field($model, 'company', $tt1ColInSm)->textInput()?>
  </div>

	<div class="form-group">
    <?= $form->field($model, 'status_id', $tt1ColInSm)->dropDownList(Yii::$app->appHelper->getLookupData('lkp_lead_status'))?>
  </div>

	<div class="form-group text-center">
    <?= Html::submitButton(Yii::t('main', 'Search'), ['id' => 'search-lead-btn', 'class' => 'btn btn-primary'])?>
    <?php // Html::resetButton(Yii::t('main', 'Reset'), ['class' => 'btn btn-default']) ?>
  </div>

  <?php ActiveForm::end(); ?>
</div>
