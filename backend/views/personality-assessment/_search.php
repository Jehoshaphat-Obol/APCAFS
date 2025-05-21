<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PersonalityAssessmentSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="personality-assessment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'personality_profile_id') ?>

    <?= $form->field($model, 'personality_IE_score') ?>

    <?= $form->field($model, 'personality_NS_score') ?>

    <?= $form->field($model, 'personality_TF_score') ?>

    <?php // echo $form->field($model, 'personality_JB_score') ?>

    <?php // echo $form->field($model, 'personality_last_analysis_date') ?>

    <?php // echo $form->field($model, 'personality_status_id') ?>

    <?php // echo $form->field($model, 'personality_created_at') ?>

    <?php // echo $form->field($model, 'personality_created_by') ?>

    <?php // echo $form->field($model, 'personality_updated_at') ?>

    <?php // echo $form->field($model, 'personality_updated_by') ?>

    <?php // echo $form->field($model, 'personality_deleted_at') ?>

    <?php // echo $form->field($model, 'personality_deleted_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
