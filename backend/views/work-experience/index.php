<?php

use app\models\WorkExperience;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\WorkExperienceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Work Experiences');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-experience-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Work Experience'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'experience_profile_id',
            'experience_job_title',
            'experience_company_name',
            'experience_from',
            //'experience_to',
            //'experience_status_id',
            //'experience_created_at',
            //'experience_created_by',
            //'experience_updated_at',
            //'experience_updated_by',
            //'experience_deleted_at',
            //'experience_deleted_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, WorkExperience $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
