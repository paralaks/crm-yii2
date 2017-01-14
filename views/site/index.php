<?php
use yii\helpers\Url;
use yii\helpers\Html;


/* @var $this yii\web\View */
$this->title = 'CRM - Home';

$today=date('Y-m-d');
$nextWeek=date('Y-m-d', strtotime('+7 day'));

?>
<div class="site-index">

  <?php include(__DIR__.'/../commons/common-view-defs.php'); ?>

  <h3><?= Yii::t('main', 'Hello')?>, <?= Html::encode(Yii::$app->user->identity->name) ?>!</h3>

  <?= Yii::t('main', 'Your last login was') ?> : <?=  Yii::$app->user->identity->login_at ?>.

  <div class="body-content">
    <div class="row homepage">
      <h4><?= Yii::t('main', 'Active').' '.Yii::t('main', 'Activities') ?></h4>
      <div class="col-lg-12">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-condensed">
          <?php
          if (count($activities))
          {
            echo '
            <tr>
              <th>'.Yii::t('main', 'Subject').'</th>
              <th>'.Yii::t('main', 'Activity Type').'</th>
              <th>'.Yii::t('main', 'Priority').'</th>
              <th>'.Yii::t('main', 'Status').'</th>
              <th>'.Yii::t('main', 'Due/End Date').'</th>
              <th>'.Yii::t('main', 'Owner').'</th>
            </tr>';

            foreach ($activities as $record)
            {
              $dateClass='';
              $priorityClass='';

              if ($record['end_date'] < $today)
                $dateClass='text-danger';
              if ($record['end_date'] >= $nextWeek)
                $dateClass='text-success';

              switch($record['priority_id'])
              {
                case 1: $priorityClass='text-danger'; break;
                //case 2: $priorityClass='text-primary'; break;
                case 3: $priorityClass='text-success'; break;
                default: $priorityClass=''; break;
              }

              echo '
              <tr>
                <td>'.Html::a(Html::encode($record['subject']), Url::to(['activity/view', 'id' => $record['id']]), ['class' => $dateClass]).'</td>
                <td>'.Yii::$app->appHelper->getLookupValue('lkp_activity_type', $record['type_id']).'</td>
                <td class="'.$priorityClass.'">'.Yii::$app->appHelper->getLookupValue('lkp_activity_priority', $record['priority_id']).'</td>
                <td>'.Yii::$app->appHelper->getLookupValue('lkp_activity_status', $record['status_id']).'</td>
                <td>'.Html::encode($record['end_date']).'</td>
                <td>'.Yii::$app->appHelper->getLookupValue('users', $record['owner_id']).'</td>
            </tr>';
            }
          }
          else
            echo '<tr><th class="text-info">'.Yii::t('main', 'NO_RECORDS_FOUND').'</th></tr>';
          ?>
          </table>
        </div>
      </div>
    </div>


    <div class="row homepage">
      <h4><?= Yii::t('main', 'Open').' '.Yii::t('main', 'Opportunities') ?></h4>
      <div class="col-lg-12">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-condensed">
          <?php
          if (count($opportunities))
          {
            echo '
            <tr>
              <th>'.Yii::t('main', 'Opportunity Name').'</th>
              <th>'.Yii::t('main', 'Probability').'</th>
              <th>'.Yii::t('main', 'Stage').'</th>
              <th>'.Yii::t('main', 'Type').'</th>
              <th>'.Yii::t('main', 'Close Date').'</th>
              <th>'.Yii::t('main', 'Owner').'</th>
            </tr>';

            foreach ($opportunities as $record)
            {
              $dateClass='';

              if ($record['close_date'] < $today)
                $dateClass='text-danger';
              if ($record['close_date'] >= $nextWeek)
                $dateClass='text-success';

              echo '
              <tr>
                <td>'.Html::a(Html::encode($record['name']), Url::to(['opportunity/view', 'id' => $record['id']]), ['class' => $dateClass]).'</td>
                <td>'.Yii::$app->appHelper->getLookupValue('probabilities', $record['probability']).'</td>
                <td>'.Yii::$app->appHelper->getLookupValue('lkp_opportunity_stage', $record['stage_id']).'</td>
                <td>'.Yii::$app->appHelper->getLookupValue('lkp_opportunity_type', $record['type_id']).'</td>
                <td>'.Html::encode($record['close_date']).'</td>
                <td>'.Yii::$app->appHelper->getLookupValue('users', $record['owner_id']).'</td>
            </tr>';
            }
          }
          else
            echo '<tr><th class="text-info">'.Yii::t('main', 'NO_RECORDS_FOUND').'</th></tr>';
          ?>
          </table>
        </div>
      </div>

    </div>

  </div>
</div>
