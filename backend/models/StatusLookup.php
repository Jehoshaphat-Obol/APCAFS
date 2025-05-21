<?php

namespace app\models;

use Yii;
use app\models\Award;
use app\models\Company;
use app\models\CompanySubscription;
use app\models\District;
use app\models\Education;
use app\models\JobApplication;
use app\models\JobPost;
use app\models\JobTest;
use app\models\Language;
use app\models\PersonalityAssessment;
use app\models\PhoneNumber;
use app\models\Profile;
use app\models\Publication;
use app\models\Region;
use app\models\Skill;
use app\models\StaffProfile;
use app\models\SubscriptionPlan;
use app\models\TestQuestion;
use app\models\TestResult;
use app\models\User;
use app\models\WorkExperience;

/**
 * This is the model class for table "status_lookup".
 *
 * @property int $id
 * @property string $status_code
 * @property string $status_name
 * @property string|null $status_description
 * @property string $status_created_at
 * @property string $status_updated_at
 * @property string|null $status_deleted_at
 *
 * @property Award[] $awards
 * @property Company[] $companies
 * @property CompanySubscription[] $companySubscriptions
 * @property District[] $districts
 * @property Education[] $educations
 * @property JobApplication[] $jobApplications
 * @property JobPost[] $jobPosts
 * @property JobTest[] $jobTests
 * @property Language[] $languages
 * @property PersonalityAssessment[] $personalityAssessments
 * @property PhoneNumber[] $phoneNumbers
 * @property Profile[] $profiles
 * @property Publication[] $publications
 * @property Region[] $regions
 * @property Skill[] $skills
 * @property StaffProfile[] $staffProfiles
 * @property SubscriptionPlan[] $subscriptionPlans
 * @property TestQuestion[] $testQuestions
 * @property TestResult[] $testResults
 * @property User[] $users
 * @property WorkExperience[] $workExperiences
 */
