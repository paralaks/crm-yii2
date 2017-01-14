<?php
use yii\helpers\Html;

$loginLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);

?>
<div class="password-reset">

Hello <?= HTML::encode($user->name) ?>, <br><br>

Your password was changed recently. <br><br>

Click <?= Html::a('here', $loginLink) ?> to login with your new password.

Thank you!

</div>
