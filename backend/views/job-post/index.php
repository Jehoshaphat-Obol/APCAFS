<?php

use app\models\JobPost;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\JobPostSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Job Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('hr')): ?>
        <p>
            <?= Html::a(Yii::t('app', 'Create Job Post'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?php Pjax::begin(); ?>

    <?php
    $columns = [
        ['class' => 'yii\grid\SerialColumn'],
    ];

    if (Yii::$app->user->can('super-admin')) {
        $columns[] = [
            'attribute' => 'post_company_id',
            'value' => 'company.company_name',
        ];
    }

    $columns[] = [
        'attribute' => 'post_job_title',
        'format' => 'raw',
        'value' => function ($model) {
            $full = $model->post_job_title;
            $short = \yii\helpers\StringHelper::truncate($full, 30);
            return "<span title='" . \yii\helpers\Html::encode($full) . "'>$short</span>";
        },
    ];
    $columns[] = 'post_job_type';
    $columns[] = 'post_publication_date';
    $columns[] = 'post_deadline';
    
    $columns[] = [
        'attribute' => 'post_status_id',
        'value' => 'statusLookup.status_name',
    ];
    $columns[] = [
        'label' => 'Applications',
        'attribute' => 'applications', // optional kama unatumia sorting/searching
        'value' => function($model) use ($applicationCountMap) {
            return $applicationCountMap[$model->id] ?? 0;
        },
        'headerOptions' => [
            'style' => 'color: #007bff; font-weight: bold; text-decoration: underline;',
        ],
    ];
    $columns[] = [
        'class' => ActionColumn::className(),
        'urlCreator' => function ($action, \app\models\JobPost $model, $key, $index, $column) {
            return Url::toRoute([$action, 'id' => $model->id]);
        }
    ];
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns,
    ]); ?>

    <?php Pjax::end(); ?>

</div>
