<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/** @var yii\web\View $this */
/** @var app\models\JobPost $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="job-post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'post_job_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_job_type')->dropDownList([
            'Full-Time' => 'Full-Time', 
            'Part-Time' => 'Part-Time', 
            'Intern' => 'Intern', 
            'Contract' => 'Contract', 
            'Volunteer' => 'Volunteer',
        ], [
            'prompt' => 'Select Job Type'
        ]) ?>

    <?= $form->field($model, 'post_job_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'post_deadline')->textInput([
        'class' => 'form-control flatpickr',
        'placeholder' => 'Choose Date...'
    ]) ?>

    <?= $form->field($model, 'post_profession')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_is_remote')->dropDownList([
            1 => 'Yes',
            0 => 'No'
        ], [
            'prompt' => 'Choose if it is done remotely'
        ]) ?>

    <?= $form->field($model, 'post_salary_range_min')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_salary_range_max')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_status_id')->dropDownList(
        ArrayHelper::map($status, 'id', 'status_name'),
    ['prompt' => 'Select Status']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
