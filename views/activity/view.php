<?php
use yii\helpers\Html;
use app\models\Activity;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */

$this->title=Yii::t('main', 'Activity Detail').' - '.$model->subject;

$this->params['breadcrumbs'][]=['label' => Yii::t('main', 'Activity'), 'url' => ['index']];
$this->params['breadcrumbs'][]=$this->title;
?>

<div class="activity-view">

  <?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

  <div class="pageTitle"><?= Html::encode($this->title) ?></div>
</div>


<div class="lightBorder rowHighlight">

	<div class="row">
		<div class="col-sm-6">
			<div class="row">
				<label for="subject" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('subject') ?>:</label>
				<div class="col-xs-8"><?= Html::encode($model->subject) ?></div>
			</div>
		</div>

		<div class="col-sm-6">
			<div class="row">
				<label for="location" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('location') ?>:</label>
				<div class="col-xs-8"><?= Html::encode($model->location) ?> </div>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-sm-6">
			<div class="row">
				<label for="type" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('type_id') ?>:</label>
				<div class="col-xs-8"><?= Yii::$app->appHelper->getLookupValue('lkp_activity_type', $model->type_id) ?></div>
			</div>
		</div>

		<div class="col-sm-6">
			<div class="row">
				<label for="priority" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('priority_id') ?>:</label>
				<div class="col-xs-8"><?= Yii::$app->appHelper->getLookupValue('lkp_activity_priority', $model->priority_id) ?></div>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-sm-6">
			<div class="row">
				<label for="start_date" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('start_date') ?>:</label>
				<div class="col-xs-8"><?= Html::encode($model->start_date) ?></div>
			</div>
		</div>

		<div class="col-sm-6">
			<div class="row">
				<label for="end_date" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('end_date') ?>:</label>
				<div class="col-xs-8"><?= Html::encode($model->end_date) ?></div>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-sm-6">
			<div class="row">
				<label for="status_id" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('status_id') ?>:</label>
				<div class="col-xs-8"><?= Yii::$app->appHelper->getLookupValue('lkp_activity_status', $model->status_id) ?></div>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-sm-6">
			<div class="row">
				<label for="allday" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('allday') ?>:</label>
				<div class="col-xs-8">
					<span class="glyphicon glyphicon-<?php if ($model->allday) echo 'ok'; ?>"></span>
				</div>
			</div>
		</div>

		<div class="col-sm-6">
			<div class="row">
				<label for="remind_at" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('remind_at') ?>:</label>
				<div class="col-xs-8"> <?= Html::encode($model->remind_at) ?></div>
			</div>
		</div>
	</div>


  <?= $this->render('../commons/desc-owner-timestamps', ['model' => $model])?>


  <div class="row">
		<div class="col-xs-12 text-center">
      <?= Html::a(Yii::t('main', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-success'])?>
      <?= Html::a(Yii::t('main', 'Delete'), ['delete','id' => $model->id],
                ['class' => 'btn btn-danger','data' => ['confirm' => Yii::t('main', 'CONFIRM_DELETION'),'method' => 'post']])?>
    </div>
	</div>
</div>

<br />

<?php

if ($model->status_id && $model->status_id != Activity::STATUS_COMPLETED &&
    (count($model->contacts) + count($model->accounts) + count($model->opportunities)) == 0)
  echo Yii::$app->appHelper->getActivityAddNewRelatedButton($model->id);

if (count($model->contacts))
  echo $this->render('../commons/related-list-activity-morph', ['model' => $model, 'records' => $model->contacts]);

if (count($model->accounts))
  echo $this->render('../commons/related-list-activity-morph', ['model' => $model, 'records' => $model->accounts]);

if (count($model->opportunities))
  echo $this->render('../commons/related-list-activity-morph', ['model' => $model, 'records' => $model->opportunities]);
?>

