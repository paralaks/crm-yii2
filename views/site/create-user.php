<?php
/* @var $this yii\web\View */
/* @var $model app\models\User */
$this->title=Yii::t('main', 'New') . Yii::t('main', 'User');

$this->params['breadcrumbs'][]=['label' => Yii::t('main', 'User'), 'url' => ['index']];
$this->params['breadcrumbs'][]=$this->title;
?>
<div class="user-create">
	<h3 class="pageTitle"><?= $this->title ?></h3>
  <?= $this->render('_form-user', ['model' => $model, ])?>
</div>