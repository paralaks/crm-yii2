<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Contacts */

$this->title=Yii::t('main', 'Contact Detail').' - '.$model->first_name.' '.$model->last_name;

$this->params['breadcrumbs'][]=['label' => Yii::t('main', 'Contact'), 'url' => ['index']];
$this->params['breadcrumbs'][]=$this->title;
?>

<div class="contacts-view">

  <?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

  <div class="pageTitle">
    <div class="text"><?= Html::encode($this->title) ?></div>
    <div class="picture"><img src="/images/contact/<?= $model->picture ?>"></div>
  </div>
</div>

<div class="container relatedListLinks">
  <a href="#relatedListRelatedContacts"><?= Yii::t('main', 'Related Contacts') ?></a>
  <a href="#relatedListOpportunities"><?= Yii::t('main', 'Opportunities') ?></a>
  <a href="#relatedListActivities"><?= Yii::t('main', 'Activities') ?></a>
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
        <label for="type_id" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('type_id') ?>:</label>
        <div class="col-xs-8"><?= Yii::$app->appHelper->getLookupValue('lkp_contact_type', $model->type_id) ?></div>
      </div>
    </div>
  </div>


  <div class="row">
    <label for="type_id" class="text-right col-xs-4 col-sm-2"> <?= Yii::t('main', 'Categories') ?>: </label>
    <div class="col-xs-8 col-sm-0"> </div>
    <div class="text-center col-xs-12 col-sm-3"><?= Yii::$app->appHelper->getLookupValue('lkp_contact_category', $model->category_id) ?></div>
    <div class="text-center col-xs-12 col-sm-3"><?= Yii::$app->appHelper->getLookupValue('lkp_contact_category', $model->category2_id) ?></div>
    <div class="text-center col-xs-12 col-sm-3"><?= Yii::$app->appHelper->getLookupValue('lkp_contact_category', $model->category3_id) ?></div>
  </div>

  <div class="row">
    <label for="account_id" class="text-right col-xs-4 col-sm-2"> <?= Yii::t('main', 'Accounts') ?>:</label>
    <div class="col-xs-8 col-sm-0"> </div>
    <div class="text-center col-xs-12 col-sm-3"><a href="<?= Url::to(['account/view', 'id'=>($model->account ? $model->account->id : 0)]) ?>"><?= Html::encode( $model->account ? $model->account->name : '') ?></a></div>
    <div class="text-center col-xs-12 col-sm-3"><a href="<?= Url::to(['account/view', 'id'=>($model->account2 ? $model->account2->id : 0)]) ?>"><?= Html::encode( $model->account2 ? $model->account2->name : '') ?></a></div>
    <div class="text-center col-xs-12 col-sm-3"><a href="<?= Url::to(['account/view', 'id'=>($model->account3 ? $model->account3->id : 0)]) ?>"><?= Html::encode( $model->account3 ? $model->account3->name : '') ?></a></div>
  </div>

  <div class="row">
    <label for="account_id" class="text-right col-xs-4 col-sm-2"> <?= Yii::t('main', 'Titles') ?>:</label>
    <div class="col-xs-8 col-sm-0"> </div>
    <div class="text-center col-xs-12 col-sm-3"><?= Html::encode($model->title) ?></div>
    <div class="text-center col-xs-12 col-sm-3"><?= Html::encode($model->title2) ?></div>
    <div class="text-center col-xs-12 col-sm-3"><?= Html::encode($model->title3) ?></div>
  </div>


  <div class="row">
    <div class="col-sm-6">
      <div class="row">
        <label for="department" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('department') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->department) ?></div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-sm-6">
      <div class="row">
        <label for="email" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('email') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->email) ?></div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="row">
        <label for="phone" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('phone') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->phone) ?></div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-sm-6">
      <div class="row">
        <label for="mobile_phone" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('mobile_phone') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->mobile_phone) ?></div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="row">
        <label for="home_phone" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('home_phone') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->home_phone) ?></div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-sm-6">
      <div class="row">
        <label for="other_phone" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('other_phone') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->other_phone) ?></div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="row">
        <label for="birthdate" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('birthdate') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->birthdate) ?></div>
      </div>
    </div>

    <!-- div class="col-sm-6">
      <div class="row">
        <label for="fax" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('fax') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->fax) ?></div>
      </div>
    </div -->
  </div>


  <div class="row">
    <div class="col-sm-6">
      <div class="row">
        <label for="assistant" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('assistant') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->assistant) ?></div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="row">
        <label for="assistant_phone" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('assistant_phone') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->assistant_phone) ?></div>
      </div>
    </div>
  </div>


  <div class="row">
    <label for="interests" class="text-right col-xs-4 col-sm-2">&nbsp;<?= $model->getAttributeLabel('interests') ?>:</label>
    <div class="col-xs-8 col-sm-10"><?= Html::encode($model->interests) ?></div>
  </div>


  <div class="row">
    <div class="col-xs-6 col-sm-4 col-md-2 col-md-offset-1 text-nowrap">
      <label for="do_not_call" class="text-right">&nbsp;<?= $model->getAttributeLabel('do_not_call') ?>:</label>&nbsp;&nbsp;<span class="glyphicon glyphicon-<?php if ($model->do_not_call) echo 'ok'; ?>"></span>
    </div>
    <div class="col-xs-6 col-sm-4 col-md-2 text-nowrap">
      <label for="do_not_email" class="text-right">&nbsp;<?= $model->getAttributeLabel('do_not_email') ?>:</label>&nbsp;&nbsp;<span class="glyphicon glyphicon-<?php if ($model->do_not_email) echo 'ok'; ?>"></span>
    </div>
    <!-- div class="col-xs-6 col-sm-3 col-md-2 text-nowrap">
      <label for="do_not_fax" class="text-right">&nbsp;<?= $model->getAttributeLabel('do_not_fax') ?>:</label>&nbsp;&nbsp;<span class="glyphicon glyphicon-<?php if ($model->do_not_fax) echo 'ok'; ?>"></span>
    </div -->
    <div class="col-xs-6 col-sm-4 col-md-2 text-nowrap">
      <label for="email_opt_out" class="text-right">&nbsp;<?= $model->getAttributeLabel('email_opt_out') ?>:</label>&nbsp;&nbsp;<span class="glyphicon glyphicon-<?php if ($model->email_opt_out) echo 'ok'; ?>"></span>
    </div>
    <!-- >div class="col-xs-6 col-sm-3 col-md-2 text-nowrap">
      <label for="do_not_call" class="text-right">&nbsp;<?= $model->getAttributeLabel('fax_opt_out') ?>:</label>&nbsp;&nbsp;<span class="glyphicon glyphicon-<?php if ($model->fax_opt_out) echo 'ok'; ?>"></span>
    </div -->
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
        <label for="lead_source_id" class="text-right col-xs-4">&nbsp;<?= $model->getAttributeLabel('lead_source_detail') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->lead_source_detail) ?></div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-sm-6">
      <div class="row">
        <label for="address" class="text-right col-xs-4">&nbsp;<?= Yii::t('main', 'Address') ?>:</label>
        <div class="col-xs-8"><?= Html::encode($model->street) ?> <br> <?= Html::encode($model->city) ?>, <?= Html::encode($model->state) ?>, <?= Html::encode($model->zip) ?> <br> <?= Yii::$app->appHelper->getLookupValue('countries', $model->country) ?></div>
      </div>
    </div>
  </div>


  <?= $this->render('../commons/desc-owner-timestamps', ['model' => $model]) ?>


  <div class="row">
    <div class="col-xs-12 text-center">
      <?= Html::a(Yii::t('main', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
      <?= Html::a(Yii::t('main', 'Delete'), ['delete','id' => $model->id], ['class' => 'btn btn-danger','data' => ['confirm' => Yii::t('main', 'CONFIRM_DELETION'),'method' => 'post']]) ?>
    </div>
  </div>

</div>

<br />

<?= $this->render('opportunity-list', ['model' => $model]) ?>

<?= $this->render('../commons/related-list-activity', ['model' => $model]) ?>
