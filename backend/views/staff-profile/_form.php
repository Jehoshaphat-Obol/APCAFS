<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\StaffProfile $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="staff-profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'staff_first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'staff_middle_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'staff_last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'staff_phone_number')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
