<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\WorkExperienceSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="work-experience-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'experience_profile_id') ?>

    <?= $form->field($model, 'experience_job_title') ?>

    <?= $form->field($model, 'experience_company_name') ?>

    <?= $form->field($model, 'experience_from') ?>

    <?php // echo $form->field($model, 'experience_to') ?>

    <?php // echo $form->field($model, 'experience_status_id') ?>

    <?php // echo $form->field($model, 'experience_created_at') ?>

    <?php // echo $form->field($model, 'experience_created_by') ?>

    <?php // echo $form->field($model, 'experience_updated_at') ?>

    <?php // echo $form->field($model, 'experience_updated_by') ?>

    <?php // echo $form->field($model, 'experience_deleted_at') ?>

    <?php // echo $form->field($model, 'experience_deleted_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
