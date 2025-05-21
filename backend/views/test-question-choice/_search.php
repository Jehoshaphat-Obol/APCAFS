<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TestQuestionChoiceSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="test-question-choice-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'choice_company_id') ?>

    <?= $form->field($model, 'choice_question_id') ?>

    <?= $form->field($model, 'choice_label') ?>

    <?= $form->field($model, 'choice_text') ?>

    <?php // echo $form->field($model, 'choice_is_correct') ?>

    <?php // echo $form->field($model, 'choice_status_id') ?>

    <?php // echo $form->field($model, 'choice_created_at') ?>

    <?php // echo $form->field($model, 'choice_created_by') ?>

    <?php // echo $form->field($model, 'choice_updated_at') ?>

    <?php // echo $form->field($model, 'choice_updated_by') ?>

    <?php // echo $form->field($model, 'choice_deleted_at') ?>

    <?php // echo $form->field($model, 'choice_deleted_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
