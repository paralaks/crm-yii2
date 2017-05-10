<?php
include(dirname(__FILE__).'/../SigninCept.php');

// $I = new AcceptanceTester($scenario);
$I->am('Logged in user');
$I->wantTo('Ensure I can view lead list');
$I->expectTo('See leads list page with search form');

$I->amOnPage('/site/index');
$I->see('Leads');
$I->click('//*[@id="w1"]/li[2]/a');

$I->seeInCurrentUrl('/lead/index');
$I->seeLink('New Lead');

// search form check
$I->see('Search for Leads', 'h4');
$I->see('Name');
$I->see('Email');
$I->see('Company');
$I->see('Lead Status');
$I->seeElement('#search-lead-btn', ['type'=>'submit']);

// list check
// table header
$I->see('Showing');
$I->see('items.');
$I->see('#', 'th');
$I->see('First Name', 'th');
$I->see('Last Name', 'th');
$I->see('Email', 'th');
$I->see('Company', 'th');
$I->see('Lead Status', 'th');
$I->see('Industry', 'th');
$I->see('State', 'th');
$I->see('Country', 'th');
$I->see('Owner', 'th');
$I->see('Updated At', 'th');
$I->see('Added At', 'th');

// table data; 2nd row check
$I->see('Paul', 'td');
$I->see('Allen', 'td');
$I->see('paul@microsoft.com', 'td');
$I->see('Microsoft', 'td');
$I->see('Open - Not Contacted', 'td');
$I->see('Agriculture', 'td');
$I->see('Washington', 'td');
$I->see('USA', 'td');
$I->see('Admin User', 'td');

// action links on editable row check
$I->seeElement('//*[@id="w1"]/table/tbody/tr[1]/td[13]/span/a[1]', ['href'=>'/lead/update/1']);
$I->seeElement('//*[@id="w1"]/table/tbody/tr[1]/td[13]/span/a[2]', ['href'=>'/lead/delete/1']);

// search form submission check
$I->fillField('#leadsearch-name', 'Bill');
$I->selectOption('#leadsearch-status_id', '1');
$I->click('#search-lead-btn');

// search results form check
$I->see('Search for Leads', 'h4');
$I->see('Name');
$I->see('Email');
$I->see('Company');
$I->see('Lead Status');
$I->seeElement('#search-lead-btn', ['type'=>'submit']);

// search result check
$I->seeInField('//*[@id="leadsearch-name"]', 'Bill');
$I->seeInField('//*[@id="leadsearch-status_id"]', '1');

// search results list check
$I->see('Bill', 'td');
$I->see('Gates', 'td');
$I->see('bill@microsoft.com', 'td');
$I->see('Microsoft', 'td');
$I->see('Open - Not Contacted', 'td');
$I->see('Agriculture', 'td');
$I->see('Washington', 'td');
$I->see('USA', 'td');
$I->see('Basic User', 'td');
$I->seeElement('//*[@id="w1"]/table/tbody/tr[1]/td[13]/span/a[1]', ['href'=>'/lead/update/1']);
$I->seeElement('//*[@id="w1"]/table/tbody/tr[1]/td[13]/span/a[2]', ['href'=>'/lead/delete/1']);
