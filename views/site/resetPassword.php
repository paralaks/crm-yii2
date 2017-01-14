<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('main', 'Reset password');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">

  <?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

  <!--  >div class="pageTitle"><?= $this->title ?></div -->

  <?php $form = ActiveForm::begin(['id' => 'reset-password-form', 'action' => Url::to(['site/reset-password']), 'options' => ['class'=>'form-horizontal form-one-half']]); ?>
    <?= HTML::hiddenInput('token', $token); ?>
    <div class="row">
      <div class="col-sm-12 text-center"><strong><?= Yii::t('main', 'Please enter your new password.') ?></strong></div>
    </div>
    <div class="row">
      <?= $form->field($model, 'password', $tt1ColInSm)->passwordInput() ?>
      <?= $form->field($model, 'password_repeat', $tt1ColInSm)->passwordInput() ?>
    </div>

    <div class="form-group text-center">
      <?= Html::submitButton(Yii::t('main', 'Change Password'), ['class' => 'btn btn-primary']) ?>
    </div>
  <?php ActiveForm::end(); ?>

</div>
