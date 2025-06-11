<?php 
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Profile;
use app\models\JobPost;
use app\models\JobApplication;
use app\models\WorkExperience;
use app\models\Education;
use app\models\Skill;
use app\models\Language;
use app\models\Publication;
use app\models\StatusLookup;
use yii\db\Transaction;
use yii\helpers\Html;

class AnalyzeCv extends Model
{
    // job post details
    public $post_job_title;
    public $post_job_description;
    public $post_profession;
    public $post_job_type;

    // job application details
    public $applicant_user_id;

    // profile details
    public $profile_bios;
    public $profile_social_media_username;

    // work experience details
    public $experience_job_title;

    // education details
    public $education_degree_name;
    public $education_programme_name;

    // skills details
    public $skill_name;

    // languages details
    public $language_name;

    // languages details
    public $publication_title;




    public function analyze($id = null)
    {
        $transaction = Yii::$app->db->beginTransaction();

        try
        {
            if(Yii::$app->user->can('hr'))
            {
                $post = JobPost::find()
                        ->where(['id' => $id])
                        ->andWhere(['post_status_id' => StatusLookup::find()->where(['status_code' => 'published'])->select('id')->scalar()])
                        ->one();

                    if ($post !== null) {
                        $jobSummary = implode(' <br> ', [
                            'Job Title: ' . $post->post_job_title,
                            'Job Type: ' . $post->post_job_type,
                            'Description: ' . $post->post_job_description,
                            'With Profession in: ' . $post->post_profession,
                        ]);
                        // echo $jobSummary;
                    } else {
                        echo "Hakuna job post iliyopatikana.";
                    }

                $applications = JobApplication::find()
                        ->where(['applicant_status_id' => StatusLookup::find()->where(['status_code' => 'apply'])->select('id')->scalar()])
                        ->all();
                
                $userIds = [];

                foreach ($applications as $application) {
                    $userIds[] = $application->applicant_user_id;
                }

                $profiles = Profile::find()
                        ->where(['profile_status_id' => StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar()])
                        ->andWhere(['profile_user_id' => $userIds])
                        ->all();

                $experiences = WorkExperience::find()
                    ->where(['experience_status_id' => StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar()])
                    ->all();

                $experienceMap = [];
                foreach ($experiences as $exp) {
                    $profileId = $exp->experience_profile_id; // sasa tunatumia profile ID
                    $experienceString = $exp->experience_job_title; // unaweza ongeza info nyingine pia
                    if (!isset($experienceMap[$profileId])) {
                        $experienceMap[$profileId] = [];
                    }
                    $experienceMap[$profileId][] = $experienceString;
                }

                $educations = Education::find()
                    ->where(['education_status_id' => StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar()])
                    ->all();

                $educationMap = [];
                foreach ($educations as $edu) {
                    $profileId = $edu->education_profile_id;
                    $educationString = $edu->education_degree_name . ' in ' . $edu->education_programme_name;
                    if (!isset($educationMap[$profileId])) {
                        $educationMap[$profileId] = [];
                    }
                    $educationMap[$profileId][] = $educationString;
                }

                $skills = Skill::find()
                    ->where(['skill_status_id' => StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar()])
                    ->all();

                $skillMap = [];
                foreach ($skills as $skill) {
                    $profileId = $skill->skill_profile_id;
                    $skillString = $skill->skill_name;
                    if (!isset($skillMap[$profileId])) {
                        $skillMap[$profileId] = [];
                    }
                    $skillMap[$profileId][] = $skillString;
                }

                $languages = Language::find()
                    ->where(['language_status_id' => StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar()])
                    ->all();

                $languageMap = [];
                foreach ($languages as $lang) {
                    $profileId = $lang->language_profile_id;
                    $languageString = $lang->language_name;
                    if (!isset($languageMap[$profileId])) {
                        $languageMap[$profileId] = [];
                    }
                    $languageMap[$profileId][] = $languageString;
                }

                $publications = Publication::find()
                    ->where(['publication_status_id' => StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar()])
                    ->all();

                $publicationMap = [];
                foreach ($publications as $pub) {
                    $profileId = $pub->publication_profile_id;
                    $publicationString = $pub->publication_title;
                    if (!isset($publicationMap[$profileId])) {
                        $publicationMap[$profileId] = [];
                    }
                    $publicationMap[$profileId][] = $publicationString;
                }

                $profileData = [];

                foreach ($profiles as $profile) {
                    $profileId = $profile->id; // tumia profile ID hapa sasa

                    $experienceText = isset($experienceMap[$profileId]) ? implode(', ', $experienceMap[$profileId]) : 'No experience';

                    $educationText = isset($educationMap[$profileId]) ? implode(', ', $educationMap[$profileId]) : 'No education';

                    $skillText = isset($skillMap[$profileId]) ? implode(', ', $skillMap[$profileId]) : 'No skills';

                    $languageText = isset($languageMap[$profileId]) ? implode(', ', $languageMap[$profileId]) : 'No languages';

                    $publicationText = isset($publicationMap[$profileId]) ? implode(', ', $publicationMap[$profileId]) : 'No publications';

                    $applicationString = 'Bios: ' . $profile->profile_bios . '<br>' .
                                        'Social media username: ' . $profile->profile_social_media_username . '<br>' .
                                        'Experience: ' . $experienceText. '<br>' .
                                        'Education: ' . $educationText. '<br>' .
                                        'Skills: ' . $skillText. '<br>' .
                                        'Languages: ' . $languageText. '<br>' .
                                        'Publications: ' . $publicationText;

                    $profileData[] = [
                        'user_id' => $profile->profile_user_id, // bado tunarudisha user_id kama reference
                        'application' => $applicationString,
                    ];
                }
                return $profileData;

                
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