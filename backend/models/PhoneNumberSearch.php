<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PhoneNumber;

/**
 * PhoneNumberSearch represents the model behind the search form of `app\models\PhoneNumber`.
 */
class PhoneNumberSearch extends PhoneNumber
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'phone_profile_id', 'phone_status_id', 'phone_created_by', 'phone_updated_by', 'phone_deleted_by'], 'integer'],
            [['phone_number', 'phone_created_at', 'phone_updated_at', 'phone_deleted_at'], 'safe'],
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
        $query = PhoneNumber::find();

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
            'phone_profile_id' => $this->phone_profile_id,
            'phone_status_id' => $this->phone_status_id,
            'phone_created_at' => $this->phone_created_at,
            'phone_created_by' => $this->phone_created_by,
            'phone_updated_at' => $this->phone_updated_at,
            'phone_updated_by' => $this->phone_updated_by,
            'phone_deleted_at' => $this->phone_deleted_at,
            'phone_deleted_by' => $this->phone_deleted_by,
        ]);

        $query->andFilterWhere(['like', 'phone_number', $this->phone_number]);

        return $dataProvider;
    }
}
