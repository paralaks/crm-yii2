<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\ReportsAsset;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

ReportsAsset::register($this);

$this->title = Yii::t('main', 'Reports');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="reports-index">

  <?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

  <div class="pageTitle"><?= Html::encode($this->title) ?></div>

  <?php $form = ActiveForm::begin(['options'=> ['class'=>'form-horizontal']] ); ?>

  <?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

  <div class="form-group">
    <?= $form->field($model, 'report_object', $tt3ColIn)->dropDownList($dropdownObjects) ?>
    <?= $form->field($model, 'report_type', $tt3ColIn)->dropDownList($dropdownTypes) ?>
    <?= $form->field($model, 'display_type', $tt3ColIn)->dropDownList(
      [
        'bar_chart_tooltip'=>Yii::t('main', 'Bar Chart'),
        'pie_chart'=>Yii::t('main', 'Pie Chart'),
        '3d_donut'=>Yii::t('main', '3D Donut'),
      ]) ?>
  </div>


  <div class="form-group text-center">
    <?= Html::submitButton(Yii::t('main', 'Run Report'), ['class' => 'btn btn-primary']) ?>
   </div>

  <?php ActiveForm::end(); ?>

</div>

<div id="reportGraph" style="width:100%; height:auto; margin-top:10px; margin-left:auto; margin-right:auto; background-color:#FFFFF0">
</div>

<?= $dropdownJS ?>

<?php
  if (empty($data))
    return;

  if (!empty($model->display_type))
    echo $this->render('report-'.$model->display_type, ['data' => $data, 'graphFontSize'=>'22px']);

?>

