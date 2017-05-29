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
      $contact=Contact::findOne("email='".$model->email."'");
      $contactInfo = $contact ? ' '.$contact->first_name.' '.$contact->last_name : '';

      Yii::$app->session->setFlash('pageError', Yii::t('main', 'Lead was converted to contact').' '. Yii::t('main', 'on').' '.$model->converted_at . ' ' . $contactInfo);

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

    $contact=null;
    $account=null;
    $opportunity=null;


    $model=new LeadConvertForm();
    $model->load(Yii::$app->request->get());

    $model->new_opportunity=Yii::$app->request->post('new_opportunity', 0);
    $model->account_name=Yii::$app->request->post('account_name', $lead->company);

    list($accountResults, $this->tooManyResults)=$this->searchAccountsByName($model->account_name, 100);

    $viewData=['lead'=>$lead, 'model'=>$model, 'accountResults'=>$accountResults, 'tooManyResults'=>$this->tooManyResults];

    if ($model->load(Yii::$app->request->post()) && $model->validate(['account_name', 'account_id', 'opportunity_name', 'probability', 'stage_id', 'close_date' ]))
    {
      $fields['owner_id']=$lead->owner_id;
      $fields['adder_id']=$lead->adder_id;
      $fields['modifier_id']=$lead->modifier_id;

      $trans=Yii::$app->db->beginTransaction();

      try
     {
        // create a new account
        if (empty($model->account_id)) // new account
        {
          $fields=$lead->attributes;

          unset($fields['id']);
          unset($fields['email']);
          unset($fields['title']);
          unset($fields['first_name']);
          unset($fields['last_name']);
          unset($fields['company']);
          unset($fields['mobile_phone']);
          unset($fields['do_not_call']);
          unset($fields['do_not_email']);
          unset($fields['do_not_fax']);
          unset($fields['email_opt_out']);
          unset($fields['fax_opt_out']);
          unset($fields['birthdate']);
          unset($fields['salutation_id']);
          unset($fields['converted_at']);
          unset($fields['read_by_owner']);
          unset($fields['status_id']);

          unset($fields['created_at']);
          unset($fields['updated_at']);

          $fields['name']=$model->account_name;

          $account=new Account();
          $loadStatus=$account->setAttributes($fields);
          $account->save(true);

          if ($account->getErrors())
            throw new \Exception(Yii::t('main', 'Account could not be saved'));

          $model->account_id=$account->id;
        }

        // create a new opportunity if requested
        if ($model->new_opportunity==1)
        {
          $opportunity=new Opportunity();
          $opportunity->setAttributes(['name'=>$model->opportunity_name, 'probability'=>$model->probability, 'stage_id'=>$model->stage_id, 'close_date'=>$model->close_date,
            'account_id'=>$model->account_id, 'lead_source_id'=>$lead->lead_source_id, 'owner_id'=>$lead->owner_id, 'adder_id'=>$lead->adder_id, 'modifier_id'=>$lead->modifier_id]);
          $opportunity->save(true);

          if ($opportunity->getErrors())
            throw new \Exception(Yii::t('main', 'Opportunity could not be saved'));
        }

        // create contact
        $fields=$lead->attributes;

        unset($fields['id']);
        unset($fields['company']);
        unset($fields['num_of_employees']);
        unset($fields['annual_revenue']);
        unset($fields['status_id']);
        unset($fields['industry_id']);
        unset($fields['rating_id']);
        unset($fields['converted_at']);
        unset($fields['read_by_owner']);

        $fields['converted_lead_id']=$lead->id;
        $fields['account_id']=$model->account_id;

        $contact=new Contact();
        $contact->setAttributes($fields);
        $contact->save(true);

        if ($contact->getErrors())
          throw new \Exception(Yii::t('main', 'Contact could not be saved'));

        if ($model->new_opportunity==1)
        {
          $opportunity->contact_id=$contact->id;
          $opportunity->update();
        }

        // mark lead as converted
        $lead->converted_at=date('Y-m-d H:i:s');
        $lead->update();

        $trans->commit();

        Yii::$app->session->setFlash('pageSuccess', Yii::t('main', 'Lead converted successfully. Contact details are below.'));

        return $this->redirect(['contact/view', 'id' => $contact->id]);
      }
      catch (\Exception $e)
      {
        try
        {
          if ($account && $account->id)
            $account->delete();

          if ($opportunity && $opportunity->id)
            $opportunity->delete();

          $trans->rollback();
        }
        catch (\Exception $e2)
        {
          // Yii::$app->session->setFlash('pageError', Yii::t('main', 'Lead conversion failed.').'<br>'.$e2->getMessage());
        }

        Yii::$app->session->setFlash('pageError', Yii::t('main', 'Lead conversion failed.') .'<br>'. $e->getMessage());

        return $this->redirect(['view', 'id' => $lead->id]);
      }
    }

    return $this->render('conversion-form', $viewData);
  }
}
