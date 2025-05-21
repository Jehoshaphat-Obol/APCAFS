<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Profile $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'profile_user_id')->textInput() ?>

    <?= $form->field($model, 'profile_first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'profile_middle_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'profile_last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'profile_social_media_username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'profile_date_of_birth')->textInput() ?>

    <?= $form->field($model, 'profile_bios')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'profile_region_id')->textInput() ?>

    <?= $form->field($model, 'profile_district_id')->textInput() ?>

    <?= $form->field($model, 'profile_local_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'profile_status_id')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
