<?php 
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use app\models\User;
use app\models\Company;
use app\models\CompanySubscription;
use app\models\CompanySubscriptionSearch;
use app\models\StatusLookup;
use app\models\JobPost;
use app\models\JobTest;
use app\models\JobApplication;
use app\models\Education;
use app\models\WorkExperience;
use app\models\Language;
use app\models\Skill;
use app\models\Award;
use app\models\Publication;
use app\models\PhoneNumber;
use app\models\Profile;

/**
 * DashboardController implements the CRUD actions for Dashboard model.
 */
class DashboardController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['dashboard'],
                'rules' => [
                    [
                        'actions' => ['super-admin-dashboard' , 'dashboard'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['super-admin-dashboard'],
                        'allow' => true,
                        'roles' => ['super-admin'],
                    ],
                    [
                        'actions' => ['company-admin-dashboard'],
                        'allow' => true,
                        'roles' => ['company-admin'],
                    ],
                    [
                        'actions' => ['manager-dashboard'],
                        'allow' => true,
                        'roles' => ['manager'],
                    ],
                    [
                        'actions' => ['hr-dashboard'],
                        'allow' => true,
                        'roles' => ['hr'],
                    ],
                    [
                        'actions' => ['applicant-dashboard'],
                        'allow' => true,
                        'roles' => ['applicant'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionSuperAdminDashboard()
    {
        try
        {
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('manager') || Yii::$app->user->can('hr') || Yii::$app->user->can('applicant'))
            {
                $statuses = ['paid', 'active', 'not-paid', 'inactive', 'pending']; // Badilisha hizi status_codes kulingana na unazohitaji

                $companies = Company::find()
                    ->where(['company_status_id' => StatusLookup::find()
                        ->where(['in', 'status_code', $statuses])
                        ->select('id')])
                    ->count();
                $users = User::find()
                    ->where(['user_status_id' => StatusLookup::find()
                        ->where(['in', 'status_code', $statuses])
                        ->select('id')])
                    ->count();
                $subscribedCompany = CompanySubscription::find()
                                    ->where(['subscription_status_id' => StatusLookup::find()->where(['status_code' => 'paid'])->select('id')->scalar()])
                                    ->count();
                $unSubscribedCompany = CompanySubscription::find()
                                    ->where(['subscription_status_id' => StatusLookup::find()->where(['status_code' => 'not-paid'])->select('id')->scalar()])
                                    ->count();
                $searchModel = new CompanySubscriptionSearch();
                $dataProvider = $searchModel->search($this->request->queryParams);
                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'subscribedCompany' => $subscribedCompany,
                    'unSubscribedCompany' => $unSubscribedCompany,
                    'companies' => $companies,
                    'users' => $users,
                ]);
            }
            throw new ForbiddenHttpException();
        } catch (ForbiddenHttpException $e)
        {
            return $this->redirect(['error']);
        }
    }

    public function actionCompanyAdminDashboard()
    {
        try
        {
            if(Yii::$app->user->can('company-admin'))
            {
                $statuses = ['paid', 'active', 'published', 'unpublish', 'apply', 'not-paid', 'inactive', 'pending']; // Badilisha hizi status_codes kulingana na unazohitaji
                $users = User::find()
                    ->where(['company_id' => Yii::$app->user->identity->company_id])
                    ->andWhere(['user_status_id' => StatusLookup::find()
                        ->where(['in', 'status_code', $statuses])
                        ->select('id')])
                    ->count();

                $jobs = JobPost::find()
                    ->where(['post_company_id' => Yii::$app->user->identity->company_id])
                    ->andWhere(['post_status_id' => StatusLookup::find()
                        ->where(['in', 'status_code', $statuses])
                        ->select('id')])
                    ->count();

                $tests = JobTest::find()
                    ->where(['test_company_id' => Yii::$app->user->identity->company_id])
                    ->andWhere(['test_status_id' => StatusLookup::find()
                        ->where(['in', 'status_code', $statuses])
                        ->select('id')])
                    ->count();
                return $this->render('index', [
                    'users' => $users,
                    'jobs' => $jobs,
                    'tests' => $tests
                ]);
            }
            throw new ForbiddenHttpException();
        } catch (ForbiddenHttpException $e)
        {
            return $this->redirect(['error']);
        }
    }

    public function actionManagerDashboard()
    {
        try
        {
            if(Yii::$app->user->can('manager'))
            {
                return $this->render('index');
            }
            throw new ForbiddenHttpException();
        } catch (ForbiddenHttpException $e)
        {
            return $this->redirect(['error']);
        }
    }

    public function actionHrDashboard()
    {
        try
        {
            if(Yii::$app->user->can('hr'))
            {
                $statuses = ['paid', 'active', 'published', 'unpublish', 'apply', 'not-paid', 'inactive', 'pending']; // Badilisha hizi status_codes kulingana na unazohitaji
                $tests = JobTest::find()
                    ->where(['test_company_id' => Yii::$app->user->identity->company_id])
                    ->andWhere(['test_status_id' => StatusLookup::find()
                        ->where(['in', 'status_code', $statuses])
                        ->select('id')])
                    ->count();
                    
                $applications = JobApplication::find()
                    ->where(['applicant_company_id' => Yii::$app->user->identity->company_id])
                    ->andWhere(['applicant_status_id' => StatusLookup::find()
                        ->where(['in', 'status_code', $statuses])
                        ->select('id')])
                    ->count();
                // Zilizopitia AI (score si null)
                $processedCount = JobApplication::find()
                    ->where(['applicant_company_id' => Yii::$app->user->identity->company_id])
                    ->andWhere(['in', 'applicant_status_id', StatusLookup::find()
                        ->where(['in', 'status_code', $statuses])
                        ->select('id')])
                    ->andWhere(['not', ['applicant_score' => null]])
                    ->count();
                // Zisizopitia AI (score ni null)
                $unprocessedCount = JobApplication::find()
                    ->where(['applicant_company_id' => Yii::$app->user->identity->company_id])
                    ->andWhere(['in', 'applicant_status_id', StatusLookup::find()
                        ->where(['in', 'status_code', $statuses])
                        ->select('id')])
                    ->andWhere(['applicant_score' => null])
                    ->count();
                $jobs = JobPost::find()
                    ->where(['post_company_id' => Yii::$app->user->identity->company_id])
                    ->andWhere(['post_status_id' => StatusLookup::find()
                        ->where(['in', 'status_code', $statuses])
                        ->select('id')])
                    ->count();
                $totalCount = $processedCount + $unprocessedCount;
                $percentage = $totalCount > 0 ? ($processedCount / $totalCount) * 100 : 0;
                return $this->render('index', [
                    'tests' => $tests,
                    'applications' => $applications,
                    'jobs' => $jobs,
                    'processedCount' => $processedCount,
                    'unprocessedCount' => $unprocessedCount,
                    'totalCount' => $totalCount,
                    'percentage' => $percentage,
                ]);
            }
            throw new ForbiddenHttpException();
        } catch (ForbiddenHttpException $e)
        {
            return $this->redirect(['error']);
        }
    }

    public function actionApplicantDashboard()
    {
        try
        {
            if (Yii::$app->user->can('applicant')) {
                $userId = Yii::$app->user->id;

                $applications = JobApplication::find()
                    ->where(['applicant_user_id' => $userId])
                    ->with('jobPost') // assuming relation exists
                    ->orderBy(['applicant_created_at' => SORT_DESC])
                    ->all();

                // Tafuta profile kwa kutumia profile_user_id
                $profile = Profile::find()->where(['profile_user_id' => $userId])->one();

                // Kama profile haipo, mpeleke kwenye ukurasa wa kuunda profile
                if ($profile === null) {
                    Yii::$app->session->setFlash('error', 'Please complete your profile to access the dashboard.');
                    return $this->redirect(['/profile/create']);
                }

                // Profile ipo, anza kuhesabu sehemu zilizokamilika
                $completedSections = 1; // tayari profile ipo
                $totalSections = 8;
                $profileId = $profile->id;

                // Orodha ya sehemu nyingine za profile zinazohitajika
                if (Education::find()->where(['education_profile_id' => $profileId])->exists()) $completedSections++;
                if (WorkExperience::find()->where(['experience_profile_id' => $profileId])->exists()) $completedSections++;
                if (Language::find()->where(['language_profile_id' => $profileId])->exists()) $completedSections++;
                if (Skill::find()->where(['skill_profile_id' => $profileId])->exists()) $completedSections++;
                if (Award::find()->where(['award_profile_id' => $profileId])->exists()) $completedSections++;
                if (Publication::find()->where(['publication_profile_id' => $profileId])->exists()) $completedSections++;
                if (PhoneNumber::find()->where(['phone_profile_id' => $profileId])->exists()) $completedSections++;

                // Hesabu asilimia ya completion
                $completionPercentage = ($completedSections / $totalSections) * 100;

                return $this->render('index', [
                    'completionPercentage' => $completionPercentage,
                    'profile' => $profile,
                    'applications' => $applications,
                ]);
            }
            throw new ForbiddenHttpException();
        } catch (ForbiddenHttpException $e)
        {
            return $this->redirect(['error']);
        }
    }
}
?>