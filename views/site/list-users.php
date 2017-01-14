<?php
use yii\helpers\Html;
use app\models\User;
use app\helpers\AppHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\usersearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('main', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

  <?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

  <div class="pageTitle"><?= $this->title ?><?= Html::a(Yii::t('main', 'New') . Yii::t('main', 'User'), ['useradd'], ['class' => 'btn btn-success button-new-index-page']) ?></div>
</div>

<div class="table-responsive">
  <table class="table table-striped table-bordered table-hover table-condensed searchResults">
    <tr class="ui-state-default">
      <th><?= Yii::t('main', 'Username') ?></th>
      <th><?= Yii::t('main', 'Name') ?></th>
      <th><?= Yii::t('main', 'Email') ?></th>
      <th><?= Yii::t('main', 'Role') ?></th>
      <th><?= Yii::t('main', 'Status') ?></th>
      <th><?= Yii::t('main', 'Added By') ?></th>
      <th><?= Yii::t('main', 'Modified By') ?></th>
      <th><?= Yii::t('main', 'Last Login') ?></th>
      <th>&nbsp;</th>
    </tr>
<?php
if (count($users))
  foreach ($users as $record)
  {
    echo '
    <tr>
      <td>'.Html::encode($record['username']).'</td>
      <td>'.Html::encode($record['name']).'</td>
      <td>'.Html::encode($record['email']).'</td>
      <td>'.Yii::t('main', $record['role']).'</td>
      <td>'.($record['status'] == AppHelper::STATUS_ACTIVE ? Yii::t('main', 'Active') : Yii::t('main', 'Inactive')).'</td>
      <td>'.Yii::$app->appHelper->getLookupValue('users', $record['adder_id']).' ('.$record['created_at'].')</td>
      <td>'.Yii::$app->appHelper->getLookupValue('users', $record['modifier_id']).' ('.$record['updated_at'].')</td>
      <td>'.$record['login_at'].'</td>
      <td class="text-small">'.$record['actions'].'</td>
    </tr>';
  }
else
  echo '<tr><td colspan="11">'.Yii::t('main', 'NO_RECORDS_FOUND').'</td>';
?>
  </table>
</div>
