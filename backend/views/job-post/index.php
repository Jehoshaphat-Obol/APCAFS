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
    $canApplicant = Yii::$app->user->can('applicant'); 

    $template = '{view} {update} {delete}';

    if ($canApplicant) {
        $template = ' {applicant-view}'; 
    }

    $columns[] = [
        'class' => ActionColumn::className(),
        'template' => $template,
        'urlCreator' => function ($action, $model, $key, $index, $column) {
            if ($action === 'applicant-view') {
                return Url::toRoute(['applicant-view', 'id' => $model->id]);
            }
            return Url::toRoute([$action, 'id' => $model->id]);
        },
        'buttons' => [
            'applicant-view' => function ($url, $model, $key) use ($canApplicant) {
                if (!$canApplicant) {
                    return ''; // Wala haionekani kama si applicant
                }
                return Html::a('View', $url, [
                    'title' => 'Applicant View',
                    'aria-label' => 'Applicant View',
                    'data-pjax' => '0',
                    'style' => '
                        background-color: #28a745;
                        color: white;
                        padding: 5px 10px;
                        border-radius: 4px;
                        font-weight: bold;
                        text-decoration: none;
                        display: inline-block;
                        cursor: pointer;
                        transition: background-color 0.3s ease;
                    ',
                    'onmouseover' => "this.style.backgroundColor='#218838';",
                    'onmouseout' => "this.style.backgroundColor='#28a745';",
                ]);
            },
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
