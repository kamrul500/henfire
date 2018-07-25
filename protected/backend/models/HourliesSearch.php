<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Hourlies;

/**
 * HourliesSearch represents the model behind the search form about `app\models\Hourlies`.
 */
class HourliesSearch extends Hourlies
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'delivery_time', 'cost', 'promoted', 'paid', 'success', 'views', 'sales'], 'integer'],
            [['title', 'description', 'video', 'images', 'date_created', 'country_code'], 'safe'],
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
        $query = Hourlies::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'delivery_time' => $this->delivery_time,
            'cost' => $this->cost,
            'promoted' => $this->promoted,
            'paid' => $this->paid,
            'success' => $this->success,
            'views' => $this->views,
            'sales' => $this->sales,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'video', $this->video])
            ->andFilterWhere(['like', 'images', $this->images])
            ->andFilterWhere(['like', 'country_code', $this->country_code]);

        return $dataProvider;
    }
}
