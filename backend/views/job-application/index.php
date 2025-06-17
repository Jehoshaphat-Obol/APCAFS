<?php

use app\models\JobApplication;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\JobApplicationSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Job Applications');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-application-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->isGuest || !(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('hr') || Yii::$app->user->can('manager') || Yii::$app->user->can('applicant'))): ?>
        <p>
            <?= Html::a(Yii::t('app', 'Create Job Application'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?php Pjax::begin(); ?>

    <?php
    $columns = [
        ['class' => 'yii\grid\SerialColumn'],
    ];

    if (Yii::$app->user->can('super-admin')) {
        $columns[] = [
            'attribute' => 'applicant_company_id',
            'value' => 'company.company_name',
        ];
    }

    $columns[] = [
        'attribute' => 'applicant_job_post_id',
        'format' => 'raw',
        'value' => function ($model) {
            $full = $model->jobPost->post_job_title ?? '';
            $short = \yii\helpers\StringHelper::truncate($full, 30);
            return "<span title='" . Html::encode($full) . "'>$short</span>";
        },
        'headerOptions' => [
            'style' => 'color: #007bff; font-weight: bold; text-decoration: underline;',
        ],
    ];

    $columns[] = [
        'attribute' => 'applicant_user_id',
        'value' => 'user2.username',
    ];

    $columns[] = 'applicant_score';

    $columns[] = [
        'attribute' => 'applicant_status_id',
        'value' => 'statusLookup.status_name',
    ];

    $columns[] = [
        'class' => ActionColumn::className(),
        'urlCreator' => function ($action, \app\models\JobApplication $model, $key, $index, $column) {
            return Url::toRoute([$action, 'id' => $model->id]);
        },
        'template' => Yii::$app->user->can('super-admin') ? '{view} {update} {delete}' : '{view}',
        'visibleButtons' => [
            'view' => true,
            'update' => true,
            'delete' => true,
        ],
    ];
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns,
    ]); ?>

    <?php Pjax::end(); ?>

</div>