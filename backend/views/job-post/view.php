<?php

use app\models\JobApplication;
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\StatusLookup;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\JobPost $model */

$this->title = $model->post_job_title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Job Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="job-post-view">
<?php if(Yii::$app->user->can('hr')): ?>
    <h1><?= Html::encode($this->title) ?></h1>
<?php endif; ?>
    <p>
        <?php if(Yii::$app->user->can('hr')): ?>
            <?php 
                $statusIds = StatusLookup::find()
                ->select('id')
                ->where(['status_code' => ['active', 'unpublish', 'draft']])
                ->column();
            
                if (in_array($model->post_status_id, $statusIds)) {
                    echo Html::a('Published', ['publish', 'id' => $model->id], [
                    'class' => 'btn btn-info',
                    'data' => [
                        'confirm' => 'Are you sure you want to publish this job post?',
                        'method' => 'post',
                        ],
                    ]);
                } else{
                    echo Html::a('Unpublished', ['unpublish', 'id' => $model->id], [
                        'class' => 'btn btn-info',
                        'data' => [
                            'confirm' => 'Are you sure you want to unpublish this job post?',
                            'method' => 'post',
                        ],
                    ]);
                }
            ?>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>

<?php if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('manager') || Yii::$app->user->can('hr')): ?>
    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'company.company_name',
        [
            'attribute' => 'user2.username', // User aliyehusika awali
            'label' => 'Posted By',
        ],
        'post_job_title',
        'post_job_type',
        'post_job_description:ntext',
        'post_publication_date:datetime',
        'post_deadline:date',
        'post_profession',
        'post_location',
        [
            'attribute' => 'post_is_remote',
            'value' => $model->post_is_remote ? 'Yes' : 'No',
        ],
        'post_salary_range_min',
        'post_salary_range_max',
        'statusLookup.status_name',
        
        // Tarehe ya kuundwa (formatted + conditional display)
        [
            'attribute' => 'post_created_at',
            'format' => ['date', 'php:d M Y H:i'],
            'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'),
        ],

        // Aliyeunda
        [
            'attribute' => 'user.username',
            'label' => 'Created By',
            'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'),
        ],

        // Tarehe ya kusasishwa
        [
            'attribute' => 'post_updated_at',
            'format' => ['date', 'php:d M Y H:i'],
            'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'),
        ],

        // Aliyesasisha
        [
            'attribute' => 'user1.username',
            'label' => 'Updated By',
            'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'),
        ],

        // Tarehe ya kufutwa (soft delete)
        [
            'attribute' => 'post_deleted_at',
            'format' => ['date', 'php:d M Y H:i'],
            'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'),
        ],

        // Aliyefuta
        [
            'attribute' => 'user0.username',
            'label' => 'Deleted By',
            'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'),
        ],
    ],
    ]) ?>
<?php endif; ?>
<?php if(Yii::$app->user->can('manager') || Yii::$app->user->can('hr')): ?>
    <div class="job-application-index">

    <h1><?= Html::encode("Job Applications") ?></h1>

    <p>
        <?= Html::a('Analyze', ['analyze', 'id' => $model->id], [
            'class' => 'btn btn-primary',
            'data' => [
                'confirm' => 'Are you sure you want to Analyze job applications?',
                'method' => 'post',
            ],
        ])?>

        <?= Html::a('Select Candidates', ['select-candidates-form', 'id' => $model->id], [
            'class' => 'btn btn-success',
        ]) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
        
            [
                'attribute' => 'applicant_company_id',
                'value' => 'company.company_name',
            ],
            [
                'attribute' => 'applicant_job_post_id',
                'value' => 'jobPost.post_job_title',
            ],
            [
                'attribute' => 'applicant_user_id',
                'value' => 'user2.username',
            ],

            'applicant_score',
            
            [
                'attribute' => 'applicant_status_id',
                'value' => 'statusLookup.status_name',
            ],
            
            'applicant_created_at',
            //'applicant_created_by',
            //'applicant_updated_at',
            //'applicant_updated_by',
            //'applicant_deleted_at',
            //'applicant_deleted_by',
            [
                'class' => ActionColumn::className(),
                'template' => '{view}', // View tu itaonekana
                'controller' => 'job-application', // Muhimu! Elekeza kwa controller sahihi
                'urlCreator' => function ($action, $jobApp, $key, $index, $column) {
                    return Url::toRoute(["job-application/$action", 'id' => $jobApp->id]);
                },
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

<?php endif; ?>

<?php if(Yii::$app->user->can('applicant')): ?>
    <div class="container my-5">
        <div class="card shadow-lg">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0"><?= Html::encode($model->post_job_title) ?> at <?= Html::encode($model->company->company_name) ?></h4>
            </div>
            <div class="card-body">
                <p><strong>Job Type:</strong> <?= ucfirst($model->post_job_type) ?></p>
                <p><strong>Location:</strong> <?= Html::encode($model->post_location) ?> <?= $model->post_is_remote ? '(Remote)' : '' ?></p>
                <p><strong>Profession:</strong> <?= Html::encode($model->post_profession) ?></p>
                <p><strong>Salary Range:</strong> Tsh <?= Yii::$app->formatter->asDecimal($model->post_salary_range_min, 2) ?> - Tsh <?= Yii::$app->formatter->asDecimal($model->post_salary_range_max, 2) ?></p>
                <p><strong>Deadline:</strong> <?= Yii::$app->formatter->asDate($model->post_deadline) ?></p>

                <hr>

                <h5 class="mt-4">Job Description</h5>
                <p><?= nl2br(Html::encode($model->post_job_description)) ?></p>

                <?php
                    // Angalia kama user ameomba hii kazi tayari
                    $existingApplication = \app\models\JobApplication::find()
                        ->where(['applicant_job_post_id' => $model->id, 'applicant_user_id' => Yii::$app->user->id])
                        ->one();
                ?>
                <div class="mt-4">
                    <?php if ($existingApplication): ?>
                        <?= Html::a('❌ Cancel Application', ['cancel', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to cancel this job application?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    <?php else: ?>
                        <?= Html::a('✅ Apply Now', ['apply', 'id' => $model->id], [
                            'class' => 'btn btn-primary',
                            'data' => [
                                'confirm' => 'Are you sure you want to apply for this job?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    <?php endif; ?>
                    <?= Html::a('⬅ Back to Jobs', ['job-post/index'], ['class' => 'btn btn-secondary']) ?>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>
</div>
