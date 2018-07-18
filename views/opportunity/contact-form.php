<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;


/* @var $this yii\web\View */

$this->title=Yii::t('main', 'Select Related Contact');

$this->params['breadcrumbs'][]=['label' => Yii::t('main', 'Opportunity'), 'url' => ['index']];
$this->params['breadcrumbs'][]=$this->title;
?>

<div class="contact-change">
	<div class="pageTitle"><?= $this->title ?></div>
</div>

<?php $form = ActiveForm::begin(['options'=> ['action'=>'/opportunity/addcontact/'.$model->id, 'class'=>'form-horizontal']]); ?>

<?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

<input type="hidden" name="id" value="<?= $model->id ?>" />
<input type="hidden" name="relId" value="<?= $relation->id ?>" />
<input type="hidden" id="formSubmit" name="formSubmit" value="" />
<?= $form->field($relation, 'opportunity_id')->hiddenInput()->label(false)?>

<div class="text-center">
  <?= Yii::t('main', 'Use search form below') ?>
</div>
<br/>

<div class="form-one-third">
	<div class="form-group">
    <?php
    $useList=isset($useList) ? $useList : false;
    $contactOptions=$tt1ColInSm;
    $contactOptions['inputOptions']['style']=$useList ? 'display:none' : '';

    echo $form->field($relation, 'contact_id', $contactOptions)->label($useList ? false : null)->dropdownList(
    [($relation->contact_id ? intval($relation->contact_id) : '') =>
        Html::encode($relation->contact_id ? $relation->contact->first_name . ' ' . $relation->contact->last_name : '')]);
    ?>
  </div>

	<div class="form-group text-center">
    <?php
      $value= !$relation->id ? Yii::t('main', 'Save') : Yii::t('main', 'Update');
      $onClick= !$relation->id ? 'return keywordSearchResultChecked("'.Yii::t('main', 'SELECT_FROM_SEARCH_RESULTS').'")' : 'return true';
      echo Html::submitButton($value, ['name'=> 'submit1', 'value'=>'save', 'class' => 'btn btn-primary', 'onclick'=>'$("#formSubmit").val("save"); '.$onClick]);
    ?>
    <?= Html::a(Yii::t('main', 'Cancel'), Url::to(['opportunity/view', 'id' => $model->id]), ['class' => 'btn btn-success'])?>
  </div>
</div>

<?php
if ($relation->id)
  echo $this->render('../commons/change-helper-search-results', ['model' => $model, 'controller' => $controller, 'relation' => $relation, 'jsFunction'=>'setOpportunityRelatedContact']);
else
  echo $this->render('../commons/change-helper-search-results-multi', ['model' => $model, 'controller' => $controller, 'relation' => $relation, 'useList' => $useList]);
?>

<?php ActiveForm::end(); ?>
