<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Account */

$this->title=Yii::t('main', 'Account Detail').' - '.$model->name;

$this->params['breadcrumbs'][]=['label' => Yii::t('main', 'Account'), 'url' => ['index'] ];
$this->params['breadcrumbs'][]=$this->title;
?>

<div class="accounts-view">

  <?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

  <div class="pageTitle"><?= Html::encode($this->title) ?></div>

  <div class="container relatedListLinks">
    <a href="#relatedListContacts"><?= Yii::t('main', 'Contacts') ?></a>
    <a href="#relatedListActivities"><?= Yii::t('main', 'Activities') ?></a>
  </div>
  <!-- DetailView::widget(['model' => $model,'attributes' => ['id','name','number','phone','fax','annual_revenue','num_of_employees','website','description:ntext','street','city','state','zip','country','street_other','city_other','state_other','zip_other','country_other','lead_source_id','industry_id','type_id','ownership_id','rating_id','owner_id','adder_id','modifier_id','deleted_at','created_at','updated_at']])  -->
</div>


<div class="lightBorder rowHighlight">

  <div class="row">
    <div class="col-sm-6">
      <div class="row">
        <label for="name" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('name') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->name) ?></div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="row">
        <label for="type_id" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('type_id') ?>:</label>
        <div class="col-xs-8"><?= Yii::$app->appHelper->getLookupValue('lkp_account_type', $model->type_id) ?></div>
      </div>
    </div>
  </div>


  <!-- <div class="row">
    <div class="col-sm-6">
      <div class="row">
        <label for="number" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('number') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->number) ?></div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="row">
        <label for="rating_id" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('rating_id') ?>:</label>
        <div class="col-xs-8"><?= Yii::$app->appHelper->getLookupValue('lkp_rating', $model->rating_id) ?></div>
      </div>
    </div>
  </div> -->


  <div class="row">
    <div class="col-sm-6">
      <div class="row">
        <label for="industry_id" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('phone') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->phone) ?></div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="row">
        <label for="industry_id" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('fax') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->fax) ?></div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-sm-6">
      <div class="row">
        <label for="industry" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('industry_id') ?>:</label>
        <div class="col-xs-8"><?= Yii::$app->appHelper->getLookupValue('lkp_industry', $model->industry_id) ?></div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="row">
        <label for="industry_id" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('num_of_employees') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->num_of_employees) ?></div>
      </div>
    </div>
  </div>


  <!-- <div class="row">
    <div class="col-sm-6">
      <div class="row">
        <label for="industry_id" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('annual_revenue') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->annual_revenue) ?></div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="row">
        <label for="ownership" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('ownership_id') ?>:</label>
        <div class="col-xs-8"><?= Yii::$app->appHelper->getLookupValue('lkp_account_ownership', $model->ownership_id) ?></div>
      </div>
    </div>
  </div> -->


  <div class="row">
    <div class="col-sm-6">
      <div class="row">
        <label for="lead_source_id" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('lead_source_id') ?>:</label>
        <div class="col-xs-8"><?= Yii::$app->appHelper->getLookupValue('lkp_lead_source', $model->lead_source_id) ?></div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="row">
        <label for="lead_source_id" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('lead_source_detail') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->lead_source_detail) ?></div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-sm-6">
      <div class="row">
        <label for="address" class="text-right col-xs-4">&nbsp;<?= Yii::t('main', 'Address') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->street) ?> <br> <?= Html::encode($model->city) ?>, <?= Html::encode($model->state) ?>, <?= Html::encode($model->zip) ?> <br> <?= Yii::$app->appHelper->getLookupValue($model->country) ?></div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="row">
        <label for="website" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('website') ?>:</label>
        <div class="col-xs-8"><?= Html::a(Html::encode($model->website), Html::encode($model->website), ['target'=>'_blank'])  ?></div>
      </div>
    </div>
    <!-- <div class="col-sm-6">
      <div class="row">
        <label for="address_other" class="text-right col-xs-4">&nbsp;<?= Yii::t('main', 'Shipping Address') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->street_other) ?> <br> <?= Html::encode($model->city_other) ?>, <?= Html::encode($model->state_other) ?>, <?= Html::encode($model->zip_other) ?> <br> <?= Yii::$app->appHelper->getLookupValue($model->country_other) ?></div>
      </div>
    </div> -->
  </div>


  <?= $this->render('../commons/desc-owner-timestamps', ['model' => $model]) ?>


  <div class="row">
    <div class="col-xs-12 text-center">
      <?= Html::a(Yii::t('main', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-success'])?>
      <?= Html::a(Yii::t('main', 'Delete'), ['delete','id' => $model->id], ['class' => 'btn btn-danger','data' => ['confirm' => Yii::t('main', 'CONFIRM_DELETION'),'method' => 'post']])?>
    </div>
  </div>
</div>

<br />

<?= $this->render('../commons/related-list-contact', ['model' => $model]) ?>

<?= $this->render('../commons/related-list-activity', ['model' => $model]) ?>
