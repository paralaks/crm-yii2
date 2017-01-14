<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>

<a name="relatedListOpportunities"></a>
<div class="row relatedListStart">
  <div><?= Yii::t('main', 'Opportunities') ?></div><a href="<?= Url::to(['opportunity/create', 'contact_id'=>$model->id]) ?>" class="btn btn-primary btn-xs"><?= Yii::t('main', 'Add New') ?></a>
</div>

<div class="table-responsive">
  <table class="table table-striped table-bordered table-hover table-condensed searchResults">
    <tr class="ui-state-default">
      <th><?= Yii::t('main', 'Opportunity Name') ?></th>
      <th><?= Yii::t('main', 'Probability') ?></th>
      <th><?= Yii::t('main', 'Stage') ?></th>
      <th><?= Yii::t('main', 'Next Step') ?></th>
      <th><?= Yii::t('main', 'Close Date') ?></th>
      <th><?= Yii::t('main', 'Lead Source') ?></th>
      <th><?= Yii::t('main', 'Owner') ?></th>
      <th><?= Yii::t('main', 'Added At') ?></th>
      <th><?= Yii::t('main', 'Modified At') ?></th>
      <th>&nbsp;</th>
    </tr>
<?php
if (count($model->opportunities))
  foreach ($model->opportunities as $record)
  {
    $actions=Html::a(Yii::t('main', 'View'), Url::to(['opportunity/view', 'id'=>$record->id])).'&nbsp;&nbsp;&nbsp;'.
             Html::a(Yii::t('main', 'Edit'), Url::to(['opportunity/update', 'id'=>$record->id]));

    echo '
    <tr>
      <td>'.HTML::encode($record->name).'</td>
      <td>'.$record->probability.'</td>
      <td>'.Yii::$app->appHelper->getLookupValue('lkp_opportunity_stage', $record->stage_id).'</td>
      <td>'.HTML::encode($record->next_step).'</td>
      <td>'.$record->close_date.'</td>
      <td>'.Yii::$app->appHelper->getLookupValue('lkp_lead_source', $record->lead_source_id).'</td>
      <td>'.HTML::encode($record->owner->name).'</td>
      <td>'.$record->created_at.'</td>
      <td>'.$record->updated_at.'</td>
      <td class="text-small">'.$actions.'</td>
    </tr>';
  }
else
  echo '<tr><td colspan="11">'.Yii::t('main', 'NO_RECORDS_FOUND').'</td>';
?>
  </table>
</div>
