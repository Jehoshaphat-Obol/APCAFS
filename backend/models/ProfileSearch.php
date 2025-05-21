<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Profile;

/**
 * ProfileSearch represents the model behind the search form of `app\models\Profile`.
 */
class ProfileSearch extends Profile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'profile_user_id', 'profile_region_id', 'profile_district_id', 'profile_status_id', 'profile_created_by', 'profile_updated_by', 'profile_deleted_by'], 'integer'],
            [['profile_first_name', 'profile_middle_name', 'profile_last_name', 'profile_social_media_username', 'profile_date_of_birth', 'profile_bios', 'profile_local_address', 'profile_created_at', 'profile_updated_at', 'profile_deleted_at'], 'safe'],
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
        $query = Profile::find();

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
            'profile_user_id' => $this->profile_user_id,
            'profile_date_of_birth' => $this->profile_date_of_birth,
            'profile_region_id' => $this->profile_region_id,
            'profile_district_id' => $this->profile_district_id,
            'profile_status_id' => $this->profile_status_id,
            'profile_created_at' => $this->profile_created_at,
            'profile_created_by' => $this->profile_created_by,
            'profile_updated_at' => $this->profile_updated_at,
            'profile_updated_by' => $this->profile_updated_by,
            'profile_deleted_at' => $this->profile_deleted_at,
            'profile_deleted_by' => $this->profile_deleted_by,
        ]);

        $query->andFilterWhere(['like', 'profile_first_name', $this->profile_first_name])
            ->andFilterWhere(['like', 'profile_middle_name', $this->profile_middle_name])
            ->andFilterWhere(['like', 'profile_last_name', $this->profile_last_name])
            ->andFilterWhere(['like', 'profile_social_media_username', $this->profile_social_media_username])
            ->andFilterWhere(['like', 'profile_bios', $this->profile_bios])
            ->andFilterWhere(['like', 'profile_local_address', $this->profile_local_address]);

        return $dataProvider;
    }
}
