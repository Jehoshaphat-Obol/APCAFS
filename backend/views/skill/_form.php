<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Skill $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="skill-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'skill_profile_id')->textInput() ?>

    <?= $form->field($model, 'skill_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'skill_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'skill_status_id')->textInput() ?>

    <?= $form->field($model, 'skill_created_at')->textInput() ?>

    <?= $form->field($model, 'skill_created_by')->textInput() ?>

    <?= $form->field($model, 'skill_updated_at')->textInput() ?>

    <?= $form->field($model, 'skill_updated_by')->textInput() ?>

    <?= $form->field($model, 'skill_deleted_at')->textInput() ?>

    <?= $form->field($model, 'skill_deleted_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
