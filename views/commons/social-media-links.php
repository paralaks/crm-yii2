<?php

use yii\helpers\Html;

?>
<div class="row">
  <label for="type_id" class="text-right col-xs-4 col-sm-2"> <?= Yii::t('main', 'Social Media') ?>: </label>
  <div class="col-xs-8 col-sm-10">
  <?php
    if (count($model->socialmedia))
      foreach ($model->socialmedia as $record)
        echo '<div class="social_media_icon"><a href="'.Html::encode($record['value']).'" target=_blank><img src="/images/'.Yii::$app->appHelper->getLookupValue('lkp_social_media', $record['social_media_id']).'.png"></a>
              <br>'.
              Html::a(Yii::t('main', 'Delete'), ['deletesocialmedia', 'id' => $model->id, 'rel_id'=>$record['id']], ['data' => ['confirm' => Yii::t('main', 'CONFIRM_DELETION'),'method' => 'post']]).
              '</div>';
  ?>
  </div>
</div>

<form id="addSocialMediaUrlForm" method="post" action="/<?= $classNameLower ?>/addsocialmedia/<?= $model->id ?>" accept-charset="UTF-8" role="form" class="form-horizontal text-center"
      onSubmit="return validateAddSocialMediaUrlForm('<?= Yii::t('main', 'Please enter a valid address')?>', '<?= Yii::t('main', 'Please select social media from the list')?>')">
  <div class="row">
      <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
      <input type="hidden" name="<?= $className ?>[id]" value="<?= $model->id; ?>" />
      <div class="col-xs-0 col-sm-2"></div>

      <label class="col-xs-2 col-sm-2 text-right" for="name"><?= Yii::t('main', 'Website') ?>:</label>
      <div class="col-xs-5 col-sm-3"><?= Html::input('text', 'social_media_url', null, ['id'=>'social_media_url', 'class'=>'form-control', 'onchange'=>'handleSocialMediaUrlChange()']) ?></div>

      <div class="col-xs-3 col-sm-2"><?= Html::dropDownList('social_media_id', 0, Yii::$app->appHelper->getLookupData('lkp_social_media'), ['id'=>'social_media_id', 'class'=>'form-control']) ?></div>
      <div class="col-xs-1 text-left"><input type="submit" value="<?= Yii::t('main', 'Add') ?>" class="btn btn-primary btn-xs"></div>
  </div>
</form>
