<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property int $profile_user_id
 * @property string $profile_first_name
 * @property string|null $profile_middle_name
 * @property string $profile_last_name
 * @property string $profile_social_media_username
 * @property string $profile_date_of_birth
 * @property string|null $profile_bios
 * @property int $profile_region_id
 * @property int $profile_district_id
 * @property string|null $profile_local_address
 * @property int $profile_status_id
 * @property string $profile_created_at
 * @property int|null $profile_created_by
 * @property string $profile_updated_at
 * @property int|null $profile_updated_by
 * @property string|null $profile_deleted_at
 * @property int|null $profile_deleted_by
 *
 * @property Award[] $awards
 * @property District $district
 * @property Education[] $educations
 * @property Language[] $languages
 * @property PersonalityAssessment[] $personalityAssessments
 * @property PhoneNumber[] $phoneNumbers
 * @property Publication[] $publications
 * @property Region $region
 * @property Skill[] $skills
 * @property StatusLookup $statusLookup
 * @property User $user
 * @property User $user0
 * @property User $user1
 * @property User $user2
 * @property WorkExperience[] $workExperiences
 */
class Profile extends \yii\db\ActiveRecord
{

    // phone number details
        public $phone_number;

        // work experience details
        public $experience_job_title;
        public $experience_company_name;
        public $experience_from;
        public $experience_to;

        // education details
        public $education_degree_name;
        public $education_programme_name;
        public $education_university_name;
        public $education_graduation_date;

        // skill details
        public $skill_type;
        public $skill_name;

        // award details
        public $award_title;
        public $award_organization_name;
        public $award_issue_number;
        public $award_date_of_issue;

        // language details
        public $language_name;

