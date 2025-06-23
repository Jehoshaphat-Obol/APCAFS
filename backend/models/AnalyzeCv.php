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
use yii\helpers\ArrayHelper;


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

        try {
            if (Yii::$app->user->can('hr')) {
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
                        'Experience: ' . $experienceText . '<br>' .
                        'Education: ' . $educationText . '<br>' .
                        'Skills: ' . $skillText . '<br>' .
                        'Languages: ' . $languageText . '<br>' .
                        'Publications: ' . $publicationText;

                    $pAssessmentData[] = [
                        'profile_id' => $profile->id,
                        'social_media_username' => $profile->profile_social_media_username,
                    ];

                    $profileData[] = [
                        'user_id' => $profile->profile_user_id, // bado tunarudisha user_id kama reference
                        'application' => $applicationString,
                    ];
                }

                /**CV ANALYSIS inaanzia hapa*/
                $cvEndpoint = Yii::$app->params['cvAnalysis'];
                // ✅ Final Payload Format (no nesting under "cv_analysis")
                $cvPayload = json_encode([
                    'job_post' => $jobSummary,
                    'applications' => $profileData
                ]);

                // ✅ cURL to send POST request
                $ch = curl_init($cvEndpoint . "/rank/");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $cvPayload);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Host: localhost',
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($cvPayload)
                ]);

                $cvResponse = curl_exec($ch);
                curl_close($ch);

                $cvResponseData = json_decode($cvResponse, true);

                //JobApplication
                if (isset($cvResponseData['results']) && is_array($cvResponseData['results'])) {
                    $successCount = 0;

                    foreach ($cvResponseData['results'] as $record) {
                        if (isset($record['user_id'], $record['score'])) {
                            $userId = $record['user_id'];
                            $score = round($record['score'], 2);

                            $updateCount = Yii::$app->db->createCommand()->update(
                                'job_application',
                                ['applicant_score' => $score],
                                [
                                    'applicant_user_id' => $userId,
                                    'applicant_job_post_id' => $post->id, // ← inahakikisha tunahusika na post moja tu
                                ]
                            )->execute();

                            if ($updateCount > 0) {
                                $successCount++;
                            }
                        } else {
                            Yii::error("Missing required keys in record: " . json_encode($record));
                        }
                    }

                    if ($successCount > 0) {
                        Yii::$app->session->setFlash('success', "$successCount application scores updated successfully.");
                    } else {
                        Yii::$app->session->setFlash('error', 'No scores were updated.');
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'No results returned from CV ranking API.');
                }

                /******PERSONALITY ASSEMENT INAANZIA HAPA
                 * katika mistari ifuatayo
                 */
                // Prepare the payload
                $payload = json_encode(['personality_assessment' => $pAssessmentData]);

                // Make the POST request using cURL
                $ch = curl_init($twitterEndpoint . "/assess/");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($payload)
                ]);

                $response = curl_exec($ch);
                curl_close($ch);

                $responseData = json_decode($response, true);

                // return $responseData;
                // saving personality Assessment data
                // if (isset($responseData['results']) && is_array($responseData['results'])) {
                //     $rows = [];
                //     $requiredKeys = ['profile_id', 'IE_score', 'NS_score', 'TF_score', 'JB_score'];

                //     foreach ($responseData['results'] as $record) {
                //         if (!empty(array_intersect($requiredKeys, array_keys($record)))) {
                //             $rows[] = [
                //                 $record['profile_id'],
                //                 $record['IE_score'] * 100,
                //                 $record['NS_score'] * 100,
                //                 $record['TF_score'] * 100,
                //                 $record['JP_score'] * 100,
                //                 StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar(),
                //                 date('Y-m-d'),
                //                 Yii::$app->user->id ?? null,
                //             ];
                //         } else {
                //             Yii::error("Missing required keys in record: " . json_encode($record));
                //         }
                //     }

                //     if (!empty($rows)) {
                //         Yii::$app->db->createCommand()
                //             ->batchInsert('personality_assessment', [
                //                 'personality_profile_id',
                //                 'personality_IE_score',
                //                 'personality_NS_score',
                //                 'personality_TF_score',
                //                 'personality_JB_score',
                //                 'personality_status_id',
                //                 'personality_last_analysis_date',
                //                 'personality_created_by',
                //             ], $rows)->execute();

                //         Yii::$app->session->setFlash('success', 'All valid assessments saved successfully.');
                //     } else {
                //         Yii::$app->session->setFlash('error', 'No valid results to save.');
                //     }
                // } else {
                //     Yii::$app->session->setFlash('error', 'No results returned from assessment API.');
                // }

                // saving personality Assessment data
                if (isset($responseData['results']) && is_array($responseData['results'])) {
                    $rows = [];
                    $requiredKeys = ['profile_id', 'IE_score', 'NS_score', 'TF_score', 'JP_score'];

                    // 1. Chukua profile_ids zote kutoka kwenye results
                    $incomingProfileIds = ArrayHelper::getColumn($responseData['results'], 'profile_id');

                    if (empty($incomingProfileIds)) {
                        Yii::$app->session->setFlash('error', 'No profile IDs found in results.');
                        return;
                    }

                    // 2. Futa entries zote zenye profile_id zinazokuja (OVERWRITE mode)
                    Yii::$app->db->createCommand()
                        ->delete('personality_assessment', ['personality_profile_id' => $incomingProfileIds])
                        ->execute();

                    // 3. Andaa values zinazohitajika
                    $activeStatusId = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
                    $today = date('Y-m-d');
                    $userId = Yii::$app->user->id ?? null;

                    // 4. Loop kwenye results na andaa rows zote
                    foreach ($responseData['results'] as $record) {
                        if (empty(array_diff($requiredKeys, array_keys($record)))) {
                            $rows[] = [
                                $record['profile_id'],
                                $record['IE_score'] * 100,
                                $record['NS_score'] * 100,
                                $record['TF_score'] * 100,
                                $record['JP_score'] * 100,
                                $activeStatusId,
                                $today,
                                $userId,
                            ];
                        } else {
                            Yii::error("Missing required keys in record: " . json_encode($record));
                        }
                    }

                    // 5. Insert all new records
                    if (!empty($rows)) {
                        Yii::$app->db->createCommand()
                            ->batchInsert('personality_assessment', [
                                'personality_profile_id',
                                'personality_IE_score',
                                'personality_NS_score',
                                'personality_TF_score',
                                'personality_JB_score',
                                'personality_status_id',
                                'personality_last_analysis_date',
                                'personality_created_by',
                            ], $rows)->execute();

                        Yii::$app->session->setFlash('success', 'Assessments saved (overwritten if existing).');
                    } else {
                        Yii::$app->session->setFlash('error', 'No valid results to save.');
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'No results returned from assessment API.');
                }



                $transaction->commit();
                return true;
            } else {
                throw new \Exception("Forbidden to perform this action");
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::error($e->getMessage(), __METHOD__);
            throw $e;
        }
    }
}
