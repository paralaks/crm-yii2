<?php
include(dirname(__FILE__).'/../SigninCept.php');

// $I = new AcceptanceTester($scenario);
$I->am('User');
$I->wantTo('Ensure mandatory lead fields are checked on update');
$I->expectTo('See validation error messages');

// all fields blank
$I->amOnPage('/lead/update/1');
$I->fillField('#lead-first_name', '');
$I->fillField('#lead-last_name', '');
$I->fillField('#lead-company', '');
$I->fillField('#lead-email', '');
$I->selectOption('#lead-lead_source_id', '');
$I->click('#lead-save-btn');
$I->see('Record could not be saved.', $errorMessageBox);
$I->see('First Name cannot be blank.');
$I->see('Last Name cannot be blank.');
$I->see('Company cannot be blank.');
$I->see('Email cannot be blank.');
$I->see('Lead Source cannot be blank.');

// keep populating fields until save succeeds
$I->amOnPage('/lead/update/1');
$I->fillField('#lead-first_name', 'Acceptance');
$I->fillField('#lead-last_name', '');
$I->fillField('#lead-company', '');
$I->fillField('#lead-email', '');
$I->selectOption('#lead-lead_source_id', '');
$I->click('#lead-save-btn');
$I->see('Record could not be saved.', $errorMessageBox);
$I->dontSee('First Name cannot be blank.', $errorMessageBox);
$I->see('Last Name cannot be blank.');
$I->see('Company cannot be blank.');
$I->see('Email cannot be blank.');
$I->see('Lead Source cannot be blank.');


$I->amOnPage('/lead/update/1');
$I->fillField('#lead-first_name', 'Acceptance');
$I->fillField('#lead-last_name', 'Tester');
$I->fillField('#lead-company', '');
$I->fillField('#lead-email', '');
$I->selectOption('#lead-lead_source_id', '');
$I->click('#lead-save-btn');
$I->see('Record could not be saved.', $errorMessageBox);
$I->dontSee('First Name cannot be blank.', $errorMessageBox);
$I->dontSee('Last Name cannot be blank.', $errorMessageBox);
$I->see('Company cannot be blank.');
$I->see('Email cannot be blank.');
$I->see('Lead Source cannot be blank.');


$I->amOnPage('/lead/update/1');
$I->fillField('#lead-first_name', 'Acceptance');
$I->fillField('#lead-last_name', 'Tester');
$I->fillField('#lead-company', 'Accepance Guy Co.');
$I->fillField('#lead-email', '');
$I->selectOption('#lead-lead_source_id', '');
$I->click('#lead-save-btn');
$I->see('Record could not be saved.', $errorMessageBox);
$I->dontSee('First Name cannot be blank.', $errorMessageBox);
$I->dontSee('Last Name cannot be blank.', $errorMessageBox);
$I->dontSee('Company cannot be blank.', $errorMessageBox);
$I->see('Email cannot be blank.');
$I->see('Lead Source cannot be blank.');


$I->amOnPage('/lead/update/1');
$I->fillField('#lead-first_name', 'Acceptance');
$I->fillField('#lead-last_name', 'Tester');
$I->fillField('#lead-company', 'Acceptance Guy Co.');
$I->fillField('#lead-email', 'acceptance.tester@test.org');
$I->selectOption('#lead-lead_source_id', '');
$I->click('#lead-save-btn');
$I->see('Record could not be saved.', $errorMessageBox);
$I->dontSee('First Name cannot be blank.', $errorMessageBox);
$I->dontSee('Last Name cannot be blank.', $errorMessageBox);
$I->dontSee('Company cannot be blank.', $errorMessageBox);
$I->dontSee('Email cannot be blank.', $errorMessageBox);
$I->see('Lead Source cannot be blank.');


$I->amOnPage('/lead/update/1');
$I->fillField('#lead-first_name', 'Acceptance');
$I->fillField('#lead-last_name', 'Tester');
$I->fillField('#lead-company', 'Acceptance Guy Co.');
$I->fillField('#lead-email', 'acceptance.tester@test.org');
$I->selectOption('#lead-lead_source_id', 3);
$I->click('#lead-save-btn');
$I->see('Record saved successfully', $successMessageBox);
$I->dontSee('First Name cannot be blank.');
$I->dontSee('Last Name cannot be blank.');
$I->dontSee('Company cannot be blank.');
$I->dontSee('Email cannot be blank.');
$I->dontSee('Lead Source cannot be blank.');
$I->seeInCurrentUrl('/lead/1');
