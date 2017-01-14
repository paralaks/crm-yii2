<?php
use yii\helpers\Html;

$loginLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);

?>
Hello <?= HTML::encode($user->name) ?>,

Your password was changed recently.

Click <?= $loginLink ?> to login with your new password.

Thank you!
