<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TestQuestionChoice;

/**
 * TestQuestionChoiceSearch represents the model behind the search form of `app\models\TestQuestionChoice`.
 */
class TestQuestionChoiceSearch extends TestQuestionChoice
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'choice_company_id', 'choice_question_id', 'choice_is_correct', 'choice_status_id', 'choice_created_by', 'choice_updated_by', 'choice_deleted_by'], 'integer'],
            [['choice_label', 'choice_text', 'choice_created_at', 'choice_updated_at', 'choice_deleted_at'], 'safe'],
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
        $query = TestQuestionChoice::find();

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
            'choice_company_id' => $this->choice_company_id,
            'choice_question_id' => $this->choice_question_id,
            'choice_is_correct' => $this->choice_is_correct,
            'choice_status_id' => $this->choice_status_id,
            'choice_created_at' => $this->choice_created_at,
            'choice_created_by' => $this->choice_created_by,
            'choice_updated_at' => $this->choice_updated_at,
            'choice_updated_by' => $this->choice_updated_by,
            'choice_deleted_at' => $this->choice_deleted_at,
            'choice_deleted_by' => $this->choice_deleted_by,
        ]);

        $query->andFilterWhere(['like', 'choice_label', $this->choice_label])
            ->andFilterWhere(['like', 'choice_text', $this->choice_text]);

        return $dataProvider;
    }
}
