<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\helpers\AppHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LeadsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title=Yii::t('main', 'Leads');
$this->params['breadcrumbs'][]=$this->title;
?>

<div class="leads-index">
	<div class="pageTitle"><?= $this->title ?> <?= Html::a(Yii::t('main', 'New') . Yii::t('main', 'Lead'), ['create'], ['id' => 'new-lead-btn', 'class' => 'btn btn-success button-new-index-page']) ?></div>
</div>

<?= $this->render('_search', ['model' => $searchModel])?>

<br />

<div class="table-responsive">
<?php
$this->registerJs("
    $('tbody td').css('cursor', 'pointer');
    $('tbody td').click(function (e) {
        var id = $(this).closest('tr').data('id');
        if (e.target == this)
            location.href = '" . Url::to(['lead/view']) . "/' + id;
    });
");

echo GridView::widget(
['dataProvider' => $dataProvider,
  'tableOptions' => ['class' => 'table table-striped table-bordered table-hover table-condensed'],
  'headerRowOptions' => ['class' => 'ui-state-default'],
  'rowOptions'   => function ($model, $key, $index, $grid) {
        return ['data-id' => $model->id];
  },
  'filterModel' => null,
  'columns' => [['class' => 'yii\grid\SerialColumn'],  // 'email' => [ 'format'=>'url', 'format' => 'raw', 'value'=>function ($data) { return Html::a($data->email, ['lead/view', 'id'=>$data->id]); },],
    'first_name',
    'last_name',
    'email',
    'company',
    'status_id' => ['attribute' => 'status_id',
      'value' => function ($data)
      {
        return Yii::$app->appHelper->getLookupValue('lkp_lead_status', $data->status_id);
      }],
    'industry_id' => ['attribute' => 'industry_id',
      'value' => function ($data)
      {
        return Yii::$app->appHelper->getLookupValue('lkp_industry', $data->industry_id);
      }],
    'state' => ['attribute' => 'state',
      'value' => function ($data)
      {
        return Yii::$app->appHelper->getLookupValue('states', $data->state);
      }],
    'country' => ['attribute' => 'country',
      'value' => function ($data)
      {
        return Yii::$app->appHelper->getLookupValue('countries', $data->country);
      }],
      'owner_id' => ['attribute' => 'owner_id', 'value' => function ($data)
    {
      return Yii::$app->appHelper->getLookupValue('users', $data->owner_id);
    }],
    'updated_at',
    'created_at',  // ['class' => 'yii\grid\ActionColumn'],
    ['class' => 'app\helpers\CrmActionColumn']]]);
?>
</div>
