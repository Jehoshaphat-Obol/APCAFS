<?php

use app\models\Skill;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\SkillSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Skills');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skill-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Skill'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'skill_profile_id',
            'skill_type',
            'skill_name',
            'skill_status_id',
            //'skill_created_at',
            //'skill_created_by',
            //'skill_updated_at',
            //'skill_updated_by',
            //'skill_deleted_at',
            //'skill_deleted_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Skill $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
