<?php
include(dirname(__FILE__).'/../SigninCept.php');

$I->am('Logged in user');
$I->amOnPage('/lead/1');
$I->wantTo('See a lead\'s detail information');
$I->expectTo('See lead detail page with lead data');


$I->see('Lead Detail - Bill Gates', 'div.pageTitle');
$I->see('Name: Mr. Bill Gates');
$I->see('Company: Microsoft');
$I->see('Title: Retired');
$I->see('Industry: Agriculture');
$I->see('Email: bill@microsoft.com');
$I->see('Phone: 357-634-0488');
$I->see('Rating: Hot');
$I->see('Annual Revenue: 6000000000');
$I->see('Num. Of Employees: 35344');
$I->see('Website: http://www.microsoft.com');
$I->see('Lead Source: Web');
$I->see('Lead Status: Open - Not Contacted');
$I->see('Description: Used to be CEO now doing charity work');
$I->see('Owner: Basic User');
$I->see('Added By: Admin User');
$I->see('Modified By: Admin User');

// check buttons
$I->seeLink('Edit');
$I->seeLink('Delete');
$I->seeLink('Convert');
$I->seeLink('Add New');
