<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Education $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="education-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'education_profile_id')->textInput() ?>

    <?= $form->field($model, 'education_degree_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'education_programme_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'education_university_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'education_graduation_date')->textInput() ?>

    <?= $form->field($model, 'education_status_id')->textInput() ?>

    <?= $form->field($model, 'education_created_at')->textInput() ?>

    <?= $form->field($model, 'education_created_by')->textInput() ?>

    <?= $form->field($model, 'education_updated_at')->textInput() ?>

    <?= $form->field($model, 'education_updated_by')->textInput() ?>

    <?= $form->field($model, 'education_deleted_at')->textInput() ?>

    <?= $form->field($model, 'education_deleted_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
