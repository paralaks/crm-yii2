<?php
include(dirname(__FILE__).'/../SigninCept.php');

// $I = new AcceptanceTester($scenario);
$I->am('Logged in user');
$I->wantTo('Create a new lead');
$I->expectTo('See new lead created successfully');

$I->amOnPage('/lead/create');
$I->submitForm('#w0',
   ['Lead[salutation_id]'=>'6',
    'Lead[first_name]'=>'Immanuel',
    'Lead[last_name]'=>'Kant',
    'Lead[company]'=>'Enlightenment Philosophy Inc.',
    'Lead[industry_id]'=>'9',
    'Lead[email]'=>'kant@felossoffar.edu',
    'Lead[lead_source_id]'=>'7',
    'Lead[description]'=>'Enlightenment is man\'s emergence from his self-imposed nonage. Nonage is the inability to use one\'s own understanding without another\'s guidance. This nonage is self-imposed if its cause lies not in lack of understanding but in indecision and lack of courage to use one\'s own mind without another\'s guidance. Dare to know! (Sapere aude.) "Have the courage to use your own understanding," is therefore the motto of the enlightenment.']);

$I->seeInCurrentUrl('/lead/5');
$I->see('Record saved successfully.', $successMessageBox);
$I->see('Lead Detail - Immanuel Kant');
$I->see('Name: Prof. Immanuel Kant');
$I->see('Company: Enlightenment Philosophy Inc.');
$I->see('Industry: Education');
$I->see('Email: kant@felossoffar.edu');
$I->see('Lead Source: Other');
$I->see('Description: Enlightenment is man\'s emergence from his self-imposed nonage');
$I->see('Owner: Basic User');
$I->see('Added By: Basic User');
$I->see('Modified By: Basic User');