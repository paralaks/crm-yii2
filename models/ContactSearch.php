<?php
namespace app\models;

use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Contact;
use app\models\Account;

/**
 * ContactSearch represents the model behind the search form about `app\models\Contact`.
 */
class ContactSearch extends Contact
{
  // @formatter:off
  public $contact_name=null;
  public $account_name=null;

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['id', 'category_id'], 'integer'],
      [['contact_name', 'account_name'], 'string'],
      [['contact_name', 'account_name'], 'trim'],
    ];
  }

  public function attributeLabels()
  {
    return [
      'contact_name' => Yii::t('main', 'Contact Name'),
      'account_name' => Yii::t('main', 'Account Name'),
      'category_id' => Yii::t('main', 'Category'),
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
    $query=Contact::find();
    $dataProvider=new ActiveDataProvider(['query' => $query]);
    $this->load($params);

    if (!$this->validate())
    {
      // uncomment the following line if you do not want to return any records when validation fails
      // $query->where('0=1');
      return $dataProvider;
    }

    if (!empty($this->contact_name))
    {
      $name=explode(' ', $this->contact_name);
      $this->first_name = $name[0];
      $this->last_name = count($name)==1 ? $this->first_name : trim(str_replace($this->first_name, '', $this->contact_name));

      $query->andFilterWhere(['or', ['like', 'first_name', $this->first_name], ['like', 'last_name', $this->last_name]]);
    }

    if (!empty($this->account_name))
    {
      $subQuery=Account::find()->select('id')->andWhere(['like', 'name', $this->account_name]);
      $query->andFilterWhere(['or', ['in', 'account_id', $subQuery], ['in', 'account2_id', $subQuery], ['in', 'account3_id', $subQuery]]);
    }

    $query->andFilterWhere(['or', ['in', 'category_id', $this->category_id], ['in', 'category2_id', $this->category_id], ['in', 'category3_id', $this->category_id]]);

    if (!Yii::$app->user->can('Manager'))
      $query->andWhere(['is', 'deleted_at', null]);

    return $dataProvider;
  }
}
