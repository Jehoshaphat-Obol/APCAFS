<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\JobApplication $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="job-application-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'applicant_company_id')->textInput() ?>

    <?= $form->field($model, 'applicant_job_post_id')->textInput() ?>

    <?= $form->field($model, 'applicant_user_id')->textInput() ?>

    <?= $form->field($model, 'applicant_score')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'applicant_status_id')->textInput() ?>

    <?= $form->field($model, 'applicant_created_at')->textInput() ?>

    <?= $form->field($model, 'applicant_created_by')->textInput() ?>

    <?= $form->field($model, 'applicant_updated_at')->textInput() ?>

    <?= $form->field($model, 'applicant_updated_by')->textInput() ?>

    <?= $form->field($model, 'applicant_deleted_at')->textInput() ?>

    <?= $form->field($model, 'applicant_deleted_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
