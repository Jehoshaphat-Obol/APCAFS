<?php

namespace app\controllers;

use Yii;
use app\models\AddJobPost;
use app\models\JobPost;
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
                'only' => ['index', 'view', 'create', 'update', 'delete', 'error', 'restore', 'deleted-posts'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'restore', 'deleted-posts'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'view', 'delete', 'restore', 'deleted-posts'],
                        'allow' => true,
                        'roles' => ['super-admin', 'company-admin'],
                    ],
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'restore', 'deleted-posts'],
                        'allow' => true,
                        'roles' => ['hr'],
                    ],
                    [
                        'actions' => ['index', 'view', 'deleted-posts'],
                        'allow' => true,
                        'roles' => ['manager'],
                    ],
                    [
                        'actions' => ['index', 'view'],
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
                $searchModel = new JobPostSearch();
                
                if($searchModel !== null)
                {
                    $dataProvider = $searchModel->search($this->request->queryParams);
                    Yii::$app->session->setFlash('info', 'Welcome, The following are list of Job Posts');
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
            if(Yii::$app->user->can('applicant'))
            {
                $model = $this->findModel($id);

                if($model != null)
                {
                    $application = new ApplyJob([
                        'post_company_id' => $model->post_company_id,
                        'post_job_id' => $model->id,
                    ]);

                    if ($application->apply()) {
                        Yii::$app->session->setFlash('success', 'Maombi ya kazi yamewasilishwa kwa mafanikio.');
                        return $this->redirect(['job-post/view', 'id' => $model->id]);
                    } else {
                        Yii::$app->session->setFlash('error', 'Imeshindikana kutuma maombi. Tafadhali jaribu tena.');
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
        return 'Cancel Button'; 
    }

    /**
     * Apply button
     */
    public function actionAnalyze($id)
    {
        try
        {
            if(Yii::$app->user->can('hr'))
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
            if(Yii::$app->user->can('hr'))
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

            if(Yii::$app->user->can('hr'))
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
            if(Yii::$app->user->can('hr'))
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
            if(Yii::$app->user->can('hr'))
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
