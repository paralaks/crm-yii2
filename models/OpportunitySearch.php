<?php
namespace app\models;

use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Opportunity;

/**
 * OpportunitySearch represents the model behind the search form about `app\models\Opportunity`.
 */
class OpportunitySearch extends Opportunity
{
  // @formatter:off
  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['id', 'probability', 'stage_id', 'type_id'], 'integer'],
      [['name'], 'string'], [['name'], 'string'],
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
    $query=Opportunity::find();
    $dataProvider=new ActiveDataProvider(['query' => $query]);
    $this->load($params);

    if (!$this->validate())
    {
      // uncomment the following line if you do not want to return any records when validation fails
      // $query->where('0=1');
      return $dataProvider;
    }
    $query->andFilterWhere(['like', 'name', $this->name]);
    $query->andFilterWhere(['=', 'probability', $this->probability]);
    $query->andFilterWhere(['=', 'stage_id', $this->stage_id]);
    $query->andFilterWhere(['=', 'type_id', $this->type_id]);

    if (!Yii::$app->user->can('Manager'))
      $query->andWhere(['is', 'deleted_at', null]);

    return $dataProvider;
  }
}
