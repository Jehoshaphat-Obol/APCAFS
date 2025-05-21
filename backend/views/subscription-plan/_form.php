<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SubscriptionPlan $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="subscription-plan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subscription_plan_duration')->textInput() ?>

    <?= $form->field($model, 'subscription_plan_duration_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subscription_plan_status_id')->textInput() ?>

    <?= $form->field($model, 'subscription_plan_created_at')->textInput() ?>

    <?= $form->field($model, 'subscription_plan_created_by')->textInput() ?>

    <?= $form->field($model, 'subscription_plan_updated_at')->textInput() ?>

    <?= $form->field($model, 'subscription_plan_updated_by')->textInput() ?>

    <?= $form->field($model, 'subscription_plan_deleted_at')->textInput() ?>

    <?= $form->field($model, 'subscription_plan_deleted_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
