<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

/**
 * JobSearch represents the model behind the search form about `app\models\Job`.
 */
class FreelanceJobsSearch extends Job
{
    /**
      * {@inheritdoc}
      */
     public $pageSize = 20;
    public function rules()
    {
        return [
            [['id', 'user_id', 'promoted', 'paid', 'success'], 'integer'],
            [['title', 'description', 'category', 'subCat', 'experience_level', 'date_created', 'date_expire'], 'safe'],
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
        $query = Job::find()->where(['>', 'date_expire', new Expression('NOW()')])->andWhere(['=','freelancer', '0']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['date_created'=>SORT_DESC]],
            'pagination' => [
                  'pageSize' => $this->pageSize,
                  'route' => 'freelance-jobs/',
                  ],
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
            'promoted' => $this->promoted,
            'paid' => $this->paid,
            'success' => $this->success,
        ]);

        if(!empty($this->experience_level))
        {
          $delArray = explode(',', $this->experience_level);
          $query->andFilterWhere([ 'experience_level'=> $delArray ]);
        }
        if(!empty($this->category))
        {
          $delArray = explode(',', $this->category);
          $query->andFilterWhere([ 'category'=> $delArray ]);
        }

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'subCat', $this->subCat])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
