<?php
namespace app\models;

use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Account;

/**
 * AccountSearch represents the model behind the search form about `app\models\Account`.
 */
class AccountSearch extends Account
{
  // @formatter:off
  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['id', 'industry_id', 'lead_source_id'], 'integer'],
      ['name', 'string'],
      ['name', 'trim'],
    ];
  }

  public function attributeLabels()
  {
    return [
      'name' => Yii::t('main', 'Account Name'),
      'industry_id' => Yii::t('main', 'Industry'),
      'lead_source_id' => Yii::t('main', 'Lead Source'),
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
    $query=Account::find();
    $dataProvider=new ActiveDataProvider(['query' => $query]);
    $this->load($params);

    if (!$this->validate())
    {
      // uncomment the following line if you do not want to return any records when validation fails
      // $query->where('0=1');
      return $dataProvider;
    }

    $query->andFilterWhere(['like', 'name', $this->name]);
    $query->andFilterWhere(['=', 'industry_id', $this->industry_id]);
    $query->andFilterWhere(['=', 'lead_source_id', $this->lead_source_id]);

    if (!Yii::$app->user->can('Manager'))
      $query->andWhere(['is', 'deleted_at', null]);

    return $dataProvider;
  }
}
