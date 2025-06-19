<?php

namespace app\controllers;

use Yii;
use app\models\Profile;
use app\models\AddProfile;
use app\models\PhoneNumber;
use app\models\WorkExperience;
use app\models\Education;
use app\models\Skill;
use app\models\Award;
use app\models\Language;
use app\models\Publication;
use app\models\Region;
use app\models\District;
use app\models\ProfileSearch;
use app\models\StatusLookup;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;


/**
 * ProfileController implements the CRUD actions for Profile model.
 */
class ProfileController extends Controller
{
    public $id;
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete', 'error', 'restore', 'deleted-profiles'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'restore', 'deleted-profiles'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'error', 'restore', 'deleted-profiles'],
                        'allow' => true,
                        'roles' => ['super-admin'],
                    ],
                    [
                        'actions' => ['index', 'view', 'delete', 'restore', 'deleted-profiles'],
                        'allow' => true,
                        'roles' => ['company-admin', 'hr'],
                    ],
                    [
                        'actions' => ['view', 'create', 'update'],
                        'allow' => true,
                        'roles' => ['applicant'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                    'create' => ['GET', 'POST'],
                    'save-step' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        $loginUrl = ['site/login']; // default ni management

        if (Yii::$app->user->isGuest || Yii::$app->user->can('applicant')) {
            $loginUrl = ['site/signin']; // kwa applicants
        }

        Yii::$app->user->loginUrl = $loginUrl;

        return parent::beforeAction($action);
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
     * Lists all Profile models.
     *
     * @return string
     */
    public function actionIndex()
    {
        try
        {
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('hr'))
            {
                $searchModel = new ProfileSearch();
                
                if($searchModel !== null)
                {
                    $dataProvider = $searchModel->search($this->request->queryParams);
                    Yii::$app->session->setFlash('info', 'Welcome, The following are list of applicant profiles');
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
    public function actionDeletedProfiles()
    {
        try
        {
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('hr'))
            {
                $deletedProfiles = Profile::onlyDeleted()->all();
                if($deletedProfiles !== null)
                {
                    Yii::$app->session->setFlash('info', 'Welcome, The following are list of profiles inside Bin');
                    return $this->render('deleted-profiles', [
                        'deletedProfiles' => $deletedProfiles,
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
     * Displays a single Profile model.
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
                    Yii::$app->session->setFlash('info', 'Welcome, Here you will be able to see detailed information about this profile');
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
     * Creates a new Profile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        try
        {
            if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('applicant'))
            {
                $model = new AddProfile();
                if($model !== null)
                {
                    $regions = Region::find()
                                ->where(['region_status_id' => StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar()])
                                ->all();

                    
                    if ($this->request->isPost) {
                        if ($model->load($this->request->post()) && $model->save()) {
                            Yii::$app->session->setFlash('success', 'Congratulation!, Profile created successfully.');
                            return $this->redirect(['dashboard/applicant-dashboard']);
                        }
                    }
                    Yii::$app->session->setFlash('info', 'Welcome, You must setting up your profile to be able to continue with your account.');
                    return $this->render('create', [
                        'model' => $model,
                        'regions' => $regions,
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
    
    public function actionGetDistricts()
    {
        $regionId = Yii::$app->request->get('region_id');
        $activeStatusId = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();

        $districts = District::find()
            ->where(['district_region_id' => $regionId])
            ->andWhere(['district_status_id' => $activeStatusId])
            ->all();

        $data = [];
        foreach ($districts as $district) {
            $data[] = [
                'id' => $district->id,
                'district_name' => $district->district_name,
            ];
        }

        return $this->asJson($data);
    }

    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        try {
            if (!(Yii::$app->user->can('super-admin') || Yii::$app->user->can('applicant'))) {
                throw new ForbiddenHttpException();
            }

            $model = new AddProfile();

            $profile = Profile::findOne([
                'id' => $id,
                'profile_user_id' => Yii::$app->user->id
            ]);

            if (!$profile) {
                throw new NotFoundHttpException('The requested profile does not exist or access denied.');
            }

            // Pre-fill model with existing profile data
            $model->profile_first_name = $profile->profile_first_name;
            $model->profile_middle_name = $profile->profile_middle_name;
            $model->profile_last_name = $profile->profile_last_name;
            $model->profile_social_media_username = $profile->profile_social_media_username;
            $model->profile_date_of_birth = $profile->profile_date_of_birth;
            $model->profile_bios = $profile->profile_bios;
            $model->profile_region_id = $profile->profile_region_id;
            $model->profile_district_id = $profile->profile_district_id;
            $model->profile_local_address = $profile->profile_local_address;

            // Load associated data (phones, experience, etc.)
            $model->phone_number = PhoneNumber::find()->where(['phone_profile_id' => $profile->id])->asArray()->all();
            $model->experiences = WorkExperience::find()->where(['experience_profile_id' => $profile->id])->asArray()->all();
            $model->educations = Education::find()->where(['education_profile_id' => $profile->id])->asArray()->all();
            $model->skills = Skill::find()->where(['skill_profile_id' => $profile->id])->asArray()->all();
            $model->awards = Award::find()->where(['award_profile_id' => $profile->id])->asArray()->all();
            $model->languages = Language::find()->where(['language_profile_id' => $profile->id])->asArray()->all();
            $model->publications = Publication::find()->where(['publication_profile_id' => $profile->id])->asArray()->all();

            $regions = Region::find()
                ->where(['region_status_id' => StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar()])
                ->all();

            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->update($id)) {
                    Yii::$app->session->setFlash('success', 'Profile updated successfully.');
                    return $this->redirect(['dashboard/applicant-dashboard']);
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to update profile. Please check your input.');
                }
            }

            return $this->render('update', [
                'model' => $model,
                'regions' => $regions,
                'profile' => $profile,
            ]);
        } catch (ForbiddenHttpException $e) {
            return $this->redirect(['error']);
        }
    }

    /**
     * Deletes an existing Profile model.
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
                    Yii::$app->session->setFlash('success', 'Congratulation!, Profile deleted successfully. You may restore them back from Bin');
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
            if(Yii::$app->user->can('super-admin'))
            {
                $model = Profile::findWithDeleted()->where(['id' => $id])->one();
                if ($model !== null) {
                    $model->restore();
                    Yii::$app->session->setFlash('success', 'Congratulation!, Profile has been restored successfully.');
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
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profile::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
