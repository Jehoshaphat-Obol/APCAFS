<?php

namespace app\controllers;

use Yii;
use app\models\AddCompany;
use app\models\SubscriptionPlan;
use app\models\CompanySubscription;
use app\models\Company;
use app\models\CompanySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete', 'error', 'restore', 'deleted-companies'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'restore', 'deleted-companies'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'restore', 'deleted-companies'],
                        'allow' => true,
                        'roles' => ['super-admin'],
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

    /**
     * Lists all Company models.
     *
     * @return string
     */
    public function actionIndex()
    {
        try
        {
            if(Yii::$app->user->can('super-admin'))
            {
                $searchModel = new CompanySearch();
                
                if($searchModel !== null)
                {
                    $dataProvider = $searchModel->search($this->request->queryParams);
                    Yii::$app->session->setFlash('info', 'Welcome, The following are list of companies');
                    return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                    ]);
                }
            }
            throw new ForbiddenHttpException();
        } catch(ForbiddenHttpException $e)
        {
            return $this->redirect(['error']);
        }
    }

    /**
     * Lists all Deleted Companies models.
     *
     * @return string
     */
    public function actionDeletedCompanies()
    {
        try
        {
            if(Yii::$app->user->can('super-admin'))
            {
                $deletedCompanies = Company::onlyDeleted()->all();
                if($deletedCompanies !== null)
                {
                    Yii::$app->session->setFlash('info', 'Welcome, The following are list of company inside Bin');
                    return $this->render('deleted-companies', [
                        'deletedCompanies' => $deletedCompanies,
                    ]);
                }
                throw new NotFoundHttpException('The requested page does not exist.');
            }
            throw new ForbiddenHttpException();
        } catch(ForbiddenHttpException $e)
        {
            return $this->redirect(['error']);
        }
    }

    /**
     * Displays a single Company model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        try
        {
            if(Yii::$app->user->can('super-admin'))
            {
                $model = $this->findModel($id);
                
                if($model !== null)
                {
                    Yii::$app->session->setFlash('info', 'Welcome, Here you will be able to see detailed information about this Company');
                    return $this->render('view', [
                        'model' => $model,
                    ]);
                }
                throw new NotFoundHttpException('The requested page does not exist.');
            }
            throw new ForbiddenHttpException();
        } catch(ForbiddenHttpException $e)
        {
            return $this->redirect(['error']);
        }
    }

    /**
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new AddCompany();

        try
        {
            if(Yii::$app->user->can('super-admin'))
            {
                if($model !== null)
                {
                    $plans = SubscriptionPlan::find()->all();

                    if ($this->request->isPost) {
                        if ($model->load($this->request->post()) && $model->save()) {
                            Yii::$app->session->setFlash('success', 'Congratulation!, Company created successfully.');
                            return $this->redirect(['index']);
                        }
                    }
                    Yii::$app->session->setFlash('info', 'Welcome, Expanding your multi-tenancy business by creating new Company and Specify how many users may the company have.');
                    return $this->render('create', [
                        'model' => $model,
                        'plans' => $plans,
                    ]);
                }   
                throw new NotFoundHttpException('The requested page does not exist.');
            }
            throw new ForbiddenHttpException();
        } catch (ForbiddenHttpException $e)
        {
            return $this->redirect(['error']);
        } 
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        try {
            // Ruhusa ya super-admin tu
            if (!Yii::$app->user->can('super-admin')) {
                throw new ForbiddenHttpException("You are not authorized to perform this action.");
            }

            // Pata kampuni
            $company = Company::findOne($id);
            if (!$company) {
                throw new NotFoundHttpException('The requested page does not exist.');
            }

            // Tumia AddCompany model kwa ajili ya form handling
            $model = new AddCompany();

            // Set ID muhimu kwa ajili ya validation ya unique (update mode)
            $model->id = $company->id;

            // Tumia attribute assignment moja moja kwa usahihi zaidi
            $model->company_name = $company->company_name;
            $model->company_phone_number = $company->company_phone_number;
            $model->company_email = $company->company_email;
            $model->company_address = $company->company_address;
            $model->company_user_size = $company->company_user_size;
            $model->company_website_url = $company->company_website_url;

            // Tafuta subscription ya zamani (kama ipo) na weka kwenye model
            $subscription = CompanySubscription::find()
                ->where(['subscription_company_id' => $company->id])
                ->orderBy(['id' => SORT_DESC])
                ->one();

            if ($subscription) {
                $model->subscription_plan_id = $subscription->subscription_plan_id;
            }

            // Pata mipango yote ya subscription
            $plans = SubscriptionPlan::find()->all();

            // Ikiwa form imepostiwa (POST request)
            if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
                // Hakikisha id iko sawa kwa update
                $model->id = $id;

                if ($model->validate()) {
                    try {
                        if ($model->update($id)) {
                            Yii::$app->session->setFlash('success', 'Congratulation!, The existing company updated successfully.');
                            return $this->redirect(['view', 'id' => $id]);
                        }
                    } catch (\Exception $e) {
                        Yii::$app->session->setFlash('error', 'Error: ' . $e->getMessage());
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Please fix the validation errors.');
                }
            }

            return $this->render('update', [
                'model' => $model,
                'plans' => $plans,
            ]);
        } catch (ForbiddenHttpException $e) {
            // Redirect au onyesha error page
            return $this->redirect(['error']);
        }
    }


    /**
     * Deletes an existing Company model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        try
        {
            if(Yii::$app->user->can('super-admin'))
            {
                $model = $this->findModel($id);
                if ($model !== null) {
                    $model->softDelete();
                    Yii::$app->session->setFlash('success', 'Congratulation!, Company deleted successfully. You may restore them back from Bin');
                    return $this->redirect(['index']);
                }
                throw new NotFoundHttpException('The requested page does not exist.');
            } 
            throw new ForbiddenHttpException();
        } catch (ForbiddenHttpException $e)
        {
            return $this->redirect(['error']);
        }
    }

    /**
     * Restore an existing Companies model.
     * If Restore is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionRestore($id)
    {
        try
        {
            if(Yii::$app->user->can('super-admin'))
            {
                $model = Company::findWithDeleted()->where(['id' => $id])->one();
                if ($model !== null) {
                    $model->restore();
                    Yii::$app->session->setFlash('success', 'Congratulation!, Company Restored successfully.');
                    return $this->redirect(['index']);
                }
                throw new NotFoundHttpException('The requested page does not exist.');
            } 
            throw new ForbiddenHttpException();
        } catch (ForbiddenHttpException $e)
        {
            return $this->redirect(['error']);
        }
    }

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
