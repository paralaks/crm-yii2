<?php

/* @var $this yii\web\View */
/* @var $model app\models\Contacts */
$this->title=Yii::t('main', 'New') . Yii::t('main', 'Contact');

$this->params['breadcrumbs'][]=['label' => Yii::t('main', 'Contact'), 'url' => ['index']];
$this->params['breadcrumbs'][]=$this->title;
?>

<div class="contact-create">
	<h3 class="pageTitle"><?= $this->title ?></h3>
  <?= $this->render('_form', ['model' => $model, ])?>
</div>
