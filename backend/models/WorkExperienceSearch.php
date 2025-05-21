<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\WorkExperience;

/**
 * WorkExperienceSearch represents the model behind the search form of `app\models\WorkExperience`.
 */
class WorkExperienceSearch extends WorkExperience
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'experience_profile_id', 'experience_status_id', 'experience_created_by', 'experience_updated_by', 'experience_deleted_by'], 'integer'],
            [['experience_job_title', 'experience_company_name', 'experience_from', 'experience_to', 'experience_created_at', 'experience_updated_at', 'experience_deleted_at'], 'safe'],
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
        $query = WorkExperience::find();

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
            'experience_profile_id' => $this->experience_profile_id,
            'experience_from' => $this->experience_from,
            'experience_to' => $this->experience_to,
            'experience_status_id' => $this->experience_status_id,
            'experience_created_at' => $this->experience_created_at,
            'experience_created_by' => $this->experience_created_by,
            'experience_updated_at' => $this->experience_updated_at,
            'experience_updated_by' => $this->experience_updated_by,
            'experience_deleted_at' => $this->experience_deleted_at,
            'experience_deleted_by' => $this->experience_deleted_by,
        ]);

        $query->andFilterWhere(['like', 'experience_job_title', $this->experience_job_title])
            ->andFilterWhere(['like', 'experience_company_name', $this->experience_company_name]);

        return $dataProvider;
    }
}
