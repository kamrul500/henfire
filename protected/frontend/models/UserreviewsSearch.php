<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Userreviews;

/**
 * UserreviewsSearch represents the model behind the search form about `app\models\Userreviews`.
 */
class UserreviewsSearch extends Userreviews
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'reviewr_id', 'hourlie', 'job', 'project_id'], 'integer'],
            [['review', 'rating'], 'safe'],
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
        $query = Userreviews::find();

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
            'reviewr_id' => $this->reviewr_id,
            'hourlie' => $this->hourlie,
            'job' => $this->job,
            'project_id' => $this->project_id,
        ]);

        $query->andFilterWhere(['like', 'review', $this->review])
            ->andFilterWhere(['like', 'rating', $this->rating]);

        return $dataProvider;
    }
}
