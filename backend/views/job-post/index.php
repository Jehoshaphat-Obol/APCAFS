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
    <?php if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('hr')): ?>
        <p>
            <?= Html::a(Yii::t('app', 'Create Job Post'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'post_company_id',
                'value' => 'company.company_name'
            ],
            'post_job_title',
            'post_job_type',
            //'post_job_description:ntext',
            'post_publication_date',
            //'post_deadline',
            //'post_profession',
            //'post_location',
            //'post_is_remote',
            //'post_salary_range_min',
            //'post_salary_range_max',
            [
                'attribute' => 'post_status_id',
                'value' => 'statusLookup.status_name'
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, JobPost $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
