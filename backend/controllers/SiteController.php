<?php

namespace app\controllers;

use yii\helpers\Html;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ApplicantLoginForm;
use app\models\SignupForm;
use app\models\RegisterForm;
use app\models\ContactForm;
use app\models\Company;
use app\models\SetupCompany;
use app\models\CompanyActivationCodeForm;
use app\models\StaffProfile;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                'except' => ['setup-company', 'login', 'signup', 'error', 'signin', 'register'],
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = 'site';
        return $this->render('index');
    }


    public function actionPolicy()
    {
        $this->layout = 'site';
        return $this->render('policy');
    }

    /**
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionSetupCompany()
    {
        $this->layout = 'auth';

        $model = new SetupCompany();

        try {
            // Hakikisha hakuna kampuni yoyote kwenye database
            if (Company::find()->count() > 0) {
                return $this->redirect(['login']); // Redirect to login if a company already exists
            }

            if ($this->request->isPost) {
                if ($model->load($this->request->post())) {
                    $company_id = $model->save();
                    if ($company_id) {
                        Yii::$app->session->setFlash('success', 'Company setup done successfully.');
                        return $this->redirect(['signup', 'company_id' => $company_id]);
                    } else {
                        Yii::$app->session->setFlash('error', 'Failed to Setup Company');
                    }
                }
            }

            return $this->render('setup-company', [
                'model' => $model,
            ]);
        } catch (\Exception $e) {
            Yii::error($e->getMessage(), __METHOD__);
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->render('setup-company', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Signs Staff user up.
     *
     * @return mixed
     */

    public function actionSignup($company_id = null)
    {
        $this->layout = 'auth';
        $model = new SignupForm();

        try {
            // Hakikisha company_id ipo
            $company = Company::findOne(['id' => $company_id]);
            if (!$company) {
                Yii::$app->session->setFlash('error', 'Company ID is required or invalid.');
                return $this->redirect(['setup-company']);
            }

            $model->company_id = $company_id;

            if ($model->load(Yii::$app->request->post()) && $model->signup()) {
                if ($company->company_activation_code_date === null) {
                    $type = 'company';
                } else {
                    throw new \yii\web\BadRequestHttpException("Company already activated.");
                }

                Yii::$app->session->setFlash('success', 'Admin created successfully. Please verify activation.');
                // Yii::$app->session->setFlash('error', 'Something went wrong during signup.');
                return $this->redirect(['verify-activation', 'type' => $type, 'company_id' => $company_id]);
            }

            return $this->render('signup', ['model' => $model]);

        } catch (\Exception $e) {
            Yii::error("Error occurred in signup: " . $e->getMessage());
            return $this->redirect(['signup', 'company_id' => $company_id]);
        }
    }

    /**
     * Signs applicant user up.
     *
     * @return mixed
     */

    public function actionRegister()
    {
        $this->layout = 'auth';
        $model = new RegisterForm();

        try {
            if ($model->load(Yii::$app->request->post()) && $model->register()) {
                Yii::$app->session->setFlash('success', 'Your account registration done successfully.');
                return $this->redirect(['signin']);
            }

            return $this->render('register', ['model' => $model]);

        } catch (\Exception $e) {
            Yii::error("Error occurred in register: " . $e->getMessage());
            return $this->redirect(['register']).Html::errorSummary($e);
        }
    }

    /**
     * this action used to return activation verification page
     * and if successfully the activation code is verified it will
     * redirect to login page
     */
    public function actionVerifyActivation($company_id = null, $type)
    {
        $this->layout = 'auth';
        $model = new CompanyActivationCodeForm();

        try {
            if (empty($company_id) || empty($type)) {
                Yii::$app->session->setFlash('error', 'Invalid parameters.');
                return $this->redirect(['error']);
            }

            $company = Company::findOne($company_id);
            if (!$company) {
                Yii::$app->session->setFlash('error', 'Company not found.');
                return $this->redirect(['setup-company']);
            }

            $model->company_id = $company_id;

            if ($type === 'company' && $model->load(Yii::$app->request->post())) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Company Activation code verified successfully. You can now log in.');
                    return $this->redirect(['login']);
                }
            }

            return $this->render('verification', [
                'model' => $model,
                'type' => $type,
            ]);
        } catch (\Exception $e) {
            Yii::error("Verify Activation Error: " . $e->getMessage(), __METHOD__);
            return $this->redirect(['setup-company']);
        }
    }



    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'auth';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            
            // return $this->handlePostLoginRedirect();
            // return $this->redirect(['dashboard/dashboard']);
            return;

        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionSignin()
    {
        $this->layout = 'auth';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new ApplicantLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            
            return;
            // return $this->redirect(['dashboard/dashboard']);

        }

        $model->password = '';
        return $this->render('signin', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        // Hifadhi role kabla ya ku-logout
        $isApplicant = Yii::$app->user->can('applicant');

        Yii::$app->user->logout();

        if ($isApplicant) {
            return $this->redirect(['site/signin']);
        }

        return $this->redirect(['site/login']);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionRequestPasswordReset()
    {
        $this->layout = "auth";

        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Please check your email for instructions.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Failed to send the email.');
            }
        }

        return $this->render('requestPasswordResetToken', ['model' => $model]);
    }

    public function actionResetPassword($token)
    {
        $this->layout = "auth";
        try {
            $model = new ResetPasswordForm($token);
        } catch (\yii\base\InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'You have successfully reset your password.');
            return $this->goHome();
        }

        return $this->render('resetPassword', ['model' => $model]);
    }

}
