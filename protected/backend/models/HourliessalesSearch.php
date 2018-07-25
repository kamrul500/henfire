<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Hourliessales;

/**
 * HourliessalesSearch represents the model behind the search form about `app\models\hourliessales`.
 */
class HourliessalesSearch extends hourliessales
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'seller_id', 'buyer_id', 'item_id', 'amount_bought', 'buyer_cancelled', 'seller_cancelled', 'completed', 'isEscro', 'released_escro', 'complaint', 'is_refunded', 'freelancer_paid'], 'integer'],
            [['item_name', 'cost', 'total_cost', 'paid_status', 'date_completed', 'buyer_transaction_code', 'payment_type', 'buyer_paypal', 'buyer_paypal_auth', 'seller_paypal', 'buyer_card_vault', 'complaint_message', 'seller_transaction_code', 'custom_trans_id', 'our_commission', 'totalaftercommission', 'sellers_currency', 'buyers_currency', 'origional_currency_price'], 'safe'],
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
        $query = hourliessales::find();

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
            'amount_bought' => $this->amount_bought,
            'buyer_cancelled' => $this->buyer_cancelled,
            'seller_cancelled' => $this->seller_cancelled,
            'completed' => $this->completed,
            'date_completed' => $this->date_completed,
            'isEscro' => $this->isEscro,
            'released_escro' => $this->released_escro,
            'complaint' => $this->complaint,
            'is_refunded' => $this->is_refunded,
            'freelancer_paid' => $this->freelancer_paid,
        ]);

        $query->andFilterWhere(['like', 'item_name', $this->item_name])
            ->andFilterWhere(['like', 'cost', $this->cost])
            ->andFilterWhere(['like', 'total_cost', $this->total_cost])
            ->andFilterWhere(['like', 'paid_status', $this->paid_status])
            ->andFilterWhere(['like', 'buyer_transaction_code', $this->buyer_transaction_code])
            ->andFilterWhere(['like', 'payment_type', $this->payment_type])
            ->andFilterWhere(['like', 'buyer_paypal', $this->buyer_paypal])
            ->andFilterWhere(['like', 'buyer_paypal_auth', $this->buyer_paypal_auth])
            ->andFilterWhere(['like', 'seller_paypal', $this->seller_paypal])
            ->andFilterWhere(['like', 'buyer_card_vault', $this->buyer_card_vault])
            ->andFilterWhere(['like', 'complaint_message', $this->complaint_message])
            ->andFilterWhere(['like', 'seller_transaction_code', $this->seller_transaction_code])
            ->andFilterWhere(['like', 'custom_trans_id', $this->custom_trans_id])
            ->andFilterWhere(['like', 'our_commission', $this->our_commission])
            ->andFilterWhere(['like', 'totalaftercommission', $this->totalaftercommission])
            ->andFilterWhere(['like', 'sellers_currency', $this->sellers_currency])
            ->andFilterWhere(['like', 'buyers_currency', $this->buyers_currency])
            ->andFilterWhere(['like', 'origional_currency_price', $this->origional_currency_price]);

        return $dataProvider;
    }
}
