<?php

namespace app\controllers;

use Yii;
use app\models\Company;
use app\models\User;
use app\models\AddUser;
use app\models\ChangePassword;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\web\BadRequestHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete', 'error', 'restore', 'deleted-users', 'change-password'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'restore', 'deleted-users', 'change-password'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'restore', 'deleted-users', 'change-password'],
                        'allow' => true,
                        'roles' => ['super-admin', 'company-admin', 'manager', 'hr'],
                    ],
                    [
                        'actions' => ['change-password'],
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
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        try
        {
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('hr'))
            {
                $searchModel = new UserSearch();
                if($searchModel !== null)
                {
                    $company = Company::find()
                            ->where(['id' => Yii::$app->user->identity->company_id])
                            ->one();
                    $dataProvider = $searchModel->search($this->request->queryParams);
                    if(Yii::$app->user->can('super-admin'))
                    {
                        Yii::$app->session->setFlash('info', 'Welcome, list of all system users for all Companies');
                    } elseif(Yii::$app->user->can('company-admin'))
                    {
                        Yii::$app->session->setFlash('info', 'Welcome, list of Company users for your company');
                    } elseif(Yii::$app->user->can('manager'))
                    {
                        Yii::$app->session->setFlash('info', 'Welcome, list of all applicants for your company');
                    }

                    return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'company' => $company,
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
     * Lists all Deleted Branches models.
     *
     * @return string
     */
    public function actionDeletedUsers()
    {
        try
        {
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'))
            {
                $deletedUsers = User::onlyDeleted()->all();
                if($deletedUsers !== null)
                {
                    if(Yii::$app->user->can('super-admin'))
                    {
                        Yii::$app->session->setFlash('info', 'Welcome, list of all system users inside Bin');
                    } elseif(Yii::$app->user->can('company-admin'))
                    {
                        Yii::$app->session->setFlash('info', 'Welcome, list of all Company users inside Bin');
                    }

                    return $this->render('deleted-users', [
                        'deletedUsers' => $deletedUsers,
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
     * Displays a single User model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        try
        {
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'))
            {
                $model = $this->findModel($id);
        
                if($model !== null)
                {
                    Yii::$app->session->setFlash('info', 'Welcome, Here you will be able to see detailed information about this User');
                    return $this->render('view', [
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        try
        {
            $company = Company::find()
                    ->where(['id' => Yii::$app->user->identity->company_id])
                    ->one();
            if($company->companyUserCheckLimit()) {
                $model = new AddUser();
                if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'))
                {
                    if($model !== null)
                    {
                        $company_id = Yii::$app->user->identity->company_id;

                        $companies = Company::find()
                        ->orderBy([
                        'company_name' => SORT_ASC,
                        ])->all();

                        $company = new Company();
                        if ($this->request->isPost) {
                            if ($model->load($this->request->post()) && $model->save()) {
                                
                                if(Yii::$app->user->can('super-admin'))
                                {
                                    Yii::$app->session->setFlash('success', 'Congratulation!, Company Admin created successfully.');
                                } elseif(Yii::$app->user->can('company-admin'))
                                {
                                    Yii::$app->session->setFlash('success', 'Congratulation!, Company Manager created successfully.');
                                } 

                                return $this->redirect(['index']);
                            }
                        } 
                
                        if(Yii::$app->user->can('super-admin'))
                        {
                            Yii::$app->session->setFlash('info', 'Welcome, Assigning Company Admin to its company.');
                        } elseif(Yii::$app->user->can('company-admin'))
                        {
                            Yii::$app->session->setFlash('info', 'Welcome, Expanding your company by adding Human Resource Managers (HR).');
                        }

                        return $this->render('create', [
                            'model' => $model,
                            'companies' => $companies,
                            'company' => $company
                        ]);
                    }
                    throw new NotFoundHttpException('The requested page does not exist.');
                }
                throw new ForbiddenHttpException();
            } else {
                // Kampuni imefikia kikomo cha matawi
                Yii::$app->session->setFlash('warning', 'You have reached the user creation limit, please contact your admin.');
                return $this->redirect(['index']);
            }
        } catch (ForbiddenHttpException $e)
        {
            return $this->redirect(['error']);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        try
        {
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('manager'))
            {
                if($model !== null)
                {
                    $company_id = Yii::$app->user->identity->company_id;

                    $companies = Company::find()
                        ->orderBy([
                        'company_name' => SORT_ASC,
                        ])->all();

                        // Get all roles assigned to the user
                        $auth = Yii::$app->authManager;
                        $roles = $auth->getRolesByUser($model->id);
                        $model->roles = array_keys($roles); 


                    if ($this->request->isPost && $model->load($this->request->post())) {

                        // Futa role zote alizokuwa nazo awali
                        $auth->revokeAll($model->id);

                        // Kuchagua role mpya
                        if (!empty($model->roles)) {
                            $roleObj = $auth->getRole($model->roles); // Pata role iliyo chaguliwa
                            if ($roleObj) {
                                $auth->assign($roleObj, $model->id); // Teua role mpya
                            }
                        }

                        $model->user_updated_by = Yii::$app->user->id;
                        if(!$model->save())
                        {
                            throw new \Exception("Failed to update user information");
                        }
                        if(Yii::$app->user->can('super-admin'))
                        {
                            Yii::$app->session->setFlash('success', 'Congratulation!, The existing Company Admin updated successfully.');
                        } elseif(Yii::$app->user->can('company-admin'))
                        {
                            Yii::$app->session->setFlash('success', 'Congratulation!, The existing Human Resource Manager updated successfully.');
                        }
                        
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
            
                    return $this->render('update', [
                        'model' => $model,
                        'companies' => $companies,
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
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        try
        {
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'))
            {
                if(Yii::$app->user->id != $id)
                {
                    $model = $this->findModel($id);

                    if ($model !== null) {
                        $model->softDelete();

                        if(Yii::$app->user->can('super-admin'))
                        {
                            Yii::$app->session->setFlash('success', 'Congratulation!, Company Admin deleted successfully. You may restore them back from Bin');
                        } elseif(Yii::$app->user->can('company-admin'))
                        {
                            Yii::$app->session->setFlash('success', 'Congratulation!, Human Resource Manager deleted successfully. You may restore them back from Bin');
                        }

                        return $this->redirect(['index']);
                    }
                    throw new NotFoundHttpException('The requested page does not exist.');
                }
                throw new BadRequestHttpException('Sorry! Forbidden to delete your self');
            } 
            throw new ForbiddenHttpException();
        } catch (ForbiddenHttpException $e)
        {
            return $this->redirect(['error']);
        }
    }

    /**
     * Restore an existing User model.
     * If Restore is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionRestore($id)
    {
        try
        {
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'))
            {
                $model = User::findWithDeleted()->where(['id' => $id])->one();
                if ($model !== null) {
                    $model->restore();
                    
                    if(Yii::$app->user->can('super-admin'))
                    {
                        Yii::$app->session->setFlash('success', 'Congratulation!, Company Admin Restored successfully.');
                    } elseif(Yii::$app->user->can('company-admin'))
                    {
                        Yii::$app->session->setFlash('success', 'Congratulation!, Human Resource Manager Restored successfully.');
                    }

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
     * Changing password.
     *
     * @return mixed
     */
    public function actionChangePassword()
    {
        $model = new ChangePassword();
        $model->id = Yii::$app->user->identity->id; // Pre-populate with current user ID

        try
        {
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('manager') || Yii::$app->user->can('hr') || Yii::$app->user->can('applicant'))
            {
                if($model !== null)
                {
                    if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        // Password changed successfully
                        Yii::$app->session->setFlash('success', 'Password changed successfully');
                        
                        $isApplicant = Yii::$app->user->can('applicant');

                        Yii::$app->user->logout();

                        if ($isApplicant) {
                            return $this->redirect(['site/signin']);
                        }

                        Yii::$app->session->setFlash('success', 'Password Changed successfully, Please Login With your New Password');
                        return $this->redirect(['site/login']);
                    } else {
                        return $this->render('change-password', ['model' => $model]);
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
