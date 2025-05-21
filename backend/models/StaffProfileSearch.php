<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StaffProfile;

/**
 * StaffProfileSearch represents the model behind the search form of `app\models\StaffProfile`.
 */
class StaffProfileSearch extends StaffProfile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'staff_company_id', 'staff_user_id', 'staff_status_id', 'staff_created_by', 'staff_updated_by', 'staff_deleted_by'], 'integer'],
            [['staff_first_name', 'staff_middle_name', 'staff_last_name', 'staff_phone_number', 'staff_created_at', 'staff_updated_at', 'staff_deleted_at'], 'safe'],
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
        $query = StaffProfile::find();

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
            'staff_company_id' => $this->staff_company_id,
            'staff_user_id' => $this->staff_user_id,
            'staff_status_id' => $this->staff_status_id,
            'staff_created_at' => $this->staff_created_at,
            'staff_created_by' => $this->staff_created_by,
            'staff_updated_at' => $this->staff_updated_at,
            'staff_updated_by' => $this->staff_updated_by,
            'staff_deleted_at' => $this->staff_deleted_at,
            'staff_deleted_by' => $this->staff_deleted_by,
        ]);

        $query->andFilterWhere(['like', 'staff_first_name', $this->staff_first_name])
            ->andFilterWhere(['like', 'staff_middle_name', $this->staff_middle_name])
            ->andFilterWhere(['like', 'staff_last_name', $this->staff_last_name])
            ->andFilterWhere(['like', 'staff_phone_number', $this->staff_phone_number]);

        return $dataProvider;
    }
}
