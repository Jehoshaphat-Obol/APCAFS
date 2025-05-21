<?php

namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JobPost;
use app\models\StatusLookup;

/**
 * JobPostSearch represents the model behind the search form of `app\models\JobPost`.
 */
class JobPostSearch extends JobPost
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'post_company_id', 'post_user_id', 'post_is_remote', 'post_status_id', 'post_created_by', 'post_updated_by', 'post_deleted_by'], 'integer'],
            [['post_job_title', 'post_job_type', 'post_job_description', 'post_publication_date', 'post_deadline', 'post_profession', 'post_location', 'post_created_at', 'post_updated_at', 'post_deleted_at'], 'safe'],
            [['post_salary_range_min', 'post_salary_range_max'], 'number'],
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
        
        if(Yii::$app->user->can('super-admin'))
        {
            $query = JobPost::find();
        } elseif (Yii::$app->user->can('company-admin'))
        {
            $query = JobPost::find()
            ->where(['post_company_id' => $company_id]);
        } elseif(Yii::$app->user->can('hr'))
        {
            $query = JobPost::find()
            ->where(['post_company_id' => $company_id]);
        } elseif (Yii::$app->user->can('applicant'))
        {
            $query = JobPost::find()
            ->where(['post_status_id' => StatusLookup::find()->where(['status_code' => 'published'])->select('id')->scalar()]);
        } else
        {
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
            'post_company_id' => $this->post_company_id,
            'post_user_id' => $this->post_user_id,
            'post_publication_date' => $this->post_publication_date,
            'post_deadline' => $this->post_deadline,
            'post_is_remote' => $this->post_is_remote,
            'post_salary_range_min' => $this->post_salary_range_min,
            'post_salary_range_max' => $this->post_salary_range_max,
            'post_status_id' => $this->post_status_id,
            'post_created_at' => $this->post_created_at,
            'post_created_by' => $this->post_created_by,
            'post_updated_at' => $this->post_updated_at,
            'post_updated_by' => $this->post_updated_by,
            'post_deleted_at' => $this->post_deleted_at,
            'post_deleted_by' => $this->post_deleted_by,
        ]);

        $query->andFilterWhere(['like', 'post_job_title', $this->post_job_title])
            ->andFilterWhere(['like', 'post_job_type', $this->post_job_type])
            ->andFilterWhere(['like', 'post_job_description', $this->post_job_description])
            ->andFilterWhere(['like', 'post_profession', $this->post_profession])
            ->andFilterWhere(['like', 'post_location', $this->post_location]);

        return $dataProvider;
    }
}
