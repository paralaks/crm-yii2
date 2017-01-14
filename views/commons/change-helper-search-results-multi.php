<?php
use yii\helpers\Html;
?>

<?= $this->render('../commons/change-helper-search-form', ['controller' => $controller]) ?>

<div class="table-responsive">
	<table class="table table-bordered table-hover table-condensed searchResults">
<?php
$output='';
if (is_array($controller->searchResults))
{
  $output.='
  <tr class="ui-state-default"><th class="idList"><input type="checkbox" id="toggleAllCheckboxes"></th><th>' . Yii::t('main', 'Search Results') . '</th></tr>';

  if (count($controller->searchResults))
  {
    foreach ($controller->searchResults as $result)
      $output.='
	<tr><td class="idList">' .Html::checkbox("idList[]", (empty($result['!']) ? false : true), ["value" => $result['id'], "class" => "idListCBox"]) . '</td>
	<td>' . Html::encode($result['name']) . '</td></tr>';

    if ($controller->tooManyResults === true)
      $output.='<tr class="text-danger"><td><br>' . Yii::t('main', 'Search returned too many results.') . '</td></tr>';
  }
  else
    $output.='<tr><td class="idList"> </td><td>' . Yii::t('main', 'NO_RECORDS_FOUND') . '</td></tr>';
}

echo $output;
?>
  </table>
</div>
