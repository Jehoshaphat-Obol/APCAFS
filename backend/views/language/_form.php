<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Language $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="language-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'language_profile_id')->textInput() ?>

    <?= $form->field($model, 'language_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'language_status_id')->textInput() ?>

    <?= $form->field($model, 'language_created_at')->textInput() ?>

    <?= $form->field($model, 'language_created_by')->textInput() ?>

    <?= $form->field($model, 'language_updated_at')->textInput() ?>

    <?= $form->field($model, 'language_updated_by')->textInput() ?>

    <?= $form->field($model, 'language_deleted_at')->textInput() ?>

    <?= $form->field($model, 'language_deleted_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
