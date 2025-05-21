<?php 
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\JobPost;
use yii\db\Transaction;
use yii\helpers\Html;

class AddJobPost extends Model
{
    // company details
    public $post_job_title;
    public $post_job_type;
    public $post_job_description;
    public $post_deadline;
    public $post_profession;
    public $post_location;
    public $post_is_remote;
    public $post_salary_range_min;
    public $post_salary_range_max;
    public $post_status_id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_is_remote'], 'default', 'value' => 0],
            [['post_salary_range_max'], 'default', 'value' => 0.00],
            [['post_company_id', 'post_job_title', 'post_job_type', 'post_job_description', 'post_deadline', 'post_profession', 'post_location', 'post_status_id'], 'trim'],
            [['post_company_id', 'post_job_title', 'post_job_type', 'post_job_description', 'post_deadline', 'post_profession', 'post_location', 'post_status_id'], 'required'],
            [['post_company_id', 'post_user_id', 'post_is_remote', 'post_status_id', 'post_created_by'], 'integer'],
            [['post_job_description'], 'string'],
            [['post_deadline', 'post_created_at'], 'safe'],
            [['post_salary_range_min', 'post_salary_range_max'], 'number'],
            [['post_job_title'], 'string', 'max' => 100],
            [['post_job_type'], 'string', 'max' => 30],
            [['post_profession', 'post_location'], 'string', 'max' => 255],
            [['post_company_id', 'post_user_id', 'post_job_title', 'post_job_type', 'post_profession', 'post_deadline'], 'unique', 'targetAttribute' => ['post_company_id', 'post_user_id', 'post_job_title', 'post_job_type', 'post_profession', 'post_deadline']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'post_job_title' => Yii::t('app', 'Job Title'),
            'post_job_type' => Yii::t('app', 'Job Type'),
            'post_job_description' => Yii::t('app', 'Job Description'),
            'post_deadline' => Yii::t('app', 'Deadline'),
            'post_profession' => Yii::t('app', 'Profession'),
            'post_location' => Yii::t('app', 'Location'),
            'post_is_remote' => Yii::t('app', 'Is Remote'),
            'post_salary_range_min' => Yii::t('app', 'Salary Range Min'),
            'post_salary_range_max' => Yii::t('app', 'Salary Range Max'),
            'post_status_id' => Yii::t('app', 'Status Name'),
        ];
    }

    public function save()
    {
        $transaction = Yii::$app->db->beginTransaction();

        try
        {
            if(Yii::$app->user->can('hr'))
            {
                $post = new JobPost();
                $post->post_company_id = Yii::$app->user->identity->company_id;
                $post->post_user_id = Yii::$app->user->id;
                $post->post_job_title = $this->post_job_title;
                $post->post_job_type = $this->post_job_type;
                $post->post_job_description = $this->post_job_description;
                $post->post_deadline = $this->post_deadline;
                $post->post_profession = $this->post_profession;
                $post->post_location = $this->post_location;
                $post->post_is_remote = $this->post_is_remote;
                $post->post_salary_range_min = $this->post_salary_range_min;
                $post->post_salary_range_max = $this->post_salary_range_max;
                $post->post_status_id = $this->post_status_id;
                $post->post_created_by = Yii::$app->user->id;

                if(!$post->save())
                {
                    throw new \Exception('Failed to register New Job Post'. Html::errorSummary($company));
                }

                $transaction->commit();
                return true;
            }
            throw new \Exception("Forbidden to perform this action");
            return false;
        } catch(\Exception $e)
        {
            $transaction->rollback();
            throw $e;
        }
    }
}
?>