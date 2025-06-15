<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Company;

/**
 * CompanySearch represents the model behind the search form of `app\models\Company`.
 */
class CompanySearch extends Company
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'company_user_size'], 'integer'],
            [['company_name', 'company_phone_number', 'company_email', 'company_address', 'company_website_url', 'company_activation_code', 'company_activation_code_date', 'company_created_at', 'company_updated_at', 'company_deleted_at', 'company_status_id'], 'safe'],
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
        $query = Company::find();

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

        $query->joinWith(['companyStatus AS status']);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'company_user_size' => $this->company_user_size,
            'company_activation_code_date' => $this->company_activation_code_date,
            'company_created_at' => $this->company_created_at,
            'company_updated_at' => $this->company_updated_at,
            'company_deleted_at' => $this->company_deleted_at,
        ]);

        $query->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'company_phone_number', $this->company_phone_number])
            ->andFilterWhere(['like', 'company_email', $this->company_email])
            ->andFilterWhere(['like', 'company_address', $this->company_address])
            ->andFilterWhere(['like', 'company_website_url', $this->company_website_url])
            ->andFilterWhere(['like', 'company_activation_code', $this->company_activation_code])
            ->andFilterWhere(['like', 'status.status_name', $this->company_status_id]);

        return $dataProvider;
    }
}
