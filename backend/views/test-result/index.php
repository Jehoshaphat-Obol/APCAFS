<?php

use app\models\TestResult;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\TestResultSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Test Results');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-result-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Test Result'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'result_company_id',
            'result_test_id',
            'result_user_id',
            'result_score',
            //'result_status_id',
            //'result_created_at',
            //'result_created_by',
            //'result_updated_at',
            //'result_updated_by',
            //'result_deleted_at',
            //'result_deleted_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TestResult $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
