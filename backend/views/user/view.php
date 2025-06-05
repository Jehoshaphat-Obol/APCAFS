<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

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
            'company_id',
            'username',
            [
            'attribute' => 'auth_key',
            'visible' => Yii::$app->user->can('super-admin'),
            ],
            [
            'attribute' => 'password_hash',
            'visible' => Yii::$app->user->can('super-admin'),
            ],
            [
                'attribute' => 'password_reset_token',
                'visible' => Yii::$app->user->can('super-admin'),
            ],
            'email:email',
            [
                'attribute' => 'verification_token',
                'visible' => Yii::$app->user->can('super-admin'),
            ],
            'user_status_id',
            [
            'attribute' => 'created_at',
            'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'),
            ],
            [
                'attribute' => 'user_created_by',
                'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'),
            ],
            [
            'attribute' => 'updated_at',
            'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'),
            ],
            [
                'attribute' => 'user_updated_by',
                'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'),
            ],
            [
            'attribute' => 'user_deleted_at',
            'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'),
            ],
            [
                'attribute' => 'user_deleted_by',
                'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'),
            ],
        ],
    ]) ?>

</div>
