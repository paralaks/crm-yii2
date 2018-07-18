<?php
namespace app\controllers;

use Yii;
use app\models\Opportunity;
use app\models\OpportunitySearch;
use app\models\OpportunityContact;
use yii\db\Query;

/**
 * OpportunityController implements the CRUD actions for Opportunity model.
 */
class OpportunityController extends CrmController
{

  /**
   * Lists all Opportunity models.
   *
   * @return mixed
   */
  public function actionIndex()
  {
    $searchModel=new OpportunitySearch();
    $dataProvider=$searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
  }

  /**
   * Creates a new Opportunity model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   *
   * @return mixed
   */
  public function actionCreate()
  {
    $model=new Opportunity();

    if ($model->load(Yii::$app->request->post()) && $model->save())
    {
      // adding to contact while creating?
      $contactId=Yii::$app->request->get('contact_id', Yii::$app->request->post('contact_id', ''));
      if (!empty($contactId))
      {
        $relation=new OpportunityContact();
        $relation->opportunity_id=$model->id;
        $relation->contact_id=$contactId;

        if (!$relation->save()) {
          Yii::$app->session->setFlash('pageError', Yii::t('main', 'Contact could not be added to opportunity.'));
          return $this->redirect(['view', 'id' => $model->id]);
        }
      }

      return $this->redirect(['view', 'id' => $model->id]);
    }

    return $this->render('create', ['model' => $model, 'contact_id' => $contactId]);
  }

  public function actionAddcontact($id)
  {
    $model=$this->findModel($id);
    $relation=new OpportunityContact();
    $relation->opportunity_id=$model->id;

    $relId=Yii::$app->request->get('relId', Yii::$app->request->post('relId', ''));
    $useList=false;

    // updating one record
    if ($relId)
    {
      $relation=OpportunityContact::findOne($relId);
      $relation->contact_name=Yii::$app->appHelper->getValueFromTable('contacts', $relation->contact_id);

      if ($this->formSubmit == 'save' && $relation->load(Yii::$app->request->post()) && $relation->validate())
      {
        if ($relation->save())
          return $this->redirect(['view', 'id' => $model->id]);
        else
          Yii::$app->session->setFlash('pageErrors', $relation->errors);
      }
    }
    else
    {
      $useList=true;
      $relation->load(Yii::$app->request->post());

      if ($this->formSubmit == 'save')
      {
        $idList=Yii::$app->request->post('idList', '');

        if (empty($idList))
          Yii::$app->session->setFlash('pageError', Yii::t('main', 'Contact information is missing.'));
        else
        {
          $success='';
          $error='';

          foreach ($idList as $contact_id)
          {
            $relation=new OpportunityContact();
            $relation->load(Yii::$app->request->post());
            $relation->opportunity_id=$model->id;
            $relation->contact_id=$contact_id;

            if ($relation->save())
              $success.='<li>' . Yii::$app->appHelper->getValueFromTable('contacts', $contact_id);
            else
              $error.='<li>' . Yii::$app->appHelper->getValueFromTable('contacts', $contact_id);
          }

          if ($success != '')
            Yii::$app->session->setFlash('pageSuccess', Yii::t('main', 'Contacts below added to opportunity successfully.') . "<ul>$success</ul>");
          if ($error != '')
            Yii::$app->session->setFlash('pageError', Yii::t('main', 'Contacts below could not be added to opportunity.') . "<ul>$error</ul>");

          return $this->redirect(['view', 'id' => $model->id]);
        }
      }
    }

    $query=new Query();
    $this->excludeIds=$query->select('contact_id')->from('rel_opportunity_contact')->where(['=', 'opportunity_id', $model->id])->column();

    $this->keywordLabel=Yii::t('main', 'Contact Name');
    list($this->searchResults, $this->tooManyResults)=$this->searchContactsByName($this->keyword, null, $this->excludeIds);

    return $this->render('contact-form', ['model' => $model, 'controller' => $this, 'relation' => $relation, 'useList' => $useList]);
  }

  public function actionEditcontact($id)
  {
    return $this->actionAddcontact($id);
  }

  public function actionDeletecontact($id)
  {
    $model=Opportunity::findOne($id);
    $relId=Yii::$app->request->get('relId', 0);

    $relation=OpportunityContact::findOne($relId);
    $relation->delete();

    return $this->redirect(['view', 'id' => $model->id]);
  }

  public function actionContactupdatehistory($id)
  {
    $relId=Yii::$app->request->get('relId', 0);

    $model=OpportunityContact::findOne($relId);
    $updates=$model->getUpdateHistory();

    return $this->render('../commons/update-history', ['model' => $model, 'updates' => $updates]);
  }
}
