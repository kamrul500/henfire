<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Hourlieworkflow;

/**
 * HourlieworkflowSearch represents the model behind the search form about `app\models\Hourlieworkflow`.
 */
class HourlieworkflowSearch extends Hourlieworkflow
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'workstream', 'user_id', 'flagged', 'flagged_comment'], 'integer'],
            [['comment', 'upload', 'date'], 'safe'],
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
        $query = Hourlieworkflow::find();

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
            'workstream' => $this->workstream,
            'user_id' => $this->user_id,
            'date' => $this->date,
            'flagged' => $this->flagged,
            'flagged_comment' => $this->flagged_comment,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'upload', $this->upload]);

        return $dataProvider;
    }
}
