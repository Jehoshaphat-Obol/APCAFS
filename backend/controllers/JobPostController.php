<?php

namespace app\controllers;

use Yii;
use app\models\AddJobPost;
use app\models\Profile;
use app\models\JobPost;
use app\models\JobApplication;
use app\models\ApplyJob;
use app\models\AnalyzeCv;
use app\models\JobPostSearch;
use app\models\JobApplicationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use app\models\StatusLookup;
use yii\helpers\ArrayHelper;

/**
 * JobPostController implements the CRUD actions for JobPost model.
 */
class JobPostController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'applicant-view', 'create', 'update', 'delete', 'error', 'restore', 'apply', 'cancel', 'analyze', 'publish', 'unpublish', 'deleted-posts'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'applicant-view', 'create', 'update', 'delete', 'restore', 'apply', 'cancel', 'analyze', 'publish', 'unpublish', 'deleted-posts'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'view', 'delete', 'restore', 'deleted-posts'],
                        'allow' => true,
                        'roles' => ['company-admin'],
                    ],
                    [
                        'actions' => ['index', 'view', 'applicant-view', 'create', 'update', 'delete', 'error', 'restore', 'apply', 'cancel', 'analyze', 'publish', 'deleted-posts'],
                        'allow' => true,
                        'roles' => ['super-admin'],
                    ],
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'restore', 'analyze', 'publish', 'unpublish', 'deleted-posts'],
                        'allow' => true,
                        'roles' => ['hr'],
                    ],
                    [
                        'actions' => ['index', 'view', 'deleted-posts'],
                        'allow' => true,
                        'roles' => ['manager'],
                    ],
                    [
                        'actions' => ['index', 'apply', 'cancel', 'applicant-view'],
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

    /**
     * Lists all JobPost models.
     *
     * @return string
     */
    public function actionIndex()
    {
        try
        {
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('manager') || Yii::$app->user->can('hr') || Yii::$app->user->can('applicant'))
            {
                // Zuia applicant ambaye hana profile
                if (Yii::$app->user->can('applicant')) {
                    $userId = Yii::$app->user->id;
                    $profile = Profile::find()->where(['profile_user_id' => $userId])->one();
                    if ($profile === null) {
                        Yii::$app->session->setFlash('error', 'Please complete your profile before accessing job posts.');
                        return $this->redirect(['/profile/create']);
                    }
                }
                
                $searchModel = new JobPostSearch();

                $applicationCounts = JobApplication::find()
                ->select(['applicant_job_post_id', 'COUNT(*) as total_applications'])
                ->where(['applicant_status_id' => StatusLookup::find()->where(['status_code' => 'apply'])->select('id')->scalar()])
                ->groupBy('applicant_job_post_id')
                ->asArray()
                ->all();

                // Convert kuwa key-value: [job_post_id => total]
                $applicationCountMap = ArrayHelper::map($applicationCounts, 'applicant_job_post_id', 'total_applications');
                
                if($searchModel !== null)
                {
                    $dataProvider = $searchModel->search($this->request->queryParams);
                    Yii::$app->session->setFlash('info', 'Welcome, The following are list of Job Posts');
                    return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'applicationCountMap' => $applicationCountMap,
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
    public function actionDeletedPosts()
    {
        try
        {
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('manager') || Yii::$app->user->can('hr'))
            {
                $deletedPosts = JobPost::onlyDeleted()->all();
                if($deletedPosts !== null)
                {
                    Yii::$app->session->setFlash('info', 'Welcome, The following are list of Job Posts inside Bin');
                    return $this->render('deleted-posts', [
                        'deletedPosts' => $deletedPosts,
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
     * Apply button
     */
    public function actionApply($id)
    {
        try
        {
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('applicant'))
            {
                $model = $this->findModel($id);

                if($model != null)
                {
                    $application = new ApplyJob([
                        'post_company_id' => $model->post_company_id,
                        'post_job_id' => $model->id,
                    ]);

                    if ($application->apply()) {
                        Yii::$app->session->setFlash('success', 'Your job application has been successfully submitted.');
                        return $this->redirect(['dashboard/applicant-dashboard']);
                    } else {
                        Yii::$app->session->setFlash('error', 'Unable to submit your application. Please try again.');
                        return $this->redirect(['job-post/view', 'id' => $model->id]);
                    }
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
     * cancel jop apply button
     */
    public function actionCancel($id)
    {
        try {
            $application = JobApplication::find()
                        ->where(['applicant_job_post_id' => $id, 'applicant_user_id' => Yii::$app->user->id])
                        ->one();

            if ($application) {
                if ($application->delete()) {
                    Yii::$app->session->setFlash('success', 'Application cancelled successfully.');
                } else {
                    Yii::$app->session->setFlash('error', 'Unable to cancel the job application.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'No application found.');
            }

            return $this->redirect(['dashboard/applicant-dashboard']);
        } catch (\Exception $e) {
            Yii::error($e->getMessage(), __METHOD__);
            throw new \yii\web\ServerErrorHttpException('Something went wrong. Please try again later.');
        }
    }

    /**
     * Apply button
     */
    public function actionAnalyze($id)
    {
        try
        {
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('hr'))
            {
                $model = $this->findModel($id);

                if($model != null)
                {
                    $analyze = new AnalyzeCv();

                    // echo "<pre>";
                    // print_r($analyze->analyze($id));
                    // echo "</pre>";
                    // return false;

                    if ($analyze->analyze($id)) {
                        Yii::$app->session->setFlash('success', 'Maombi ya Mchakato wa maombi ya kazi yamewasilishwa kwa mafanikio.');
                        return $this->redirect(['job-post/view', 'id' => $model->id]);
                    } else {
                        Yii::$app->session->setFlash('error', 'Imeshindikana Kuchakata maombi ya Kazi. Tafadhali jaribu tena.');
                        return $this->redirect(['job-post/view', 'id' => $model->id]);
                    }
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
     * Displays a single JobPost model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        try
        {
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('manager') || Yii::$app->user->can('hr') || Yii::$app->user->can('applicant'))
            {                
                $model = $this->findModel($id);
                
                if($model !== null)
                {
                    $searchModel = new JobApplicationSearch();

                    // Ensure job applications only for this job post
                    $queryParams = $this->request->queryParams;
                    $queryParams['JobApplicationSearch']['applicant_job_post_id'] = $id;

                    // Search using filtered params
                    $dataProvider = $searchModel->search($queryParams);

                    Yii::$app->session->setFlash('info', 'Welcome, Here you will be able to see detailed information about this Job Post');
                    return $this->render('view', [
                        'model' => $model,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
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
     * Displays a single JobPost model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionApplicantView($id)
    {
        try
        {
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('applicant'))
            {                
                $model = $this->findModel($id);
                
                if($model !== null)
                {
                    Yii::$app->session->setFlash('info', 'Welcome, Here you will be able to see detailed information about this Job Post');
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
     * Creates a new JobPost model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        try
        {
            $model = new AddJobPost();

            $status = StatusLookup::find()
                ->orderBy([
                'status_name' => SORT_ASC,
                ])->all();
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('hr'))
            {
                if($model !== null)
                {
                    
                    if ($this->request->isPost) {
                        if ($model->load($this->request->post()) && $model->save()) {
                            Yii::$app->session->setFlash('success', 'Congratulation!, Job Post created successfully.');
                            return $this->redirect(['index']);
                        }
                    }
                    Yii::$app->session->setFlash('info', 'Welcome, Create your job post.');
                    return $this->render('create', [
                        'model' => $model,
                        'status' => $status,
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
     * Updates an existing JobPost model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        try
        {
            $model = $this->findModel($id);

            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('hr'))
            {
                if($model !== null)
                {
                    if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                        Yii::$app->session->setFlash('success', 'Congratulation!, The existing job post updated successfully.');
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
     * Deletes an existing JobPost model.
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
                    Yii::$app->session->setFlash('success', 'Congratulation!, Job Post deleted successfully. You may restore them back from Bin');
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
                $model = JobPost::findWithDeleted()->where(['id' => $id])->one();
                if ($model !== null) {
                    $model->restore();
                    Yii::$app->session->setFlash('success', 'Congratulation!, job Post has been restored successfully.');
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

    /** method for publish job post      
     * If publish is successful, the browser will be redirected to the 'inventory view' page.
     * @param int $id Id
    */
    public function actionPublish($id)
    {
        try
        {
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('hr'))
            {
                $model = $this->findModel($id);
                if($model !== null)
                {
                    $model->post_status_id = StatusLookup::find()->where(['status_code' => 'published'])->select('id')->scalar();;
                    $model->save();
                    Yii::$app->session->setFlash('success', 'Congratulation!, Job Post has been Published successfully.');
                    return $this->redirect(['view', 'id' => $model->id]);
                }
                throw new NotFoundHttpException('The requested page does not exist.');
            }
            throw new \Exception('You are not allowed to access this Page');
        } catch (\Exception $e)
        {
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->redirect('error');
        }
    }

    /** method for unpublish job post      
     * If publish is successful, the browser will be redirected to the 'inventory view' page.
     * @param int $id Id
    */
    public function actionUnpublish($id)
    {
        try
        {
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('hr'))
            {
                $model = $this->findModel($id);
                if($model !== null)
                {
                    $model->post_status_id = StatusLookup::find()->where(['status_code' => 'unpublish'])->select('id')->scalar();;
                    $model->save();
                    Yii::$app->session->setFlash('success', 'Congratulation!, Job Post has been Unpublished   successfully.');
                    return $this->redirect(['view', 'id' => $model->id]);
                }
                throw new NotFoundHttpException('The requested page does not exist.');
            }
            throw new \Exception('You are not allowed to access this Page');
        } catch (\Exception $e)
        {
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->redirect('error');
        }
    }

    public function actionSelectCandidatesForm($id)
    {
        $model = new \yii\base\DynamicModel(['number']);
        $model->addRule('number', 'required');
        $model->addRule('number', 'integer', ['min' => 1]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            return $this->redirect(['select-candidates', 'id' => $id, 'number' => $model->number]);
        }

        return $this->render('select_candidates_form', [
            'model' => $model,
            'jobPostId' => $id,
        ]);
    }

    public function actionSelectCandidates($id, $number)
    {
        // Step 1: Chukua walio na score kubwa zaidi kulingana na kiwango kilichotolewa
        $topApplicants = JobApplication::find()
            ->where(['applicant_job_post_id' => $id])
            ->andWhere(['not', ['applicant_score' => null]])
            ->orderBy(['applicant_score' => SORT_DESC])
            ->limit($number)
            ->all();

        $selectedIds = array_map(function ($a) {
            return $a->id;
        }, $topApplicants);

        // Step 2: Update waliochaguliwa kuwa 'accepted'
        $acceptedCount = JobApplication::updateAll(
            ['applicant_status_id' => StatusLookup::find()->where(['status_code' => 'accepted'])->select('id')->scalar()], // badilisha kama unatumia integer status
            ['id' => $selectedIds]
        );

        // Step 3: Update waliobaki (ambao hawakuchaguliwa) kuwa 'rejected'
        $rejectedCount = JobApplication::updateAll(
            ['applicant_status_id' => StatusLookup::find()->where(['status_code' => 'rejected'])->select('id')->scalar()], // badilisha pia kama unatumia integer status
            [
                'and',
                ['applicant_job_post_id' => $id],
                ['not', ['id' => $selectedIds]],
                ['not', ['applicant_score' => null]]
            ]
        );

        Yii::$app->session->setFlash('success', "$acceptedCount applicants accepted, $rejectedCount rejected.");
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Finds the JobPost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return JobPost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JobPost::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
