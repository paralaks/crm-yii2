<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Opportunity */

$this->title=Yii::t('main', 'Opportunity Detail') . ' - ' . $model->name;

$this->params['breadcrumbs'][]=['label' => Yii::t('main', 'Opportunity'), 'url' => ['index']];
$this->params['breadcrumbs'][]=$this->title;
?>

<div class="opportunities-view">

  <?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

  <div class="pageTitle"><?= Html::encode($this->title) ?></div>
</div>


<div class="lightBorder rowHighlight">

	<div class="row">
		<div class="col-sm-6">
			<div class="row">
				<label for="type_id" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('type_id') ?>:</label>
				<div class="col-xs-8"><?= Yii::$app->appHelper->getLookupValue('lkp_opportunity_type', $model->type_id) ?></div>
			</div>
		</div>

		<div class="col-sm-6">
			<div class="row">
				<label for="name" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('name') ?>:</label>
				<div class="col-xs-8"><?= Html::encode($model->name) ?></div>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-sm-6">
			<div class="row">
				<label for="stage_id" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('stage_id') ?>:</label>
				<div class="col-xs-8"><?= Yii::$app->appHelper->getLookupValue('lkp_opportunity_stage', $model->stage_id) ?></div>
			</div>
		</div>

		<div class="col-sm-6">
			<div class="row">
				<label for="close_date" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('close_date') ?>:</label>
				<div class="col-xs-8"><?= Html::encode($model->close_date) ?></div>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-sm-6">
			<div class="row">
				<label for="probability" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('probability') ?>:</label>
				<div class="col-xs-8"><?= Html::encode($model->probability) ?></div>
			</div>
		</div>

		<div class="col-sm-6">
			<div class="row">
				<label for="next_step" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('next_step') ?>:</label>
				<div class="col-xs-8"><?= Html::encode($model->next_step) ?></div>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-sm-6">
			<div class="row">
				<label for="lead_source_id" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('lead_source_id') ?>:</label>
				<div class="col-xs-8"><?= Yii::$app->appHelper->getLookupValue('lkp_lead_source', $model->lead_source_id) ?></div>
			</div>
		</div>

		<div class="col-sm-6">
			<div class="row">
				<label for="next_step" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('competitors') ?>:</label>
				<div class="col-xs-8"><?= Html::encode($model->competitors) ?></div>
			</div>
		</div>
	</div>


  <?= $this->render('../commons/desc-owner-timestamps', ['model' => $model])?>


  <div class="row">
		<div class="col-xs-12 text-center">
      <?= Html::a(Yii::t('main', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-success'])?>
      <?= Html::a(Yii::t('main', 'Delete'), ['delete','id' => $model->id], ['class' => 'btn btn-danger','data' => ['confirm' => Yii::t('main', 'CONFIRM_DELETION'),'method' => 'post']])?>
    </div>
	</div>
</div>

<br />

<?= $this->render('contact-list', ['model' => $model])?>

<?= $this->render('../commons/related-list-activity', ['model' => $model])?>

