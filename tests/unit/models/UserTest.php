<?php
namespace tests\models;
use app\models\User;

class UserTest extends \Codeception\Test\Unit
{
    public function testFindUserById()
    {
        expect_that($user = User::findIdentity(1));
        expect($user->username)->equals('admin@crm-yii.com');

        expect_not(User::findIdentity(999));
    }

    public function testFindUserByAccessToken()
    {
        expect_that($user = User::findIdentityByAccessToken('rest1api2token3admin'));
        expect($user->username)->equals('admin@crm-yii.com');

        expect_not(User::findIdentityByAccessToken('non-existing'));
    }

    public function testFindUserByUsername()
    {
        expect_that($user = User::findByUsername('admin@crm-yii.com'));
        expect_not(User::findByUsername('not-admin'));
    }

    /**
     * @depends testFindUserByUsername
     */
    public function testValidateUser($user)
    {
        $user = User::findByUsername('admin@crm-yii.com');
        expect_that($user->validateAuthKey($user->getAuthKey()));
        expect_not($user->validateAuthKey('test102key'));

        expect_that($user->validatePassword('admin123'));
        expect_not($user->validatePassword('123456'));
    }

}
