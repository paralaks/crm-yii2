<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
use app\helpers\AppHelper;


/**
 * Password reset request form
 */
class ResetPasswordRequestForm extends Model
{

  public $email;

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      ['email', 'filter', 'filter' => 'trim'],
      ['email', 'required'], ['email', 'email'],
      ['email', 'exist', 'targetClass' => '\app\models\User', 'filter' => ['status' => AppHelper::STATUS_ACTIVE], 'message' => Yii::t('main', 'There is no user with such email.')]];
  }

  /**
   *
   * @return array customized attribute labels
   */
  public function attributeLabels()
  {
    return [
      'email' => Yii::t('main', 'Email')
    ];
  }

  /**
   * Sends an email with a link, for resetting the password.
   *
   * @return boolean whether the email was send
   */
  public function sendEmail()
  {
    /* @var $user User */
    $user=User::findOne(['status' => AppHelper::STATUS_ACTIVE, 'email' => $this->email]);
    $user->scenario='reset-password-request';

    if ($user)
    {
      if (! User::isPasswordResetTokenValid($user->password_reset_token))
      {
        $user->generatePasswordResetToken();
      }

      if ($user->save())
      {
        return \Yii::$app->mailer->compose(['html' => 'site/passwordResetToken-html', 'text' => 'site/passwordResetToken-text'], ['user' => $user])
          ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
          ->setTo($this->email)
          ->setSubject('Password reset for ' . \Yii::$app->name)
          ->send();
      }
    }

    return false;
  }
}
