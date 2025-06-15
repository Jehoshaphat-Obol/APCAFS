<?php

namespace app\models;

use Yii;
use app\models\User;
use app\models\StatusLookup;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string $company_name
 * @property string $company_phone_number
 * @property string $company_email
 * @property string $company_address
 * @property string|null $company_website_url
 * @property int $company_user_size
 * @property string $company_activation_code
 * @property string|null $company_activation_code_date
 * @property int $company_status_id
 * @property string $company_created_at
 * @property string $company_updated_at
 * @property string|null $company_deleted_at
 *
 * @property StatusLookup $companyStatus
 * @property CompanySubscription[] $companySubscriptions
 * @property JobApplication[] $jobApplications
 * @property JobPost[] $jobPosts
 * @property JobTest[] $jobTests
 * @property StaffProfile[] $staffProfiles
 * @property TestQuestion[] $testQuestions
 * @property TestResult[] $testResults
 * @property User[] $users
 */
class Company extends \yii\db\ActiveRecord
{
    public $subscription_plan_id;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%company}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_website_url', 'company_activation_code_date', 'company_deleted_at'], 'default', 'value' => null],
            [['company_user_size'], 'default', 'value' => 2],
            [['company_name', 'company_phone_number', 'company_email', 'company_address', 'company_activation_code', 'company_status_id'], 'required'],
            [['company_user_size', 'company_status_id'], 'integer'],
            [['company_activation_code_date', 'company_created_at', 'company_updated_at', 'company_deleted_at', 'subscriptionPlanId'], 'safe'],
            [['company_name', 'company_email', 'company_address', 'company_website_url'], 'string', 'max' => 255],
            [['company_phone_number'], 'string', 'max' => 10],
            [['company_activation_code'], 'string', 'max' => 50],
            [['company_name'], 'unique'],
            [['company_email'], 'unique'],
            [['company_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusLookup::class, 'targetAttribute' => ['company_status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'company_name' => Yii::t('app', 'Name'),
            'company_phone_number' => Yii::t('app', 'Phone Number'),
            'company_email' => Yii::t('app', 'Email'),
            'company_address' => Yii::t('app', 'Address'),
            'company_website_url' => Yii::t('app', 'Website Url'),
            'company_user_size' => Yii::t('app', 'User Size'),
            'company_activation_code' => Yii::t('app', 'Activation Code'),
            'company_activation_code_date' => Yii::t('app', 'Activation Code Date'),
            'companyStatus.status_name' => Yii::t('app', 'Status'),
            'company_status_id' => Yii::t('app', 'Status'),
            'company_created_at' => Yii::t('app', 'Created At'),
            'company_updated_at' => Yii::t('app', 'Updated At'),
            'company_deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * Gets query for [[CompanyStatus]].
     *
     * @return \yii\db\ActiveQuery|StatusLookupQuery
     */
    public function getCompanyStatus()
    {
        return $this->hasOne(StatusLookup::class, ['id' => 'company_status_id']);
    }

    // public function getSubscriptionPlanId()
    // {
    //     return $this->_subscription_plan_id ?? ($this->activeSubscription ? $this->activeSubscription->subscription_plan_id : null);
    // }

    // public function setSubscriptionPlanId($value)
    // {
    //     $this->_subscription_plan_id = $value;
    // }

    /**
     * Gets query for [[CompanySubscriptions]].
     *
     * @return \yii\db\ActiveQuery|CompanySubscriptionQuery
     */
    public function getCompanySubscriptions()
    {
        return $this->hasMany(CompanySubscription::class, ['subscription_company_id' => 'id']);
    }

    /**
     * Gets query for [[JobApplications]].
     *
     * @return \yii\db\ActiveQuery|JobApplicationQuery
     */
    public function getJobApplications()
    {
        return $this->hasMany(JobApplication::class, ['applicant_company_id' => 'id']);
    }

    /**
     * Gets query for [[JobPosts]].
     *
     * @return \yii\db\ActiveQuery|JobPostQuery
     */
    public function getJobPosts()
    {
        return $this->hasMany(JobPost::class, ['post_company_id' => 'id']);
    }

    /**
     * Gets query for [[JobTests]].
     *
     * @return \yii\db\ActiveQuery|JobTestQuery
     */
    public function getJobTests()
    {
        return $this->hasMany(JobTest::class, ['test_company_id' => 'id']);
    }

    /**
     * Gets query for [[StaffProfiles]].
     *
     * @return \yii\db\ActiveQuery|StaffProfileQuery
     */
    public function getStaffProfiles()
    {
        return $this->hasMany(StaffProfile::class, ['staff_company_id' => 'id']);
    }

    /**
     * Gets query for [[TestQuestions]].
     *
     * @return \yii\db\ActiveQuery|TestQuestionQuery
     */
    public function getTestQuestions()
    {
        return $this->hasMany(TestQuestion::class, ['question_company_id' => 'id']);
    }

    /**
     * Gets query for [[TestResults]].
     *
     * @return \yii\db\ActiveQuery|TestResultQuery
     */
    public function getTestResults()
    {
        return $this->hasMany(TestResult::class, ['result_company_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['company_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return CompanyQuery the active query used by this AR class.
     */
    // public static function find()
    // {
    //     return new CompanyQuery(get_called_class());
    // }

    /** 
     *
     * this method used to generate company activation code 
     */ 
    public function generateActivationCode()
    {
        $this->company_activation_code =  Yii::$app->security->generateRandomString(6);
    }

    /**
     * Soft delete: Inaweka `deleted_at` kwa sasa.
     */
    public function softDelete()
    {
        $this->company_deleted_at = date('Y-m-d H:i:s');
        $this->company_status_id = StatusLookup::find()->where(['status_code' => 'deleted'])->select('id')->scalar();
        // $this->company_deleted_by = Yii::$app->user->id , 'company_deleted_by';
        return $this->save(false, ['company_deleted_at', 'company_status_id']);
    }

    /**
     * Restore: Inaondoa thamani ya `deleted_at`.
     */
    public function restore()
    {
        $this->company_deleted_at = null;
        $this->company_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
        return $this->save(false, ['company_deleted_at', 'company_status_id']);
    }

    /**
     * Override `find()` ili kuchuja rekodi zilizofutwa kwa default.
     */
    public static function find()
    {
        return parent::find()->where(['company_deleted_at' => null]);
    }

    /**
     * Methodi maalum ya kuchuja na kurudisha rekodi ambazo zimefutwa pekee.
     */
    public static function onlyDeleted()
    {
        return parent::find()->where(['not', ['company_deleted_at' => null]]);
    }

    /**
     * Methodi maalum ya kupata rekodi pamoja na zilizofutwa.
     */
    public static function findWithDeleted()
    {
        return parent::find();
    }

    /**
     * method itatumika kuangalia idadi ya users ambazo kampuni anatakiwa kuwa naoo kama ilivyojazwa kwenye company_user_size column,
     * pamoja na idadi ya user watakaotengenezwa na company admin kwenye company yake.
     */
    public function companyUserCheckLimit()
    {
        try
        {
            // Get the company data and check validity
            $company = Company::find()
                ->where(['id' => Yii::$app->user->identity->company_id])
                ->andWhere(['company_status_id' => StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar()])
                ->andWhere(['company_deleted_at' => null])
                ->one();

            if (!$company) {
                throw new \Exception("Company not found for ID: {$company->id}");
            }

            // Get the user limit for the company
            $user_limit = $company->company_user_size;

            // Get the current user count
            $usersCount = User::find()
                ->where(['company_id' => $company->id])
                ->count();

            // Check if the user limit is reached
            return $usersCount < $user_limit; // Returns true if under the limit, false if exceeded
        } catch (\Exception $e) {
            Yii::error("Error in companyusersCheckLimit: " . $e->getMessage(), __METHOD__);
            throw $e;
        }
    }

    public function getActiveSubscription()
    {
        return $this->hasOne(CompanySubscription::class, ['subscription_company_id' => 'id'])
            ->andWhere(['IS', 'subscription_deleted_at', null])
            ->andWhere(['>=', 'subscription_end_date', date('Y-m-d')])
            ->andWhere(['subscription_status_id' => StatusLookup::find()->where(['status_code' => 'paid'])->select('id')])
            ->orderBy(['subscription_start_date' => SORT_DESC]);
    }
}
