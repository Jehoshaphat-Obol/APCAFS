<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SubscriptionPlan;

/**
 * SubscriptionPlanSearch represents the model behind the search form of `app\models\SubscriptionPlan`.
 */
class SubscriptionPlanSearch extends SubscriptionPlan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'subscription_plan_duration', 'subscription_plan_status_id', 'subscription_plan_created_by', 'subscription_plan_updated_by', 'subscription_plan_deleted_by'], 'integer'],
            [['subscription_plan_duration_type', 'subscription_plan_created_at', 'subscription_plan_updated_at', 'subscription_plan_deleted_at'], 'safe'],
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
        $query = SubscriptionPlan::find();

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
            'subscription_plan_duration' => $this->subscription_plan_duration,
            'subscription_plan_status_id' => $this->subscription_plan_status_id,
            'subscription_plan_created_at' => $this->subscription_plan_created_at,
            'subscription_plan_created_by' => $this->subscription_plan_created_by,
            'subscription_plan_updated_at' => $this->subscription_plan_updated_at,
            'subscription_plan_updated_by' => $this->subscription_plan_updated_by,
            'subscription_plan_deleted_at' => $this->subscription_plan_deleted_at,
            'subscription_plan_deleted_by' => $this->subscription_plan_deleted_by,
        ]);

        $query->andFilterWhere(['like', 'subscription_plan_duration_type', $this->subscription_plan_duration_type]);

        return $dataProvider;
    }
}
