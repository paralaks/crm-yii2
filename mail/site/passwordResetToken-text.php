<?php
use yii\helpers\Html;

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);

?>
Hello <?= HTML::encode($user->name) ?>,

You requested a new password.

Please click <?= $resetLink ?> to reset your password.

Thank you!

