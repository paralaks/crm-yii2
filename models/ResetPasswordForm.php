<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
use yii\base\InvalidParamException;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{

  public $password;
  public $password_repeat;

  /**
   *
   * @var \common\models\User
   */
  private $_user;


  /**
   * Creates a form model given a token.
   *
   * @param string $token
   * @param array $config
   *          name-value pairs that will be used to initialize the object properties
   * @throws \yii\base\InvalidParamException if token is empty or not valid
   */
  public function __construct($token, $config=[])
  {
    if (empty($token) || ! is_string($token))
    {
      throw new InvalidParamException(Yii::t('main', 'Password reset information was missing.'));
    }

    $this->_user=User::findByPasswordResetToken($token);

    if (! $this->_user)
    {
      throw new InvalidParamException(Yii::t('main', 'Password reset information was incorrect.'));
    }

    parent::__construct($config);
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
             [['password', 'password_repeat'], 'required'],
             [['password', 'password_repeat'], 'filter', 'filter' => 'trim'],
             [['password', 'password_repeat'], 'string', 'min' => 6],
             ['password', 'in', 'range' => ['password', '123456'], 'not' => true, 'message' => Yii::t('main', 'Please select a better password.')],
             ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('main', 'Passwords do not match.')],
    ];
  }

  /**
   *
   * @return array customized attribute labels
   */
  public function attributeLabels()
  {
    return [
      'password' => Yii::t('main', 'Password'),
      'password_repeat' => Yii::t('main', 'Password 2')
    ];
  }

  /**
   * Resets password.
   *
   * @return boolean if password was reset.
   */
  public function resetPassword()
  {
    $user=$this->_user;
    $user->setPassword($this->password);
    $user->removePasswordResetToken();

    return $user->save(false);
  }
}
