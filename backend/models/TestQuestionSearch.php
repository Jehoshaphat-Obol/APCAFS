<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TestQuestion;

/**
 * TestQuestionSearch represents the model behind the search form of `app\models\TestQuestion`.
 */
class TestQuestionSearch extends TestQuestion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'question_company_id', 'question_test_id', 'question_status_id', 'question_created_by', 'question_updated_by', 'question_deleted_by'], 'integer'],
            [['question', 'question_created_at', 'question_updated_at', 'question_deleted_at'], 'safe'],
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
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = TestQuestion::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'question_company_id' => $this->question_company_id,
            'question_test_id' => $this->question_test_id,
            'question_status_id' => $this->question_status_id,
            'question_created_at' => $this->question_created_at,
            'question_created_by' => $this->question_created_by,
            'question_updated_at' => $this->question_updated_at,
            'question_updated_by' => $this->question_updated_by,
            'question_deleted_at' => $this->question_deleted_at,
            'question_deleted_by' => $this->question_deleted_by,
        ]);

        $query->andFilterWhere(['like', 'question', $this->question]);

        return $dataProvider;
    }
}
