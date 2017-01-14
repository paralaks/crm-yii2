<?php
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title=Yii::t('main', 'Activities');
$this->params['breadcrumbs'][]=$this->title;
?>

<div class="activities-index">
	<div class="pageTitle"><?= $this->title?>
		<?= Yii::$app->appHelper->getActivityAddNewRelatedButton() ?>
	</div>
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
            location.href = '" . Url::to(['activity/view']) . "/' + id;
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
  'columns' => [['class' => 'yii\grid\SerialColumn', ],
    'subject',
    'location',
    'type_id' => ['attribute' => 'type_id',
      'value' => function ($data)
      {
        return Yii::$app->appHelper->getLookupValue('lkp_activity_type', $data->type_id);
      }],
    'priority_id' => ['attribute' => 'priority_id',
      // 'format' => 'html',
      'value' => function ($data)
      {
        return Yii::$app->appHelper->getLookupValue('lkp_activity_priority', $data->priority_id, false);
      }],
    'status_id' => ['attribute' => 'status_id',
      'value' => function ($data)
      {
        return Yii::$app->appHelper->getLookupValue('lkp_activity_status', $data->status_id);
      }],
    'owner_id' => ['attribute' => 'owner_id', 'value' => function ($data)
    {
      return Yii::$app->appHelper->getLookupValue('users', $data->owner_id);
    }],
    'start_date',
    'end_date',
    // 'updated_at',
    // 'created_at', // ['class' => 'yii\grid\ActionColumn'],
    ['class' => 'app\helpers\CrmActionColumn']]]);
?>
</div>

