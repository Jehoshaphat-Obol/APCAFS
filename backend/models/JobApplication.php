<?php

namespace app\models;

use Yii;
use app\models\Company;
use app\models\JobPost;
use app\models\StatusLookup;
use app\models\User;

/**
 * This is the model class for table "job_application".
 *
 * @property int $id
 * @property int $applicant_company_id
 * @property int $applicant_job_post_id
 * @property int $applicant_user_id
 * @property float|null $applicant_score
 * @property int $applicant_status_id
 * @property string $applicant_created_at
 * @property int|null $applicant_created_by
 * @property string $applicant_updated_at
 * @property int|null $applicant_updated_by
 * @property string|null $applicant_deleted_at
 * @property int|null $applicant_deleted_by
 *
 * @property Company $company
 * @property JobPost $jobPost
 * @property StatusLookup $statusLookup
 * @property User $user
 * @property User $user0
 * @property User $user1
 * @property User $user2
 */
class JobApplication extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%job_application}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['applicant_score', 'applicant_created_by', 'applicant_updated_by', 'applicant_deleted_at', 'applicant_deleted_by'], 'default', 'value' => null],
            [['applicant_company_id', 'applicant_job_post_id', 'applicant_user_id', 'applicant_status_id'], 'required'],
            [['applicant_company_id', 'applicant_job_post_id', 'applicant_user_id', 'applicant_status_id', 'applicant_created_by', 'applicant_updated_by', 'applicant_deleted_by'], 'integer'],
            [['applicant_score'], 'number'],
            [['applicant_created_at', 'applicant_updated_at', 'applicant_deleted_at'], 'safe'],
            [['applicant_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['applicant_company_id' => 'id']],
            [['applicant_created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['applicant_created_by' => 'id']],
            [['applicant_deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['applicant_deleted_by' => 'id']],
            [['applicant_job_post_id'], 'exist', 'skipOnError' => true, 'targetClass' => JobPost::class, 'targetAttribute' => ['applicant_job_post_id' => 'id']],
            [['applicant_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusLookup::class, 'targetAttribute' => ['applicant_status_id' => 'id']],
            [['applicant_updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['applicant_updated_by' => 'id']],
            [['applicant_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['applicant_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'applicant_company_id' => Yii::t('app', 'Company'),
            'applicant_job_post_id' => Yii::t('app', 'Job Post'),
            'applicant_user_id' => Yii::t('app', 'Applied By '),
            'applicant_score' => Yii::t('app', 'Score'),
            'applicant_status_id' => Yii::t('app', 'Status'),
            'applicant_created_at' => Yii::t('app', 'Created At'),
            'applicant_created_by' => Yii::t('app', 'Created By'),
            'applicant_updated_at' => Yii::t('app', 'Updated At'),
            'applicant_updated_by' => Yii::t('app', 'Updated By'),
            'applicant_deleted_at' => Yii::t('app', 'Deleted At'),
            'applicant_deleted_by' => Yii::t('app', 'Deleted By'),
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery|CompanyQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'applicant_company_id']);
    }

    /**
     * Gets query for [[JobPost]].
     *
     * @return \yii\db\ActiveQuery|JobPostQuery
     */
    public function getJobPost()
    {
        return $this->hasOne(JobPost::class, ['id' => 'applicant_job_post_id']);
    }

    /**
     * Gets query for [[StatusLookup]].
     *
     * @return \yii\db\ActiveQuery|StatusLookupQuery
     */
    public function getStatusLookup()
    {
        return $this->hasOne(StatusLookup::class, ['id' => 'applicant_status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'applicant_created_by']);
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::class, ['id' => 'applicant_deleted_by']);
    }

    /**
     * Gets query for [[User1]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser1()
    {
        return $this->hasOne(User::class, ['id' => 'applicant_updated_by']);
    }

    /**
     * Gets query for [[User2]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser2()
    {
        return $this->hasOne(User::class, ['id' => 'applicant_user_id']);
    }

    /**
     * {@inheritdoc}
     * @return JobApplicationQuery the active query used by this AR class.
     */
    // public static function find()
    // {
    //     return new JobApplicationQuery(get_called_class());
    // }

    /**
     * Soft delete: Inaweka `deleted_at` kwa sasa.
     */
    public function softDelete()
    {
        $this->applicant_deleted_at = date('Y-m-d H:i:s');
        $this->applicant_status_id = StatusLookup::find()->where(['status_code' => 'deleted'])->select('id')->scalar();
        $this->applicant_deleted_by = Yii::$app->user->id;
        return $this->save(false, ['applicant_deleted_at', 'applicant_status_id', 'applicant_deleted_by']);
    }

    /**
     * Restore: Inaondoa thamani ya `deleted_at`.
     */
    public function restore()
    {
        $this->applicant_deleted_at = null;
        $this->applicant_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
        $this->applicant_updated_by = Yii::$app->user->id;
        return $this->save(false, ['applicant_deleted_at', 'applicant_status_id', 'applicant_updated_by']);
    }

    /**
     * Override `find()` ili kuchuja rekodi zilizofutwa kwa default.
     */
    public static function find()
    {
        return parent::find()->where(['applicant_deleted_at' => null]);
    }

    /**
     * Methodi maalum ya kuchuja na kurudisha rekodi ambazo zimefutwa pekee.
     */
    public static function onlyDeleted()
    {
        return parent::find()->where(['not', ['applicant_deleted_at' => null]]);
    }

    /**
     * Methodi maalum ya kupata rekodi pamoja na zilizofutwa.
     */
    public static function findWithDeleted()
    {
        return parent::find();
    }

}
