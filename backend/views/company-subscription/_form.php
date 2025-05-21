<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CompanySubscription $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="company-subscription-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subscription_company_id')->textInput() ?>

    <?= $form->field($model, 'subscription_plan_id')->textInput() ?>

    <?= $form->field($model, 'subscription_start_date')->textInput() ?>

    <?= $form->field($model, 'subscription_end_date')->textInput() ?>

    <?= $form->field($model, 'subscription_status_id')->textInput() ?>

    <?= $form->field($model, 'subscription_created_at')->textInput() ?>

    <?= $form->field($model, 'subscription_created_by')->textInput() ?>

    <?= $form->field($model, 'subscription_updated_at')->textInput() ?>

    <?= $form->field($model, 'subscription_updated_by')->textInput() ?>

    <?= $form->field($model, 'subscription_deleted_at')->textInput() ?>

    <?= $form->field($model, 'subscription_deleted_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
