<?php

namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JobTest;
use app\models\StatusLookup;

/**
 * JobTestSearch represents the model behind the search form of `app\models\JobTest`.
 */
class JobTestSearch extends JobTest
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'test_company_id', 'test_job_post_id', 'test_user_id', 'test_duration', 'test_status_id', 'test_created_by', 'test_updated_by', 'test_deleted_by'], 'integer'],
            [['test_identification', 'test_created_at', 'test_updated_at', 'test_deleted_at'], 'safe'],
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
            $query = JobTest::find();
        } elseif (Yii::$app->user->can('company-admin'))
        {
            $query = JobTest::find()
            ->where(['test_company_id' => $company_id]);
        } elseif(Yii::$app->user->can('hr'))
        {
            $query = JobTest::find()
            ->where(['test_company_id' => $company_id]);
        } elseif (Yii::$app->user->can('applicant'))
        {
            $query = JobTest::find()
            ->where(['test_status_id' => StatusLookup::find()->where(['status_code' => 'published'])->select('id')->scalar()]);
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
            'test_company_id' => $this->test_company_id,
            'test_job_post_id' => $this->test_job_post_id,
            'test_user_id' => $this->test_user_id,
            'test_duration' => $this->test_duration,
            'test_status_id' => $this->test_status_id,
            'test_created_at' => $this->test_created_at,
            'test_created_by' => $this->test_created_by,
            'test_updated_at' => $this->test_updated_at,
            'test_updated_by' => $this->test_updated_by,
            'test_deleted_at' => $this->test_deleted_at,
            'test_deleted_by' => $this->test_deleted_by,
        ]);

        $query->andFilterWhere(['like', 'test_identification', $this->test_identification]);

        return $dataProvider;
    }
}
