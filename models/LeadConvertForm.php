<?php
namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Lead conversion form
 *
 * @property integer $new_opportunity
 * @property integer $account_id
 * @property integer $stage_id
 * @property integer $probability
 * @property string $account_name
 * @property string $opportunity_name
 * @property string $convert_lead
 *
 * @property date $close_date
 *
 */
class LeadConvertForm extends Model
{
  public $new_opportunity;
  public $account_id;
  public $stage_id;
  public $probability;
  public $account_name;
  public $opportunity_name;
  public $close_date;
  public $type_id;

  public function rules()
  {
    return [[['new_opportunity', 'stage_id', 'probability', 'type_id'], 'number'],
      [['account_name', 'opportunity_name', 'convertLead'], 'string', 'max' => 255],
      ['close_date', 'date', 'format' => 'yyyy-MM-dd'],

      ['account_id',
        'required',
        'when' => function ($model)
        {
          return trim($model->account_name) == "" ? true : false;
        },
        'whenClient' => 'function(attribute, value)
        {
          var other=$("#leadconvertform-account_name").val();
          return (((other!==undefined && other.trim().length==0) || other===undefined) && value.trim().length==0) ? true : false;
        }'],

      ['opportunity_name',
        'required',
        'when' => function ($model)
        {
          return $model->new_opportunity == 1 && trim($model->opportunity_name) == "" ? true : false;
        },
        'whenClient' => 'function(attribute, value)
         {
           if ($("input:radio[name=\'LeadConvertForm[new_opportunity]\']:checked").val()==1 && value.trim().length==0)
            return true;
         }
       '],

      ['probability',
        'required',
        'when' => function ($model)
        {
          return $model->new_opportunity == 1 && $model->probability <= 0 ? true : false;
        },
        'whenClient' => 'function(attribute, value)
         {
           if ($("input:radio[name=\'LeadConvertForm[new_opportunity]\']:checked").val()==1 && value.trim().length==0)
            return true;
         }
       '],

      ['stage_id',
        'required',
        'when' => function ($model)
        {
          return $model->new_opportunity == 1 && $model->stage_id == 0 ? true : false;
        },
        'whenClient' => 'function(attribute, value)
         {
           if ($("input:radio[name=\'LeadConvertForm[new_opportunity]\']:checked").val()==1 && value.trim().length==0)
            return true;
         }
       '],

      ['type_id',
        'required',
        'when' => function ($model)
        {
          return $model->new_opportunity == 1 && $model->type_id == 0 ? true : false;
        },
        'whenClient' => 'function(attribute, value)
        {
          if ($("input:radio[name=\'LeadConvertForm[new_opportunity]\']:checked").val()==1 && value.trim().length==0)
           return true;
        }
       '],

      ['close_date',
        'required',
        'when' => function ($model)
        {
          return $model->new_opportunity == 1 && trim($model->close_date) == "" ? true : false;
        },
        'whenClient' => 'function(attribute, value)
         {
           if ($("input:radio[name=\'LeadConvertForm[new_opportunity]\']:checked").val()==1 && value.trim().length==0)
            return true;
         }
       ']];
  }

  /**
   *
   * @return array customized attribute labels
   */
  public function attributeLabels()
  {
    return ['stage_id' => Yii::t('main', 'Stage'), 'account_id' => Yii::t('main', 'Account')];
  }

  public function convert($lead)
  {
    $contact=null;
    $account=null;
    $opportunity=null;

    $this->new_opportunity=0;
    $this->account_name=$lead->company;
    $this->load(Yii::$app->request->isGet ? Yii::$app->request->get() : Yii::$app->request->post());

    if (Yii::$app->request->isPost && $this->validate(['account_name', 'account_id', 'opportunity_name', 'probability', 'stage_id', 'close_date']))
    {
      $fields['owner_id']=$lead->owner_id;
      $fields['adder_id']=$lead->adder_id;
      $fields['modifier_id']=$lead->modifier_id;

      $trans=Yii::$app->db->beginTransaction();
      try
      {
        // create a new account
        if (empty($this->account_id)) // new account
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

          $fields['name']=$this->account_name;

          $account=new Account();
          $loadStatus=$account->setAttributes($fields);
          $account->save(true);

          if ($account->getErrors())
            throw new \Exception(Yii::t('main', 'Account could not be saved'));

          $this->account_id=$account->id;
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
        $fields['account_id']=$this->account_id;

        $contact=new Contact();
        $contact->setAttributes($fields);
        $contact->save(true);

        if ($contact->getErrors())
          throw new \Exception(Yii::t('main', 'Contact could not be saved'));


          // create a new opportunity if requested
          if ($this->new_opportunity == 1)
          {
            $opportunity=new Opportunity();

            $opportunity->setAttributes(
            ['name' => $this->opportunity_name,
              'probability' => $this->probability,
              'stage_id' => $this->stage_id,
              'close_date' => $this->close_date,
              'type_id' => $type_id->id,
              'contact_id' => $contact->id,
              'account_id' => $this->account_id,
              'lead_source_id' => $lead->lead_source_id,
              'owner_id' => $lead->owner_id,
              'adder_id' => $lead->adder_id,
              'modifier_id' => $lead->modifier_id]);
            $opportunity->save(true);

            if ($opportunity->getErrors())
              throw new \Exception(Yii::t('main', 'Opportunity could not be saved'));
          }

          // mark lead as converted
          $lead->converted_at=date('Y-m-d H:i:s');
          $lead->update();

          $trans->commit();

          Yii::$app->session->setFlash('pageSuccess', Yii::t('main', 'Lead converted successfully. Contact details are below.'));

          return ['redirect', 'contact/view', 'id' => $contact->id];
      }
      catch (\Exception $e)
      {
        try
        {
          $trans->rollback();

          // MyIsam tables do not support transactions so delete
          if ($account && $account->id)
            $account->delete();
            if ($opportunity && $opportunity->id)
              $opportunity->delete();
        }
        catch (\Exception $e2)
        {
          // Yii::$app->session->setFlash('pageError', Yii::t('main', 'Lead conversion failed.').'<br>'.$e2->getMessage());
        }

        Yii::$app->session->setFlash('pageError', Yii::t('main', 'Lead conversion failed.') . '<br>' . $e->getMessage());

        return ['redirect', 'view', 'id' => $lead->id];
      }
    }

    return ['', 'errors'=>$this->hasErrors()];
  }
}
