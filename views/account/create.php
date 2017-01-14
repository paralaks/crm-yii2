<?php

/* @var $this yii\web\View */
/* @var $model app\models\Account */
$this->title=Yii::t('main', 'New') . Yii::t('main', 'Account');

$this->params['breadcrumbs'][]=['label' => Yii::t('main', 'Account'), 'url' => ['index']];
$this->params['breadcrumbs'][]=$this->title;
?>

<div class="account-create">
	<h3 class="pageTitle"><?= $this->title ?></h3>
  <?= $this->render('_form', ['model' => $model,])?>
</div>
