<?php
namespace app\controllers;

use Yii;
use app\models\Account;
use app\models\AccountSearch;
use yii\db\Query;

/**
 * AccountController implements the CRUD actions for Account model.
 */
class AccountController extends CrmController
{
  /**
   * Lists all Account models.
   *
   * @return mixed
   */
  public function actionIndex()
  {
    $searchModel=new AccountSearch();
    $dataProvider=$searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
  }

    /**
   * Creates a new Account model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   *
   * @return mixed
   */
  public function actionCreate()
  {
    $model=new Account();

    if ($model->load(Yii::$app->request->post()) && $model->save())
       return $this->redirect(['view', 'id' => $model->id]);
    else
       return $this->render('create', ['model' => $model]);
  }

  /**
   * Shows account change screen model.
   *
   * @return mixed
   */
  public function actionShowchangeaccount()
  {
    $model=new Account();
    $model->name=Yii::$app->request->post('name', '');
    $accIdx=intVal(Yii::$app->request->get('accIdx', Yii::$app->request->post('accIdx')));
    $this->excludeIds=Yii::$app->request->get('excludeIds', Yii::$app->request->post('excludeIds'));

    $this->keywordLabel=Yii::t('main', 'Account Name');
    list($this->searchResults, $this->tooManyResults)=$this->searchAccountsByName($this->keyword, null, explode('-', $this->excludeIds));

    return $this->render('account-change-helper', ['model' => $model, 'controller' => $this, 'accIdx'=>$accIdx]);
  }

  public function actionAddsocialmedia($id)
  {
    $model=$this->findModel($id);

    $social_media_id=intval(Yii::$app->request->post('social_media_id', 0));
    $social_media_url=Yii::$app->request->post('social_media_url', 'none');

    try
    {
      $query=new Query();
      $command=$query->createCommand();

      $command->insert('rel_account_social_media', ['account_id' => $model->id, 'social_media_id' => $social_media_id, 'value' => $social_media_url, 'created_at' => date('Y-m-d H:i:s')])->execute();
      Yii::$app->session->setFlash('pageSuccess', Yii::t('main', 'SAVE_SUCCEEDED'));
    }
    catch (\Exception $e)
    {
      Yii::$app->session->setFlash('pageError', Yii::t('main', 'SAVE_FAILED'));
    }

    $this->redirect(['account/view', 'id' => $model->id]);
  }

  public function actionDeletesocialmedia($id)
  {
    $model=$this->findModel($id);
    $rel_id=intval(Yii::$app->request->get('rel_id', 0));

    try
    {
      $query=new Query();
      $command=$query->createCommand();

      $command->update('rel_account_social_media', ['deleted_at' => date('Y-m-d H:i:s')], ['id' => $rel_id, 'account_id' => $model->id])->execute();
      Yii::$app->session->setFlash('pageSuccess', Yii::t('main', 'DELETE_SUCCEEDED'));
    }
    catch (\Exception $e)
    {
      Yii::$app->session->setFlash('pageError', Yii::t('main', 'DELETE_FAILED'));
    }

    $this->redirect(['account/view', 'id' => $model->id]);
  }
}
