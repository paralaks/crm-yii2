<?php
namespace app\controllers;

use Yii;
use app\models\Contact;
use app\models\ContactSearch;
use yii\db\Query;

/**
 * ContactController implements the CRUD actions for Contact model.
 */
class ContactController extends CrmController
{
 /**
   * Lists all Contact models.
   *
   * @return mixed
   */
  public function actionIndex()
  {
    $searchModel=new ContactSearch();
    $dataProvider=$searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
  }

  /**
   * Creates a new Contact model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   *
   * @return mixed
   */
  public function actionCreate()
  {
    $model=new Contact();

    if ($model->load(Yii::$app->request->post()) && $model->save())
    {
      $model->savePicture();

      return $this->redirect(['view', 'id' => $model->id]);
    }
    else
    {
      // from account page?
      $model->account_id=Yii::$app->request->get('account_id', 0);
      $model->owner_id=Yii::$app->user->identity->id;

      return $this->render('create', ['model' => $model]);
    }
  }

  public function actionAddsocialmedia($id)
  {
    $model=$this->findModel($id);

    $social_media_id=Yii::$app->request->post('social_media_id', 0);
    $social_media_url=Yii::$app->request->post('social_media_url','none');

    try
    {
      $query=new Query();
      $command=$query->createCommand();

      $command->insert('rel_contact_social_media', ['contact_id'=>$model->id, 'social_media_id'=>$social_media_id, 'value'=>$social_media_url, 'created_at'=>date('Y-m-d H:i:s')])->execute();
      Yii::$app->session->setFlash('pageSuccess', Yii::t('main', 'SAVE_SUCCEEDED'));
    }
    catch (\Exception $e)
    {
      Yii::$app->session->setFlash('pageError', Yii::t('main', 'SAVE_FAILED'));
    }

    $this->redirect(['contact/view', 'id'=>$model->id]);
  }

  public function actionDeletesocialmedia($id)
  {
    $model=$this->findModel($id);
    $rel_id=Yii::$app->request->get('rel_id', 0);

    try
    {
      $query=new Query();
      $command=$query->createCommand();

      $command->update('rel_contact_social_media', ['deleted_at'=>date('Y-m-d H:i:s')], ['id'=>$rel_id, 'contact_id'=>$model->id])->execute();
      Yii::$app->session->setFlash('pageSuccess', Yii::t('main', 'DELETE_SUCCEEDED'));
    }
    catch (\Exception $e)
    {
      Yii::$app->session->setFlash('pageError', Yii::t('main', 'DELETE_FAILED'));
    }

    $this->redirect(['contact/view', 'id'=>$model->id]);
  }
}
