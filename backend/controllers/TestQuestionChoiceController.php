<?php

namespace app\controllers;

use app\models\TestQuestionChoice;
use app\models\TestQuestionChoiceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * TestQuestionChoiceController implements the CRUD actions for TestQuestionChoice model.
 */
class TestQuestionChoiceController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete', 'error', 'restore', 'deleted-choices'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'restore', 'deleted-choices'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'view', 'delete', 'restore', 'deleted-choices'],
                        'allow' => true,
                        'roles' => ['super-admin', 'company-admin'],
                    ],
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'restore', 'deleted-choices'],
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
     * Lists all TestQuestionChoice models.
     *
     * @return string
     */
    public function actionIndex()
    {
        try
        {
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('hr'))
            {
                $searchModel = new TestQuestionChoiceSearch();
                
                if($searchModel !== null)
                {
                    $dataProvider = $searchModel->search($this->request->queryParams);
                    Yii::$app->session->setFlash('info', 'Welcome, The following are list of Test Choice');
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
    public function actionDeletedChoices()
    {
        try
        {
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('hr'))
            {
                $deletedChoices = JobPost::onlyDeleted()->all();
                if($deletedChoices !== null)
                {
                    Yii::$app->session->setFlash('info', 'Welcome, The following are list of Test Question inside Bin');
                    return $this->render('deleted-choices', [
                        'deletedChoices' => $deletedChoices,
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
     * Displays a single TestQuestionChoice model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        try
        {
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('hr'))
            {
                $model = $this->findModel($id);
                
                if($model !== null)
                {
                    Yii::$app->session->setFlash('info', 'Welcome, Here you will be able to see detailed information about this Test Question');
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
     * Creates a new TestQuestionChoice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        try
        {
            $model = new TestQuestionChoice();

            if(Yii::$app->user->can('hr'))
            {
                if($model !== null)
                {
                    
                    if ($this->request->isPost) {
                        if ($model->load($this->request->post()) && $model->save()) {
                            Yii::$app->session->setFlash('success', 'Congratulation!, Test Choice created successfully.');
                            return $this->redirect(['index']);
                        }
                    }
                    Yii::$app->session->setFlash('info', 'Welcome, Create your job Test.');
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
     * Updates an existing TestQuestionChoice model.
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
                        Yii::$app->session->setFlash('success', 'Congratulation!, The existing Test Choice updated successfully.');
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
     * Deletes an existing TestQuestionChoice model.
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
                    Yii::$app->session->setFlash('success', 'Congratulation!, Test Choice deleted successfully. You may restore them back from Bin');
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
                $model = TestQuestionChoice::findWithDeleted()->where(['id' => $id])->one();
                if ($model !== null) {
                    $model->restore();
                    Yii::$app->session->setFlash('success', 'Congratulation!, Test Choice has been restored successfully.');
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
     * Finds the TestQuestionChoice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return TestQuestionChoice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TestQuestionChoice::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
