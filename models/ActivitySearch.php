<?php
namespace app\models;

use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Activity;

/**
 * ActivitySearch represents the model behind the search form about `app\models\Activity`.
 */
class ActivitySearch extends Activity
{
// @formatter:off
  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['id', 'type_id', 'priority_id', 'status_id'], 'integer'],
      [['subject'], 'string'],
      [['subject'], 'trim'],
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
    $query=Activity::find();
    $dataProvider=new ActiveDataProvider(['query' => $query]);
    $this->load($params);

    if (!$this->validate())
    {
      // uncomment the following line if you do not want to return any records when validation fails
      // $query->where('0=1');
      return $dataProvider;
    }

    $query->andFilterWhere(['like', 'subject', $this->subject]);
    $query->andFilterWhere(['=', 'type_id', $this->type_id]);
    $query->andFilterWhere(['=', 'priority_id', $this->priority_id]);
    $query->andFilterWhere(['=', 'status_id', $this->status_id]);

    if (!Yii::$app->user->can('Manager'))
      $query->andWhere(['is', 'deleted_at', null]);

    return $dataProvider;
  }
}
