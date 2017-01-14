<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = Yii::t('main', 'Update Profile');

$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'User'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-update">
  <h3 class="pageTitle"><?= $this->title ?></h3>

<?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

<div class="signup-form">

  <?php $form = ActiveForm::begin(['id' => 'form-identity-manage', 'options'=> ['class'=>'form-horizontal form-one-half']] ); ?>

    <div class="row">
      <?= $form->field($model, 'username', $tt1ColInSm)->textInput(['disabled'=>'disabled']) ?>
    </div>
    <div class="row">
      <?= $form->field($model, 'name', $tt1ColInSm)->textInput(['disabled'=>'disabled']) ?>
    </div>
    <div class="row">
      <?= $form->field($model, 'email', $tt1ColInSm)->textInput(['disabled'=>'disabled']) ?>
    </div>

    <div class="row">
      <?= $form->field($model, 'password', $tt1ColInSm)->passwordInput() ?>
    </div>

    <div class="row">
      <?= $form->field($model, 'password_new', $tt1ColInSm)->passwordInput() ?>
    </div>

    <div class="row">
      <?= $form->field($model, 'password_repeat', $tt1ColInSm)->passwordInput() ?>
    </div>

    <div class="form-group text-center">
      <?= Html::submitButton(Yii::t('main', 'Change Password'), ['class' => 'btn btn-primary']) ?>
      <?= Html::a(Yii::t('main', 'Cancel'), Url::to(['site/index']), ['class' => 'btn btn-success']) ?>
    </div>

  <?php ActiveForm::end(); ?>

</div>

</div>