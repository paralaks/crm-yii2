<?php
use yii\helpers\Url;
use yii\helpers\Html;

$modelClassLower='';
$listName='';
$th1='';
$th2='';
$th3='';
$isContact=false;
$isAccount=false;
$isOpportunity=false;

if (count($records))
{
  $modelClassLower=strtolower($records[0]->modelClassName());
  switch ($modelClassLower)
  {
    case 'contact':
      $isContact=true;
      $listName=Yii::t('main', 'Contacts');
      $th1=Yii::t('main', 'Contact Name');
      $th2=Yii::t('main', 'Email');
      $th3=Yii::t('main', 'Title');
    break;
    case 'account':
      $isAccount=true;
      $listName=Yii::t('main', 'Accounts');
      $th1=Yii::t('main', 'Account Name');
      $th2=Yii::t('main', 'Industry');
      $th3=Yii::t('main', 'Location');
    break;
    case 'opportunity':
      $isOpportunity=true;
      $listName=Yii::t('main', 'Opportunities');
      $th1=Yii::t('main', 'Opportunity Name');
      $th2=Yii::t('main', 'Probability');
      $th3=Yii::t('main', 'Stage');
    break;
    default:
  }
}
?>

<a name="relatedListMorph<?= $modelClassLower ?>"></a>
<div class="row relatedListStart">
	<div style="font-size: 10pt"><?= $listName ?></div>
	<a href="<?= Url::to(['activity/addrelated', 'id'=>$model->id, 'related_type'=>$modelClassLower]) ?>" class="btn btn-primary btn-xs"><?= Yii::t('main', 'Add New') ?></a>
</div>

<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover table-condensed searchResults">
		<tr class="ui-state-default">
			<?= '<th style="width:22%">'.$th1.'</th><th style="width:20%">'.$th2.'</th><th style="width:20%">'.$th3.'</th>'?>
			<th style="width: 20%"><?= Yii::t('main', 'Owner') ?></th>
			<th style="width: 12%"><?= Yii::t('main', 'Added At') ?></th>
			<th style="width: 6%">&nbsp;</th>
		</tr>
<?php
// @formatter:off
if (count($records))
  foreach ($records as $record)
  {
    $viewUrl=Url::to([$modelClassLower.'/view', 'id'=>$record->id]);
    $actions=Html::a(Yii::t('main', 'Delete'), Url::to(['activity/deleterelated', 'id'=>$model->id, 'related_type'=>$modelClassLower, 'related_id'=>$record->id]),
                  ['class' => 'text-danger', 'onclick'=>'return confirm("'.Yii::t('main', 'CONFIRM_DELETION').'")']);
    echo '
    <tr>'.
    (!$isContact ? '' : '
      <td>'.Html::a(Html::encode($record->first_name).' '.Html::encode($record->last_name), $viewUrl).'</td>
      <td>'.Html::encode($record->email).'</td>
      <td>'.Html::encode($record->title).'</td>'
    ).
    (!$isAccount ? '' : '
      <td>'.Html::a(Html::encode($record->name), $viewUrl).'</td>
      <td>'.Yii::$app->appHelper->getLookupValue('lkp_industry', $record->industry_id).'</td>
      <td>'.Yii::$app->appHelper->getLookupValue('states', $record->state).' / '.Yii::$app->appHelper->getLookupValue('countries', $record->country).'</td>'
    ).
    (!$isOpportunity ? '' : '
      <td>'.Html::a(Html::encode($record->name), $viewUrl).'</td>
      <td>'.$record->probability.'</td>
      <td>'.Yii::$app->appHelper->getLookupValue('lkp_opportunity_stage', $record->stage_id).'</td>'
    ).
    ' <td>'.Html::encode($record->owner->name).'</td>
      <td>'.$record->created_at.'</td>
      <td class="text-small">'.$actions.'</td>
    </tr>';
  }
else
  echo '<tr><td colspan="11">'.Yii::t('main', 'NO_RECORDS_FOUND').'</td>';
// @formatter:on
?>
  </table>
</div>

