<?php

namespace app\controllers;

use Yii;
use app\models\Profile;
use app\models\StatusLookup;
use app\models\JobApplication;
use app\models\JobApplicationSearch;
use app\models\PersonalityAssessment;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * JobApplicationController implements the CRUD actions for JobApplication model.
 */
class JobApplicationController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete', 'error', 'restore', 'deleted-applications'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'restore', 'deleted-applications'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'view', 'delete', 'restore', 'deleted-applications'],
                        'allow' => true,
                        'roles' => ['company-admin'],
                    ],
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'error', 'restore', 'deleted-applications'],
                        'allow' => true,
                        'roles' => ['super-admin'],
                    ],
                    [
                        'actions' => ['index', 'view', 'delete', 'restore', 'deleted-applications'],
                        'allow' => true,
                        'roles' => ['hr'],
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
     * Lists all JobApplication models.
     *
     * @return string
     */
    public function actionIndex()
    {
        try
        {
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('manager')|| Yii::$app->user->can('hr'))
            {
                $searchModel = new JobApplicationSearch();
                
                if($searchModel !== null)
                {
                    $dataProvider = $searchModel->search($this->request->queryParams);
                    Yii::$app->session->setFlash('info', 'Welcome, The following are list of Job Applications');
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
     * Lists all Deleted Applications models.
     *
     * @return string
     */
    public function actionDeletedApplications()
    {
        try
        {
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('manager') || Yii::$app->user->can('hr'))
            {
                $deletedApplications = JobApplication::onlyDeleted()->all();
                if($deletedApplications !== null)
                {
                    Yii::$app->session->setFlash('info', 'Welcome, The following are list of Job Applications inside Bin');
                    return $this->render('deleted-applications', [
                        'deletedApplications' => $deletedApplications,
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
     * Displays a single JobApplication model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        try
        {
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('manager') || Yii::$app->user->can('hr'))
            {
                $model = $this->findModel($id);

                $profile = Profile::find()
                    ->where(['profile_user_id' => $model->applicant_user_id])
                    ->andWhere(['profile_status_id' => StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar()])
                    ->one();

                if($model !== null)
                {
                    Yii::$app->session->setFlash('info', 'Welcome, Here you will be able to see detailed information about this Job Application');
                    return $this->render('view', [
                        'model' => $model,
                        'profile' => $profile,
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
     * Creates a new JobApplication model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        try {
            $model = new JobApplication();
            
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('applicant'))
            {
                if($model !== null)
                {
                    if ($this->request->isPost) {
                        if ($model->load($this->request->post()) && $model->save()) {
                            Yii::$app->session->setFlash('success', 'Congratulation!, Job Applicant created successfully.');
                            return $this->redirect(['view', 'id' => $model->id]);
                        }
                    }
                    Yii::$app->session->setFlash('info', 'Welcome, Apply Now for this job.');
                    return $this->render('create', [
                        'model' => $model,
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
     * Updates an existing JobApplication model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        try {
            $model = $this->findModel($id);

            if(Yii::$app->user->can('super-admin'))
            {
                if($model !== null)
                {
                    if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }

                    return $this->render('update', [
                        'model' => $model,
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
     * Deletes an existing JobApplication model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        try
        {
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('hr'))
            {
                $model = $this->findModel($id);

                if ($model !== null) {
                    $model->softDelete();
                    Yii::$app->session->setFlash('success', 'Congratulation!, Job Application deleted successfully. You may restore them back from Bin');
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
     * Restore an existing Products model.
     * If Restore is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionRestore($id)
    {
        try
        {
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('hr'))
            {
                $model = JobApplication::findWithDeleted()->where(['id' => $id])->one();
                if ($model !== null) {
                    $model->restore();
                    Yii::$app->session->setFlash('success', 'Congratulation!, job applicantion has been restored successfully.');
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
     * Finds the JobApplication model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return JobApplication the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JobApplication::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
