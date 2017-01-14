<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('main', 'Request password reset');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password-request">

  <?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

  <!--  >div class="pageTitle"><?= $this->title ?></div -->


  <?php $form = ActiveForm::begin(['id' => 'reset-password-request-form', 'action'=>Url::to(['site/reset-password-request']), 'options'=> ['class'=>'form-horizontal form-one-half']]); ?>
    <div class="row">
      <div class="col-sm-12 text-center"><strong><?= Yii::t('main', 'Enter you email for password recovery') ?></strong>
      </div>
    </div>

    <div class="row">
      <?= $form->field($model, 'email', $tt1ColInSm) ?>
    </div>

    <div class="form-group text-center">
        <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
    </div>
  <?php ActiveForm::end(); ?>

</div>
