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
                return $this->render('index');
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
                return $this->render('index');
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
            if(Yii::$app->user->can('applicant'))
            {
                return $this->render('index');
            }
            throw new ForbiddenHttpException();
        } catch (ForbiddenHttpException $e)
        {
            return $this->redirect(['error']);
        }
    }
}
?>