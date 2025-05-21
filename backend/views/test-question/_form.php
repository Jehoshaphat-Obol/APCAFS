<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TestQuestion $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="test-question-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'question_company_id')->textInput() ?>

    <?= $form->field($model, 'question_test_id')->textInput() ?>

    <?= $form->field($model, 'question')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'question_status_id')->textInput() ?>

    <?= $form->field($model, 'question_created_at')->textInput() ?>

    <?= $form->field($model, 'question_created_by')->textInput() ?>

    <?= $form->field($model, 'question_updated_at')->textInput() ?>

    <?= $form->field($model, 'question_updated_by')->textInput() ?>

    <?= $form->field($model, 'question_deleted_at')->textInput() ?>

    <?= $form->field($model, 'question_deleted_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
