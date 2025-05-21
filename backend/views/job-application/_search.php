<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\JobApplicationSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="job-application-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'applicant_company_id') ?>

    <?= $form->field($model, 'applicant_job_post_id') ?>

    <?= $form->field($model, 'applicant_user_id') ?>

    <?= $form->field($model, 'applicant_score') ?>

    <?php // echo $form->field($model, 'applicant_status_id') ?>

    <?php // echo $form->field($model, 'applicant_created_at') ?>

    <?php // echo $form->field($model, 'applicant_created_by') ?>

    <?php // echo $form->field($model, 'applicant_updated_at') ?>

    <?php // echo $form->field($model, 'applicant_updated_by') ?>

    <?php // echo $form->field($model, 'applicant_deleted_at') ?>

    <?php // echo $form->field($model, 'applicant_deleted_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
