<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Settings;

/**
 * UserSearch represents the model behind the search form about `app\models\Settings`.
 */
class UserSearch extends Settings
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['sitename', 'email', 'logo', 'currency', 'facebook', 'twitter', 'google', 'commission', 'PayPalAuth', 'PayPalSecret', 'PayPalEnvironment'], 'safe'],
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
        $query = Settings::find();

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
        ]);

        $query->andFilterWhere(['like', 'sitename', $this->sitename])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'facebook', $this->facebook])
            ->andFilterWhere(['like', 'twitter', $this->twitter])
            ->andFilterWhere(['like', 'google', $this->google])
            ->andFilterWhere(['like', 'commission', $this->commission])
            ->andFilterWhere(['like', 'PayPalAuth', $this->PayPalAuth])
            ->andFilterWhere(['like', 'PayPalSecret', $this->PayPalSecret])
            ->andFilterWhere(['like', 'PayPalEnvironment', $this->PayPalEnvironment]);

        return $dataProvider;
    }
}
