<?php
include(dirname(__FILE__).'/CreateLeadCept.php');

// $I = new AcceptanceTester($scenario);
$I->am('Logged in user');

// all fields blank
$I->amOnPage('/lead/create');
$I->wantTo('Ensure lead can not be created without first name');
$I->expectTo('See validation error for first name');
$I->click('#lead-save-btn');
$I->seeInCurrentUrl('/lead/create');
$I->see('Record could not be saved.', $errorMessageBox);
$I->see('First Name cannot be blank.', $errorMessageBox);

// last name missing
$I->amOnPage('/lead/create');
$I->wantTo('Ensure lead can not be created without last name');
$I->expectTo('See validation error for last name');
$I->selectOption('#lead-salutation_id', 3);
$I->fillField('#lead-first_name', 'Immanuel');
$I->click('#lead-save-btn');
$I->seeInCurrentUrl('/lead/create');
$I->see('Record could not be saved.', $errorMessageBox);
$I->see('Last Name cannot be blank.', $errorMessageBox);

// company missing
$I->amOnPage('/lead/create');
$I->wantTo('Ensure lead can not be created without company');
$I->expectTo('See validation error for company');
$I->selectOption('#lead-salutation_id', 3);
$I->fillField('#lead-first_name', 'Immanuel');
$I->fillField('#lead-last_name', 'Kant');
$I->click('#lead-save-btn');
$I->seeInCurrentUrl('/lead/create');
$I->see('Record could not be saved.', $errorMessageBox);
$I->see('Company cannot be blank.', $errorMessageBox);

// email is missing
$I->amOnPage('/lead/create');
$I->wantTo('Ensure lead can not be created without email');
$I->expectTo('See validation error for email');
$I->selectOption('#lead-salutation_id', 3);
$I->fillField('#lead-first_name', 'Immanuel');
$I->fillField('#lead-last_name', 'Kant');
$I->fillField('#lead-company', 'Enlightenment Philosophy Inc.');
$I->click('#lead-save-btn');
$I->seeInCurrentUrl('/lead/create');
$I->see('Record could not be saved.', $errorMessageBox);
$I->see('Email cannot be blank.', $errorMessageBox);

// lead source is missing
$I->amOnPage('/lead/create');
$I->wantTo('Ensure lead can not be created without first name');
$I->expectTo('See validation error for first name');
$I->selectOption('#lead-salutation_id', 3);
$I->fillField('#lead-first_name', 'Immanuel');
$I->fillField('#lead-last_name', 'Kant');
$I->fillField('#lead-company', 'Enlightenment Philosophy Inc.');
$I->fillField('#lead-email', 'blah@blah.com');
$I->click('#lead-save-btn');
$I->seeInCurrentUrl('/lead/create');
$I->see('Record could not be saved.', $errorMessageBox);
$I->see('Lead Source cannot be blank.', $errorMessageBox);

// duplicate email
$I->amOnPage('/lead/create');
$I->selectOption('#lead-salutation_id', 3);
$I->fillField('#lead-first_name', 'Immanuel');
$I->fillField('#lead-last_name', 'Kant');
$I->fillField('#lead-company', 'Enlightenment Philosophy Inc.');
$I->fillField('#lead-email', 'kant@felossoffar.edu');
$I->selectOption('#lead-lead_source_id', 7);
$I->fillField('#lead-description', 'Enlightenment is man\'s emergence from his self-imposed nonage. Nonage is the inability to use one\'s own understanding without another\'s guidance. This nonage is self-imposed if its cause lies not in lack of understanding but in indecision and lack of courage to use one\'s own mind without another\'s guidance. Dare to know! (Sapere aude.) "Have the courage to use your own understanding," is therefore the motto of the enlightenment.');
$I->click('#lead-save-btn');
$I->seeInCurrentUrl('/lead/create');
$I->see('Record could not be saved.', $errorMessageBox);
$I->see('Email "kant@felossoffar.edu" has already been taken.', $errorMessageBox);
