<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CompanySubscriptionSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="company-subscription-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'subscription_company_id') ?>

    <?= $form->field($model, 'subscription_plan_id') ?>

    <?= $form->field($model, 'subscription_start_date') ?>

    <?= $form->field($model, 'subscription_end_date') ?>

    <?php // echo $form->field($model, 'subscription_status_id') ?>

    <?php // echo $form->field($model, 'subscription_created_at') ?>

    <?php // echo $form->field($model, 'subscription_created_by') ?>

    <?php // echo $form->field($model, 'subscription_updated_at') ?>

    <?php // echo $form->field($model, 'subscription_updated_by') ?>

    <?php // echo $form->field($model, 'subscription_deleted_at') ?>

    <?php // echo $form->field($model, 'subscription_deleted_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
