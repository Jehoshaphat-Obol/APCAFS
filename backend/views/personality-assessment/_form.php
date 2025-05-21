<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PersonalityAssessment $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="personality-assessment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'personality_profile_id')->textInput() ?>

    <?= $form->field($model, 'personality_IE_score')->textInput() ?>

    <?= $form->field($model, 'personality_NS_score')->textInput() ?>

    <?= $form->field($model, 'personality_TF_score')->textInput() ?>

    <?= $form->field($model, 'personality_JB_score')->textInput() ?>

    <?= $form->field($model, 'personality_last_analysis_date')->textInput() ?>

    <?= $form->field($model, 'personality_status_id')->textInput() ?>

    <?= $form->field($model, 'personality_created_at')->textInput() ?>

    <?= $form->field($model, 'personality_created_by')->textInput() ?>

    <?= $form->field($model, 'personality_updated_at')->textInput() ?>

    <?= $form->field($model, 'personality_updated_by')->textInput() ?>

    <?= $form->field($model, 'personality_deleted_at')->textInput() ?>

    <?= $form->field($model, 'personality_deleted_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
