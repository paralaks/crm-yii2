<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Contacts */

$this->title=Yii::t('main', 'Edit') . Yii::t('main', 'Contact') . ' - ' . $model->first_name . ' ' . $model->last_name;

$this->params['breadcrumbs'][]=['label' => Yii::t('main', 'Contact'), 'url' => ['index']];
$this->params['breadcrumbs'][]=['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][]=Yii::t('main', 'Update');
?>

<div class="contacts-update">
	<h3 class="pageTitle"><?= Html::encode($this->title) ?></h3>
  <?= $this->render('_form', ['model' => $model, ])?>
</div>
