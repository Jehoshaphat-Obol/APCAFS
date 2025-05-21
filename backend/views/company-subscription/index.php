<?php

use app\models\CompanySubscription;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\CompanySubscriptionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Company Subscriptions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-subscription-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Company Subscription'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'subscription_company_id',
            'subscription_plan_id',
            'subscription_start_date',
            'subscription_end_date',
            //'subscription_status_id',
            //'subscription_created_at',
            //'subscription_created_by',
            //'subscription_updated_at',
            //'subscription_updated_by',
            //'subscription_deleted_at',
            //'subscription_deleted_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CompanySubscription $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
