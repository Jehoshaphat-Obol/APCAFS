<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TestQuestionChoice $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="test-question-choice-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'choice_company_id')->textInput() ?>

    <?= $form->field($model, 'choice_question_id')->textInput() ?>

    <?= $form->field($model, 'choice_label')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'choice_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'choice_is_correct')->textInput() ?>

    <?= $form->field($model, 'choice_status_id')->textInput() ?>

    <?= $form->field($model, 'choice_created_at')->textInput() ?>

    <?= $form->field($model, 'choice_created_by')->textInput() ?>

    <?= $form->field($model, 'choice_updated_at')->textInput() ?>

    <?= $form->field($model, 'choice_updated_by')->textInput() ?>

    <?= $form->field($model, 'choice_deleted_at')->textInput() ?>

    <?= $form->field($model, 'choice_deleted_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
