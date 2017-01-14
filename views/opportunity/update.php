<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Opportunity */

$this->title=Yii::t('main', 'Edit') . Yii::t('main', 'Opportunity') . ' - ' . $model->name;

$this->params['breadcrumbs'][]=['label' => Yii::t('main', 'Opportunity'), 'url' => ['index']];
$this->params['breadcrumbs'][]=['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][]=Yii::t('main', 'Update');
?>
<div class="opportunities-update">
	<h3 class="pageTitle"><?= Html::encode($this->title) ?></h3>
  <?= $this->render('_form', ['model' => $model,])?>
</div>
