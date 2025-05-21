<?php

namespace app\models;

use Yii;
use app\models\Company;
use app\models\JobPost;
use app\models\StatusLookup;
use app\models\TestQuestion;
use app\models\TestResult;
use app\models\User;

/**
 * This is the model class for table "job_test".
 *
 * @property int $id
 * @property int $test_company_id
 * @property int $test_job_post_id
 * @property int|null $test_user_id
 * @property string $test_identification
 * @property int $test_duration
 * @property int $test_status_id
 * @property string $test_created_at
 * @property int|null $test_created_by
 * @property string $test_updated_at
 * @property int|null $test_updated_by
 * @property string|null $test_deleted_at
 * @property int|null $test_deleted_by
 *
 * @property Company $company
 * @property JobPost $jobPost
 * @property StatusLookup $statusLookup
 * @property TestQuestion[] $testQuestions
 * @property TestResult[] $testResults
 * @property User $user
 * @property User $user0
 * @property User $user1
 * @property User $user2
 */
class JobTest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%job_test}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['test_user_id', 'test_created_by', 'test_updated_by', 'test_deleted_at', 'test_deleted_by'], 'default', 'value' => null],
            [['test_company_id', 'test_job_post_id', 'test_identification', 'test_duration', 'test_status_id'], 'required'],
            [['test_company_id', 'test_job_post_id', 'test_user_id', 'test_duration', 'test_status_id', 'test_created_by', 'test_updated_by', 'test_deleted_by'], 'integer'],
            [['test_created_at', 'test_updated_at', 'test_deleted_at'], 'safe'],
            [['test_identification'], 'string', 'max' => 30],
            [['test_company_id', 'test_job_post_id', 'test_user_id', 'test_identification'], 'unique', 'targetAttribute' => ['test_company_id', 'test_job_post_id', 'test_user_id', 'test_identification']],
            [['test_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['test_company_id' => 'id']],
            [['test_created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['test_created_by' => 'id']],
            [['test_deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['test_deleted_by' => 'id']],
            [['test_job_post_id'], 'exist', 'skipOnError' => true, 'targetClass' => JobPost::class, 'targetAttribute' => ['test_job_post_id' => 'id']],
            [['test_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusLookup::class, 'targetAttribute' => ['test_status_id' => 'id']],
            [['test_updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['test_updated_by' => 'id']],
            [['test_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['test_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'test_company_id' => Yii::t('app', 'Test Company Name'),
            'test_job_post_id' => Yii::t('app', 'Test Job Post Title'),
            'test_user_id' => Yii::t('app', 'Test User Name'),
            'test_identification' => Yii::t('app', 'Test Identification'),
            'test_duration' => Yii::t('app', 'Test Duration'),
            'test_status_id' => Yii::t('app', 'Test Status Name'),
            'test_created_at' => Yii::t('app', 'Test Created At'),
            'test_created_by' => Yii::t('app', 'Test Created By'),
            'test_updated_at' => Yii::t('app', 'Test Updated At'),
            'test_updated_by' => Yii::t('app', 'Test Updated By'),
            'test_deleted_at' => Yii::t('app', 'Test Deleted At'),
            'test_deleted_by' => Yii::t('app', 'Test Deleted By'),
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery|CompanyQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'test_company_id']);
    }

    /**
     * Gets query for [[JobPost]].
     *
     * @return \yii\db\ActiveQuery|JobPostQuery
     */
    public function getJobPost()
    {
        return $this->hasOne(JobPost::class, ['id' => 'test_job_post_id']);
    }

    /**
     * Gets query for [[StatusLookup]].
     *
     * @return \yii\db\ActiveQuery|StatusLookupQuery
     */
    public function getStatusLookup()
    {
        return $this->hasOne(StatusLookup::class, ['id' => 'test_status_id']);
    }

    /**
     * Gets query for [[TestQuestions]].
     *
     * @return \yii\db\ActiveQuery|TestQuestionQuery
     */
    public function getTestQuestions()
    {
        return $this->hasMany(TestQuestion::class, ['question_test_id' => 'id']);
    }

    /**
     * Gets query for [[TestResults]].
     *
     * @return \yii\db\ActiveQuery|TestResultQuery
     */
    public function getTestResults()
    {
        return $this->hasMany(TestResult::class, ['result_test_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'test_created_by']);
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::class, ['id' => 'test_deleted_by']);
    }

    /**
     * Gets query for [[User1]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser1()
    {
        return $this->hasOne(User::class, ['id' => 'test_updated_by']);
    }

    /**
     * Gets query for [[User2]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser2()
    {
        return $this->hasOne(User::class, ['id' => 'test_user_id']);
    }

    /**
     * {@inheritdoc}
     * @return JobTestQuery the active query used by this AR class.
     */
    // public static function find()
    // {
    //     return new JobTestQuery(get_called_class());
    // }

    /**
     * Soft delete: Inaweka `deleted_at` kwa sasa.
     */
    public function softDelete()
    {
        $this->test_deleted_at = date('Y-m-d H:i:s');
        $this->test_status_id = StatusLookup::find()->where(['status_code' => 'deleted'])->select('id')->scalar();
        $this->test_deleted_by = Yii::$app->user->id;
        return $this->save(false, ['test_deleted_at', 'test_status_id', 'test_deleted_by']);
    }

    /**
     * Restore: Inaondoa thamani ya `deleted_at`.
     */
    public function restore()
    {
        $this->test_deleted_at = null;
        $this->test_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
        $this->test_updated_by = Yii::$app->user->id;
        return $this->save(false, ['test_deleted_at', 'test_status_id', 'test_updated_by']);
    }

    /**
     * Override `find()` ili kuchuja rekodi zilizofutwa kwa default.
     */
    public static function find()
    {
        return parent::find()->where(['test_deleted_at' => null]);
    }

    /**
     * Methodi maalum ya kuchuja na kurudisha rekodi ambazo zimefutwa pekee.
     */
    public static function onlyDeleted()
    {
        return parent::find()->where(['not', ['test_deleted_at' => null]]);
    }

    /**
     * Methodi maalum ya kupata rekodi pamoja na zilizofutwa.
     */
    public static function findWithDeleted()
    {
        return parent::find();
    }
}