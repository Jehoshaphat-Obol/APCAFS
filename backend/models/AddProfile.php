<?php 
    namespace app\models;

    use Yii;
    use yii\base\Model;
    use app\models\Profile;
    use app\models\PhoneNumber;
    use app\models\WorkExperience;
    use app\models\Education;
    use app\models\Skill;
    use app\models\Award;
    use app\models\Language;
    use app\models\Publication;
    use app\models\StatusLookup;
    use yii\db\Transaction;
    use yii\helpers\Html;

    class AddProfile extends Model
    {
        // applicant profile details
        public $profile_first_name;
        public $profile_middle_name;
        public $profile_last_name;
        public $profile_social_media_username;
        public $profile_date_of_birth;
        public $profile_bios;
        public $profile_region_id;
        public $profile_district_id;
        public $profile_local_address;

        // phone number details
        public $phone_number = [];

        // work experience details
        public $experiences = []; 

        // education details
        public $educations = [];

        // skill details
        public $skills = [];

        // award details
        public $awards = [];

        // language details
        public $languages = [];

        // publication details
        public $publications = [];

        /**
         * {@inheritdoc}
         */
        public function rules()
        {
            return [
                // Required fields for profile
                [['profile_first_name', 'profile_last_name', 'profile_social_media_username', 'profile_date_of_birth', 'profile_region_id', 'profile_district_id', 'phone_number', 'profile_bios'], 'required'],

                // Integer fields
                [['profile_region_id', 'profile_district_id'], 'integer'],

                // Safe attributes (no special validation but still accepted as input)
                [['profile_date_of_birth'], 'safe'],

                // String length validations
                [['profile_first_name', 'profile_middle_name', 'profile_last_name'], 'string', 'max' => 100],
                [['profile_social_media_username', 'profile_local_address'], 'string', 'max' => 255],
                [['profile_bios'], 'string'],

                // Phone number validation
                ['phone_number', 'string', 'max' => 10],
                ['phone_number', 'each', 'rule' => ['match', 'pattern' => '/^\d{10}$/', 'message' => 'Phone number must be numeric and exactly 10 digits.']],

                // Experience
                ['experiences', 'each', 'rule' => ['safe']],
                ['experiences', 'each', 'rule' => function($attribute, $params, $validator) {
                    foreach ($this->$attribute as $index => $experience) {
                        if (empty($experience['job_title']) || empty($experience['company_name']) || empty($experience['from']) || empty($experience['to'])) {
                            $this->addError($attribute . "[$index]", 'All experience fields are required.');
                        }
                    }
                }],

                // Education
                ['educations', 'each', 'rule' => ['safe']],
                ['educations', 'each', 'rule' => function($attribute, $params, $validator) {
                    foreach ($this->$attribute as $index => $edu) {
                        if (empty($edu['degree_name']) || empty($edu['programme_name']) || empty($edu['university_name']) || empty($edu['graduation_date'])) {
                            $this->addError($attribute . "[$index]", 'All education fields are required.');
                        }
                    }
                }],

                // Skills
                ['skills', 'each', 'rule' => ['safe']],
                ['skills', 'each', 'rule' => function($attribute, $params, $validator) {
                    foreach ($this->$attribute as $index => $skill) {
                        if (empty($skill['skill_type']) || empty($skill['skill_name'])) {
                            $this->addError($attribute . "[$index]", 'All skill fields are required.');
                        }
                    }
                }],

                // Awards
                ['awards', 'each', 'rule' => ['safe']],
                ['awards', 'each', 'rule' => function($attribute, $params, $validator) {
                    foreach ($this->$attribute as $index => $award) {
                        if (empty($award['title']) || empty($award['organization_name']) || empty($award['issue_number']) || empty($award['date_of_issue'])) {
                            $this->addError($attribute . "[$index]", 'All award fields are required.');
                        }
                    }
                }],

                // Languages
                ['languages', 'each', 'rule' => ['safe']],
                ['languages', 'each', 'rule' => function($attribute, $params, $validator) {
                    foreach ($this->$attribute as $index => $lang) {
                        if (empty($lang['name'])) {
                            $this->addError($attribute . "[$index]", 'Language name is required.');
                        }
                    }
                }],

                // Publications
                ['publications', 'each', 'rule' => ['safe']],
                ['publications', 'each', 'rule' => function($attribute, $params, $validator) {
                    foreach ($this->$attribute as $index => $pub) {
                        if (empty($pub['title']) || empty($pub['publisher_name']) || empty($pub['date_of_publication'])) {
                            $this->addError($attribute . "[$index]", 'All publication fields are required.');
                        }
                    }
                }],
            ];
        }
        /**
         * {@inheritdoc}
         */
        public function attributeLabels()
        {
            return [
                'profile_first_name' => Yii::t('app', 'First Name'),
                'profile_middle_name' => Yii::t('app', 'Middle Name'),
                'profile_last_name' => Yii::t('app', 'Last Name'),
                'profile_social_media_username' => Yii::t('app', 'Social Media Username'),
                'profile_date_of_birth' => Yii::t('app', 'Date Of Birth'),
                'profile_bios' => Yii::t('app', 'Bios'),
                'profile_region_id' => Yii::t('app', 'Residential Region'),
                'profile_district_id' => Yii::t('app', 'Residential District'),
                'profile_local_address' => Yii::t('app', 'Residential Local Address'),
                'phone_number' => Yii::t('app', 'Phone Number'),
                'experience_job_title' => Yii::t('app', 'Experience Job Title'),
                'experience_company_name' => Yii::t('app', 'Experience Company Name'),
                'experience_from' => Yii::t('app', 'Experience From'),
                'experience_to' => Yii::t('app', 'Experience To'),
                'education_degree_name' => Yii::t('app', 'Education Degree Name'),
                'education_programme_name' => Yii::t('app', 'Education Programme Name'),
                'education_university_name' => Yii::t('app', 'Education University Name'),
                'education_graduation_date' => Yii::t('app', 'Education Graduation Date'),
                'skill_type' => Yii::t('app', 'Skill Type'),
                'skill_name' => Yii::t('app', 'Skill Name'),
                'award_title' => Yii::t('app', 'Award Title'),
                'award_organization_name' => Yii::t('app', 'Award Organization Name'),
                'award_issue_number' => Yii::t('app', 'Award Issue Number'),
                'award_date_of_issue' => Yii::t('app', 'Award Date Of Issue'),
                'language_name' => Yii::t('app', 'Language Name'),
                'publication_title' => Yii::t('app', 'Publication Title'),
                'publication_publisher_name' => Yii::t('app', 'Publication Publisher Name'),
                'publication_date_of_publication' => Yii::t('app', 'Publication Date Of Publication'),
            ];
        }

        public function save()
        {
            $transaction = Yii::$app->db->beginTransaction();

            try
            {
                if(Yii::$app->user->can('applicant'))
                {
                    $profile = new Profile();
                    $profile->profile_user_id = Yii::$app->user->id;
                    $profile->profile_first_name = $this->profile_first_name;
                    $profile->profile_middle_name = $this->profile_middle_name;
                    $profile->profile_last_name = $this->profile_last_name;
                    $profile->profile_social_media_username = $this->profile_social_media_username;
                    $profile->profile_date_of_birth = $this->profile_date_of_birth;
                    $profile->profile_bios = $this->profile_bios;
                    $profile->profile_region_id = $this->profile_region_id;
                    $profile->profile_district_id = $this->profile_district_id;
                    $profile->profile_local_address = $this->profile_local_address;
                    $profile->profile_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
                    $profile->profile_created_by = Yii::$app->user->id;

                    if(!$profile->save())
                    {
                        throw new \Exception('Failed to save your profile'. Html::errorSummary($profile));
                        return false;
                    }

                    foreach ($this->phone_number as $number) {
                        $phone = new PhoneNumber();
                        $phone->phone_profile_id = $profile->id;
                        $phone->phone_number = $number['phone_number'];  // get the string from array
                        $phone->phone_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
                        $phone->phone_created_by = Yii::$app->user->id;

                        if (!$phone->save()) {
                            throw new \Exception('Failed to save phone number: ' . $number['phone_number'] . Html::errorSummary($phone));
                            return false;
                        }
                    }

                    if (!empty($this->experiences)) {
                        foreach ($this->experiences as $exp) {
                            $experience = new WorkExperience();
                            $experience->experience_profile_id = $profile->id;
                            $experience->experience_job_title = $exp['experience_job_title'];
                            $experience->experience_company_name = $exp['experience_company_name'];
                            $experience->experience_from = $exp['experience_from'];
                            $experience->experience_to = $exp['experience_to'];
                            $experience->experience_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
                            $experience->experience_created_by = Yii::$app->user->id;

                            if (!$experience->save()) {
                                throw new \Exception('Failed to save work experience: ' . Html::errorSummary($experience));
                            }
                        }
                    }

                    if (!empty($this->educations)) {
                        foreach ($this->educations as $edu) {
                            $education = new Education();
                            $education->education_profile_id = $profile->id;
                            $education->education_degree_name = $edu['education_degree_name'] ?? null;
                            $education->education_programme_name = $edu['education_programme_name'] ?? null;
                            $education->education_university_name = $edu['education_university_name'] ?? null;
                            $education->education_graduation_date = $edu['education_graduation_date'] ?? null;
                            $education->education_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
                            $education->education_created_by = Yii::$app->user->id;

                            if (!$education->save()) {
                                throw new \Exception('Failed to save education entry: ' . Html::errorSummary($education));
                            }
                        }
                    }


                    if (!empty($this->skills)) {
                        foreach ($this->skills as $skillItem) {
                            $skill = new Skill();
                            $skill->skill_profile_id = $profile->id;
                            $skill->skill_type = $skillItem['skill_type'] ?? null;
                            $skill->skill_name = $skillItem['skill_name'] ?? null;
                            $skill->skill_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
                            $skill->skill_created_by = Yii::$app->user->id;

                            if (!$skill->save()) {
                                throw new \Exception('Failed to save skill: ' . Html::errorSummary($skill));
                            }
                        }
                    }

                    if (!empty($this->awards)) {
                        foreach ($this->awards as $awardItem) {
                            $award = new Award();
                            $award->award_profile_id = $profile->id;
                            $award->award_title = $awardItem['award_title'] ?? null;
                            $award->award_organization_name = $awardItem['award_organization_name'] ?? null;
                            $award->award_issue_number = $awardItem['award_issue_number'] ?? null;
                            $award->award_date_of_issue = $awardItem['award_date_of_issue'] ?? null;
                            $award->award_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
                            $award->award_created_by = Yii::$app->user->id;

                            if (!$award->save()) {
                                throw new \Exception('Failed to save award: ' . Html::errorSummary($award));
                            }
                        }
                    }

                    if (!empty($this->languages)) {
                        foreach ($this->languages as $languageItem) {
                            $language = new Language();
                            $language->language_profile_id = $profile->id;
                            $language->language_name = $languageItem['language_name'] ?? null;
                            $language->language_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
                            $language->language_created_by = Yii::$app->user->id;

                            if (!$language->save()) {
                                throw new \Exception('Failed to save language: ' . Html::errorSummary($language));
                            }
                        }
                    }

                    if (!empty($this->publications)) {
                        foreach ($this->publications as $publicationItem) {
                            $publication = new Publication();
                            $publication->publication_profile_id = $profile->id;
                            $publication->publication_title = $publicationItem['publication_title'] ?? null;
                            $publication->publication_publisher_name = $publicationItem['publication_publisher_name'] ?? null;
                            $publication->publication_date_of_publication = $publicationItem['publication_date_of_publication'] ?? null;
                            $publication->publication_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
                            $publication->publication_created_by = Yii::$app->user->id;

                            if (!$publication->save()) {
                                throw new \Exception('Failed to save publication: ' . Html::errorSummary($publication));
                            }
                        }
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

        public function update($profileId)
        {
            $transaction = Yii::$app->db->beginTransaction();

            try {
                if (!Yii::$app->user->can('applicant')) {
                    throw new \Exception("Forbidden to perform this action");
                }

                $profile = Profile::findOne([
                    'id' => $profileId,
                    'profile_user_id' => Yii::$app->user->id
                ]);

                if (!$profile) {
                    throw new \Exception("Profile not found or access denied.");
                }

                // Update profile fields
                $profile->profile_first_name = $this->profile_first_name;
                $profile->profile_middle_name = $this->profile_middle_name;
                $profile->profile_last_name = $this->profile_last_name;
                $profile->profile_social_media_username = $this->profile_social_media_username;
                $profile->profile_date_of_birth = $this->profile_date_of_birth;
                $profile->profile_bios = $this->profile_bios;
                $profile->profile_region_id = $this->profile_region_id;
                $profile->profile_district_id = $this->profile_district_id;
                $profile->profile_local_address = $this->profile_local_address;
                $profile->profile_updated_by = Yii::$app->user->id;
                $profile->profile_updated_at = date('Y-m-d H:i:s');

                if (!$profile->save()) {
                    throw new \Exception('Failed to update your profile: ' . Html::errorSummary($profile));
                }

                // ==== DELETE OLD DATA FIRST ====
                PhoneNumber::deleteAll(['phone_profile_id' => $profile->id]);
                WorkExperience::deleteAll(['experience_profile_id' => $profile->id]);
                Education::deleteAll(['education_profile_id' => $profile->id]);
                Skill::deleteAll(['skill_profile_id' => $profile->id]);
                Award::deleteAll(['award_profile_id' => $profile->id]);
                Language::deleteAll(['language_profile_id' => $profile->id]);
                Publication::deleteAll(['publication_profile_id' => $profile->id]);

                // ==== INSERT NEW DATA ====

                foreach ($this->phone_number as $number) {
                    $phone = new PhoneNumber();
                    $phone->phone_profile_id = $profile->id;
                    $phone->phone_number = $number['phone_number'];
                    $phone->phone_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
                    $phone->phone_created_by = Yii::$app->user->id;

                    if (!$phone->save()) {
                        throw new \Exception('Failed to save phone number: ' . Html::errorSummary($phone));
                    }
                }

                foreach ($this->experiences as $exp) {
                    $experience = new WorkExperience();
                    $experience->experience_profile_id = $profile->id;
                    $experience->experience_job_title = $exp['experience_job_title'];
                    $experience->experience_company_name = $exp['experience_company_name'];
                    $experience->experience_from = $exp['experience_from'];
                    $experience->experience_to = $exp['experience_to'];
                    $experience->experience_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
                    $experience->experience_created_by = Yii::$app->user->id;

                    if (!$experience->save()) {
                        throw new \Exception('Failed to save work experience: ' . Html::errorSummary($experience));
                    }
                }

                foreach ($this->educations as $edu) {
                    $education = new Education();
                    $education->education_profile_id = $profile->id;
                    $education->education_degree_name = $edu['education_degree_name'] ?? null;
                    $education->education_programme_name = $edu['education_programme_name'] ?? null;
                    $education->education_university_name = $edu['education_university_name'] ?? null;
                    $education->education_graduation_date = $edu['education_graduation_date'] ?? null;
                    $education->education_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
                    $education->education_created_by = Yii::$app->user->id;

                    if (!$education->save()) {
                        throw new \Exception('Failed to save education entry: ' . Html::errorSummary($education));
                    }
                }

                foreach ($this->skills as $skillItem) {
                    $skill = new Skill();
                    $skill->skill_profile_id = $profile->id;
                    $skill->skill_type = $skillItem['skill_type'] ?? null;
                    $skill->skill_name = $skillItem['skill_name'] ?? null;
                    $skill->skill_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
                    $skill->skill_created_by = Yii::$app->user->id;

                    if (!$skill->save()) {
                        throw new \Exception('Failed to save skill: ' . Html::errorSummary($skill));
                    }
                }

                foreach ($this->awards as $awardItem) {
                    $award = new Award();
                    $award->award_profile_id = $profile->id;
                    $award->award_title = $awardItem['award_title'] ?? null;
                    $award->award_organization_name = $awardItem['award_organization_name'] ?? null;
                    $award->award_issue_number = $awardItem['award_issue_number'] ?? null;
                    $award->award_date_of_issue = $awardItem['award_date_of_issue'] ?? null;
                    $award->award_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
                    $award->award_created_by = Yii::$app->user->id;

                    if (!$award->save()) {
                        throw new \Exception('Failed to save award: ' . Html::errorSummary($award));
                    }
                }

                foreach ($this->languages as $languageItem) {
                    $language = new Language();
                    $language->language_profile_id = $profile->id;
                    $language->language_name = $languageItem['language_name'] ?? null;
                    $language->language_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
                    $language->language_created_by = Yii::$app->user->id;

                    if (!$language->save()) {
                        throw new \Exception('Failed to save language: ' . Html::errorSummary($language));
                    }
                }

                foreach ($this->publications as $publicationItem) {
                    $publication = new Publication();
                    $publication->publication_profile_id = $profile->id;
                    $publication->publication_title = $publicationItem['publication_title'] ?? null;
                    $publication->publication_publisher_name = $publicationItem['publication_publisher_name'] ?? null;
                    $publication->publication_date_of_publication = $publicationItem['publication_date_of_publication'] ?? null;
                    $publication->publication_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
                    $publication->publication_created_by = Yii::$app->user->id;

                    if (!$publication->save()) {
                        throw new \Exception('Failed to save publication: ' . Html::errorSummary($publication));
                    }
                }

                $transaction->commit();
                return true;

            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        }
    }
?>