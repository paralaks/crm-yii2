<?php
namespace app\controllers;

use Yii;
use app\models\Lead;
use app\models\Account;
use app\models\Contact;
use app\models\Opportunity;
use app\models\LeadSearch;
use app\models\LeadConvertForm;

/**
 * LeadController implements the CRUD actions for Lead model.
 */
class LeadController extends CrmController
{
  /**
   * Lists all Lead models.
   *
   * @return mixed
   */
  public function actionIndex()
  {
    $searchModel=new LeadSearch();
    $dataProvider=$searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', ['searchModel' => $searchModel,'dataProvider' => $dataProvider]);
  }

  public function actionView($id)
  {
    $model=$this->findModel($id);

    if ($model->converted_at)
    {
      $contact=Contact::findOne("email='" . $model->email . "'");
      $contactInfo=$contact ? ' ' . $contact->first_name . ' ' . $contact->last_name : '';

      Yii::$app->session->setFlash('pageError', Yii::t('main', 'LEAD_WAS_CONVERTED') . ' ' . Yii::t('main', 'on') . ' ' . $model->converted_at . ' ' . $contactInfo);

      return $this->redirect('/lead/index');
    }

    return $this->render('view', ['model' => $model]);
  }

  /**
   * Creates a new Lead model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   *
   * @return mixed
   */
  public function actionCreate()
  {
    $model=new Lead();

    if ($model->load(Yii::$app->request->post()) && $model->save())
    {
      return $this->redirect(['view', 'id' => $model->id]);
    }
    else
    {
      $model->owner_id=Yii::$app->user->identity->id;

      return $this->render('create', ['model' => $model]);
    }
  }

  public function actionConvert($id)
  {
    $lead=$this->findModel($id);

    $model=new LeadConvertForm();
    $result=$model->convert($lead);

    if (is_array($result) && $result[0] == 'redirect')
    {
      array_shift($result);
      $this->redirect($result);
    }

    list($accountResults, $this->tooManyResults)=$this->searchAccountsByName($model->account_name, 100);

    $accountResultsDropdown=['0' => ''];
    if (count($accountResults))
    {
      foreach ($accountResults as $acc)
        $accountResultsDropdown[$acc['id']]=$acc['name'];
    }

    $viewData=['lead' => $lead, 'model' => $model, 'accountResults'=>$accountResultsDropdown, 'tooManyResults'=>$this->tooManyResults];

    return $this->render('conversion-form', $viewData);
  }
}
