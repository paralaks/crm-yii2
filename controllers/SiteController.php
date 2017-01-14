<?php
namespace app\controllers;

use Yii;
use yii\db\Query;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\ResetPasswordRequestForm;
use app\models\ResetPasswordForm;
use app\models\LookupForm;
use app\models\User;
use app\models\Activity;
use app\helpers\AppHelper;
use app\models\IdentityForm;
use app\models\Opportunity;

class SiteController extends Controller
{

  public function actions()
  {
    return ['error' => ['class' => 'yii\web\ErrorAction'], 'captcha' => ['class' => 'yii\captcha\CaptchaAction', 'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null]];
  }

  public function actionIndex()
  {
    if (Yii::$app->user->isGuest)
      return $this->render('login', ['model' => new LoginForm()]);

    $activities=(new Query())->select('id, subject, type_id, priority_id, status_id, end_date, owner_id')
      ->from('activities')
      ->where('owner_id="' . Yii::$app->user->identity->id . '" and status_id!=' . Activity::STATUS_COMPLETED . ' and deleted_at is null')
      ->orderBy('end_date desc')
      ->limit(25)
      ->all();

    $opportunities=(new Query())->select('id, name, close_date, probability, type_id, stage_id, owner_id')
      ->from('opportunities')
      ->where('owner_id="' . Yii::$app->user->identity->id . '" and stage_id!=' . Opportunity::STAGE_CLOSED . ' and deleted_at is null')
      ->orderBy('close_date desc')
      ->limit(25)
      ->all();

    return $this->render('index', ['activities' => $activities, 'opportunities' => $opportunities]);
  }

  public function actionLogin()
  {
    $model=new LoginForm();

    if ($model->load(Yii::$app->request->post()) && $model->login())
    {
      $user=Yii::$app->user->identity;

      Yii::$app->session->setFlash('pageSuccess', Yii::t('main', 'You have logged in.'));

      Yii::$app->user->identity->scenario='login';
      Yii::$app->user->identity->login_at=date('Y-m-d H:i:s');
      Yii::$app->user->identity->save();

      // redirect to requested URL or home
      $returnURL=Yii::$app->session->get('__returnUrl');
      $returnURL=empty($returnURL) ? '/site/index' : $returnURL;

      return $this->redirect($returnURL);
    }
    else
    {
      $model->password='';
      return $this->render('login', ['model' => $model]);
    }
  }

  public function actionLogout()
  {
    Yii::$app->user->logout();
    Yii::$app->session->setFlash('pageSuccess', Yii::t('main', 'You have logged out.'));

    return $this->redirect(['site/login']);
  }

  public function actionContact()
  {
    $model=new ContactForm();
    if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail']))
    {
      Yii::$app->session->setFlash(Yii::t('main', 'Contact form submitted.'));

      return $this->refresh();
    }
    else
    {
      return $this->render('contact', ['model' => $model]);
    }
  }

  /**
   * Signs user up.
   *
   * @return mixed
   */
  /*
   public function actionSignup()
   {
   $model=new SignupForm();
   if ($model->load(Yii::$app->request->post()))
   {
   if ($user=$model->signup())
   {
   if (Yii::$app->getUser()->login($user))
   {
   return $this->goHome();
   }
   }
   }

   return $this->render('signup', ['model' => $model]);
   }
   */

  /**
   * Requests password reset.
   *
   * @return mixed
   */
  public function actionResetPasswordRequest()
  {
    $model=new ResetPasswordRequestForm();

    if ($model->load(Yii::$app->request->post()) && $model->validate())
    {
      if ($model->sendEmail())
      {
        Yii::$app->session->setFlash('pageSuccess', Yii::t('main', 'Reset instructions sent. Please check your email within a few minutes.'));

        return $this->goHome();
      }
      else
      {
        Yii::$app->session->setFlash('pageError', Yii::t('main', 'We are unable to reset password for the your email address.'));
      }
    }

    return $this->render('requestPasswordResetToken', ['model' => $model]);
  }

  /**
   * Resets password.
   *
   * @param string $token
   * @return mixed
   */
  public function actionResetPassword()
  {
    $token=Yii::$app->request->get('token', Yii::$app->request->post('token', ''));

    try
    {
      $model=new ResetPasswordForm($token);
    }
    catch (\Exception $e)
    {
      Yii::$app->session->setFlash('pageError', $e->getMessage());

      return $this->redirect(['site/login']);
    }

    if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword())
    {
      Yii::$app->session->setFlash('pageSuccess', Yii::t('main', 'Password changed successfully.'));

      return $this->goHome();
    }

    return $this->render('resetPassword', ['model' => $model, 'token' => $token]);
  }

  public function actionUsersmanage()
  {
    $query=new Query();
    $users=$query->select('*, (select item_name from auth_assignment as a where a.user_id=id limit 1) as role')
      ->from('users')
      ->where(['!=', 'id', Yii::$app->user->identity->id])
      ->all();

    foreach ($users as &$user)
    {
      if (Yii::$app->user->can('Administrator') || Yii::$app->user->can('Manager'))
        $user['actions']=Html::a(Yii::t('main', 'Edit'), Url::to(['site/userupdate', 'id' => $user['id']])) . '&nbsp;&nbsp;&nbsp;' . ($user['status'] == AppHelper::STATUS_ACTIVE ? Html::a(
        Yii::t('main', 'Deactivate'), Url::to(['site/userdeactivate', 'id' => $user['id']]), ['class' => 'text-danger']) : Html::a(Yii::t('main', 'Activate'),
        Url::to(['site/useractivate', 'id' => $user['id']]))) . '<br>' .
         Html::a(Yii::t('main', 'View update history'), Url::to(['site/usershowupdatehistory', 'id' => $user['id']]), ['target' => '_blank']);
      else
        $user['actions']='';
    }

    return $this->render('list-users', ['users' => $users]);
  }

  public function actionUsershowupdatehistory($id)
  {
    $model=User::findOne($id);

    $updates=Yii::$app->user->can('Manager') ? $model->getUpdateHistory() : [];

    return $this->render('../commons/update-history', ['model' => $model, 'updates' => $updates]);
  }

  public function actionUseradd()
  {
    $model=new User();

    if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()))
    {
      if (Yii::$app->user->can('Administrator'))
      {
        // we're good
      }
      else if (Yii::$app->user->can('Manager'))
      {
        $model->role="User";
      }
      else if (Yii::$app->user->can('User')) // Users can't add users
        return $this->redirect(['site/index']);

      $model->adder_id=Yii::$app->user->identity->id;

      $model->setPassword($model->password);
      $model->generateAuthKey();

      if ($model->save())
      {
        // Save RBAC permissions
        $query=new Query();
        $query->createCommand()
          ->insert('auth_assignment', ['item_name' => $model->role, 'user_id' => $model->id, 'created_at' => time()])
          ->execute();

        return $this->redirect(['site/usersmanage']);
      }
      else
      {
        $model->password='';
        $model->password_repeat='';

        Yii::$app->session->setFlash('pageErrors', $model->errors);
      }
    }

