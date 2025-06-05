<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Profile $model */

$this->title = $model->profile_last_name;
if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('manager') || Yii::$app->user->can('hr'))
{
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profiles'), 'url' => ['index']];
}
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="profile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if(Yii::$app->user->can('super-admin')):?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>

<div class="container mt-4">
    <div class="d-flex justify-content-end mb-3">
        <?= Html::button('🖨️ Print', ['class' => 'btn btn-outline-primary me-2', 'onclick' => 'window.print()']) ?>
        <?= Html::a('👁️ Preview PDF', ['cv-preview', 'id' => $model->id], ['class' => 'btn btn-outline-success', 'target' => '_blank']) ?>
        <?= Html::a('⬇️ Download PDF', ['profile/pdf', 'id' => $model->id], ['class' => 'btn btn-outline-success']) ?>
    </div>

    <div class="row">
        <!-- Account Information -->
        <div class="col-md-6">
            <div class="bg-white shadow rounded p-4 mb-4 h-100">
                <h4 class="border-bottom pb-2 mb-3 text-primary">👤 Account Information</h4>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'user2.username',
                        'user2.email',
                    ],
                    'options' => ['class' => 'table table-borderless table-sm'],
                ]) ?>
            </div>
        </div>

        <!-- Personal Details -->
        <div class="col-md-6">
            <div class="bg-white shadow rounded p-4 mb-4 h-100">
                <h4 class="border-bottom pb-2 mb-3 text-success">🧍 Personal Details</h4>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'profile_first_name',
                        'profile_middle_name',
                        'profile_last_name',
                        'profile_date_of_birth',
                    ],
                    'options' => ['class' => 'table table-borderless table-sm'],
                ]) ?>
            </div>
        </div>

        <!-- Location Info -->
        <div class="col-md-6">
            <div class="bg-white shadow rounded p-4 mb-4 h-100">
                <h4 class="border-bottom pb-2 mb-3 text-info">📍 Address & Location</h4>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'region.region_name',
                        'district.district_name',
                        'profile_local_address',
                    ],
                    'options' => ['class' => 'table table-borderless table-sm'],
                ]) ?>
            </div>
        </div>

        <!-- Social Media -->
        <div class="col-md-6">
            <div class="bg-white shadow rounded p-4 mb-4 h-100">
                <h4 class="border-bottom pb-2 mb-3 text-warning">💬 Biography & Media</h4>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'profile_social_media_username',
                        'profile_bios:ntext',
                    ],
                    'options' => ['class' => 'table table-borderless table-sm'],
                ]) ?>
            </div>
        </div>

        <!-- Education -->
        <div class="col-md-6">
            <div class="bg-white shadow rounded p-4 mb-4 h-100">
                <h4 class="border-bottom pb-2 mb-3 text-secondary">🎓 Education</h4>
                <!-- You can use GridView or loop data here -->
                <p>Education data placeholder...</p>
            </div>
        </div>

        <!-- Experience -->
        <div class="col-md-6">
            <div class="bg-white shadow rounded p-4 mb-4 h-100">
                <h4 class="border-bottom pb-2 mb-3 text-dark">💼 Experience</h4>
                <p>Experience data placeholder...</p>
            </div>
        </div>

        <!-- Referees -->
        <div class="col-md-12">
            <div class="bg-white shadow rounded p-4 mb-4">
                <h4 class="border-bottom pb-2 mb-3 text-danger">📇 Referees</h4>
                <p>Referee information placeholder...</p>
            </div>
        </div>

        <!-- System Info -->
        <?php if (Yii::$app->user->can('super-admin') || Yii::$app->user->can('applicant')): ?>
        <div class="col-md-12">
            <div class="bg-light shadow-sm rounded p-4 mb-4">
                <h4 class="border-bottom pb-2 mb-3 text-muted">⚙️ System Information</h4>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'attribute' => 'profile_created_at',
                            'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('applicant'),
                        ],
                        [
                            'attribute' => 'profile_created_by',
                            'visible' => Yii::$app->user->can('super-admin'),
                        ],
                        [
                            'attribute' => 'profile_updated_at',
                            'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('applicant'),
                        ],
                        [
                            'attribute' => 'profile_updated_by',
                            'visible' => Yii::$app->user->can('super-admin'),
                        ],
                        [
                            'attribute' => 'profile_deleted_at',
                            'visible' => Yii::$app->user->can('super-admin'),
                        ],
                        [
                            'attribute' => 'profile_deleted_by',
                            'visible' => Yii::$app->user->can('super-admin'),
                        ],
                    ],
                    'options' => ['class' => 'table table-borderless table-sm'],
                ]) ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

</div>
