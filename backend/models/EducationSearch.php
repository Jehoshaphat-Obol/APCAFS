<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Education;

/**
 * EducationSearch represents the model behind the search form of `app\models\Education`.
 */
class EducationSearch extends Education
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'education_profile_id', 'education_status_id', 'education_created_by', 'education_updated_by', 'education_deleted_by'], 'integer'],
            [['education_degree_name', 'education_programme_name', 'education_university_name', 'education_graduation_date', 'education_created_at', 'education_updated_at', 'education_deleted_at'], 'safe'],
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
        $query = Education::find();

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
            'education_profile_id' => $this->education_profile_id,
            'education_graduation_date' => $this->education_graduation_date,
            'education_status_id' => $this->education_status_id,
            'education_created_at' => $this->education_created_at,
            'education_created_by' => $this->education_created_by,
            'education_updated_at' => $this->education_updated_at,
            'education_updated_by' => $this->education_updated_by,
            'education_deleted_at' => $this->education_deleted_at,
            'education_deleted_by' => $this->education_deleted_by,
        ]);

        $query->andFilterWhere(['like', 'education_degree_name', $this->education_degree_name])
            ->andFilterWhere(['like', 'education_programme_name', $this->education_programme_name])
            ->andFilterWhere(['like', 'education_university_name', $this->education_university_name]);

        return $dataProvider;
    }
}
