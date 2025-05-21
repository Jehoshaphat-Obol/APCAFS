<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\StatusLookup $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="status-lookup-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status_created_at')->textInput() ?>

    <?= $form->field($model, 'status_updated_at')->textInput() ?>

    <?= $form->field($model, 'status_deleted_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
