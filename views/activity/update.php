<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */

$this->title=Yii::t('main', 'Edit') . Yii::t('main', 'Activity') . ' - ' . $model->subject;

$this->params['breadcrumbs'][]=['label' => Yii::t('main', 'Activity'), 'url' => ['index']];
$this->params['breadcrumbs'][]=['label' => $model->subject, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][]=Yii::t('main', 'Update');
?>

<div class="activity-update">
	<h3 class="pageTitle"><?= Html::encode($this->title) ?></h3>
  <?= $this->render('_form', [ 'model' => $model,])?>
</div>
