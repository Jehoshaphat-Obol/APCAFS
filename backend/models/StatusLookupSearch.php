<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StatusLookup;

/**
 * StatusLookupSearch represents the model behind the search form of `app\models\StatusLookup`.
 */
class StatusLookupSearch extends StatusLookup
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['status_code', 'status_name', 'status_description', 'status_created_at', 'status_updated_at', 'status_deleted_at'], 'safe'],
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
        $query = StatusLookup::find();

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
            'status_created_at' => $this->status_created_at,
            'status_updated_at' => $this->status_updated_at,
            'status_deleted_at' => $this->status_deleted_at,
        ]);

        $query->andFilterWhere(['like', 'status_code', $this->status_code])
            ->andFilterWhere(['like', 'status_name', $this->status_name])
            ->andFilterWhere(['like', 'status_description', $this->status_description]);

        return $dataProvider;
    }
}
