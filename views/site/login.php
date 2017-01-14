<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title=Yii::t('main', 'Login');
//$this->params['breadcrumbs'][]=$this->title;
?>
<div class="site-login">

  <?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

  <div class="pageTitle"><?= $this->title ?></div>

  <?php $form=ActiveForm::begin(['id' => 'form-login', 'action'=>Url::to(['site/login']),  'options' => ['class' => 'form-horizontal form-one-half']]); ?>

  <div class="row"><div class="col-xs-12"><strong><?= Yii::t('main', 'Please enter your credentials to login') ?>:</strong></div></div>

  <div class="row">
    <?= $form->field($model, 'username', $tt1ColInSm)?>
  </div>

  <div class="row">
    <?= $form->field($model, 'password', $tt1ColInSm)->passwordInput()?>
  </div>

<?php
/*
<?= $form->field($model, 'rememberMe', $tt1ColCbox)->checkbox() ?>
*/
?>

  <div class="form-group">
    <div class="col-xs-7 text-right">
      <?= Html::submitButton(Yii::t('main', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button'])?>
    </div>
    <div class="col-xs-5 text-right">
      <br>
      <?= Html::a(Yii::t('main', 'Forgot password'), Url::to(['site/reset-password-request'])) ?>
    </div>
  </div>

  <?php ActiveForm::end(); ?>
</div>


