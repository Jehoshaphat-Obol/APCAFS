<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Profile $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="profile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'profile_user_id',
            'profile_first_name',
            'profile_middle_name',
            'profile_last_name',
            'profile_social_media_username',
            'profile_date_of_birth',
            'profile_bios:ntext',
            'profile_region_id',
            'profile_district_id',
            'profile_local_address',
            'profile_status_id',
            'profile_created_at',
            'profile_created_by',
            'profile_updated_at',
            'profile_updated_by',
            'profile_deleted_at',
            'profile_deleted_by',
        ],
    ]) ?>

</div>
