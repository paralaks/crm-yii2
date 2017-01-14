<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OpportunitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

<div class="opportunities-search">
  <?php

  $form=ActiveForm::begin(['action' => ['index'], 'method' => 'get', 'options' => ['class' => 'form-horizontal form-one-half']]);
  ?>

  <h4 class="text-center"><?= Yii::t('main', 'Search for').' '.Yii::t('main', 'Opportunities')?></h4>

	<div class="form-group">
    <?= $form->field($model, 'name', $tt1ColInSm)->textInput()?>
  </div>

	<div class="form-group">
    <?= $form->field($model, 'probability', $tt1ColInSm)->dropDownList(Yii::$app->appHelper->getLookupData('probabilities'))?>
  </div>

	<div class="form-group">
    <?= $form->field($model, 'stage_id', $tt1ColInSm)->dropDownList(Yii::$app->appHelper->getLookupData('lkp_opportunity_stage'))?>
  </div>

	<div class="form-group">
    <?= $form->field($model, 'type_id', $tt1ColInSm)->dropDownList(Yii::$app->appHelper->getLookupData('lkp_opportunity_type'))?>
  </div>

	<div class="form-group text-center">
    <?= Html::submitButton(Yii::t('main', 'Search'), ['class' => 'btn btn-primary'])?>
    <?php // Html::resetButton(Yii::t('main', 'Reset'), ['class' => 'btn btn-default']) ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>