<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PhoneNumber $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="phone-number-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'phone_profile_id')->textInput() ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_status_id')->textInput() ?>

    <?= $form->field($model, 'phone_created_at')->textInput() ?>

    <?= $form->field($model, 'phone_created_by')->textInput() ?>

    <?= $form->field($model, 'phone_updated_at')->textInput() ?>

    <?= $form->field($model, 'phone_updated_by')->textInput() ?>

    <?= $form->field($model, 'phone_deleted_at')->textInput() ?>

    <?= $form->field($model, 'phone_deleted_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
