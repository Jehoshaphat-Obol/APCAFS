<?php

namespace app\models;

use Yii;
use app\models\User;
use app\models\Company;
use app\models\StatusLookup;
use app\models\JobTest;
use app\models\JobApplication;

/**
 * This is the model class for table "job_post".
 *
 * @property int $id
 * @property int $post_company_id
 * @property int|null $post_user_id
 * @property string $post_job_title
 * @property string $post_job_type
 * @property string $post_job_description
 * @property string $post_publication_date
 * @property string $post_deadline
 * @property string $post_profession
 * @property string $post_location
 * @property int|null $post_is_remote
 * @property float|null $post_salary_range_min
 * @property float|null $post_salary_range_max
 * @property int $post_status_id
 * @property string $post_created_at
 * @property int|null $post_created_by
 * @property string $post_updated_at
 * @property int|null $post_updated_by
 * @property string|null $post_deleted_at
 * @property int|null $post_deleted_by
 *
 * @property Company $company
 * @property JobApplication[] $jobApplications
 * @property JobTest[] $jobTests
 * @property StatusLookup $statusLookup
 * @property User $user
 * @property User $user0
 * @property User $user1
 * @property User $user2
 */
class JobPost extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job_post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_user_id', 'post_created_by', 'post_updated_by', 'post_deleted_at', 'post_deleted_by'], 'default', 'value' => null],
            [['post_is_remote'], 'default', 'value' => 0],
            [['post_salary_range_max'], 'default', 'value' => 0.00],
            [['post_company_id', 'post_job_title', 'post_job_type', 'post_job_description', 'post_deadline', 'post_profession', 'post_location', 'post_status_id'], 'required'],
            [['post_company_id', 'post_user_id', 'post_is_remote', 'post_status_id', 'post_created_by', 'post_updated_by', 'post_deleted_by'], 'integer'],
            [['post_job_description'], 'string'],
            [['post_publication_date', 'post_deadline', 'post_created_at', 'post_updated_at', 'post_deleted_at'], 'safe'],
            [['post_salary_range_min', 'post_salary_range_max'], 'number'],
            [['post_job_title'], 'string', 'max' => 100],
            [['post_job_type'], 'string', 'max' => 30],
            [['post_profession', 'post_location'], 'string', 'max' => 255],
            [['post_company_id', 'post_user_id', 'post_job_title', 'post_job_type', 'post_profession', 'post_publication_date', 'post_deadline'], 'unique', 'targetAttribute' => ['post_company_id', 'post_user_id', 'post_job_title', 'post_job_type', 'post_profession', 'post_publication_date', 'post_deadline']],
            [['post_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['post_company_id' => 'id']],
            [['post_created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['post_created_by' => 'id']],
            [['post_deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['post_deleted_by' => 'id']],
            [['post_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusLookup::class, 'targetAttribute' => ['post_status_id' => 'id']],
            [['post_updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['post_updated_by' => 'id']],
            [['post_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['post_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'post_company_id' => Yii::t('app', 'Company Name'),
            'post_user_id' => Yii::t('app', 'User Name'),
            'post_job_title' => Yii::t('app', 'Job Title'),
            'post_job_type' => Yii::t('app', 'Job Type'),
            'post_job_description' => Yii::t('app', 'Job Description'),
            'post_publication_date' => Yii::t('app', 'Publication Date'),
            'post_deadline' => Yii::t('app', 'Deadline'),
            'post_profession' => Yii::t('app', 'Profession'),
            'post_location' => Yii::t('app', 'Location'),
            'post_is_remote' => Yii::t('app', 'Is Remote'),
            'post_salary_range_min' => Yii::t('app', 'Salary Range Min'),
            'post_salary_range_max' => Yii::t('app', 'Salary Range Max'),
            'post_status_id' => Yii::t('app', 'Status Name'),
            'post_created_at' => Yii::t('app', 'Created At'),
            'user.username' => Yii::t('app', 'Created By'),
            'post_updated_at' => Yii::t('app', 'Updated At'),
            'post_updated_by' => Yii::t('app', 'Updated By'),
            'post_deleted_at' => Yii::t('app', 'Deleted At'),
            'post_deleted_by' => Yii::t('app', 'Deleted By'),
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery|CompanyQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'post_company_id']);
    }

    /**
     * Gets query for [[JobApplications]].
     *
     * @return \yii\db\ActiveQuery|JobApplicationQuery
     */
    public function getJobApplications()
    {
        return $this->hasMany(JobApplication::class, ['applicant_job_post_id' => 'id']);
    }

    /**
     * Gets query for [[JobTests]].
     *
     * @return \yii\db\ActiveQuery|JobTestQuery
     */
    public function getJobTests()
    {
        return $this->hasMany(JobTest::class, ['test_job_post_id' => 'id']);
    }

    /**
     * Gets query for [[StatusLookup]].
     *
     * @return \yii\db\ActiveQuery|StatusLookupQuery
     */
    public function getStatusLookup()
    {
        return $this->hasOne(StatusLookup::class, ['id' => 'post_status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'post_created_by']);
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::class, ['id' => 'post_deleted_by']);
    }

    /**
     * Gets query for [[User1]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser1()
    {
        return $this->hasOne(User::class, ['id' => 'post_updated_by']);
    }

    /**
     * Gets query for [[User2]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser2()
    {
        return $this->hasOne(User::class, ['id' => 'post_user_id']);
    }

    /**
     * {@inheritdoc}
     * @return JobPostQuery the active query used by this AR class.
     */
    // public static function find()
    // {
    //     return new JobPostQuery(get_called_class());
    // }

    /**
     * Soft delete: Inaweka `deleted_at` kwa sasa.
     */
    public function softDelete()
    {
        $this->post_deleted_at = date('Y-m-d H:i:s');
        $this->post_status_id = StatusLookup::find()->where(['status_code' => 'deleted'])->select('id')->scalar();
        $this->post_deleted_by = Yii::$app->user->id;
        return $this->save(false, ['post_deleted_at', 'post_status_id', 'post_deleted_by']);
    }

    /**
     * Restore: Inaondoa thamani ya `deleted_at`.
     */
    public function restore()
    {
        $this->post_deleted_at = null;
        $this->post_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
        $this->post_updated_by = Yii::$app->user->id;
        return $this->save(false, ['post_deleted_at', 'post_status_id', 'post_updated_by']);
    }

    /**
     * Override `find()` ili kuchuja rekodi zilizofutwa kwa default.
     */
    public static function find()
    {
        return parent::find()->where(['post_deleted_at' => null]);
    }

    /**
     * Methodi maalum ya kuchuja na kurudisha rekodi ambazo zimefutwa pekee.
     */
    public static function onlyDeleted()
    {
        return parent::find()->where(['not', ['post_deleted_at' => null]]);
    }

    /**
     * Methodi maalum ya kupata rekodi pamoja na zilizofutwa.
     */
    public static function findWithDeleted()
    {
        return parent::find();
    }
}
