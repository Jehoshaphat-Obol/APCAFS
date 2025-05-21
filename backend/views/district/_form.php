<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\District $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="district-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'district_region_id')->textInput() ?>

    <?= $form->field($model, 'district_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'district_status_id')->textInput() ?>

    <?= $form->field($model, 'district_created_at')->textInput() ?>

    <?= $form->field($model, 'district_created_by')->textInput() ?>

    <?= $form->field($model, 'district_updated_at')->textInput() ?>

    <?= $form->field($model, 'district_updated_by')->textInput() ?>

    <?= $form->field($model, 'district_deleted_at')->textInput() ?>

    <?= $form->field($model, 'district_deleted_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
