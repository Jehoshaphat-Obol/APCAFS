<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\JobPostSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="job-post-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'post_company_id') ?>

    <?= $form->field($model, 'post_user_id') ?>

    <?= $form->field($model, 'post_job_title') ?>

    <?= $form->field($model, 'post_job_type') ?>

    <?php // echo $form->field($model, 'post_job_description') ?>

    <?php // echo $form->field($model, 'post_publication_date') ?>

    <?php // echo $form->field($model, 'post_deadline') ?>

    <?php // echo $form->field($model, 'post_profession') ?>

    <?php // echo $form->field($model, 'post_location') ?>

    <?php // echo $form->field($model, 'post_is_remote') ?>

    <?php // echo $form->field($model, 'post_salary_range_min') ?>

    <?php // echo $form->field($model, 'post_salary_range_max') ?>

    <?php // echo $form->field($model, 'post_status_id') ?>

    <?php // echo $form->field($model, 'post_created_at') ?>

    <?php // echo $form->field($model, 'post_created_by') ?>

    <?php // echo $form->field($model, 'post_updated_at') ?>

    <?php // echo $form->field($model, 'post_updated_by') ?>

    <?php // echo $form->field($model, 'post_deleted_at') ?>

    <?php // echo $form->field($model, 'post_deleted_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
