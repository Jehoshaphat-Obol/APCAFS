<?php

use app\models\StaffProfile;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\StaffProfileSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Staff Profiles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-profile-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Staff Profile'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'staff_company_id',
            'staff_user_id',
            'staff_first_name',
            'staff_middle_name',
            //'staff_last_name',
            //'staff_phone_number',
            //'staff_status_id',
            //'staff_created_at',
            //'staff_created_by',
            //'staff_updated_at',
            //'staff_updated_by',
            //'staff_deleted_at',
            //'staff_deleted_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, StaffProfile $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
