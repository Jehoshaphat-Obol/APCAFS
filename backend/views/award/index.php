<?php

use app\models\Award;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\AwardSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Awards');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="award-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Award'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'award_profile_id',
            'award_title',
            'award_organization_name',
            'award_issue_number',
            //'award_date_of_issue',
            //'award_status_id',
            //'award_created_at',
            //'award_created_by',
            //'award_updated_at',
            //'award_updated_by',
            //'award_deleted_at',
            //'award_deleted_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Award $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
