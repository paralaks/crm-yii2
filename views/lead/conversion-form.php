<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LeadConvertForm */

$this->title = Yii::t('main', 'Convert Lead').' - '.$lead->first_name.' '.$lead->last_name;

$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Lead'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', 'id' => $lead->id]];
$this->params['breadcrumbs'][] = Yii::t('main', 'Convert');
?>

<div class="lead-convert">
  <div class="pageTitle"><?= Html::encode($this->title) ?></div>


  <?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

<?php $form = ActiveForm::begin(['options'=> ['class'=>'form-horizontal form-one-half']] ); ?>

 	<?= $form->field($model, 'convert_lead', $tt1ColInSm)->hiddenInput()->label(false) ?>

  <div class="row">
  	<?= $form->field($model, 'account_name', $tt1ColInSm)->textInput() ?>
  </div>

  <?php if (count($accountResults))
  {
  ?>
  <div class="row">
    <div class="col-xs-12 text-center"><strong><?= Yii::t('main', 'Similar accounts found during conversion.') ?></strong></div>
  </div>

  <div class="row">
      <?= $form->field($model, 'account_id', $tt1ColInSm)->dropDownList(array_merge(["name"=>''], array_column($accountResults, "name")))->label("Existing accounts") ?>
      <?php if ($tooManyResults===true)
        echo '<br>(<b>'.Yii::t('main', 'Too many results. Try again with another keyword.').'</b>)';
        ?>
  </div>
  <?php
  }
  ?>

  <div class="row">
    <label class="form-contol col-xs-4 text-right"><?= Yii::t('main', 'Create New Opportunity?') ?></label>
    <div class="col-xs-4 text-center">
      <?= $form->field($model, 'new_opportunity')->radioList([1=>'Yes', 0=>'No'])->label(false) ?>
    </div>
  </div>

  <div id="newOpportunityFields" style="display: <?= empty($model->new_opportunity) ? 'none' : 'block' ?>">
    <div class="row">
    	<?= $form->field($model, 'opportunity_name', $tt1ColInSm)->textInput() ?>
    </div>

    <div class="row">
    	<?= $form->field($model, 'stage_id', $tt1ColInSm)->dropDownList(Yii::$app->appHelper->getLookupData('lkp_opportunity_stage', $model->stage_id)) ?>
    </div>

    <div class="row">
    	<?= $form->field($model, 'close_date', $tt1ColInSm)->textInput() ?>
    </div>
  </div>


  <div class="form-group text-center">
    <?= Html::input('submit', 'Convert', Yii::t('main', 'Convert'), ['class' => 'btn btn-primary']) ?>
    <?= Html::a(Yii::t('main', 'Cancel'), Url::to(['lead/view', 'id' => $lead->id]), ['class' => 'btn btn-success']) ?>
  </div>

<?php ActiveForm::end(); ?>

</div>
