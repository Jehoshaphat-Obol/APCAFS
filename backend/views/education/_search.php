<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\EducationSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="education-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'education_profile_id') ?>

    <?= $form->field($model, 'education_degree_name') ?>

    <?= $form->field($model, 'education_programme_name') ?>

    <?= $form->field($model, 'education_university_name') ?>

    <?php // echo $form->field($model, 'education_graduation_date') ?>

    <?php // echo $form->field($model, 'education_status_id') ?>

    <?php // echo $form->field($model, 'education_created_at') ?>

    <?php // echo $form->field($model, 'education_created_by') ?>

    <?php // echo $form->field($model, 'education_updated_at') ?>

    <?php // echo $form->field($model, 'education_updated_by') ?>

    <?php // echo $form->field($model, 'education_deleted_at') ?>

    <?php // echo $form->field($model, 'education_deleted_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
