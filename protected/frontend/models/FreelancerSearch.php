<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * FreelancerSearch represents the model behind the search form about `app\models\Freelancer`.
 */
class FreelancerSearch extends User
{
    /**
      * {@inheritdoc}
      */
    public $pageSize = 15;
    public $min_price;
    public $low_av;
    public $high_av;
    public $max_price;
    public function rules()
    {
        return [
            [['id', 'status', 'available_now', 'is_freelancer'], 'integer'],
            [['username', 'skills', 'full_name', 'country', 'country_code', 'hourlie_rate', 'min_price', 'low_av', 'high_av', 'max_price'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied.
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'sort'=> ['defaultOrder' => ['promoted'=>SORT_DESC]],
            'pagination' => [
            'pageSize' => $this->pageSize,
            'route' => 'freelancer/',
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'is_freelancer' => '1',
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        if(!empty($this->country_code))
        {
          $conArray = explode(',', $this->country_code);
          $query->andFilterWhere([ 'country_code'=> $conArray ]);
        }

        $query
        
            //->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'skills', $this->skills])
            //->andFilterWhere(['like', 'country', $this->country])
            //->andFilterWhere(['<=', 'hourlie_rate', $this->min_price])
            //->andFilterWhere(['>=', 'hourlie_rate', $this->low_av])
            //->andFilterWhere(['<=', 'hourlie_rate', $this->high_av])
            //->andFilterWhere(['>', 'hourlie_rate', $this->max_price])
            ->andFilterWhere(['like', 'available_now', $this->available_now]);

        return $dataProvider;
    }
}
