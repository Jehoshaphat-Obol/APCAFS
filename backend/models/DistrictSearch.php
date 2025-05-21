<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\District;

/**
 * DistrictSearch represents the model behind the search form of `app\models\District`.
 */
class DistrictSearch extends District
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'district_region_id', 'district_status_id', 'district_created_by', 'district_updated_by', 'district_deleted_by'], 'integer'],
            [['district_name', 'district_created_at', 'district_updated_at', 'district_deleted_at'], 'safe'],
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
        $query = District::find();

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
            'district_region_id' => $this->district_region_id,
            'district_status_id' => $this->district_status_id,
            'district_created_at' => $this->district_created_at,
            'district_created_by' => $this->district_created_by,
            'district_updated_at' => $this->district_updated_at,
            'district_updated_by' => $this->district_updated_by,
            'district_deleted_at' => $this->district_deleted_at,
            'district_deleted_by' => $this->district_deleted_by,
        ]);

        $query->andFilterWhere(['like', 'district_name', $this->district_name]);

        return $dataProvider;
    }
}