    return $this->render('create-user', ['model' => $model]);
  }

  public function actionUserupdate($id)
  {
    $model=User::findOneCrm(['id' => $id]);

    $allowed=false;

    if (Yii::$app->user->can('Administrator'))
      $allowed=true;
    else if (Yii::$app->user->can('Manager'))
      $allowed=true;

    if (!$allowed)
    {
      Yii::$app->session->setFlash('pageError', Yii::t('main', 'UNAUTHORIZED_TO_MODIFY'));

      return $this->redirect(['site/usersmanage']);
    }

    $query=new Query();

    if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()))
    {
      if ($model->password)
        $model->setPassword($model->password);

      $model->modifier_id=Yii::$app->user->identity->id;
      $model->updated_at=date('Y-m-d H:i:s');

      if ($model->save())
      {
        // Save RBAC permissions
        $query=new Query();
        $query->createCommand()
          ->delete('auth_assignment', ['user_id' => $model->id])
          ->execute();

        $query=new Query();
        $query->createCommand()
          ->insert('auth_assignment', ['item_name' => $model->role, 'user_id' => $model->id, 'created_at' => time()])
          ->execute();

        return $this->redirect(['site/usersmanage']);
      }
    }

    if ($model->hasErrors())
    {
      $model->password='';
      $model->password_repeat='';

      Yii::$app->session->setFlash('pageErrors', $model->errors);
    }

    return $this->render('update-user', ['model' => $model]);
  }

  public function userActivateDeactivate($id, $status=AppHelper::STATUS_INACTIVE)
  {
    $model=User::findOneCrm(['id' => $id]);
    $model->status=$status;
    $model->modifier_id=Yii::$app->user->identity->id;
    $model->updated_at=date('Y-m-d H:i:s');

    if (Yii::$app->user->can('Manager') && $model->role == 'Administrator')
      Yii::$app->session->setFlash('pageError', Yii::t('main', 'UNAUTHORIZED_TO_MODIFY'));
    else if ($model->save(false))
      Yii::$app->session->setFlash('pageSuccess', Yii::t('main', 'SAVE_SUCCEEDED'));
    else
      Yii::$app->session->setFlash('pageError', Yii::t('main', 'SAVE_FAILED'));

    return $this->redirect(['site/usersmanage']);
  }

  public function actionUserdeactivate($id)
  {
    return $this->userActivateDeactivate($id, AppHelper::STATUS_INACTIVE);
  }

  public function actionUseractivate($id)
  {
    return $this->userActivateDeactivate($id, AppHelper::STATUS_ACTIVE);
  }

  public function actionLookupsmanage()
  {
    if (!(Yii::$app->user->can('Administrator') || Yii::$app->user->can('Manager')))
      return $this->redirect(['site/index']);

    $model=new LookupForm();

    $query=new Query();
    $lookups=Yii::$app->db->createCommand('show tables from ' . Yii::$app->appHelper->getDbName() . ' like "lkp_%"')
      ->queryColumn();

    $lookupList=[];
    foreach ($lookups as $value)
      if (!in_array($value, ['lkp_lead_status', 'lkp_rating', 'lkp_account_ownership']))
        $lookupList[$value]=ucwords(str_ireplace(['lkp_', '_', 'account'], ['', ' ', Yii::t('main', 'Account')], $value));

    asort($lookupList);

    if (Yii::$app->request->isPost)
      $model->load(Yii::$app->request->post());

    $tableName=$model->tableName ? $model->tableName : Yii::$app->request->post('tableName');
    $tableName=$tableName ? preg_replace('/[^a-zA-Z_]/', '', $tableName) : null;
    $tableName=$tableName && stripos($tableName, 'lkp_') === false ? 'lkp_' . $tableName : $tableName;

    $result=null;

    if ($model->action)
      try
      {
        $query=new Query();
        $command=$query->createCommand();

        if ($model->action == 'save')
          $result=$model->id ? $command->update($tableName, ['value' => $model->value, 'idxpos' => $model->idxpos, 'description' => $model->description],
          ['id' => $model->id, 'editable' => 1])
            ->execute() : $command->insert($tableName, ['value' => $model->value, 'idxpos' => $model->idxpos, 'description' => $model->description, 'editable' => 1])
            ->execute();
        if ($model->action == 'delete')
          $result=$command->update($tableName, ['deleted_at' => date('Y-m-d H:i:s')], ['id' => $model->id, 'editable' => 1])
            ->execute();

        $model=new LookupForm();

        Yii::$app->session->setFlash('pageSuccess', Yii::t('main', 'SAVE_SUCCEEDED'));
      }
      catch (\Exception $e)
      {
        Yii::$app->session->setFlash('pageError', Yii::t('main', 'SAVE_FAILED'));
      }

    $query=new Query();
    $values=$tableName ? $query->select('*')
      ->from($tableName)
      ->where('deleted_at is null')
      ->orderBy(['idxpos' => 'asc', 'updated_at' => 'desc'])
      ->all() : [];

    $model->tableName=$tableName;
    $model->action='save';

    return $this->render('manage-lookups', ['model' => $model, 'lookupList' => $lookupList, 'values' => $values]);
  }

  public function actionIdentitymanage()
  {
    $model=new IdentityForm();

    if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()))
    {
      if ($model->changePassword())
      {
        Yii::$app->session->setFlash('pageSuccess', Yii::t('main', 'Password changed successfully.'));
        return $this->redirect(['site/index']);
      }

      Yii::$app->session->setFlash('pageError', Yii::t('main', 'Password could not be changed. Please try again later.'));
    }

    return $this->render('/site/update-identity', ['model' => $model]);
  }
}
