<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-form">

  <?php $form = ActiveForm::begin(['options'=> ['class'=>'form-horizontal']] ); ?>

  <?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

  <input type="hidden" id="related_type" name="related_type" value="<?= Html::encode($model->related_type) ?>" />
  <input type="hidden" id="related_id" name="related_id" value="<?= intval($model->related_id) ?>" />
  <input type="hidden" id="formSubmit" name="formSubmit" value="" />

  <div class="form-group">
    <?= $form->field($model, 'subject', $tt2ColIn)->textInput()?>
    <?= $form->field($model, 'location', $tt2ColIn)->textInput()?>
  </div>

	<div class="form-group">
    <?= $form->field($model, 'type_id', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('lkp_activity_type'))?>
    <?= $form->field($model, 'priority_id', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('lkp_activity_priority'))?>
  </div>

	<div class="form-group">
    <?= $form->field($model, 'start_date', $tt2ColIn)->textInput()?>
    <?= $form->field($model, 'end_date', $tt2ColIn)->textInput()?>
  </div>

	<div class="form-group">
    <?= $form->field($model, 'status_id', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('lkp_activity_status'))?>
  </div>

	<div class="form-group">
    <?= $form->field($model, 'allday', $tt2ColCBox)->checkbox(null, false)?>
    <?= $form->field($model, 'remind_at', $tt2ColIn)->textInput()?>
  </div>

	<div class="form-group">
    <?= $form->field($model, 'description', $tt2ColIn)->textarea()?>
    <?= $form->field($model, 'owner_id', $tt2ColIn)->dropDownList(Yii::$app->appHelper->getLookupData('users'))?>
  </div>

	<div class="form-group text-center">
    <?php
      $value= $model->isNewRecord ? Yii::t('main', 'Save') : Yii::t('main', 'Update');
      $onClick= $model->isNewRecord ? 'return keywordSearchResultChecked("'.Yii::t('main', 'SELECT_FROM_SEARCH_RESULTS').'")' : 'return true';
      echo Html::submitButton($value, ['name'=> 'submit1', 'value'=>'save', 'class' => 'btn btn-primary', 'onclick'=>'$("#formSubmit").val("save"); '.$onClick]);
    ?>

    <?= Html::a(Yii::t('main', 'Cancel'), Url::to($model->id ? ['activity/view', 'id' => $model->id] : ['activity/index']), ['class' => 'btn btn-success'])?>
  </div>

	<?= $model->isNewRecord ? $this->render('../commons/change-helper-search-results-multi', ['model' => $model, 'controller' => $controller, 'jsFunction' => 'setActivityContact']) : '' ?>

  <?php ActiveForm::end(); ?>

</div>
