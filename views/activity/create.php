<?php
/* @var $this yii\web\View */
/* @var $model app\models\Activity */
$this->title=Yii::t('main', 'New') . Yii::t('main', 'Activity');

$this->params['breadcrumbs'][]=['label' => Yii::t('main', 'Activity'), 'url' => ['index']];
$this->params['breadcrumbs'][]=$this->title;
?>

<div class="activity-create">
	<h3 class="pageTitle"><?= $this->title ?></h3>
  <?= $this->render('_form', ['model' => $model, 'controller' => $controller])?>
</div>
