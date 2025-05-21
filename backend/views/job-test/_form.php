<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\AddJobTest $model */
/** @var yii\widgets\ActiveForm $form */

$this->registerJsFile('@web/js/jobtest.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>

<div class="job-test-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'test_job_post_id')->dropDownList(
        ArrayHelper::map($jobs, 'id', 'post_job_title'),
        ['prompt' => 'Select Job Post']
    ) ?>

    <?= $form->field($model, 'test_identification')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'test_duration')->textInput() ?>

    <?= $form->field($model, 'test_status_id')->dropDownList(
        ArrayHelper::map($status, 'id', 'status_name'),
        ['prompt' => 'Select Status']
    ) ?>

    <hr>
    <h4>Test Questions</h4>
    <div id="questions-container">
        <!-- Maswali yataongezwa hapa kwa JS -->
    </div>
    <button type="button" class="btn btn-secondary" onclick="addQuestion()">Add Question</button>

    <br><br>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<!-- Template ya swali (imefichwa) -->
<template id="question-template">
    <div class="question-item card mb-3 p-3 border rounded shadow-sm">
        <button type="button" class="btn-close float-end" onclick="removeQuestion(this)"></button>

        <div class="form-group">
            <?= Html::label('Question:', 'question') ?>
            <?= Html::textInput('AddJobTest[questions][__index__][question]', '', [
                'class' => 'form-control',
                'required' => true
            ]) ?>
        </div>

        <div class="form-group">
            <?= Html::label('Correct Choice (Answer):', 'correct_choice') ?>
            <?= Html::dropDownList(
                'AddJobTest[questions][__index__][correct_choice]',
                null,
                ['A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D'],
                ['class' => 'form-control correct-choice-select']
            ) ?>
        </div>

        <div class="choices-container mt-2">
            <div class="form-group">
                <?= Html::label('Choice A', 'choice_a') ?>
                <?= Html::textInput('AddJobTest[questions][__index__][choices][0][text]', '', [
                    'class' => 'form-control',
                    'required' => true
                ]) ?>
                <?= Html::hiddenInput('AddJobTest[questions][__index__][choices][0][label]', 'A') ?>
            </div>

            <div class="form-group">
                <?= Html::label('Choice B', 'choice_b') ?>
                <?= Html::textInput('AddJobTest[questions][__index__][choices][1][text]', '', [
                    'class' => 'form-control',
                    'required' => true
                ]) ?>
                <?= Html::hiddenInput('AddJobTest[questions][__index__][choices][1][label]', 'B') ?>
            </div>

            <div class="form-group">
                <?= Html::label('Choice C', 'choice_c') ?>
                <?= Html::textInput('AddJobTest[questions][__index__][choices][2][text]', '', [
                    'class' => 'form-control',
                    'required' => true
                ]) ?>
                <?= Html::hiddenInput('AddJobTest[questions][__index__][choices][2][label]', 'C') ?>
            </div>

            <div class="form-group">
                <?= Html::label('Choice D', 'choice_d') ?>
                <?= Html::textInput('AddJobTest[questions][__index__][choices][3][text]', '', [
                    'class' => 'form-control',
                    'required' => true
                ]) ?>
                <?= Html::hiddenInput('AddJobTest[questions][__index__][choices][3][label]', 'D') ?>
            </div>
        </div>
    </div>
</template>

