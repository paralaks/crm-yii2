<?php
use yii\helpers\Url;
use yii\helpers\Html;

?>
<a name="relatedListContacts"></a>
<div class="row relatedListStart">
  <div><?= Yii::t('main', 'Contacts') ?></div><a href="<?= Url::to(['contact/create', 'account_id'=>$model->id]) ?>" class="btn btn-primary btn-xs"><?= Yii::t('main', 'Add New') ?></a>
</div>

<div class="table-responsive">
  <table class="table table-striped table-bordered table-hover table-condensed searchResults">
    <tr class="ui-state-default">
      <th><?= Yii::t('main', 'Name') ?></th>
      <th><?= Yii::t('main', 'Email') ?></th>
      <th><?= Yii::t('main', 'Title') ?></th>
      <th><?= Yii::t('main', 'State') ?></th>
      <th><?= Yii::t('main', 'Country') ?></th>
      <th><?= Yii::t('main', 'Contact Type') ?></th>
      <th><?= Yii::t('main', 'Lead Source') ?></th>
      <th><?= Yii::t('main', 'Owner') ?></th>
      <th><?= Yii::t('main', 'Added At') ?></th>
      <th>&nbsp;</th>
    </tr>
<?php
if (count($model->contacts))
  foreach ($model->contacts as $record)
  {
    $actions=Html::a(Yii::t('main', 'View'), Url::to(['contact/view', 'id'=>$record->id])).'&nbsp;&nbsp;&nbsp;'.
             Html::a(Yii::t('main', 'Edit'), Url::to(['contact/update', 'id'=>$record->id]));

    echo '
    <tr>
      <td>'.Yii::$app->appHelper->getLookupValue('lkp_salutation', $record->salutation_id).' '.Html::encode($record->first_name.' '.$record->last_name).'</td>
      <td>'.$record->email.'</td>
      <td>'.Html::encode($record->title).'</td>
      <td>'.$record->state.'</td>
      <td>'.Yii::$app->appHelper->getLookupValue('countries', $record->country).'</td>
      <td>'.Yii::$app->appHelper->getLookupValue('lkp_contact_type', $record->type_id).'</td>
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

