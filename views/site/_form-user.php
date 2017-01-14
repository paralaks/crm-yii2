<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */


$roleList=['User'=>Yii::t('main', 'User')];

if (Yii::$app->user->can('Administrator'))
{
  $roleList['Manager']=Yii::t('main', 'Manager');
  $roleList['Administrator']=Yii::t('main', 'Administrator');
}

?>

<?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

<div class="signup-form">

  <?php $form = ActiveForm::begin(['id' => 'form-user-manage', 'options'=> ['class'=>'form-horizontal']] ); ?>

    <div class="row">
      <?= $form->field($model, 'name', $tt1ColInSm) ?>
    </div>

    <div class="row">
      <?= $form->field($model, 'username', $tt1ColInSm) ?>
    </div>

    <div class="row">
      <?= $form->field($model, 'email', $tt1ColInSm) ?>
    </div>

    <div class="row">
      <?= $form->field($model, 'password', $tt1ColInSm)->passwordInput() ?>
    </div>

    <div class="row">
      <?= $form->field($model, 'password_repeat', $tt1ColInSm)->passwordInput() ?>
    </div>

    <div class="row">
      <?= $form->field($model, 'role', $tt1ColInSm)->dropDownList($roleList) ?>
    </div>

    <div class="form-group text-center">
      <?= Html::submitButton($model->isNewRecord ? Yii::t('main', 'Save') : Yii::t('main', 'Update'), ['class' => 'btn btn-primary']) ?>
      <?= Html::a(Yii::t('main', 'Cancel'), Url::to(['site/usersmanage']), ['class' => 'btn btn-success']) ?>
    </div>

  <?php ActiveForm::end(); ?>

</div>
