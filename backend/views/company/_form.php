<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Company $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_phone_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_website_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_user_size')->textInput() ?>

    <?= $form->field($model, 'subscription_plan_id')->dropDownList(
        ArrayHelper::map($plans, 'id', function($plan) {
            return $plan->formattedDuration;
        }),
        ['prompt' => 'Select Plan']
    ) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
