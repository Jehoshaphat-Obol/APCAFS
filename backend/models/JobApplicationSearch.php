<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JobApplication;

/**
 * JobApplicationSearch represents the model behind the search form of `app\models\JobApplication`.
 */
class JobApplicationSearch extends JobApplication
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'applicant_job_post_id', 'applicant_user_id', 'applicant_status_id', 'applicant_created_by', 'applicant_updated_by', 'applicant_deleted_by'], 'integer'],
            [['applicant_score'], 'number'],
            [['applicant_created_at', 'applicant_updated_at', 'applicant_deleted_at', 'applicant_company_id'], 'safe'],
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
        $company_id = Yii::$app->user->identity->company_id;

        if (Yii::$app->user->can('super-admin')) {
            $query = JobApplication::find();
        } elseif (Yii::$app->user->can('company-admin')) {
            $query = JobApplication::find()
                ->where(['applicant_company_id' => $company_id]);
        } elseif (Yii::$app->user->can('hr')) {
            $applyStatusId = StatusLookup::find()
                ->where(['status_code' => 'apply'])
                ->select('id')
                ->scalar();

            $query = JobApplication::find()
                ->where([
                    'applicant_company_id' => $company_id,
                    'applicant_status_id' => $applyStatusId,
                ]);
        } else {
            throw new \yii\web\ForbiddenHttpException();
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10, // Number of records per page
            ],
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
            'applicant_company_id' => $this->applicant_company_id,
            'applicant_job_post_id' => $this->applicant_job_post_id,
            'applicant_user_id' => $this->applicant_user_id,
            'applicant_score' => $this->applicant_score,
            'applicant_status_id' => $this->applicant_status_id,
            'applicant_created_at' => $this->applicant_created_at,
            'applicant_created_by' => $this->applicant_created_by,
            'applicant_updated_at' => $this->applicant_updated_at,
            'applicant_updated_by' => $this->applicant_updated_by,
            'applicant_deleted_at' => $this->applicant_deleted_at,
            'applicant_deleted_by' => $this->applicant_deleted_by,
        ]);

        return $dataProvider;
    }
}
