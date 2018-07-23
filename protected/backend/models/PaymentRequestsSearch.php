<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PaymentRequests;

/**
 * PaymentRequestsSearch represents the model behind the search form about `app\models\PaymentRequests`.
 */
class PaymentRequestsSearch extends PaymentRequests
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'sum', 'job_id', 'hourlie_id'], 'integer'],
            [['date', 'withdraw_method', 'paypal_email'], 'safe'],
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
        $query = PaymentRequests::find();

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
            'date' => $this->date,
            'sum' => $this->sum,
            'job_id' => $this->job_id,
            'hourlie_id' => $this->hourlie_id,
        ]);

        $query->andFilterWhere(['like', 'withdraw_method', $this->withdraw_method])
            ->andFilterWhere(['like', 'paypal_email', $this->paypal_email]);

        return $dataProvider;
    }
}
