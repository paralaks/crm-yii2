<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * Password reset form
 */
class IdentityForm extends Model
{
  private $user;

  public $name;
  public $username;
  public $email;

  public $password;
  public $password_new;
  public $password_repeat;

  public function __construct($config=[])
  {
    $this->user=User::findByUsername(Yii::$app->user->identity->username);

    $this->name=$this->user->name;
    $this->username=$this->user->username;
    $this->email=$this->user->email;

    parent::__construct($config);
  }


  public function rules()
  {
    $passFields=['password', 'password_new', 'password_repeat'];

    return [
             [$passFields, 'required'],
             [$passFields, 'filter', 'filter' => 'trim'],
             [$passFields, 'string', 'min' => 6],
             ['password_new', 'in', 'range' => ['password', '123456'], 'not' => true, 'message' => Yii::t('main', 'Please select a better password.')],
             ['password_repeat', 'compare', 'compareAttribute' => 'password_new', 'message' => Yii::t('main', 'Passwords do not match.')],
    ];
  }

  /**
   *
   * @return array customized attribute labels
   */
  public function attributeLabels()
  {
    return [
      'password' => Yii::t('main', 'Current Password'),
      'password_new' => Yii::t('main', 'New Password'),
      'password_repeat' => Yii::t('main', 'New Password 2')
    ];
  }

  public function changePassword()
  {
    if ($this->user->validatePassword($this->password))
    {
      $this->user->scenario='change-password';
      $this->user->setPassword($this->password_new);

      if ($this->user->save())
      {
        Yii::$app->mailer->compose(['html' => 'site/identityUpdate-html', 'text' => 'site/identityUpdate-text'], ['user' => $this->user])
        ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
        ->setTo($this->email)
        ->setSubject('Password was changed for ' . \Yii::$app->name)
        ->send();

        return true;
      }
    }

    $this->password='';
    $this->password_new='';
    $this->password_repeat='';

    return false;
  }
}
