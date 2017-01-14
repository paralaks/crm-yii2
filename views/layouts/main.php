<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?= Html::csrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
</head>
<body>
<?= SERVER_DECAL ?>
<?php $this->beginBody() ?>
<?php
  NavBar::begin([
      'brandLabel' => 'CRM - Yii2',
      'brandUrl' => Yii::$app->homeUrl,
      'options' => [
          'class' => 'navbar-inverse navbar-fixed-top',
      ],
  ]);

  $userSubItems=[];

  if (Yii::$app->user->isGuest)
    $items=[['label' => Yii::t('main', 'Login'), 'url' => ['/site/login']]];
  else
  {
    $items=[
      ['label' => Yii::t('main', 'Home'), 'url' => ['/site/index']],
      ['label' => Yii::t('main', 'Leads'), 'url' => ['/lead/index']],
      ['label' => Yii::t('main', 'Contacts'), 'url' => ['/contact/index']],
      ['label' => Yii::t('main', 'Accounts'), 'url' => ['/account/index']],
      ['label' => Yii::t('main', 'Opportunities'), 'url' => ['/opportunity/index']],
      ['label' => Yii::t('main', 'Activities'), 'url' => ['/activity/index']],
      ['label' => Yii::t('main', 'Reports'), 'url' => ['/report/index']],
    ];

    if (Yii::$app->user->can('Manager'))
      $userSubItems[]=['label' => Yii::t('main', 'Users'), 'url' => ['/site/usersmanage']];

    if (Yii::$app->user->can('Administrator'))
    {
      $userSubItems[]=['label' => Yii::t('main', 'Dropdowns'), 'url' => ['/site/lookupsmanage']];
      $userSubItems[]=['label' => Yii::t('main', 'Permissions'), 'url' => ['/admin/default']];
    }

    $userSubItems[]=['label' => Yii::t('main', 'Change Password'), 'url' => ['/site/identitymanage']];
    $userSubItems[]=['label' => Yii::t('main', 'Logout'), 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']];

    $items[]=['label' => Yii::$app->user->identity->name,  'items'=>$userSubItems];
  }

  echo Nav::widget([
      'options' => ['class' => 'navbar-nav navbar-right'],
      'items' => $items,
  ]);
  NavBar::end();
?>
  <div class="wrap">
    <div class="container">
    <?php
      echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]);

      if (!empty($adminContent))
        echo '<div class="container">'.$adminContent.'<div class="col-lg-10">'.$content.'</div></div>';
      else
        echo $content;
    ?>
    </div>
  </div>

  <footer class="container-fluid">
    <div class="pull-left">&copy; <?= date('Y') ?> - <span style="font-size:8pt">v<?= APP_VERSION ?></span></div>
  </footer>

  <?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
