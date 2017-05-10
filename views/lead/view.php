<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Lead */

$this->title=Yii::t('main', 'Lead Detail').' - '.$model->first_name.' '.$model->last_name;

$this->params['breadcrumbs'][]=['label' => Yii::t('main', 'Lead'), 'url' => ['index']];
$this->params['breadcrumbs'][]=$this->title;
?>

<div class="lead-view">

  <?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

  <div class="pageTitle"><?= Html::encode($this->title) ?></div>
</div>


<div class="lightBorder rowHighlight">

  <div class="row">
    <div class="col-sm-6">
      <div class="row">
        <label for="name" class="text-right col-xs-4">&nbsp;<?= Yii::t('main', 'Name') ?>:</label>
        <div class="col-xs-8"><?= Yii::$app->appHelper->getLookupValue('lkp_salutation', $model->salutation_id) ?> <?= Html::encode($model->first_name.' '.$model->last_name) ?></div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-sm-6">
      <div class="row">
        <label for="company" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('company') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->company) ?></div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="row">
        <label for="title" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('title') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->title) ?></div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-sm-6">
      <div class="row">
        <label for="industy" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('industry') ?>:</label>
        <div class="col-xs-8"><?= Yii::$app->appHelper->getLookupValue('lkp_industry', $model->industry_id) ?></div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="row">
        <label for="email" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('email') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->email) ?></div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-sm-6">
      <div class="row">
        <label for="phone" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('phone') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->phone) ?></div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="row">
        <label for="mobile_phone" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('mobile_phone') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->mobile_phone) ?></div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-sm-6">
      <div class="row">
        <label for="fax" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('fax') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->fax) ?></div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="row">
        <label for="rating" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('rating_id') ?>:</label>
        <div class="col-xs-8"><?= Yii::$app->appHelper->getLookupValue('lkp_rating', $model->rating_id) ?></div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-sm-6">
      <div class="row">
        <label for="annual_revenue" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('annual_revenue') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->annual_revenue) ?></div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="row">
        <label for="num_of_employees" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('num_of_employees') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->num_of_employees) ?></div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-sm-6">
      <div class="row">
        <label for="website" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('website') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->website) ?></div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="row">
        <label for="birthdate" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('birthdate') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->birthdate) ?></div>
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
        <label for="status_id" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('status_id') ?>:</label>
        <div class="col-xs-8"><?= Yii::$app->appHelper->getLookupValue('lkp_lead_status', $model->status_id) ?></div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-xs-6 col-sm-3 col-md-2 col-md-offset-1 text-nowrap">
      <label for="do_not_call" class="text-right">&nbsp;<?= $model->getAttributeLabel('do_not_call') ?>:</label>&nbsp;&nbsp;<span class="glyphicon glyphicon-<?php if ($model->do_not_call) echo 'ok'; ?>"></span>
    </div>
    <div class="col-xs-6 col-sm-3 col-md-2 text-nowrap">
      <label for="do_not_email" class="text-right">&nbsp;<?= $model->getAttributeLabel('do_not_email') ?>:</label>&nbsp;&nbsp;<span class="glyphicon glyphicon-<?php if ($model->do_not_email) echo 'ok'; ?>"></span>
    </div>
    <div class="col-xs-6 col-sm-3 col-md-2 text-nowrap">
      <label for="do_not_fax" class="text-right">&nbsp;<?= $model->getAttributeLabel('do_not_fax') ?>:</label>&nbsp;&nbsp;<span class="glyphicon glyphicon-<?php if ($model->do_not_fax) echo 'ok'; ?>"></span>
    </div>
    <div class="col-xs-6 col-sm-3 col-md-2 text-nowrap">
      <label for="email_opt_out" class="text-right">&nbsp;<?= $model->getAttributeLabel('email_out_out') ?>:</label>&nbsp;&nbsp;<span class="glyphicon glyphicon-<?php if ($model->email_opt_out) echo 'ok'; ?>"></span>
    </div>
    <div class="col-xs-6 col-sm-3 col-md-2 text-nowrap">
      <label for="do_not_call" class="text-right">&nbsp;<?= $model->getAttributeLabel('fax_out_out') ?>:</label>&nbsp;&nbsp;<span class="glyphicon glyphicon-<?php if ($model->fax_opt_out) echo 'ok'; ?>"></span>
    </div>
  </div>


  <div class="row">
    <label for="address" class="text-right col-xs-4 col-sm-2">&nbsp;<?= Yii::t('main', 'Address') ?>:</label>
    <div class="col-xs-8 col-sm-10"><?= Html::encode($model->street) ?> <br> <?= Html::encode($model->city) ?>, <?= Html::encode($model->state) ?>, <?= Html::encode($model->zip) ?> <br> <?= Yii::$app->appHelper->getLookupValue('countries', $model->country) ?></div>
  </div>


  <?= $this->render('../commons/desc-owner-timestamps', ['model' => $model]) ?>


  <div class="row">
    <div class="col-xs-12 text-center">
      <?= Html::a(Yii::t('main', 'Edit'), ['update', 'id' => $model->id], ['id' => 'lead-edit-btn', 'class' => 'btn btn-success']) ?>
      <?= Html::a(Yii::t('main', 'Delete'), ['delete','id' => $model->id], ['id' => 'lead-delete-btn', 'class' => 'btn btn-danger','data' => ['confirm' => Yii::t('main', 'CONFIRM_DELETION'),'method' => 'post']]) ?>
      <?= Html::a(Yii::t('main', 'Convert'), ['convert','id' => $model->id], ['id' => 'lead-convert-btn', 'class' => 'btn btn-primary']) ?>
    </div>
  </div>

</div>

<br />

<?= $this->render('../commons/related-list-activity', ['model' => $model]) ?>

