<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TestResult;

/**
 * TestResultSearch represents the model behind the search form of `app\models\TestResult`.
 */
class TestResultSearch extends TestResult
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'result_company_id', 'result_test_id', 'result_user_id', 'result_status_id', 'result_created_by', 'result_updated_by', 'result_deleted_by'], 'integer'],
            [['result_score'], 'number'],
            [['result_created_at', 'result_updated_at', 'result_deleted_at'], 'safe'],
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
        $query = TestResult::find();

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
            'result_company_id' => $this->result_company_id,
            'result_test_id' => $this->result_test_id,
            'result_user_id' => $this->result_user_id,
            'result_score' => $this->result_score,
            'result_status_id' => $this->result_status_id,
            'result_created_at' => $this->result_created_at,
            'result_created_by' => $this->result_created_by,
            'result_updated_at' => $this->result_updated_at,
            'result_updated_by' => $this->result_updated_by,
            'result_deleted_at' => $this->result_deleted_at,
            'result_deleted_by' => $this->result_deleted_by,
        ]);

        return $dataProvider;
    }
}
