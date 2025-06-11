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

<?php if(Yii::$app->user->can('hr')): ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'company.company_name',
            'user2.username',
            'post_job_title',
            'post_job_type',
            'post_job_description:ntext',
            'post_publication_date',
            'post_deadline',
            'post_profession',
            'post_location',
            'post_is_remote',
            'post_salary_range_min',
            'post_salary_range_max',
            'post_status_id',
            'post_created_at',
            'user.username',
            'post_updated_at',
            'user1.username',
            'post_deleted_at',
            'user0.username',
        ],
    ]) ?>

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
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'applicant_company_id',
            'applicant_job_post_id',
            'applicant_user_id',
            'applicant_score',
            //'applicant_status_id',
            //'applicant_created_at',
            //'applicant_created_by',
            //'applicant_updated_at',
            //'applicant_updated_by',
            //'applicant_deleted_at',
            //'applicant_deleted_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, JobApplication $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
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

                <div class="mt-4">
                    <?= Html::a('✅ Apply Now', ['apply', 'id' => $model->id], [
                            'class' => 'btn btn-primary',
                            'data' => [
                                'confirm' => 'Are you sure you want to Apply this job?',
                                'method' => 'post',
                            ],
                        ])?>
                    <?= Html::a('⬅ Back to Jobs', ['job-post/index'], ['class' => 'btn btn-secondary']) ?>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>
</div>
