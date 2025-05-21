<?php

use app\models\TestQuestionChoice;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\TestQuestionChoiceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Test Question Choices');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-question-choice-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Test Question Choice'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'choice_company_id',
            'choice_question_id',
            'choice_label',
            'choice_text:ntext',
            //'choice_is_correct',
            //'choice_status_id',
            //'choice_created_at',
            //'choice_created_by',
            //'choice_updated_at',
            //'choice_updated_by',
            //'choice_deleted_at',
            //'choice_deleted_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TestQuestionChoice $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
