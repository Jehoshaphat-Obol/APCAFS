<?php

use app\models\JobTest;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\JobTestSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Job Tests');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-test-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Job Test'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'test_company_id',
                'value' => 'company.company_name'
            ],
            [
                'attribute' => 'test_job_post_id',
                'value' => 'jobPost.post_job_title'
            ],          
            'test_identification',
            [
                'attribute' => 'test_duration',
                'value' => function ($model) {
                    return $model->test_duration . ' minutes';
                }
            ],
            [
                'attribute' => 'test_status_id',
                'value' => 'statusLookup.status_name'
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, JobTest $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
