<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Hourliesreviews;

/**
 * HourliesreviewsSearch represents the model behind the search form about `app\models\Hourliesreviews`.
 */
class HourliesreviewsSearch extends Hourliesreviews
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'hourlie_id', 'user_id', 'freelancer_id', 'rating'], 'integer'],
            [['review'], 'safe'],
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
        $query = Hourliesreviews::find();

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
            'hourlie_id' => $this->hourlie_id,
            'user_id' => $this->user_id,
            'freelancer_id' => $this->freelancer_id,
            'rating' => $this->rating,
        ]);

        $query->andFilterWhere(['like', 'review', $this->review]);

        return $dataProvider;
    }
}
