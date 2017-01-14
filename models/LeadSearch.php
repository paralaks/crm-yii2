<?php
namespace app\models;

use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Lead;

/**
 * LeadSearch represents the model behind the search form about `app\models\Lead`.
 */
class LeadSearch extends Lead
{
  // @formatter:off
  public $name;
  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['id', 'num_of_employees', 'do_not_call', 'do_not_email', 'do_not_fax', 'email_opt_out', 'fax_opt_out', 'salutation_id', 'lead_source_id',
        'status_id', 'industry_id', 'rating_id', 'read_by_owner', 'owner_id', 'adder_id', 'modifier_id'], 'integer'],
      [['email', 'title', 'first_name', 'last_name', 'description', 'company', 'website', 'phone', 'mobile_phone', 'fax',
        'birthdate', 'street', 'city', 'state', 'zip', 'country', 'converted_at', 'deleted_at', 'created_at', 'updated_at'], 'safe'],
      [['annual_revenue'], 'number'],
      [['name'], 'string'],
      [['name'], 'trim'],
    ];
  }

  /**
   * @inheritdoc
   */
  public function scenarios()
  {
    // bypass scenarios() implementation in the parent class
    return Model::scenarios();
  }

  /**
   * Creates data provider instance with search query applied
   *
   * @param array $params
   *
   * @return ActiveDataProvider
   */
  public function search($params)
  {
    $query=Lead::find();
    $dataProvider=new ActiveDataProvider(['query' => $query]);
    $this->load($params);

    if (!$this->validate())
    {
      // uncomment the following line if you do not want to return any records when validation fails
      // $query->where('0=1');
      return $dataProvider;
    }

    if (!empty($this->name))
    {
      $name=explode(' ', $this->name);
      $this->first_name = $name[0];
      $this->last_name = count($name)==1 ? $this->first_name : trim(str_replace($this->first_name, '', $this->name));

      $query->andFilterWhere(['or', ['like', 'first_name', $this->first_name], ['like', 'last_name', $this->last_name]]);
    }

    $query->andFilterWhere(['like', 'email', $this->email]);
    $query->andFilterWhere(['like', 'company', $this->company]);
    $query->andFilterWhere(['=', 'status_id', $this->status_id]);
    $query->andWhere(['is', 'converted_at', null]);

    if (!Yii::$app->user->can('Manager'))
      $query->andWhere(['is', 'deleted_at', null]);

    return $dataProvider;
  }
}
