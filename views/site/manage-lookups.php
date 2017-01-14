<?php
use yii\widgets\ActiveForm;
use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\usersearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('main', 'Manage Dropdowns');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lookup-edit">

  <?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

  <div class="pageTitle"><?= $this->title ?></div>
  <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
</div>

<div class="lookup-table-form">
  <form id="form-lookup-source" method="post" action="/site/lookupsmanage" accept-charset="UTF-8" class="form-horizontal">
    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />

    <div class="row">
      <div class="col-sm-12">
        <label for="name" class="control-label ui-state-default text-nowrap  col-xs-5 col-sm-5">&nbsp;<?= Yii::t('main', 'Dropdown Name') ?>:</label>
        <div class="col-xs-7 col-sm-7"><?= Html::dropDownList('tableName', $model->tableName, $lookupList,
              ['prompt'=>'', 'class'=>'form-control', 'onChange'=>'document.getElementById("form-lookup-source").submit()']) ?></div>
      </div>
    </div>
  </form>
</div>

<div class="lookup-form">
  <?php $form = ActiveForm::begin(['options'=> ['id' => 'form-lookup-value', 'class'=>'form-horizontal']] ); ?>
    <div class="row">
      <?= $form->field($model, 'tableName', $tt1ColIn)->hiddenInput()->label(false) ?>
    </div>
    <?= $form->field($model, 'id', $tt1ColIn)->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'action', $tt1ColIn)->hiddenInput()->label(false) ?>

    <div class="row">
      <?= $form->field($model, 'value', $tt1ColInSm) ?>
    </div>

    <div class="row">
      <?= $form->field($model, 'idxpos', $tt1ColInSm) ?>
    </div>

    <div class="row">
      <?= $form->field($model, 'description', $tt1ColInSm) ?>
    </div>

    <div class="form-group text-center">
      <?= Html::submitButton(!$model->id ? Yii::t('main', 'Save') : Yii::t('main', 'Update'), ['class' => 'btn btn-primary']) ?>
      <?= Html::resetButton(Yii::t('main', 'Reset'),['class' => 'btn btn-success', 'onClick'=>'resetLookupFormFields()']) ?>
    </div>
  <?php ActiveForm::end(); ?>
</div>


<div class="table-responsive">
  <table class="table table-striped table-bordered table-hover table-condensed searchResults">
    <tr class="ui-state-default">
      <th><?= Yii::t('main', 'ID') ?></th>
      <th><?= Yii::t('main', 'Value') ?></th>
      <th><?= Yii::t('main', 'Ordering') ?></th>
      <th><?= Yii::t('main', 'Tooltip Text') ?></th>
      <th><?= Yii::t('main', 'Editable') ?></th>
      <th><?= Yii::t('main', 'Updated At') ?></th>
      <th>&nbsp;</th>
    </tr>
<?php
if (count($values))
  foreach ($values as $record)
  {
    $actions= $record['editable'] ?
              Html::a(Yii::t('main', 'Edit'), '#', ['class'=>'', 'onClick'=>"setLookupFormFields({$record['id']}, '".Html::encode($record['value'])."', '{$record['idxpos']}', '".Html::encode($record['description'])."')"]).'&nbsp;&nbsp;&nbsp;'.
              Html::a(Yii::t('main', 'Delete'), '#', ['class' => 'text-danger', 'onclick'=>"submitDeleteLookupField({$record['id']}, '".$model->tableName."')"])
            : '&nbsp;';

    echo '
    <tr>
      <td>'.$record['id'].'</td>
      <td>'.Html::encode($record['value']).'</td>
      <td>'.$record['idxpos'].'</td>
      <td>'.Html::encode($record['description']).'</td>
      <td>'.($record['editable'] ? '<span class="glyphicon glyphicon-ok text-success"></span>' : '<span class="glyphicon glyphicon-remove text-danger"></span>').'</td>
      <td>'.$record['updated_at'].'</td>
      <td class="text-small">'.$actions.'</td>
    </tr>';
  }
else
  echo '<tr><td colspan="11">'.Yii::t('main', 'NO_RECORDS_FOUND').'</td>';
?>
  </table>
</div>
