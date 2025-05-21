<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Region $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="region-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'region_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'region_status_id')->textInput() ?>

    <?= $form->field($model, 'region_created_at')->textInput() ?>

    <?= $form->field($model, 'region_created_by')->textInput() ?>

    <?= $form->field($model, 'region_updated_at')->textInput() ?>

    <?= $form->field($model, 'region_updated_by')->textInput() ?>

    <?= $form->field($model, 'region_deleted_at')->textInput() ?>

    <?= $form->field($model, 'region_deleted_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
