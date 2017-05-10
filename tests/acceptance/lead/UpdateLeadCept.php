<?php
include(dirname(__FILE__).'/../SigninCept.php');

// $I = new AcceptanceTester($scenario);
$I->am('Logged in user');
$I->wantTo('Update an existing lead');
$I->expectTo('See lead\'s birth date updated');

$I->amOnPage('/lead/1');
$I->click('#lead-edit-btn');

$I->seeInCurrentUrl('/lead/update/1');
$I->seeInField('#lead-first_name', 'Bill');
$I->seeInField('#lead-last_name', 'Gates');
$I->seeInField('#lead-email', 'bill@microsoft.com');

$birthDate=date('Y-m-').str_pad(rand(1, 28), 2, '0', STR_PAD_LEFT);
$I->fillField('#lead-birthdate', $birthDate);
$I->click('#lead-save-btn');

// check update result
$I->seeInCurrentUrl('/lead/1');
$I->see('Record saved successfully.', $successMessageBox);
$I->see('Birthdate: '.$birthDate);

// test cancel button
$I->amOnPage('/lead/1');
$I->click('#lead-edit-btn');
$I->seeInCurrentUrl('/lead/update/1');
$I->click('#cancel-btn');
$I->seeInCurrentUrl('/lead/1');
