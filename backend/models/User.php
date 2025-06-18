<?php

namespace app\models;

use Yii;
use app\models\StatusLookup;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int|null $company_id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property string|null $verification_token
 * @property int $user_status_id
 * @property int $created_at
 * @property int|null $user_created_by
 * @property int $updated_at
 * @property int|null $user_updated_by
 * @property string|null $user_deleted_at
 * @property int|null $user_deleted_by
 *
 * @property Award[] $awards
 * @property Award[] $awards0
 * @property Award[] $awards1
 * @property Company $company
 * @property CompanySubscription[] $companySubscriptions
 * @property CompanySubscription[] $companySubscriptions0
 * @property CompanySubscription[] $companySubscriptions1
 * @property District[] $districts
 * @property District[] $districts0
 * @property District[] $districts1
 * @property Education[] $educations
 * @property Education[] $educations0
 * @property Education[] $educations1
 * @property JobApplication[] $jobApplications
 * @property JobApplication[] $jobApplications0
 * @property JobApplication[] $jobApplications1
 * @property JobApplication[] $jobApplications2
 * @property JobPost[] $jobPosts
 * @property JobPost[] $jobPosts0
 * @property JobPost[] $jobPosts1
 * @property JobPost[] $jobPosts2
 * @property JobTest[] $jobTests
 * @property JobTest[] $jobTests0
 * @property JobTest[] $jobTests1
 * @property JobTest[] $jobTests2
 * @property Language[] $languages
 * @property Language[] $languages0
 * @property Language[] $languages1
 * @property PersonalityAssessment[] $personalityAssessments
 * @property PersonalityAssessment[] $personalityAssessments0
 * @property PersonalityAssessment[] $personalityAssessments1
 * @property PhoneNumber[] $phoneNumbers
 * @property PhoneNumber[] $phoneNumbers0
 * @property PhoneNumber[] $phoneNumbers1
 * @property Profile[] $profiles
 * @property Profile[] $profiles0
 * @property Profile[] $profiles1
 * @property Profile[] $profiles2
 * @property Publication[] $publications
 * @property Publication[] $publications0
 * @property Publication[] $publications1
 * @property Region[] $regions
 * @property Region[] $regions0
 * @property Region[] $regions1
 * @property Skill[] $skills
 * @property Skill[] $skills0
 * @property Skill[] $skills1
 * @property StaffProfile[] $staffProfiles
 * @property StaffProfile[] $staffProfiles0
 * @property StaffProfile[] $staffProfiles1
 * @property StaffProfile[] $staffProfiles2
 * @property TestQuestion[] $testQuestions
 * @property TestQuestion[] $testQuestions0
 * @property TestQuestion[] $testQuestions1
 * @property TestResult[] $testResults
 * @property TestResult[] $testResults0
 * @property TestResult[] $testResults1
 * @property TestResult[] $testResults2
 * @property User $userCreatedBy
 * @property User $userDeletedBy
 * @property StatusLookup $userStatus
 * @property User $userUpdatedBy
 * @property User[] $users
 * @property User[] $users0
 * @property User[] $users1
 * @property WorkExperience[] $workExperiences
 * @property WorkExperience[] $workExperiences0
 * @property WorkExperience[] $workExperiences1
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
public $roles;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'password_reset_token', 'verification_token', 'user_created_by', 'user_updated_by', 'user_deleted_at', 'user_deleted_by'], 'default', 'value' => null],
            [['company_id', 'user_status_id', 'created_at', 'user_created_by', 'updated_at', 'user_updated_by', 'user_deleted_by'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'email', 'user_status_id', 'created_at', 'updated_at'], 'required'],
            [['user_deleted_at', 'roles'], 'safe'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['company_id' => 'id']],
            [['user_created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_created_by' => 'id']],
            [['user_deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_deleted_by' => 'id']],
            [['user_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusLookup::class, 'targetAttribute' => ['user_status_id' => 'id']],
            [['user_updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'company_id' => Yii::t('app', 'Company'),
            'username' => Yii::t('app', 'Username'),
            'roles' => Yii::t('app', 'Roles'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'verification_token' => Yii::t('app', 'Verification Token'),
            'user_status_id' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'userCreatedBy.username' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'userUpdatedBy.username' => Yii::t('app', 'Updated By'),
            'user_deleted_at' => Yii::t('app', 'Deleted At'),
            'userDeletedBy.username' => Yii::t('app', 'Deleted By'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::find()->where(['accessToken' => $token])->one();
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'user_status_id' => StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar(),
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public function findByEmail($email)
    {
        return self::findOne(['email'  => $email]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * Gets query for [[Awards]].
     *
     * @return \yii\db\ActiveQuery|AwardQuery
     */
    public function getAwards()
    {
        return $this->hasMany(Award::class, ['award_created_by' => 'id']);
    }

    /**
     * Gets query for [[Awards0]].
     *
     * @return \yii\db\ActiveQuery|AwardQuery
     */
    public function getAwards0()
    {
        return $this->hasMany(Award::class, ['award_deleted_by' => 'id']);
    }

    /**
     * Gets query for [[Awards1]].
     *
     * @return \yii\db\ActiveQuery|AwardQuery
     */
    public function getAwards1()
    {
        return $this->hasMany(Award::class, ['award_updated_by' => 'id']);
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery|CompanyQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'company_id']);
    }

    /**
     * Gets query for [[CompanySubscriptions]].
     *
     * @return \yii\db\ActiveQuery|CompanySubscriptionQuery
     */
    public function getCompanySubscriptions()
    {
        return $this->hasMany(CompanySubscription::class, ['subscription_created_by' => 'id']);
    }

    /**
     * Gets query for [[CompanySubscriptions0]].
     *
     * @return \yii\db\ActiveQuery|CompanySubscriptionQuery
     */
    public function getCompanySubscriptions0()
    {
        return $this->hasMany(CompanySubscription::class, ['subscription_deleted_by' => 'id']);
    }

    /**
     * Gets query for [[CompanySubscriptions1]].
     *
     * @return \yii\db\ActiveQuery|CompanySubscriptionQuery
     */
    public function getCompanySubscriptions1()
    {
        return $this->hasMany(CompanySubscription::class, ['subscription_updated_by' => 'id']);
    }

    /**
     * Gets query for [[Districts]].
     *
     * @return \yii\db\ActiveQuery|DistrictQuery
     */
    public function getDistricts()
    {
        return $this->hasMany(District::class, ['district_created_by' => 'id']);
    }

    /**
     * Gets query for [[Districts0]].
     *
     * @return \yii\db\ActiveQuery|DistrictQuery
     */
    public function getDistricts0()
    {
        return $this->hasMany(District::class, ['district_deleted_by' => 'id']);
    }

    /**
     * Gets query for [[Districts1]].
     *
     * @return \yii\db\ActiveQuery|DistrictQuery
     */
    public function getDistricts1()
    {
        return $this->hasMany(District::class, ['district_updated_by' => 'id']);
    }

    /**
     * Gets query for [[Educations]].
     *
     * @return \yii\db\ActiveQuery|EducationQuery
     */
    public function getEducations()
    {
        return $this->hasMany(Education::class, ['education_created_by' => 'id']);
    }

    /**
     * Gets query for [[Educations0]].
     *
     * @return \yii\db\ActiveQuery|EducationQuery
     */
    public function getEducations0()
    {
        return $this->hasMany(Education::class, ['education_deleted_by' => 'id']);
    }

    /**
     * Gets query for [[Educations1]].
     *
     * @return \yii\db\ActiveQuery|EducationQuery
     */
    public function getEducations1()
    {
        return $this->hasMany(Education::class, ['education_updated_by' => 'id']);
    }

    /**
     * Gets query for [[JobApplications]].
     *
     * @return \yii\db\ActiveQuery|JobApplicationQuery
     */
    public function getJobApplications()
    {
        return $this->hasMany(JobApplication::class, ['applicant_created_by' => 'id']);
    }

    /**
     * Gets query for [[JobApplications0]].
     *
     * @return \yii\db\ActiveQuery|JobApplicationQuery
     */
    public function getJobApplications0()
    {
        return $this->hasMany(JobApplication::class, ['applicant_deleted_by' => 'id']);
    }

    /**
     * Gets query for [[JobApplications1]].
     *
     * @return \yii\db\ActiveQuery|JobApplicationQuery
     */
    public function getJobApplications1()
    {
        return $this->hasMany(JobApplication::class, ['applicant_updated_by' => 'id']);
    }

    /**
     * Gets query for [[JobApplications2]].
     *
     * @return \yii\db\ActiveQuery|JobApplicationQuery
     */
    public function getJobApplications2()
    {
        return $this->hasMany(JobApplication::class, ['applicant_user_id' => 'id']);
    }

    /**
     * Gets query for [[JobPosts]].
     *
     * @return \yii\db\ActiveQuery|JobPostQuery
     */
    public function getJobPosts()
    {
        return $this->hasMany(JobPost::class, ['post_created_by' => 'id']);
    }

    /**
     * Gets query for [[JobPosts0]].
     *
     * @return \yii\db\ActiveQuery|JobPostQuery
     */
    public function getJobPosts0()
    {
        return $this->hasMany(JobPost::class, ['post_deleted_by' => 'id']);
    }

    /**
     * Gets query for [[JobPosts1]].
     *
     * @return \yii\db\ActiveQuery|JobPostQuery
     */
    public function getJobPosts1()
    {
        return $this->hasMany(JobPost::class, ['post_updated_by' => 'id']);
    }

    /**
     * Gets query for [[JobPosts2]].
     *
     * @return \yii\db\ActiveQuery|JobPostQuery
     */
    public function getJobPosts2()
    {
        return $this->hasMany(JobPost::class, ['post_user_id' => 'id']);
    }

    /**
     * Gets query for [[JobTests]].
     *
     * @return \yii\db\ActiveQuery|JobTestQuery
     */
    public function getJobTests()
    {
        return $this->hasMany(JobTest::class, ['test_created_by' => 'id']);
    }

    /**
     * Gets query for [[JobTests0]].
     *
     * @return \yii\db\ActiveQuery|JobTestQuery
     */
    public function getJobTests0()
    {
        return $this->hasMany(JobTest::class, ['test_deleted_by' => 'id']);
    }

    /**
     * Gets query for [[JobTests1]].
     *
     * @return \yii\db\ActiveQuery|JobTestQuery
     */
    public function getJobTests1()
    {
        return $this->hasMany(JobTest::class, ['test_updated_by' => 'id']);
    }

    /**
     * Gets query for [[JobTests2]].
     *
     * @return \yii\db\ActiveQuery|JobTestQuery
     */
    public function getJobTests2()
    {
        return $this->hasMany(JobTest::class, ['test_user_id' => 'id']);
    }

    /**
     * Gets query for [[Languages]].
     *
     * @return \yii\db\ActiveQuery|LanguageQuery
     */
    public function getLanguages()
    {
        return $this->hasMany(Language::class, ['language_created_by' => 'id']);
    }

    /**
     * Gets query for [[Languages0]].
     *
     * @return \yii\db\ActiveQuery|LanguageQuery
     */
    public function getLanguages0()
    {
        return $this->hasMany(Language::class, ['language_deleted_by' => 'id']);
    }

    /**
     * Gets query for [[Languages1]].
     *
     * @return \yii\db\ActiveQuery|LanguageQuery
     */
    public function getLanguages1()
    {
        return $this->hasMany(Language::class, ['language_updated_by' => 'id']);
    }

    /**
     * Gets query for [[PersonalityAssessments]].
     *
     * @return \yii\db\ActiveQuery|PersonalityAssessmentQuery
     */
    public function getPersonalityAssessments()
    {
        return $this->hasMany(PersonalityAssessment::class, ['personality_created_by' => 'id']);
    }

    /**
     * Gets query for [[PersonalityAssessments0]].
     *
     * @return \yii\db\ActiveQuery|PersonalityAssessmentQuery
     */
    public function getPersonalityAssessments0()
    {
        return $this->hasMany(PersonalityAssessment::class, ['personality_deleted_by' => 'id']);
    }

    /**
     * Gets query for [[PersonalityAssessments1]].
     *
     * @return \yii\db\ActiveQuery|PersonalityAssessmentQuery
     */
    public function getPersonalityAssessments1()
    {
        return $this->hasMany(PersonalityAssessment::class, ['personality_updated_by' => 'id']);
    }

    /**
     * Gets query for [[PhoneNumbers]].
     *
     * @return \yii\db\ActiveQuery|PhoneNumberQuery
     */
    public function getPhoneNumbers()
    {
        return $this->hasMany(PhoneNumber::class, ['phone_created_by' => 'id']);
    }

    /**
     * Gets query for [[PhoneNumbers0]].
     *
     * @return \yii\db\ActiveQuery|PhoneNumberQuery
     */
    public function getPhoneNumbers0()
    {
        return $this->hasMany(PhoneNumber::class, ['phone_deleted_by' => 'id']);
    }

    /**
     * Gets query for [[PhoneNumbers1]].
     *
     * @return \yii\db\ActiveQuery|PhoneNumberQuery
     */
    public function getPhoneNumbers1()
    {
        return $this->hasMany(PhoneNumber::class, ['phone_updated_by' => 'id']);
    }

    /**
     * Gets query for [[Profiles]].
     *
     * @return \yii\db\ActiveQuery|ProfileQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::class, ['profile_created_by' => 'id']);
    }

    /**
     * Gets query for [[Profiles0]].
     *
     * @return \yii\db\ActiveQuery|ProfileQuery
     */
    public function getProfiles0()
    {
        return $this->hasMany(Profile::class, ['profile_deleted_by' => 'id']);
    }

    /**
     * Gets query for [[Profiles1]].
     *
     * @return \yii\db\ActiveQuery|ProfileQuery
     */
    public function getProfiles1()
    {
        return $this->hasMany(Profile::class, ['profile_updated_by' => 'id']);
    }

    /**
     * Gets query for [[Profiles2]].
     *
     * @return \yii\db\ActiveQuery|ProfileQuery
     */
    public function getProfiles2()
    {
        return $this->hasMany(Profile::class, ['profile_user_id' => 'id']);
    }

    /**
     * Gets query for [[Publications]].
     *
     * @return \yii\db\ActiveQuery|PublicationQuery
     */
    public function getPublications()
    {
        return $this->hasMany(Publication::class, ['publication_created_by' => 'id']);
    }

    /**
     * Gets query for [[Publications0]].
     *
     * @return \yii\db\ActiveQuery|PublicationQuery
     */
    public function getPublications0()
    {
        return $this->hasMany(Publication::class, ['publication_deleted_by' => 'id']);
    }

    /**
     * Gets query for [[Publications1]].
     *
     * @return \yii\db\ActiveQuery|PublicationQuery
     */
    public function getPublications1()
    {
        return $this->hasMany(Publication::class, ['publication_updated_by' => 'id']);
    }

    /**
     * Gets query for [[Regions]].
     *
     * @return \yii\db\ActiveQuery|RegionQuery
     */
    public function getRegions()
    {
        return $this->hasMany(Region::class, ['region_created_by' => 'id']);
    }

    /**
     * Gets query for [[Regions0]].
     *
     * @return \yii\db\ActiveQuery|RegionQuery
     */
    public function getRegions0()
    {
        return $this->hasMany(Region::class, ['region_deleted_by' => 'id']);
    }

    /**
     * Gets query for [[Regions1]].
     *
     * @return \yii\db\ActiveQuery|RegionQuery
     */
    public function getRegions1()
    {
        return $this->hasMany(Region::class, ['region_updated_by' => 'id']);
    }

    /**
     * Gets query for [[Skills]].
     *
     * @return \yii\db\ActiveQuery|SkillQuery
     */
    public function getSkills()
    {
        return $this->hasMany(Skill::class, ['skill_created_by' => 'id']);
    }

    /**
     * Gets query for [[Skills0]].
     *
     * @return \yii\db\ActiveQuery|SkillQuery
     */
    public function getSkills0()
    {
        return $this->hasMany(Skill::class, ['skill_deleted_by' => 'id']);
    }

    /**
     * Gets query for [[Skills1]].
     *
     * @return \yii\db\ActiveQuery|SkillQuery
     */
    public function getSkills1()
    {
        return $this->hasMany(Skill::class, ['skill_updated_by' => 'id']);
    }

    /**
     * Gets query for [[StaffProfiles]].
     *
     * @return \yii\db\ActiveQuery|StaffProfileQuery
     */
    public function getStaffProfiles()
    {
        return $this->hasMany(StaffProfile::class, ['staff_created_by' => 'id']);
    }

    /**
     * Gets query for [[StaffProfiles0]].
     *
     * @return \yii\db\ActiveQuery|StaffProfileQuery
     */
    public function getStaffProfiles0()
    {
        return $this->hasMany(StaffProfile::class, ['staff_deleted_by' => 'id']);
    }

    /**
     * Gets query for [[StaffProfiles1]].
     *
     * @return \yii\db\ActiveQuery|StaffProfileQuery
     */
    public function getStaffProfiles1()
    {
        return $this->hasMany(StaffProfile::class, ['staff_updated_by' => 'id']);
    }

    /**
     * Gets query for [[StaffProfiles2]].
     *
     * @return \yii\db\ActiveQuery|StaffProfileQuery
     */
    public function getStaffProfiles2()
    {
        return $this->hasMany(StaffProfile::class, ['staff_user_id' => 'id']);
    }

    /**
     * Gets query for [[TestQuestions]].
     *
     * @return \yii\db\ActiveQuery|TestQuestionQuery
     */
    public function getTestQuestions()
    {
        return $this->hasMany(TestQuestion::class, ['question_created_by' => 'id']);
    }

    /**
     * Gets query for [[TestQuestions0]].
     *
     * @return \yii\db\ActiveQuery|TestQuestionQuery
     */
    public function getTestQuestions0()
    {
        return $this->hasMany(TestQuestion::class, ['question_deleted_by' => 'id']);
    }

    /**
     * Gets query for [[TestQuestions1]].
     *
     * @return \yii\db\ActiveQuery|TestQuestionQuery
     */
    public function getTestQuestions1()
    {
        return $this->hasMany(TestQuestion::class, ['question_updated_by' => 'id']);
    }

    /**
     * Gets query for [[TestResults]].
     *
     * @return \yii\db\ActiveQuery|TestResultQuery
     */
    public function getTestResults()
    {
        return $this->hasMany(TestResult::class, ['result_created_by' => 'id']);
    }

    /**
     * Gets query for [[TestResults0]].
     *
     * @return \yii\db\ActiveQuery|TestResultQuery
     */
    public function getTestResults0()
    {
        return $this->hasMany(TestResult::class, ['result_deleted_by' => 'id']);
    }

    /**
     * Gets query for [[TestResults1]].
     *
     * @return \yii\db\ActiveQuery|TestResultQuery
     */
    public function getTestResults1()
    {
        return $this->hasMany(TestResult::class, ['result_updated_by' => 'id']);
    }

    /**
     * Gets query for [[TestResults2]].
     *
     * @return \yii\db\ActiveQuery|TestResultQuery
     */
    public function getTestResults2()
    {
        return $this->hasMany(TestResult::class, ['result_user_id' => 'id']);
    }

    /**
     * Gets query for [[UserCreatedBy]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUserCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'user_created_by']);
    }

    /**
     * Gets query for [[UserDeletedBy]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUserDeletedBy()
    {
        return $this->hasOne(User::class, ['id' => 'user_deleted_by']);
    }

    /**
     * Gets query for [[UserStatus]].
     *
     * @return \yii\db\ActiveQuery|StatusLookupQuery
     */
    public function getUserStatus()
    {
        return $this->hasOne(StatusLookup::class, ['id' => 'user_status_id']);
    }

    /**
     * Gets query for [[UserUpdatedBy]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUserUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'user_updated_by']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['user_created_by' => 'id']);
    }

    /**
     * Gets query for [[Users0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUsers0()
    {
        return $this->hasMany(User::class, ['user_deleted_by' => 'id']);
    }

    /**
     * Gets query for [[Users1]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUsers1()
    {
        return $this->hasMany(User::class, ['user_updated_by' => 'id']);
    }

    /**
     * Gets query for [[WorkExperiences]].
     *
     * @return \yii\db\ActiveQuery|WorkExperienceQuery
     */
    public function getWorkExperiences()
    {
        return $this->hasMany(WorkExperience::class, ['experience_created_by' => 'id']);
    }

    /**
     * Gets query for [[WorkExperiences0]].
     *
     * @return \yii\db\ActiveQuery|WorkExperienceQuery
     */
    public function getWorkExperiences0()
    {
        return $this->hasMany(WorkExperience::class, ['experience_deleted_by' => 'id']);
    }

    /**
     * Gets query for [[WorkExperiences1]].
     *
     * @return \yii\db\ActiveQuery|WorkExperienceQuery
     */
    public function getWorkExperiences1()
    {
        return $this->hasMany(WorkExperience::class, ['experience_updated_by' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    // public static function find()
    // {
    //     return new UserQuery(get_called_class());
    // }

    /**
     * Soft delete: Inaweka `deleted_at` kwa sasa.
     */
    public function softDelete()
    {
        $this->user_deleted_at = date('Y-m-d H:i:s');
        $this->user_status_id = StatusLookup::find()->where(['status_code' => 'deleted'])->select('id')->scalar();
        $this->user_deleted_by = Yii::$app->user->id;
        return $this->save(false, ['user_deleted_at', 'user_status_id', 'user_deleted_by']);
    }

    /**
     * Restore: Inaondoa thamani ya `deleted_at`.
     */
    public function restore()
    {
        $this->user_deleted_at = null;
        $this->user_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
        $this->user_updated_by = Yii::$app->user->id;
        return $this->save(false, ['user_deleted_at', 'user_status_id', 'user_updated_by']);
    }

    /**
     * Override `find()` ili kuchuja rekodi zilizofutwa kwa default.
     */
    public static function find()
    {
        return parent::find()->where(['user_deleted_at' => null]);
    }

    /**
     * Methodi maalum ya kuchuja na kurudisha rekodi ambazo zimefutwa pekee.
     */
    public static function onlyDeleted()
    {
        return parent::find()->where(['not', ['user_deleted_at' => null]]);
    }

    /**
     * Methodi maalum ya kupata rekodi pamoja na zilizofutwa.
     */
    public static function findWithDeleted()
    {
        return parent::find();
    }

    public function getRoles()
    {
        return Yii::$app->authManager->getRolesByUser($this->id);
    }

    public function hasRole($roleName)
    {
        return Yii::$app->authManager->checkAccess($this->id, $roleName);
    }

    public function getUserRoles()
    {
        $auth = Yii::$app->authManager;
        $roles = $auth->getRolesByUser($this->id);
        return array_keys($roles);
    }

    public function getRolesList()
    {
        $roles = Yii::$app->authManager->getRoles();
        $currentUser = Yii::$app->user->identity;

        // Hakikisha kuna mtumiaji aliyelogin
        if ($currentUser && !$currentUser->hasRole('super-admin')) {
            // Kama si super-admin, zuia baadhi ya roles
            $blockedRoles = ['super-admin', 'company-admin', 'applicant'];
            foreach ($blockedRoles as $blocked) {
                unset($roles[$blocked]);
            }
        }

        return ArrayHelper::map($roles, 'name', 'name');
    }

}
