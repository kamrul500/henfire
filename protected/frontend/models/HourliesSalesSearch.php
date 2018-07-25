<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * HourliesSalesSearch represents the model behind the search form about `app\models\HourliesSales`.
 */
class HourliesSalesSearch extends HourliesSales
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'seller_id', 'buyer_id', 'item_id', 'cost', 'total_cost', 'amount_bought', 'paid', 'buyer_cancelled', 'seller_cancelled', 'completed', 'isEscro', 'released_escro', 'complaint', 'is_refunded'], 'integer'],
            [['item_name', 'date_completed', 'buyer_transaction_code', 'payment_type', 'buyer_paypal', 'seller_paypal', 'buyer_card_vault', 'complaint_message', 'seller_transaction_code', 'custom_trans_id'], 'safe'],
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
        $query = HourliesSales::find();

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
            'seller_id' => $this->seller_id,
            'buyer_id' => $this->buyer_id,
            'item_id' => $this->item_id,
            'cost' => $this->cost,
            'total_cost' => $this->total_cost,
            'amount_bought' => $this->amount_bought,
            'paid' => $this->paid,
            'buyer_cancelled' => $this->buyer_cancelled,
            'seller_cancelled' => $this->seller_cancelled,
            'completed' => $this->completed,
            'date_completed' => $this->date_completed,
            'isEscro' => $this->isEscro,
            'released_escro' => $this->released_escro,
            'complaint' => $this->complaint,
            'is_refunded' => $this->is_refunded,
        ]);

        $query->andFilterWhere(['like', 'item_name', $this->item_name])
            ->andFilterWhere(['like', 'buyer_transaction_code', $this->buyer_transaction_code])
            ->andFilterWhere(['like', 'payment_type', $this->payment_type])
            ->andFilterWhere(['like', 'buyer_paypal', $this->buyer_paypal])
            ->andFilterWhere(['like', 'seller_paypal', $this->seller_paypal])
            ->andFilterWhere(['like', 'buyer_card_vault', $this->buyer_card_vault])
            ->andFilterWhere(['like', 'complaint_message', $this->complaint_message])
            ->andFilterWhere(['like', 'seller_transaction_code', $this->seller_transaction_code])
            ->andFilterWhere(['like', 'custom_trans_id', $this->custom_trans_id]);

        return $dataProvider;
    }
}
