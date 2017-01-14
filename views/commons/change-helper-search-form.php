<?php
use yii\helpers\Html;
?>

<div class="form-group">
  <div class="col-xs-12 keywordWrapper text-center"><div id="keywordHelpBlock" class="help-block"></div></div>
</div>

<div class="form-group" id="searchBox">
	<label for="name" class="control-label col-xs-4 text-right">&nbsp;<?= $controller->keywordLabel ?>:</label>

	<div class="col-xs-4 keywordWrapper">
		<input type="text" id="keyword" name="keyword" class="form-control" value="<?= Html::encode($controller->keyword) ?>">
	</div>

	<span class="col-xs-4 text-left">
	 <?=Html::submitButton(Yii::t('main', 'Search'), ['name' => 'submit2', 'value' => 'search', 'onclick' => 'return submitKeywordSearchForm("keyword", "' . Yii::t('main', 'Search criteria can not be blank') . '")', 'class' => 'btn btn-primary btn-xs'])?>
	</span>
</div>
