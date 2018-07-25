<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Job;

/**
 * JobSearch represents the model behind the search form about `app\models\Job`.
 */
class JobSearch extends Job
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'promoted', 'paid', 'success', 'isEscro', 'released_escro', 'freelancer', 'buyer_cancelled', 'seller_cancelled', 'date_completed', 'agreed_price', 'experience_level', 'complaint', 'origional_currency_price'], 'integer'],
            [['title', 'description', 'category', 'subCat', 'date_created', 'date_expire', 'material', 'freelancer_paypal', 'worktype', 'currency', 'budget', 'buyer_transaction_code', 'payment_type', 'buyer_paypal', 'buyer_paypal_auth', 'seller_paypal', 'buyer_card_vault', 'complaint_message', 'custom_trans_id', 'our_commission', 'totalaftercommission', 'sellers_currency', 'buyers_currency'], 'safe'],
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
            'promoted' => $this->promoted,
            'paid' => $this->paid,
            'success' => $this->success,
            'isEscro' => $this->isEscro,
            'released_escro' => $this->released_escro,
            'freelancer' => $this->freelancer,
            'buyer_cancelled' => $this->buyer_cancelled,
            'seller_cancelled' => $this->seller_cancelled,
            'date_completed' => $this->date_completed,
            'agreed_price' => $this->agreed_price,
            'experience_level' => $this->experience_level,
            'complaint' => $this->complaint,
            'origional_currency_price' => $this->origional_currency_price,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'subCat', $this->subCat])
            ->andFilterWhere(['like', 'date_expire', $this->date_expire])
            ->andFilterWhere(['like', 'material', $this->material])
            ->andFilterWhere(['like', 'freelancer_paypal', $this->freelancer_paypal])
            ->andFilterWhere(['like', 'worktype', $this->worktype])
            ->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'budget', $this->budget])
            ->andFilterWhere(['like', 'buyer_transaction_code', $this->buyer_transaction_code])
            ->andFilterWhere(['like', 'payment_type', $this->payment_type])
            ->andFilterWhere(['like', 'buyer_paypal', $this->buyer_paypal])
            ->andFilterWhere(['like', 'buyer_paypal_auth', $this->buyer_paypal_auth])
            ->andFilterWhere(['like', 'seller_paypal', $this->seller_paypal])
            ->andFilterWhere(['like', 'buyer_card_vault', $this->buyer_card_vault])
            ->andFilterWhere(['like', 'complaint_message', $this->complaint_message])
            ->andFilterWhere(['like', 'custom_trans_id', $this->custom_trans_id])
            ->andFilterWhere(['like', 'our_commission', $this->our_commission])
            ->andFilterWhere(['like', 'totalaftercommission', $this->totalaftercommission])
            ->andFilterWhere(['like', 'sellers_currency', $this->sellers_currency])
            ->andFilterWhere(['like', 'buyers_currency', $this->buyers_currency]);

        return $dataProvider;
    }
}
