<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\helpers\AppHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title=Yii::t('main', 'Contacts');
$this->params['breadcrumbs'][]=$this->title;
?>

<div class="contacts-index">
	<div class="pageTitle"><?= $this->title ?> <?= Html::a(Yii::t('main', 'New') . Yii::t('main', 'Contact'), ['create'], ['class' => 'btn btn-success button-new-index-page']) ?></div>
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
            location.href = '" . Url::to(['contact/view']) . "/' + id;
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
  'columns' => [['class' => 'yii\grid\SerialColumn'],  // 'email' => [ 'format'=>'url', 'format' => 'raw', 'value'=>function ($data) { return Html::a($data->email, ['contact/view', 'id'=>$data->id]); },],
    'picture' => ['attribute' => 'picture',
      'format' => 'raw',
      'value' => function ($data)
      {
        return '<span class="mul-val-att1"><img style="height:40px" src="/images/contact/' . $data->picture . '"></span>';
      }],
    'first_name',
    'last_name',
    'account_id' => ['attribute' => 'account_id',
      'format' => 'raw',
      'value' => function ($data)
      {
        return '<span class="mul-val-att1">' . Yii::$app->appHelper->getValueFromTable('accounts', $data->account_id) . '</span>' . '<span class="mul-val-att2">' .
         Yii::$app->appHelper->getValueFromTable('accounts', $data->account2_id) . '</span>' . '<span class="mul-val-att3">' .
         Yii::$app->appHelper->getValueFromTable('accounts', $data->account3_id) . '</span>';
      }],
    'category_id' => ['attribute' => 'category_id',
      'format' => 'raw',
      'value' => function ($data)
      {
        return '<span class="mul-val-att1">' . Yii::$app->appHelper->getLookupValue('lkp_contact_category', $data->category_id) . '</span>' . '<span class="mul-val-att2">' .
         Yii::$app->appHelper->getLookupValue('lkp_contact_category', $data->category2_id) . '</span>' . '<span class="mul-val-att3">' .
         Yii::$app->appHelper->getLookupValue('lkp_contact_category', $data->category3_id) . '</span>';
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
