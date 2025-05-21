<?php

use app\models\PhoneNumber;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\PhoneNumberSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Phone Numbers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phone-number-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Phone Number'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'phone_profile_id',
            'phone_number',
            'phone_status_id',
            'phone_created_at',
            //'phone_created_by',
            //'phone_updated_at',
            //'phone_updated_by',
            //'phone_deleted_at',
            //'phone_deleted_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, PhoneNumber $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
