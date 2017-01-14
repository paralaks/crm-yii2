<?php
use yii\helpers\Url;
use app\models\Activity;
use yii\helpers\Html;
?>

<a name="relatedListActivities"></a>
<div class="row relatedListStart">
  <div><?= Yii::t('main', 'Activities') ?></div><a href="<?= Url::to(['activity/create', 'related_id'=>$model->id, 'related_type'=>$model->modelClassName()]) ?>" class="btn btn-primary btn-xs"><?= Yii::t('main', 'Add New') ?></a>
</div>

<div class="table-responsive">
  <table class="table table-striped table-bordered table-hover table-condensed searchResults">
    <tr class="ui-state-default">
      <th><?= Yii::t('main', 'Subject') ?></th>
      <th><?= Yii::t('main', 'Location') ?></th>
      <th><?= Yii::t('main', 'Activity Type') ?></th>
      <th><?= Yii::t('main', 'Priority') ?></th>
      <th colspan=2><?= Yii::t('main', 'Status') ?></th>
      <th><?= Yii::t('main', 'Due/End Date') ?></th>
      <th><?= Yii::t('main', 'Owner') ?></th>
      <th><?= Yii::t('main', 'Added At') ?></th>
      <th><?= Yii::t('main', 'Modified At') ?></th>
      <th>&nbsp;</th>
    </tr>
<?php
if (count($model->activities))
  foreach ($model->activities as $record)
  {
    $trClass='';
    switch($record->priority_id)
    {
      case 1: $trClass='text-danger'; break;
      case 2: $trClass='text-warning'; break;
      case 3: $trClass='text-primary'; break;
      default: $trClass='';
    }

    $actions=Html::a(Yii::t('main', 'View'), Url::to(['activity/view', 'id'=>$record->id])).'&nbsp;&nbsp;&nbsp;'.
             Html::a(Yii::t('main', 'Edit'), Url::to(['activity/update', 'id'=>$record->id]));

    echo '
    <tr class="'.$trClass.'">
      <td>'.Html::encode($record->subject).'</td>
      <td>'.Html::encode($record->location).'</td>
      <td>'.Yii::$app->appHelper->getLookupValue('lkp_activity_type', $record->type_id).'</td>
      <td>'.Yii::$app->appHelper->getLookupValue('lkp_activity_priority', $record->priority_id).'</td>
      <td>'.Yii::$app->appHelper->getLookupValue('lkp_activity_status', $record->status_id).'</td><td>'.($record->status_id== Activity::STATUS_COMPLETED ? '<span class="glyphicon glyphicon-ok"></span>' : '').'</td>
      <td>'.$record->end_date.'</td>
      <td>'.Yii::$app->appHelper->getLookupValue('users', $record->owner_id).'</td>
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
