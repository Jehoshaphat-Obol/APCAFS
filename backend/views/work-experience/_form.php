<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\WorkExperience $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="work-experience-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'experience_profile_id')->textInput() ?>

    <?= $form->field($model, 'experience_job_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'experience_company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'experience_from')->textInput() ?>

    <?= $form->field($model, 'experience_to')->textInput() ?>

    <?= $form->field($model, 'experience_status_id')->textInput() ?>

    <?= $form->field($model, 'experience_created_at')->textInput() ?>

    <?= $form->field($model, 'experience_created_by')->textInput() ?>

    <?= $form->field($model, 'experience_updated_at')->textInput() ?>

    <?= $form->field($model, 'experience_updated_by')->textInput() ?>

    <?= $form->field($model, 'experience_deleted_at')->textInput() ?>

    <?= $form->field($model, 'experience_deleted_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
