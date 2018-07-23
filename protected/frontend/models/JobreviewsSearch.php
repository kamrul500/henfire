<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Jobreviews;

/**
 * JobreviewsSearch represents the model behind the search form about `app\models\Jobreviews`.
 */
class JobreviewsSearch extends Jobreviews
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'job_id', 'user_id', 'freelancer_id'], 'integer'],
            [['rating', 'review', 'date', 'replies'], 'safe'],
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
        $query = Jobreviews::find();

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
            'job_id' => $this->job_id,
            'user_id' => $this->user_id,
            'freelancer_id' => $this->freelancer_id,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'rating', $this->rating])
            ->andFilterWhere(['like', 'review', $this->review])
            ->andFilterWhere(['like', 'replies', $this->replies]);

        return $dataProvider;
    }
}