        // publication details
        public $publication_title;
        public $publication_publisher_name;
        public $publication_date_of_publication;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['profile_middle_name', 'profile_bios', 'profile_local_address', 'profile_created_by', 'profile_updated_by', 'profile_deleted_at', 'profile_deleted_by'], 'default', 'value' => null],
            [['profile_user_id', 'profile_first_name', 'profile_last_name', 'profile_social_media_username', 'profile_date_of_birth', 'profile_region_id', 'profile_district_id', 'profile_status_id'], 'required'],
            [['profile_user_id', 'profile_region_id', 'profile_district_id', 'profile_status_id', 'profile_created_by', 'profile_updated_by', 'profile_deleted_by'], 'integer'],
            [['profile_date_of_birth', 'profile_created_at', 'profile_updated_at', 'profile_deleted_at'], 'safe'],
            [['profile_bios'], 'string'],
            [['profile_first_name', 'profile_middle_name', 'profile_last_name'], 'string', 'max' => 100],
            [['profile_social_media_username', 'profile_local_address'], 'string', 'max' => 255],
            [['profile_created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['profile_created_by' => 'id']],
            [['profile_deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['profile_deleted_by' => 'id']],
            [['profile_district_id'], 'exist', 'skipOnError' => true, 'targetClass' => District::class, 'targetAttribute' => ['profile_district_id' => 'id']],
            [['profile_region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::class, 'targetAttribute' => ['profile_region_id' => 'id']],
            [['profile_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusLookup::class, 'targetAttribute' => ['profile_status_id' => 'id']],
            [['profile_updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['profile_updated_by' => 'id']],
            [['profile_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['profile_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'profile_user_id' => Yii::t('app', 'Profile User Name'),
            'profile_first_name' => Yii::t('app', 'Profile First Name'),
            'profile_middle_name' => Yii::t('app', 'Profile Middle Name'),
            'profile_last_name' => Yii::t('app', 'Profile Last Name'),
            'profile_social_media_username' => Yii::t('app', 'Profile Social Media Username'),
            'profile_date_of_birth' => Yii::t('app', 'Profile Date Of Birth'),
            'profile_bios' => Yii::t('app', 'Profile Bios'),
            'profile_region_id' => Yii::t('app', 'Profile Region Name'),
            'profile_district_id' => Yii::t('app', 'Profile District Name'),
            'profile_local_address' => Yii::t('app', 'Profile Local Address'),
            'profile_status_id' => Yii::t('app', 'Profile Status Name'),
            'profile_created_at' => Yii::t('app', 'Profile Created At'),
            'profile_created_by' => Yii::t('app', 'Profile Created By'),
            'profile_updated_at' => Yii::t('app', 'Profile Updated At'),
            'profile_updated_by' => Yii::t('app', 'Profile Updated By'),
            'profile_deleted_at' => Yii::t('app', 'Profile Deleted At'),
            'profile_deleted_by' => Yii::t('app', 'Profile Deleted By'),
        ];
    }

    /**
     * Gets query for [[Awards]].
     *
     * @return \yii\db\ActiveQuery|AwardQuery
     */
    public function getAwards()
    {
        return $this->hasMany(Award::class, ['award_profile_id' => 'id']);
    }

    /**
     * Gets query for [[District]].
     *
     * @return \yii\db\ActiveQuery|DistrictQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(District::class, ['id' => 'profile_district_id']);
    }

    /**
     * Gets query for [[Educations]].
     *
     * @return \yii\db\ActiveQuery|EducationQuery
     */
    public function getEducations()
    {
        return $this->hasMany(Education::class, ['education_profile_id' => 'id']);
    }

    /**
     * Gets query for [[Languages]].
     *
     * @return \yii\db\ActiveQuery|LanguageQuery
     */
    public function getLanguages()
    {
        return $this->hasMany(Language::class, ['language_profile_id' => 'id']);
    }

    /**
     * Gets query for [[PersonalityAssessments]].
     *
     * @return \yii\db\ActiveQuery|PersonalityAssessmentQuery
     */
    public function getPersonalityAssessments()
    {
        return $this->hasMany(PersonalityAssessment::class, ['personality_profile_id' => 'id']);
    }

    /**
     * Gets query for [[PhoneNumbers]].
     *
     * @return \yii\db\ActiveQuery|PhoneNumberQuery
     */
    public function getPhoneNumbers()
    {
        return $this->hasMany(PhoneNumber::class, ['phone_profile_id' => 'id']);
    }

    /**
     * Gets query for [[Publications]].
     *
     * @return \yii\db\ActiveQuery|PublicationQuery
     */
    public function getPublications()
    {
        return $this->hasMany(Publication::class, ['publication_profile_id' => 'id']);
    }

    /**
     * Gets query for [[Region]].
     *
     * @return \yii\db\ActiveQuery|RegionQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::class, ['id' => 'profile_region_id']);
    }

    /**
     * Gets query for [[Skills]].
     *
     * @return \yii\db\ActiveQuery|SkillQuery
     */
    public function getSkills()
    {
        return $this->hasMany(Skill::class, ['skill_profile_id' => 'id']);
    }

    /**
     * Gets query for [[StatusLookup]].
     *
     * @return \yii\db\ActiveQuery|StatusLookupQuery
     */
    public function getStatusLookup()
    {
        return $this->hasOne(StatusLookup::class, ['id' => 'profile_status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'profile_created_by']);
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::class, ['id' => 'profile_deleted_by']);
    }

    /**
     * Gets query for [[User1]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser1()
    {
        return $this->hasOne(User::class, ['id' => 'profile_updated_by']);
    }

    /**
     * Gets query for [[User2]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser2()
    {
        return $this->hasOne(User::class, ['id' => 'profile_user_id']);
    }

    /**
     * Gets query for [[WorkExperiences]].
     *
     * @return \yii\db\ActiveQuery|WorkExperienceQuery
     */
    public function getWorkExperiences()
    {
        return $this->hasMany(WorkExperience::class, ['experience_profile_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ProfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProfileQuery(get_called_class());
    }

}
