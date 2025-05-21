<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Company $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="company-view">

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
            'company_name',
            'company_phone_number',
            'company_email:email',
            'company_address',
            'company_website_url:url',
            'company_user_size',
            'company_activation_code',
            'company_activation_code_date',
            'company_status_id',
            'company_created_at',
            'company_updated_at',
            'company_deleted_at',
            // Subscription details
            [
                'label' => 'Subscription Start Date',
                'value' => isset($model->activeSubscription) && $model->activeSubscription->subscription_start_date 
                    ? Yii::$app->formatter->asDate($model->activeSubscription->subscription_start_date, 'php:Y-m-d') 
                    : 'Not Set',
            ],
            [
                'label' => 'Subscription End Date',
                'value' => isset($model->activeSubscription) && $model->activeSubscription->subscription_end_date 
                    ? Yii::$app->formatter->asDate($model->activeSubscription->subscription_end_date, 'php:Y-m-d') 
                    : 'Not Set',
            ],
            [
                'label' => 'Subscription Status',
                'value' => isset($model->activeSubscription->statusLookup) && $model->activeSubscription->statusLookup->status_name 
                    ? $model->activeSubscription->statusLookup->status_name 
                    : 'Not Set',
            ],                       
        ],
    ]) ?>

</div>
