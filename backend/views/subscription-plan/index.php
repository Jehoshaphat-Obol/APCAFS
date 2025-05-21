<?php

use app\models\SubscriptionPlan;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\SubscriptionPlanSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Subscription Plans');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscription-plan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Subscription Plan'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'subscription_plan_duration',
            'subscription_plan_duration_type',
            'subscription_plan_status_id',
            'subscription_plan_created_at',
            //'subscription_plan_created_by',
            //'subscription_plan_updated_at',
            //'subscription_plan_updated_by',
            //'subscription_plan_deleted_at',
            //'subscription_plan_deleted_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, SubscriptionPlan $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
