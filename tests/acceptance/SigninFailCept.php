<?php
$I = new AcceptanceTester($scenario);

$I->am('User');
$I->wantTo('Enter bad credentials');
$I->lookForwardTo('See login error message');

$I->amOnPage('/');
$I->fillField('#loginform-username', 'garbage');
$I->fillField('#loginform-password', 'garbage');
$I->click('//*[@id="form-login"]/div[4]/div[1]/button');
$I->dontSee('Hello, Basic User!');
$I->see('Incorrect username or password.');
