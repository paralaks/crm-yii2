<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OpportunitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title=Yii::t('main', 'Opportunities');
$this->params['breadcrumbs'][]=$this->title;
?>

<div class="opportunities-index">
	<div class="pageTitle"><?= $this->title ?> <?= Html::a(Yii::t('main', 'New') . Yii::t('main', 'Opportunity'), ['create'], ['class' => 'btn btn-success button-new-index-page']) ?></div>
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
            location.href = '" . Url::to(['opportunity/view']) . "/' + id;
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
  'columns' => [['class' => 'yii\grid\SerialColumn'],
    'name',
    'probability' => ['attribute' => 'probability',
      'value' => function ($data)
      {
        return Yii::$app->appHelper->getLookupValue('probabilities', $data->probability);
      }],
    'stage_id' => ['attribute' => 'stage_id',
      'value' => function ($data)
      {
        return Yii::$app->appHelper->getLookupValue('lkp_opportunity_stage', $data->stage_id);
      }],
    'type_id' => ['attribute' => 'type_id',
      'value' => function ($data)
      {
        return Yii::$app->appHelper->getLookupValue('lkp_opportunity_type', $data->type_id);
      }],
    'owner_id' => ['attribute' => 'owner_id', 'value' => function ($data)
    {
      return Yii::$app->appHelper->getLookupValue('users', $data->owner_id);
    }],
    'close_date',
    'updated_at',
    'created_at',  // ['class' => 'yii\grid\ActionColumn'],
    ['class' => 'app\helpers\CrmActionColumn']]]);
?>
</div>