class StatusLookup extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status_lookup';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_description', 'status_deleted_at'], 'default', 'value' => null],
            [['status_code', 'status_name'], 'required'],
            [['status_description'], 'string'],
            [['status_created_at', 'status_updated_at', 'status_deleted_at'], 'safe'],
            [['status_code'], 'string', 'max' => 10],
            [['status_name'], 'string', 'max' => 100],
            [['status_code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'status_code' => Yii::t('app', 'Status Code'),
            'status_name' => Yii::t('app', 'Status Name'),
            'status_description' => Yii::t('app', 'Status Description'),
            'status_created_at' => Yii::t('app', 'Status Created At'),
            'status_updated_at' => Yii::t('app', 'Status Updated At'),
            'status_deleted_at' => Yii::t('app', 'Status Deleted At'),
        ];
    }

    /**
     * Gets query for [[Awards]].
     *
     * @return \yii\db\ActiveQuery|AwardQuery
     */
    public function getAwards()
    {
        return $this->hasMany(Award::class, ['award_status_id' => 'id']);
    }

    /**
     * Gets query for [[Companies]].
     *
     * @return \yii\db\ActiveQuery|CompanyQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Company::class, ['company_status_id' => 'id']);
    }

    /**
     * Gets query for [[CompanySubscriptions]].
     *
     * @return \yii\db\ActiveQuery|CompanySubscriptionQuery
     */
    public function getCompanySubscriptions()
    {
        return $this->hasMany(CompanySubscription::class, ['subscription_status_id' => 'id']);
    }

    /**
     * Gets query for [[Districts]].
     *
     * @return \yii\db\ActiveQuery|DistrictQuery
     */
    public function getDistricts()
    {
        return $this->hasMany(District::class, ['district_status_id' => 'id']);
    }

    /**
     * Gets query for [[Educations]].
     *
     * @return \yii\db\ActiveQuery|EducationQuery
     */
    public function getEducations()
    {
        return $this->hasMany(Education::class, ['education_status_id' => 'id']);
    }

    /**
     * Gets query for [[JobApplications]].
     *
     * @return \yii\db\ActiveQuery|JobApplicationQuery
     */
    public function getJobApplications()
    {
        return $this->hasMany(JobApplication::class, ['applicant_status_id' => 'id']);
    }

    /**
     * Gets query for [[JobPosts]].
     *
     * @return \yii\db\ActiveQuery|JobPostQuery
     */
    public function getJobPosts()
    {
        return $this->hasMany(JobPost::class, ['post_status_id' => 'id']);
    }

    /**
     * Gets query for [[JobTests]].
     *
     * @return \yii\db\ActiveQuery|JobTestQuery
     */
    public function getJobTests()
    {
        return $this->hasMany(JobTest::class, ['test_status_id' => 'id']);
    }

    /**
     * Gets query for [[Languages]].
     *
     * @return \yii\db\ActiveQuery|LanguageQuery
     */
    public function getLanguages()
    {
        return $this->hasMany(Language::class, ['language_status_id' => 'id']);
    }

    /**
     * Gets query for [[PersonalityAssessments]].
     *
     * @return \yii\db\ActiveQuery|PersonalityAssessmentQuery
     */
    public function getPersonalityAssessments()
    {
        return $this->hasMany(PersonalityAssessment::class, ['personality_status_id' => 'id']);
    }

    /**
     * Gets query for [[PhoneNumbers]].
     *
     * @return \yii\db\ActiveQuery|PhoneNumberQuery
     */
    public function getPhoneNumbers()
    {
        return $this->hasMany(PhoneNumber::class, ['phone_status_id' => 'id']);
    }

    /**
     * Gets query for [[Profiles]].
     *
     * @return \yii\db\ActiveQuery|ProfileQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::class, ['profile_status_id' => 'id']);
    }

    /**
     * Gets query for [[Publications]].
     *
     * @return \yii\db\ActiveQuery|PublicationQuery
     */
    public function getPublications()
    {
        return $this->hasMany(Publication::class, ['publication_status_id' => 'id']);
    }

    /**
     * Gets query for [[Regions]].
     *
     * @return \yii\db\ActiveQuery|RegionQuery
     */
    public function getRegions()
    {
        return $this->hasMany(Region::class, ['region_status_id' => 'id']);
    }

    /**
     * Gets query for [[Skills]].
     *
     * @return \yii\db\ActiveQuery|SkillQuery
     */
    public function getSkills()
    {
        return $this->hasMany(Skill::class, ['skill_status_id' => 'id']);
    }

    /**
     * Gets query for [[StaffProfiles]].
     *
     * @return \yii\db\ActiveQuery|StaffProfileQuery
     */
    public function getStaffProfiles()
    {
        return $this->hasMany(StaffProfile::class, ['staff_status_id' => 'id']);
    }

    /**
     * Gets query for [[SubscriptionPlans]].
     *
     * @return \yii\db\ActiveQuery|SubscriptionPlanQuery
     */
    public function getSubscriptionPlans()
    {
        return $this->hasMany(SubscriptionPlan::class, ['subscription_plan_status_id' => 'id']);
    }

    /**
     * Gets query for [[TestQuestions]].
     *
     * @return \yii\db\ActiveQuery|TestQuestionQuery
     */
    public function getTestQuestions()
    {
        return $this->hasMany(TestQuestion::class, ['question_status_id' => 'id']);
    }

    /**
     * Gets query for [[TestResults]].
     *
     * @return \yii\db\ActiveQuery|TestResultQuery
     */
    public function getTestResults()
    {
        return $this->hasMany(TestResult::class, ['result_status_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['user_status_id' => 'id']);
    }

    /**
     * Gets query for [[WorkExperiences]].
     *
     * @return \yii\db\ActiveQuery|WorkExperienceQuery
     */
    public function getWorkExperiences()
    {
        return $this->hasMany(WorkExperience::class, ['experience_status_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return StatusLookupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StatusLookupQuery(get_called_class());
    }

}
