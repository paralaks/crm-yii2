<?php
use yii\helpers\Html;

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);

?>
<div class="password-reset">

Hello <?= HTML::encode($user->name) ?>, <br><br>

You requested a new password. <br><br>

Please click <?= Html::a('here', $resetLink) ?> to reset your password.

Thank you!

</div>
