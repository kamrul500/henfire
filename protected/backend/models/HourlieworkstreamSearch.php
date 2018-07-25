<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Hourlieworkstream;

/**
 * HourlieworkstreamSearch represents the model behind the search form about `app\models\Hourlieworkstream`.
 */
class HourlieworkstreamSearch extends Hourlieworkstream
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['job_id', 'freelancer_id', 'user_id', 'is_finished', 'admin_flagged', 'freelancer_flagged', 'member_flagged'], 'integer'],
            [['flagged_comment', 'date'], 'safe'],
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
        $query = Hourlieworkstream::find();

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
            'job_id' => $this->job_id,
            'freelancer_id' => $this->freelancer_id,
            'user_id' => $this->user_id,
            'is_finished' => $this->is_finished,
            'admin_flagged' => $this->admin_flagged,
            'freelancer_flagged' => $this->freelancer_flagged,
            'member_flagged' => $this->member_flagged,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'flagged_comment', $this->flagged_comment]);

        return $dataProvider;
    }
}
