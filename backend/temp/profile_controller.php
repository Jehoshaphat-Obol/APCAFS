<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\db\Transaction;
use app\models\Profile;
use app\models\PhoneNumber;
use app\models\WorkExperience;
use app\models\Education;
use app\models\Skill;
use app\models\Award;
use app\models\Language;
use app\models\Publication;
use app\models\Region;
use app\models\District;

class ProfileController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'create' => ['GET', 'POST'],
                    'save-step' => ['POST'],
                ],
            ],
        ];
    }

    public function actionCreate()
    {
        $session = Yii::$app->session;
        
        // Initialize session data if not exists
        if (!$session->has('profile_form_data')) {
            $session->set('profile_form_data', [
                'profile' => [],
                'phone_numbers' => [],
                'work_experiences' => [],
                'educations' => [],
                'skills' => [],
                'awards' => [],
                'languages' => [],
                'publications' => [],
                'current_step' => 1,
                'completed_steps' => []
            ]);
        }

        $formData = $session->get('profile_form_data');
        $currentStep = $formData['current_step'];

        // Load dropdown data
        $regions = Region::find()->where(['region_status_id' => 1])->all();
        $districts = [];
        
        if (!empty($formData['profile']['profile_region_id'])) {
            $districts = District::find()
                ->where(['district_region_id' => $formData['profile']['profile_region_id']])
                ->andWhere(['district_status_id' => 1])
                ->all();
        }

        return $this->render('create', [
            'currentStep' => $currentStep,
            'formData' => $formData,
            'regions' => $regions,
            'districts' => $districts,
        ]);
    }

    public function actionSaveStep()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        
        $step = $request->post('step');
        $formData = $session->get('profile_form_data');
        
        try {
            switch ($step) {
                case 1: // Personal Information
                    $formData['profile'] = array_merge($formData['profile'], [
                        'profile_first_name' => $request->post('profile_first_name'),
                        'profile_middle_name' => $request->post('profile_middle_name'),
                        'profile_last_name' => $request->post('profile_last_name'),
                        'profile_social_media_username' => $request->post('profile_social_media_username'),
                        'profile_date_of_birth' => $request->post('profile_date_of_birth'),
                        'profile_bios' => $request->post('profile_bios'),
                    ]);
                    break;

                case 2: // Location & Contact
                    $formData['profile'] = array_merge($formData['profile'], [
                        'profile_region_id' => $request->post('profile_region_id'),
                        'profile_district_id' => $request->post('profile_district_id'),
                        'profile_local_address' => $request->post('profile_local_address'),
                    ]);
                    $formData['phone_numbers'] = $request->post('phone_numbers', []);
                    break;

                case 3: // Education
                    $formData['educations'] = $request->post('educations', []);
                    break;

                case 4: // Work Experience
                    $formData['work_experiences'] = $request->post('work_experiences', []);
                    break;

                case 5: // Skills & Languages
                    $formData['skills'] = $request->post('skills', []);
                    $formData['languages'] = $request->post('languages', []);
                    break;

                case 6: // Awards & Publications
                    $formData['awards'] = $request->post('awards', []);
                    $formData['publications'] = $request->post('publications', []);
                    break;

                case 7: // Final Submission
                    return $this->finalSubmission($formData);
            }

            // Mark step as completed
            if (!in_array($step, $formData['completed_steps'])) {
                $formData['completed_steps'][] = $step;
            }

            // Move to next step
            if ($step < 7) {
                $formData['current_step'] = $step + 1;
            }

            $session->set('profile_form_data', $formData);

            return [
                'success' => true,
                'message' => 'Step saved successfully',
                'nextStep' => $formData['current_step']
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Error saving step: ' . $e->getMessage()
            ];
        }
    }

    private function finalSubmission($formData)
    {
        $transaction = Yii::$app->db->beginTransaction();
        
        try {
            // Create Profile
            $profile = new Profile();
            $profile->profile_user_id = Yii::$app->user->id;
            $profile->profile_status_id = 1;
            $profile->profile_created_by = Yii::$app->user->id;
            
            foreach ($formData['profile'] as $key => $value) {
                if ($profile->hasAttribute($key)) {
                    $profile->$key = $value;
                }
            }
            
            if (!$profile->save()) {
                throw new \Exception('Failed to save profile: ' . json_encode($profile->errors));
            }

            // Save Phone Numbers
            foreach ($formData['phone_numbers'] as $phoneData) {
                if (!empty($phoneData['phone_number'])) {
                    $phone = new PhoneNumber();
                    $phone->phone_profile_id = $profile->id;
                    $phone->phone_status_id = 1;
                    $phone->phone_created_by = Yii::$app->user->id;
                    $phone->phone_number = $phoneData['phone_number'];
                    $phone->save();
                }
            }

            // Save Education
            foreach ($formData['educations'] as $eduData) {
                if (!empty($eduData['education_degree_name'])) {
                    $education = new Education();
                    $education->education_profile_id = $profile->id;
                    $education->education_status_id = 1;
                    $education->education_created_by = Yii::$app->user->id;
                    foreach ($eduData as $key => $value) {
                        if ($education->hasAttribute($key)) {
                            $education->$key = $value;
                        }
                    }
                    $education->save();
                }
            }

            // Save Work Experience
            foreach ($formData['work_experiences'] as $expData) {
                if (!empty($expData['experience_company_name'])) {
                    $experience = new WorkExperience();
                    $experience->experience_profile_id = $profile->id;
                    $experience->experience_status_id = 1;
                    $experience->experience_created_by = Yii::$app->user->id;
                    foreach ($expData as $key => $value) {
                        if ($experience->hasAttribute($key)) {
                            $experience->$key = $value;
                        }
                    }
                    $experience->save();
                }
            }

            // Save Skills
            foreach ($formData['skills'] as $skillData) {
                if (!empty($skillData['skill_name'])) {
                    $skill = new Skill();
                    $skill->skill_profile_id = $profile->id;
                    $skill->skill_status_id = 1;
                    $skill->skill_created_by = Yii::$app->user->id;
                    foreach ($skillData as $key => $value) {
                        if ($skill->hasAttribute($key)) {
                            $skill->$key = $value;
                        }
                    }
                    $skill->save();
                }
            }

            // Save Languages
            foreach ($formData['languages'] as $langData) {
                if (!empty($langData['language_name'])) {
                    $language = new Language();
                    $language->language_profile_id = $profile->id;
                    $language->language_status_id = 1;
                    $language->language_created_by = Yii::$app->user->id;
                    foreach ($langData as $key => $value) {
                        if ($language->hasAttribute($key)) {
                            $language->$key = $value;
                        }
                    }
                    $language->save();
                }
            }

            // Save Awards
            foreach ($formData['awards'] as $awardData) {
                if (!empty($awardData['award_title'])) {
                    $award = new Award();
                    $award->award_profile_id = $profile->id;
                    $award->award_status_id = 1;
                    $award->award_created_by = Yii::$app->user->id;
                    foreach ($awardData as $key => $value) {
                        if ($award->hasAttribute($key)) {
                            $award->$key = $value;
                        }
                    }
                    $award->save();
                }
            }

            // Save Publications
            foreach ($formData['publications'] as $pubData) {
                if (!empty($pubData['publication_title'])) {
                    $publication = new Publication();
                    $publication->publication_profile_id = $profile->id;
                    $publication->publication_status_id = 1;
                    $publication->publication_created_by = Yii::$app->user->id;
                    foreach ($pubData as $key => $value) {
                        if ($publication->hasAttribute($key)) {
                            $publication->$key = $value;
                        }
                    }
                    $publication->save();
                }
            }

            $transaction->commit();
            
            // Clear session data
            Yii::$app->session->remove('profile_form_data');
            
            return [
                'success' => true,
                'message' => 'Profile created successfully!',
                'redirect' => '/profile/view?id=' . $profile->id
            ];

        } catch (\Exception $e) {
            $transaction->rollBack();
            return [
                'success' => false,
                'message' => 'Error creating profile: ' . $e->getMessage()
            ];
        }
    }

    public function actionGetDistricts($regionId)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $districts = District::find()
            ->where(['district_region_id' => $regionId])
            ->andWhere(['district_status_id' => 1])
            ->all();
            
        $result = [];
        foreach ($districts as $district) {
            $result[] = [
                'id' => $district->id,
                'name' => $district->district_name
            ];
        }
        
        return $result;
    }
}