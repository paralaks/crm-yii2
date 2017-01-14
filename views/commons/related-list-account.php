<?php
use yii\helpers\Url;
use yii\helpers\Html;

?>
<a name="relatedListAccounts"></a>
<div class="row relatedListStart">
  <div><?= Yii::t('main', 'Accounts') ?></div><a href="<?= Url::to(['account/create', 'account_id'=>$model->id]) ?>" class="btn btn-primary btn-xs"><?= Yii::t('main', 'Add New') ?></a>
</div>

<div class="table-responsive">
  <table class="table table-striped table-bordered table-hover table-condensed searchResults">
    <tr class="ui-state-default">
      <th><?= Yii::t('main', 'Name') ?></th>
      <th><?= Yii::t('main', 'Type') ?></th>
      <th><?= Yii::t('main', 'Industry') ?></th>
      <th><?= Yii::t('main', 'State') ?></th>
      <th><?= Yii::t('main', 'Country') ?></th>
      <th><?= Yii::t('main', 'Lead Source') ?></th>
      <th><?= Yii::t('main', 'Owner') ?></th>
      <th><?= Yii::t('main', 'Added At') ?></th>
      <th>&nbsp;</th>
    </tr>
<?php
if (count($model->accounts))
  foreach ($model->accounts as $record)
  {
    $actions=Html::a(Yii::t('main', 'View'), Url::to(['account/view', 'id'=>$record->id])).'&nbsp;&nbsp;&nbsp;'.
             Html::a(Yii::t('main', 'Edit'), Url::to(['account/update', 'id'=>$record->id]));

    echo '
    <tr>
      <td>'.Html::encode($record->name).'</td>
      <td>'.Yii::$app->appHelper->getLookupValue('lkp_account_type', $record->type_id).'</td>
      <td>'.Yii::$app->appHelper->getLookupValue('lkp_industry', $record->industry_id).'</td>
      <td>'.$record->state.'</td>
      <td>'.Yii::$app->appHelper->getLookupValue('countries', $record->country).'</td>
      <td>'.Yii::$app->appHelper->getLookupValue('lkp_lead_source', $record->lead_source_id).'</td>
      <td>'.Html::encode($record->owner->name).'</td>
      <td>'.$record->created_at.'</td>
      <td class="text-small">'.$actions.'</td>
    </tr>';
  }
else
  echo '<tr><td colspan="11">'.Yii::t('main', 'NO_RECORDS_FOUND').'</td>';
?>
  </table>
</div>

