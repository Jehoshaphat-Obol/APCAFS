<?php

use app\models\PersonalityAssessment;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\PersonalityAssessmentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Personality Assessments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personality-assessment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (Yii::$app->user->isGuest || !(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('hr') || Yii::$app->user->can('manager') || Yii::$app->user->can('applicant'))): ?>
        <p>
            <?= Html::a(Yii::t('app', 'Create Personality Assessment'), ['create'], ['class' => 'btn btn-success']) ?>
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
                'label' => 'Full Name',
                'attribute' => 'personality_profile_id', // au chochote kinachoendana
                'value' => function ($model) {
                    return $model->profile->profile_first_name . ' ' . $model->profile->profile_last_name;
                },
            ],
            'personality_IE_score',
            'personality_NS_score',
            'personality_TF_score',
            'personality_JB_score',
            //'personality_last_analysis_date',
            //'personality_status_id',
            //'personality_created_at',
            //'personality_created_by',
            //'personality_updated_at',
            //'personality_updated_by',
            //'personality_deleted_at',
            //'personality_deleted_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, PersonalityAssessment $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
