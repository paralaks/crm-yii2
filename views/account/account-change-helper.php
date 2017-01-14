<?php
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Account */

$this->title=Yii::t('main', 'Select Account');

$this->params['breadcrumbs'][]=['label' => Yii::t('main', 'Account'), 'url' => ['index']];
$this->params['breadcrumbs'][]=$this->title;
?>

<div class="account-change">
	<h3 class="pageTitle"><?= Html::encode($this->title) ?></h3>
</div>

<form id="changeAccountForm" method="post" action="/account/showchangeaccount" accept-charset="UTF-8" role="form" class="form-horizontal">
	<input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
	<input type="hidden" name="accIdx" value="<?= Html::encode($accIdx) ?>" />
	<input type="hidden" name="excludeIds" value="<?= Html::encode($controller->excludeIds) ?>" />
	<input type="hidden" name="startWithLetter" id="startWithLetter" value="0" />

	<?= $this->render('../commons/search-helper-alphabet-shortcuts', ['formId' => 'changeAccountForm', 'searchId'=>'keyword'])?>

	<?= $this->render('../commons/change-helper-search-results', ['controller' => $controller, 'jsFunction'=>'updateAccountParentWindow', 'param1'=>Html::encode($accIdx)])?>
</form>

