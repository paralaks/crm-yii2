<?php
/* @var $this yii\web\View */
/* @var $model app\models\Opportunity */
$this->title=Yii::t('main', 'New') . Yii::t('main', 'Opportunity');

$this->params['breadcrumbs'][]=['label' => Yii::t('main', 'Opportunity'), 'url' => ['index']];
$this->params['breadcrumbs'][]=$this->title;
?>
<div class="opportunity-create">
	<h3 class="pageTitle"><?= $this->title ?></h3>
  <?= $this->render('_form', ['model' => $model, ])?>
</div>
