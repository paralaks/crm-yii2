<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\helpers\AppHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title=Yii::t('main', 'Accounts');
$this->params['breadcrumbs'][]=$this->title;
?>

<div class="accounts-index">
	<div class="pageTitle"><?= $this->title ?> <?= Html::a(Yii::t('main', 'New') . Yii::t('main', 'Account'), ['create'], ['class' => 'btn btn-success button-new-index-page']) ?></div>
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
            location.href = '" . Url::to(['account/view']) . "/' + id;
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
    // 'email' => [ 'format'=>'url', 'format' => 'raw', 'value'=>function ($data) { return Html::a($data->email, ['contact/view', 'id'=>$data->id]); },],
    'name',
    'industry_id' => ['attribute' => 'industry_id',
      'value' => function ($data)
      {
        return Yii::$app->appHelper->getLookupValue('lkp_industry', $data->industry_id);
      }],
    'lead_source_id' => ['attribute' => 'lead_source_id',
      'value' => function ($data)
      {
        return Yii::$app->appHelper->getLookupValue('lkp_lead_source', $data->lead_source_id);
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
