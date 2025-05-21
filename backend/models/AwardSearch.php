<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Award;

/**
 * AwardSearch represents the model behind the search form of `app\models\Award`.
 */
class AwardSearch extends Award
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'award_profile_id', 'award_status_id', 'award_created_by', 'award_updated_by', 'award_deleted_by'], 'integer'],
            [['award_title', 'award_organization_name', 'award_issue_number', 'award_date_of_issue', 'award_created_at', 'award_updated_at', 'award_deleted_at'], 'safe'],
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
        $query = Award::find();

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
            'award_profile_id' => $this->award_profile_id,
            'award_date_of_issue' => $this->award_date_of_issue,
            'award_status_id' => $this->award_status_id,
            'award_created_at' => $this->award_created_at,
            'award_created_by' => $this->award_created_by,
            'award_updated_at' => $this->award_updated_at,
            'award_updated_by' => $this->award_updated_by,
            'award_deleted_at' => $this->award_deleted_at,
            'award_deleted_by' => $this->award_deleted_by,
        ]);

        $query->andFilterWhere(['like', 'award_title', $this->award_title])
            ->andFilterWhere(['like', 'award_organization_name', $this->award_organization_name])
            ->andFilterWhere(['like', 'award_issue_number', $this->award_issue_number]);

        return $dataProvider;
    }
}
