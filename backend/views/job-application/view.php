<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\JobApplication $model */

$this->title = $model->user2->username . ' apply for '. $model->jobPost->post_job_title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Job Applications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="job-application-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(!(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('manager') || Yii::$app->user->can('hr') || Yii::$app->user->can('applicant'))): ?>
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

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',

        // Kampuni
        [
            'attribute' => 'applicant_company_id',
            'value' => $model->company->company_name ?? null,
            'label' => 'Company',
        ],

        // Job Post
        [
            'attribute' => 'applicant_job_post_id',
            'value' => $model->jobPost->post_job_title ?? null,
            'label' => 'Job Title',
        ],

        // Muombaji
        [
            'attribute' => 'applicant_user_id',
            'value' => $model->user2->username ?? null,
            'label' => 'Applicant Username',
        ],

        // Alama
        'applicant_score',

        // Status
        [
            'attribute' => 'applicant_status_id',
            'value' => $model->statusLookup->status_name ?? null,
            'label' => 'Status',
        ],

        // Tarehe ya kuundwa
        [
            'attribute' => 'applicant_created_at',
            'format' => ['date', 'php:d M Y H:i'],
            'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'),
        ],

        // Aliyeunda
        [
            'attribute' => 'applicant_created_by',
            'value' => $model->user->username ?? null,
            'label' => 'Created By',
            'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'),
        ],

        // Tarehe ya kusasishwa
        [
            'attribute' => 'applicant_updated_at',
            'format' => ['date', 'php:d M Y H:i'],
            'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'),
        ],

        // Aliyesasisha
        [
            'attribute' => 'applicant_updated_by',
            'value' => $model->user1->username ?? null,
            'label' => 'Updated By',
            'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'),
        ],

        // Tarehe ya kufutwa
        [
            'attribute' => 'applicant_deleted_at',
            'format' => ['date', 'php:d M Y H:i'],
            'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'),
        ],

        // Aliyefuta
        [
            'attribute' => 'applicant_deleted_by',
            'value' => $model->user0->username ?? null,
            'label' => 'Deleted By',
            'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'),
        ],
    ],
]) ?>


</div>
