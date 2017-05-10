<?php
include(dirname(__FILE__).'/../SigninCept.php');

// $I = new AcceptanceTester($scenario);

$I->am('Logged in user');
$I->wantTo('Delete a lead');
$I->expectTo('See lead is deleted');

$I->amOnPage('/lead/1');
$I->seeInCurrentUrl('/lead/1');
$I->see('Name: Mr. Bill Gates');

$I->click('#lead-delete-btn');

$I->seeInCurrentUrl('/lead/index');
$I->see('Record deleted successfully.', $successMessageBox);
