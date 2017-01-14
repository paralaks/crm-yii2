<?php
/* @var $this yii\web\View */
/* @var $model app\models\Lead */
$this->title=Yii::t('main', 'New') . Yii::t('main', 'Lead');

$this->params['breadcrumbs'][]=['label' => Yii::t('main', 'Lead'), 'url' => ['index']];
$this->params['breadcrumbs'][]=$this->title;
?>

<div class="lead-create">
	<h3 class="pageTitle"><?= $this->title ?></h3>
  <?= $this->render('_form', ['model' => $model,])?>
</div>
