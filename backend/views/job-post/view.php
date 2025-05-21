<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\StatusLookup;

/** @var yii\web\View $this */
/** @var app\models\JobPost $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Job Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="job-post-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
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
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'post_company_id',
            'post_user_id',
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
            'post_created_by',
            'post_updated_at',
            'post_updated_by',
            'post_deleted_at',
            'post_deleted_by',
        ],
    ]) ?>

</div>
