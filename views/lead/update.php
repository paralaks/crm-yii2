<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Lead */

$this->title=Yii::t('main', 'Edit') . Yii::t('main', 'Lead') . ' - ' . $model->first_name . ' ' . $model->last_name;

$this->params['breadcrumbs'][]=['label' => Yii::t('main', 'Lead'), 'url' => ['index']];
$this->params['breadcrumbs'][]=['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][]=Yii::t('main', 'Update');
?>

<div class="lead-update">
	<h3 class="pageTitle"><?= Html::encode($this->title) ?></h3>
  <?= $this->render('_form', ['model' => $model,])?>
</div>
