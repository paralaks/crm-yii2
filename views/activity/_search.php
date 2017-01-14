<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActivitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

<div class="activities-search">
  <?php $form=ActiveForm::begin(['action' => ['index'], 'method' => 'get', 'options' => ['class' => 'form-horizontal form-one-half']]); ?>

  <h4 class="text-center"><?= Yii::t('main', 'Search for').' '.Yii::t('main', 'Activities')?></h4>

	<div class="form-group">
    <?= $form->field($model, 'subject', $tt1ColInSm)->textInput()?>
  </div>

	<div class="form-group">
    <?= $form->field($model, 'type_id', $tt1ColInSm)->dropDownList(Yii::$app->appHelper->getLookupData('lkp_activity_type'))?>
  </div>

	<div class="form-group">
    <?= $form->field($model, 'priority_id', $tt1ColInSm)->dropDownList(Yii::$app->appHelper->getLookupData('lkp_activity_priority'))?>
  </div>

	<div class="form-group">
    <?= $form->field($model, 'status_id', $tt1ColInSm)->dropDownList(Yii::$app->appHelper->getLookupData('lkp_activity_status'))?>
  </div>

	<div class="form-group text-center">
    <?= Html::submitButton(Yii::t('main', 'Search'), ['class' => 'btn btn-primary'])?>
    <?php // Html::resetButton(Yii::t('main', 'Reset'), ['class' => 'btn btn-default']) ?>
  </div>

  <?php ActiveForm::end(); ?>
</div>
