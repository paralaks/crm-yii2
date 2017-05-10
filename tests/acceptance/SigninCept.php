<?php
$I = new AcceptanceTester($scenario);


$errorMessageBox='div.alert.alert-danger.alert-dismissable';
$successMessageBox='div.alert.alert-success.alert-dismissable';

$I->am('User');
$I->wantTo('Login to website');
$I->lookForwardTo('Access all website features');
$I->amOnPage("/site/login");
$I->see('DEV_Server', '#serverDecal');

$I->fillField('#loginform-username', 'user@crm-yii.com');
$I->fillField('#loginform-password', 'user123');
$I->click('//*[@id="form-login"]/div[4]/div[1]/button');
$I->see('Hello, Basic User!');
