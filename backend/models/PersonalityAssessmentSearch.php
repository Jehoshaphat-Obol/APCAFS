<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PersonalityAssessment;

/**
 * PersonalityAssessmentSearch represents the model behind the search form of `app\models\PersonalityAssessment`.
 */
class PersonalityAssessmentSearch extends PersonalityAssessment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'personality_profile_id', 'personality_IE_score', 'personality_NS_score', 'personality_TF_score', 'personality_JB_score', 'personality_status_id', 'personality_created_by', 'personality_updated_by', 'personality_deleted_by'], 'integer'],
            [['personality_last_analysis_date', 'personality_created_at', 'personality_updated_at', 'personality_deleted_at'], 'safe'],
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
        $query = PersonalityAssessment::find();

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
            'personality_profile_id' => $this->personality_profile_id,
            'personality_IE_score' => $this->personality_IE_score,
            'personality_NS_score' => $this->personality_NS_score,
            'personality_TF_score' => $this->personality_TF_score,
            'personality_JB_score' => $this->personality_JB_score,
            'personality_last_analysis_date' => $this->personality_last_analysis_date,
            'personality_status_id' => $this->personality_status_id,
            'personality_created_at' => $this->personality_created_at,
            'personality_created_by' => $this->personality_created_by,
            'personality_updated_at' => $this->personality_updated_at,
            'personality_updated_by' => $this->personality_updated_by,
            'personality_deleted_at' => $this->personality_deleted_at,
            'personality_deleted_by' => $this->personality_deleted_by,
        ]);

        return $dataProvider;
    }
}
