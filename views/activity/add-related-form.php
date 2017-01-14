<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */
/* @var $form yii\widgets\ActiveForm */

$this->title=Yii::t('main', 'Activity').' - '.Yii::t('main', 'Add New').' '.Yii::t('main', ucfirst($model->related_type));

$this->params['breadcrumbs'][]=['label' => Yii::t('main', 'Activity'), 'url' => ['index']];
$this->params['breadcrumbs'][]=$this->title;
?>

<div class="activity-add-related">
	<h3 class="pageTitle"><?= $this->title ?></h3>

  <div class="activity-form">
    <?php $form = ActiveForm::begin(['options'=> ['class'=>'form-horizontal']] ); ?>

    <?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

    <input type="hidden" id="id" name="id" value="<?= intval($model->id) ?>" />
    <input type="hidden" id="related_type" name="related_type" value="<?= Html::encode($model->related_type) ?>" />
    <input type="hidden" id="related_id" name="related_id" value="<?= intval($model->related_id) ?>" />
    <input type="hidden" id="formSubmit" name="formSubmit" value="" />

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
    </div>

		<br />

  	<div class="form-group text-center">
      <?php
        $value= Yii::t('main', 'Add Selected');
        $onClick= $model->isNewRecord ? 'return keywordSearchResultChecked("'.Yii::t('main', 'SELECT_FROM_SEARCH_RESULTS').'")' : 'return true';
        echo Html::submitButton($value, ['name'=> 'submit1', 'value'=>'save', 'class' => 'btn btn-primary', 'onclick'=>'$("#formSubmit").val("save"); '.$onClick]);
      ?>

      <?= Html::a(Yii::t('main', 'Cancel'), Url::to($model->id ? ['activity/view', 'id' => $model->id] : ['activity/index']), ['class' => 'btn btn-success'])?>
    </div>

  	<?= $this->render('../commons/change-helper-search-results-multi', ['model' => $model, 'controller' => $controller, 'jsFunction' => 'setActivityContact'])?>

    <?php ActiveForm::end(); ?>

  </div>
</div>
