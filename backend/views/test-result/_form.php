<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TestResult $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="test-result-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'result_company_id')->textInput() ?>

    <?= $form->field($model, 'result_test_id')->textInput() ?>

    <?= $form->field($model, 'result_user_id')->textInput() ?>

    <?= $form->field($model, 'result_score')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'result_status_id')->textInput() ?>

    <?= $form->field($model, 'result_created_at')->textInput() ?>

    <?= $form->field($model, 'result_created_by')->textInput() ?>

    <?= $form->field($model, 'result_updated_at')->textInput() ?>

    <?= $form->field($model, 'result_updated_by')->textInput() ?>

    <?= $form->field($model, 'result_deleted_at')->textInput() ?>

    <?= $form->field($model, 'result_deleted_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
