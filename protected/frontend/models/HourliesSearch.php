<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * HourliesSearch represents the model behind the search form about `app\models\Hourlies`.
 */
class HourliesSearch extends Hourlies
{
    /**
     * {@inheritdoc}
     */
    public $pageSize = 15;

    public function rules()
    {
        return [
            [['id', 'user_id', 'cost', 'promoted', 'paid', 'success'], 'integer'],
            [['title', 'description', 'video', 'category', 'subCat', 'date_created', 'country_code', 'delivery_time'], 'safe'],

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
        $query = Hourlies::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['promoted'=>SORT_DESC, 'date_created'=>SORT_DESC]],
            'pagination' => [
            'pageSize' => $this->pageSize,
            'route' => 'hourlies/',
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
            'id' => $this->id,
            'user_id' => $this->user_id,
            'date_created' => $this->date_created,
            'cost' => $this->cost,
            'promoted' => $this->promoted,
            'paid' => $this->paid,
            'success' => $this->success,
            'dissabled' => 0,


        ]);

        if(!empty($this->delivery_time))
        {
          $delArray = explode(',', $this->delivery_time);
          if (in_array("4", $delArray)) {
             $query->andFilterWhere([ 'delivery_time'=> $delArray ])
             ->orFilterWhere(['>=', 'delivery_time', '4']);
          }
          else {
             $query->andFilterWhere([ 'delivery_time'=> $delArray ]);
          }


        }
        if(!empty($this->country_code))
        {
          $conArray = explode(',', $this->country_code);
          $query->andFilterWhere([ 'country_code'=> $conArray ]);
        }

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'subCat', $this->subCat])
            ->andFilterWhere(['like', 'promoted', $this->promoted])
            ->andFilterWhere(['like', 'video', $this->video]);

        return $dataProvider;
    }
}
