<?php
include(dirname(__FILE__).'/CreateLeadCept.php');

$I->am('Logged in user');
$I->wantTo('Convert a lead to a contact with new opportunity');
$I->expectTo('See lead converted to a contact');


$I->amOnPage('/lead/5');
$I->see('Lead Detail - Immanuel Kant', 'div.pageTitle');
$I->seeLink('Convert');
$I->click('#lead-convert-btn');

$I->seeInCurrentUrl('lead/convert/5');

$I->see('Convert Lead - Immanuel Kant');
$I->see('Account Name');
$I->seeInField('LeadConvertForm[account_name]', 'Enlightenment Philosophy Inc.');
$I->dontSee('There are similar accounts in the system. If you want to add the lead to an existing account, please select it from the dropdown list below. Otherwise a new account with the company name will be created.');
$I->see('Create New Opportunity?');
$I->selectOption('LeadConvertForm[new_opportunity]', '1');
$I->fillField('LeadConvertForm[opportunity_name]', 'Converted Opportunity');
$I->fillField('LeadConvertForm[stage_id]', '2');
$I->fillField('LeadConvertForm[close_date]', '2020-12-31');
$I->click('#lead-convert-btn');

// conversion success
$I->seeInCurrentUrl('/contact/15');
$I->see('Contact Detail - Immanuel Kant', 'div.pageTitle');
$I->see('Name: Mr. Bill Gates');
$I->see('Email: bill@microsoft.com');
$I->see('Phone: 357-634-0488');
$I->see('Description: Used to be CEO now doing charity work');
$I->see('Owner: Basic User');
$I->see('Added By: Basic User');
$I->see('Modified By: Basic User');

// lead is not accessible
$I->wantTo('Ensure converted lead is not accessible');
$I->expectTo('See lead was converted to contact error messsage');
$I->amOnPage('/lead/1');
$I->see('Lead was converted to contact', $errorMessageBox);
