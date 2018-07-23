<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * JobSearch represents the model behind the search form about `app\models\Job`.
 */
class JobSearch extends Job
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'cost', 'promoted', 'paid', 'success', 'experience_level'], 'integer'],
            [['title', 'description', 'category', 'subCat', 'date_created', 'date_expire', 'material', 'worktype', 'currency', 'budget'], 'safe'],
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
        $query = Job::find();

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
            'date_expire' => $this->date_expire,
            'cost' => $this->cost,
            'promoted' => $this->promoted,
            'paid' => $this->paid,
            'success' => $this->success,
            'experience_level' => $this->experience_level,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'subCat', $this->subCat])
            ->andFilterWhere(['like', 'material', $this->material])
            ->andFilterWhere(['like', 'worktype', $this->worktype])
            ->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'budget', $this->budget]);

        return $dataProvider;
    }
}
