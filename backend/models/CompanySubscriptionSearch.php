<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CompanySubscription;

/**
 * CompanySubscriptionSearch represents the model behind the search form of `app\models\CompanySubscription`.
 */
class CompanySubscriptionSearch extends CompanySubscription
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'subscription_company_id', 'subscription_plan_id', 'subscription_status_id', 'subscription_created_by', 'subscription_updated_by', 'subscription_deleted_by'], 'integer'],
            [['subscription_start_date', 'subscription_end_date', 'subscription_created_at', 'subscription_updated_at', 'subscription_deleted_at'], 'safe'],
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
        $query = CompanySubscription::find();

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
            'subscription_company_id' => $this->subscription_company_id,
            'subscription_plan_id' => $this->subscription_plan_id,
            'subscription_start_date' => $this->subscription_start_date,
            'subscription_end_date' => $this->subscription_end_date,
            'subscription_status_id' => $this->subscription_status_id,
            'subscription_created_at' => $this->subscription_created_at,
            'subscription_created_by' => $this->subscription_created_by,
            'subscription_updated_at' => $this->subscription_updated_at,
            'subscription_updated_by' => $this->subscription_updated_by,
            'subscription_deleted_at' => $this->subscription_deleted_at,
            'subscription_deleted_by' => $this->subscription_deleted_by,
        ]);

        return $dataProvider;
    }
}
