<?php 
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\JobTest;
use app\models\TestQuestion;
use app\models\TestQuestionChoice;
use yii\db\Transaction;
use yii\helpers\Html;
use app\models\StatusLookup;

class AddJobTest extends Model
{
    // Job Test details
    public $test_company_id;
    public $test_job_post_id;
    public $test_user_id;
    public $test_identification;
    public $test_duration;
    public $test_status_id;

    // Test Question details
    public $questions = []; // Array ya maswali, kila swali lina 'question', 'choices' (array ya chaguzi), 'correct_choice'

    // Test Question Choice details
    public $choice_label;
    public $choice_text;
    public $choice_is_correct;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['test_job_post_id', 'test_identification', 'test_duration', 'test_status_id'], 'required'],
            [['test_job_post_id', 'test_duration', 'test_status_id'], 'integer'],
            [['test_identification'], 'string', 'max' => 30],
            ['questions', 'safe'], // Ruhusu array ya maswali
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'test_company_id' => Yii::t('app', 'Test Company ID'),
            'test_job_post_id' => Yii::t('app', 'Test Job Post ID'),
            'test_user_id' => Yii::t('app', 'Test User ID'),
            'test_identification' => Yii::t('app', 'Test Identification'),
            'test_duration' => Yii::t('app', 'Test Duration'),
            'question' => Yii::t('app', 'Question'),
            'choice_label' => Yii::t('app', 'Choice Label'),
            'choice_text' => Yii::t('app', 'Choice Text'),
            'choice_is_correct' => Yii::t('app', 'Choice Is Correct'),
            'test_status_id' => Yii::t('app', 'Test Status ID')
        ];
    }

    public function save()
    {
        $transaction = Yii::$app->db->beginTransaction();

        try
        {
            if(Yii::$app->user->can('hr'))
            {
                $test = new JobTest();
                $test->test_company_id = Yii::$app->user->identity->company_id;
                $test->test_job_post_id = $this->test_job_post_id;
                $test->test_user_id = Yii::$app->user->id;
                $test->test_identification = $this->test_identification;
                $test->test_duration = $this->test_duration;
                $test->test_status_id = $this->test_status_id;
                $test->test_created_by = Yii::$app->user->id;

                if(!$test->save())
                {
                    throw new \Exception('Failed to register New Job Test'. Html::errorSummary($test));
                }

                foreach($this->questions as $q)
                {
                    $question = new TestQuestion();
                    $question->question_company_id = Yii::$app->user->identity->company_id;
                    $question->question_test_id = $test->id;
                    $question->question = $q['question'];
                    $question->question_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
                    $question->question_created_by = Yii::$app->user->id;

                    if(!$question->save())
                    {
                        throw new \Exception('Failed to register New Test Question'. Html::errorSummary($question));
                    }

                    foreach ($q['choices'] as $choiceData)
                    {
                        $choice = new TestQuestionChoice();
                        $choice->choice_company_id = Yii::$app->user->identity->company_id;
                        $choice->choice_question_id = $question->id;
                        $choice->choice_label = $choiceData['label'];
                        $choice->choice_text = $choiceData['text'];
                        $choice->choice_is_correct = $choiceData['label'] === $q['correct_choice'] ? 1 : 0;
                        $choice->choice_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
                        $choice->choice_created_by = Yii::$app->user->id;

                        if(!$choice->save())
                        {
                            throw new \Exception('Failed to register New Test Question'. Html::errorSummary($choice));
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
}
?>