<?php

class LoginFormCest
{

  public function _before(\FunctionalTester $I)
  {
    $I->amOnRoute('site/login');
  }

  public function openLoginPage(\FunctionalTester $I)
  {
    $I->see('Login', 'div.pageTitle');
  }

  // demonstrates `amLoggedInAs` method
  public function internalLoginById(\FunctionalTester $I)
  {
    $I->amLoggedInAs(1);
    $I->amOnPage('/');
    $I->see('Admin User');
  }

  // demonstrates `amLoggedInAs` method
  public function internalLoginByInstance(\FunctionalTester $I)
  {
    $I->amLoggedInAs(\app\models\User::findByUsername('admin@crm-yii.com'));
    $I->amOnPage('/');
    $I->see('Admin User');
  }

  public function loginWithEmptyCredentials(\FunctionalTester $I)
  {
    $I->submitForm('#form-login', []);
    $I->expectTo('see validations errors');
    $I->see('Username cannot be blank.');
    $I->see('Password cannot be blank.');
  }

  public function loginWithWrongCredentials(\FunctionalTester $I)
  {
    $I->submitForm('#form-login', ['LoginForm[username]' => 'admin@crm-yii.com', 'LoginForm[password]' => 'wrong']);
    $I->expectTo('see validations errors');
    $I->see('Incorrect username or password.');
  }

  public function loginSuccessfully(\FunctionalTester $I)
  {
    $I->submitForm('#form-login', ['LoginForm[username]' => 'admin@crm-yii.com', 'LoginForm[password]' => 'admin123']);
    $I->see('Admin User');
    $I->dontSeeElement('form#form-login');
  }
}
