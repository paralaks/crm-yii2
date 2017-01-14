<?php
use yii\helpers\Html;
?>

<?= $this->render('../commons/change-helper-search-form', ['controller' => $controller]) ?>

<div class="table-responsive">
	<table class="table table-bordered table-hover table-condensed searchResults">
<?php

$param1=isset($param1) ? ", '" . $param1 . "'" : '';
$param2=isset($param2) ? ", '" . $param2 . "'" : '';

$output='';
if (is_array($controller->searchResults))
{
  $output.='
  <tr class="ui-state-default"><th>' . Yii::t('main', 'Search Results') . '</th></tr>';

  if (count($controller->searchResults))
  {
    foreach ($controller->searchResults as $result)
    {
      $name=Html::encode($result['name']);
      $nameJs=Html::encode(addslashes($result['name']));

      $output.=<<<EOT
<tr><td>
  <a href="javascript:void(0)" onclick="$jsFunction('{$result['id']}', '$nameJs' $param1 $param2)">$name</a>
</td></tr>
EOT;
    }

    if ($controller->tooManyResults === true)
      $output.='<tr class="text-danger"><td><br>' . Yii::t('main', 'Search returned too many results.') . '</td></tr>';
  }
  else
    $output.='<tr><td>' . Yii::t('main', 'NO_RECORDS_FOUND') . '</td></tr>';
}

echo $output;
?>
  </table>
</div>