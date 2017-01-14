<?php
use yii\helpers\Url;
use yii\helpers\Html;

?>
<a name="relatedListContactss"></a>

<div class="row relatedListStart">
  <div><?= Yii::t('main', 'Related Contacts') ?></div><?= Html::a(Yii::t('main', 'Add New'), Url::to(['opportunity/addcontact', 'id'=>$model->id]), ['class' => 'btn btn-primary btn-xs']) ?>
</div>

<div class="table-responsive">
  <table class="table table-striped table-bordered table-hover table-condensed searchResults">
    <tr class="ui-state-default">
      <th style="width:35%"><?= Yii::t('main', 'Contact') ?></th>
      <th><?= Yii::t('main', 'Owner') ?></th>
      <th><?= Yii::t('main', 'Added At') ?></th>
      <th><?= Yii::t('main', 'Modified By') ?></th>
      <th><?= Yii::t('main', 'Modified At') ?></th>
      <th>&nbsp;</th>
    </tr>
<?php

if (count($model->opportunitycontacts))
  foreach ($model->opportunitycontacts as $record)
  {
    if (!$record->contact)
      continue;
    /*
     * TODO : remove if not needed : Add ability to undelete as done with deleting related records from activity
    */
    $actions=Html::a(Yii::t('main', 'Edit'), Url::to(['opportunity/editcontact', 'id'=>$model->id, 'relId' => $record->id])).'&nbsp;&nbsp;&nbsp;'.
             Html::a(Yii::t('main', 'Delete'), Url::to(['opportunity/deletecontact', 'id'=>$model->id, 'relId' => $record->id]),
                     ['class' => 'text-danger', 'onclick'=>'return confirm("'.Yii::t('main', 'CONFIRM_DELETION').'")']).
                     '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.
             Html::a(Yii::t('main', 'Update History'), Url::to(['opportunity/contactupdatehistory', 'id'=>$model->id, 'relId' => $record->id]), ['target'=>'_blank']);

    echo '
    <tr class="text-del">
      <td>'.Html::a($record->contact->first_name.' '.$record->contact->last_name, Url::to(['contact/view', 'id'=>$record->contact_id])).'</td>
      <td>'.($record->owner? $record->owner->name : '').'</td>
      <td>'.$record->created_at.'</td>
      <td>'.($record->modifier ? $record->modifier->name : '').'</td>
      <td>'.$record->updated_at.'</td>
      <td class="text-small">'.$actions.'</td>
    </tr>';
  }
else
  echo '<tr><td colspan="11">'.Yii::t('main', 'NO_RECORDS_FOUND').'</td>';
?>
  </table>
</div>
