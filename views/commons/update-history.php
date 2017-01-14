<?php
use yii\helpers\Html;

$this->title=Yii::t('main', 'Update History');
$this->params['breadcrumbs'][]=$this->title;
?>
<div class="activity-view">
	<h3 class="pageTitle"><?= Html::encode($this->title) ?>&nbsp;&nbsp;
		<sup><a href="javascript:void(0)" onclick="window.close()" class="btn btn-danger btn-xs">X</a></sup>
	</h3>
</div>

<div class="table-responsive">
	<table class="table table-bordered table-striped table-condensed table-hover update-history-table">
  <?php
  if ($updates)
  {
    $labelField=Yii::t('main', 'Field');
    $labelFrom=Yii::t('main', 'From');
    $labelTo=Yii::t('main', 'To');
    $labelUpdatedBy=Yii::t('main', 'Updated By');
    $labelUpdatedAt=Yii::t('main', 'Updated At');

    $user='';
    $createdAt='';
    foreach ($updates as $update)
    {
      $userUpdate=Yii::$app->appHelper->getLookupValue('users', $update['user_id']);
      $createdAtUpdate=$update['created_at'];

      if ($user != $userUpdate || $createdAt != $createdAtUpdate)
      {
        $user=$userUpdate;
        $createdAt=$createdAtUpdate;

        echo '
<tr class="header">
  <td colspan=3><strong>' . $labelUpdatedBy . ':</strong> ' . $user . ' &nbsp;&nbsp;&nbsp; <strong>' . $labelUpdatedAt . ':</strong> ' .
         $createdAt . ' </td>
</tr>
<tr><th>' . $labelField . '</th><th>' . $labelFrom . '</th><th>' . $labelTo . '</th></tr>';
      }

      $fields=unserialize($update['fields']);
      $modelName=$update['model'];
      /*
       * $relatedHistory='';
       * if (isset($fields['related_id']))
       * { $relatedTypeInfo=Yii::$app->appHelper->getRelatedTypeInfo($fields['related_type_id']);
       *   $relatedHistory=Yii::$app->appHelper->getValueFromTable($relatedTypeInfo[1], $fields['related_id']); unset($fields['related_id']); unset($fields['related_type']);
       * }
       */
      foreach ($fields as $k=>$v)
        if ($k == 'related_type' || $k == 'related_id')
          continue;
        else
          echo '
		<tr>
			<td>' . $model->getAttributeLabel($k) . '</td>
			<td>' . Yii::$app->appHelper->getLookupValueHistory($k, $modelName, $v[0]) . '</td>
			<td>' . Yii::$app->appHelper->getLookupValueHistory($k, $modelName, $v[1]) . '</td>
		</tr>';
    }
  }
  else
    echo '<tr><th class="text-danger" colspan=3>' . Yii::t('main', 'NO_RECORDS_FOUND') . '</th></tr>';
  ?>
		<tr>
			<td class="update-history-field"></td>
			<td class="update-history-from"></td>
			<td class="update-history-to"></td>
		</tr>
	</table>
</div>
