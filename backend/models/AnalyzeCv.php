<?php 
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Profile;
use app\models\JobPost;
use app\models\PersonalityAssessment;
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

    // Personality Assessment details
    public $personality_profile_id;
    public $personality_IE_score;
    public $personality_NS_score;
    public $personality_TF_score;
    public $personality_JB_score;
    public $personality_last_analysis_date;

    public function analyze($id = null)
    {
        $transaction = Yii::$app->db->beginTransaction();

        try
        {
            if(Yii::$app->user->can('hr'))
            {
		$twitterEndpoint = Yii::$app->params['pAssessment'];

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
		    $pAssessmentData[] = [
			'profile_id' => $profile->profile_user_id,
		        'social_media_username' => $profile->profile_social_media_username,
		    ];
                    $profileData[] = [
                        'user_id' => $profile->profile_user_id, // bado tunarudisha user_id kama reference
                        'application' => $applicationString,
                    ];
                }

                // Prepare the payload
                $payload = json_encode(['personality_assessment' => $pAssessmentData]);

                // Make the POST request using cURL
                $ch = curl_init($twitterEndpoint."/assess/");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($payload)
                ]);

                $response = curl_exec($ch);
                curl_close($ch);

                // Echo the response (in real use, you may want to return JSON or render it)
                // echo "<pre>";
                // print_r(json_decode($response, true));
                // echo "</pre>";
                //             return json_decode($response, true);

                // saving personality Assessment data
                if (isset($response['results']) && is_array($response['results'])) {
                    $rows = [];
                    $requiredKeys = ['profile_id', 'IE_score', 'NS_score', 'TF_score', 'JB_score'];

                    foreach ($response['results'] as $record) {

                        // Check kama key zote muhimu zipo kabla ya ku-save
                        $allKeysExist = true;
                        foreach ($requiredKeys as $key) {
                            if (!isset($record[$key])) {
                                $allKeysExist = false;
                                break;  // Ikiwa hata key moja haipo, tunaacha
                            }
                        }

                        if (!$allKeysExist) {
                            Yii::error("Missing required keys in record: " . json_encode($record));
                            continue;
                        }

                        // Kuandaa row ya ku-save
                        $rows[] = [
                            $record['personality_profile_id'],
                            $record['personality_IE_score'],
                            $record['personality_NS_score'],
                            $record['personality_TF_score'],
                            $record['personality_JB_score'],
                            StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar(), // personality_status_id
                            date('Y-m-d'), // personality_last_analysis_date
                            Yii::$app->user->id ?? null, // personality_created_by
                        ];
                    }

                    if (!empty($rows)) {
                        $columns = [
                            'personality_profile_id',
                            'personality_IE_score',
                            'personality_NS_score',
                            'personality_TF_score',
                            'personality_JB_score',
                            'personality_status_id',
                            'personality_last_analysis_date',
                            'personality_created_by',
                        ];

                        try {
                            Yii::$app->db->createCommand()
                                ->batchInsert('personality_assessment', $columns, $rows)
                                ->execute();
                            Yii::$app->session->setFlash('success', 'All valid assessments saved successfully.');
                        } catch (\Exception $e) {
                            Yii::error("Batch insert failed: " . $e->getMessage());
                            Yii::$app->session->setFlash('error', 'Failed to save assessments.');
                        }
                    } else {
                        Yii::$app->session->setFlash('error', 'No valid results to save.');
                    }

                } else {
                    Yii::$app->session->setFlash('error', 'No results to save.');
                }    
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
