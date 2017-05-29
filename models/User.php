<?php
namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;
use yii\db\Query;
use app\helpers\AppHelper;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends CrmModel implements IdentityInterface
{
  public $password;
  public $password_repeat;
  public $role;

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return '{{%users}}';
  }

  /**
   * @inheritdoc
   */
  public function behaviors()
  {
    return [
      //TimestampBehavior::className()
    ];
  }

  public function scenarios()
  {
    $scenarios=parent::scenarios();

    $scenarios['login']=['login_at'];
    $scenarios['reset-password-request']=['password_reset_token'];
    $scenarios['change-password']=['password_hash'];

    return $scenarios;
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    $rules= [
      ['status', 'default', 'value' => AppHelper::STATUS_ACTIVE],
      ['status', 'in', 'range' => [AppHelper::STATUS_ACTIVE, AppHelper::STATUS_INACTIVE]],
      [['name', 'username', 'email', 'password', 'password_repeat'], 'filter', 'filter' => 'trim'],
      [['name', 'username', 'email', 'role'], 'required'],
      [['name', 'username', 'email'], 'string', 'min' => 2, 'max' => 255],
      ['email', 'email'],
      ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => Yii::t('main', 'This username has already been taken.')],
      ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => Yii::t('main', 'This email address has already been taken.')],
      [['password', 'password_repeat'], 'string', 'min' => 6],
      ['password', 'in', 'range' => ['password', '123456'], 'not' => true, 'message' => Yii::t('main', 'Please select a better password.')],
      ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('main', 'Passwords do not match.')],
      [['owner_id', 'adder_id', 'modifier_id'], 'integer'],
    ];

    if (Yii::$app->requestedAction->id=='userupdate')
      $rules[]=[['password', 'password_repeat'], 'string', 'skipOnEmpty' => true];
    else
      $rules[]=[['password', 'password_repeat'], 'required'];

    return $rules;
  }

  /**
   *
   * @return array customized attribute labels
   */
  public function attributeLabels()
  {
    return [
      'status' => Yii::t('main', 'Status'),
      'name' => Yii::t('main', 'Name'),
      'username' => Yii::t('main', 'Username'),
      'email' => Yii::t('main', 'Email'),
      'password' => Yii::t('main', 'Password'),
      'password_repeat' => Yii::t('main', 'Password 2'),
      'role' => Yii::t('main', 'Role'),
      'login_at' => Yii::t('main', 'Last Login'),
    ];
  }

  public static function findOneCrm($condition)
  {
    $user=static::findOne($condition);

    if ($user && $user->id)
    {
      $query=new Query();
      $role=$query->select('item_name')->from('auth_assignment')->where(['user_id'=>$user->id])->one();
      $user->role= $role ? $role['item_name'] : '';
    }

    return $user;
  }

  /**
   * @inheritdoc
   */
  public static function findIdentity($id)
  {
    $user=static::findOneCrm(['id' => $id, 'status' => AppHelper::STATUS_ACTIVE]);

    return $user;
  }

  /**
   * @inheritdoc
   */
  public static function findIdentityByAccessToken($token, $type=null)
  {
    $user=static::findOneCrm(['access_token' => $token, 'status' => AppHelper::STATUS_ACTIVE]);

    return $user;
  }

  /**
   * Finds user by username
   *
   * @param string $username
   * @return static|null
   */
  public static function findByUsername($username)
  {
    $user=static::findOneCrm(['username' => $username, 'status' => AppHelper::STATUS_ACTIVE]);

    return $user;
  }

  /**
   * Finds user by password reset token
   *
   * @param string $token
   *          password reset token
   * @return static|null
   */
  public static function findByPasswordResetToken($token)
  {
    if (! static::isPasswordResetTokenValid($token))
    {
      return null;
    }

    return static::findOneCrm(['password_reset_token' => $token, 'status' => AppHelper::STATUS_ACTIVE]);
  }

  /**
   * Finds out if password reset token is valid
   *
   * @param string $token
   *          password reset token
   * @return boolean
   */
  public static function isPasswordResetTokenValid($token)
  {
    if (empty($token))
    {
      return false;
    }
    $expire=Yii::$app->params['user.passwordResetTokenExpire'];
    $parts=explode('_', $token);
    $timestamp=(int) end($parts);
    return $timestamp + $expire >= time();
  }

  /**
   * @inheritdoc
   */
  public function getId()
  {
    return $this->getPrimaryKey();
  }

  /**
   * @inheritdoc
   */
  public function getAuthKey()
  {
    return $this->auth_key;
  }

  /**
   * @inheritdoc
   */
  public function validateAuthKey($authKey)
  {
    return $this->getAuthKey() === $authKey;
  }

  /**
   * Validates password
   *
   * @param string $password
   *          password to validate
   * @return boolean if password provided is valid for current user
   */
  public function validatePassword($password)
  {
    return Yii::$app->security->validatePassword($password, $this->password_hash);
  }

  /**
   * Generates password hash from password and sets it to the model
   *
   * @param string $password
   */
  public function setPassword($password)
  {
    $this->password_hash=Yii::$app->security->generatePasswordHash($password);
  }

  /**
   * Generates "remember me" authentication key
   */
  public function generateAuthKey()
  {
    $this->auth_key=Yii::$app->security->generateRandomString();
  }

  /**
   * Generates new password reset token
   */
  public function generatePasswordResetToken()
  {
    $this->password_reset_token=Yii::$app->security->generateRandomString() . '_' . time();
  }

  /**
   * Removes password reset token
   */
  public function removePasswordResetToken()
  {
    $this->password_reset_token=null;
  }
}
