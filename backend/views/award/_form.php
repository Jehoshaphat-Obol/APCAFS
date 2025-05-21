<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Award $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="award-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'award_profile_id')->textInput() ?>

    <?= $form->field($model, 'award_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'award_organization_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'award_issue_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'award_date_of_issue')->textInput() ?>

    <?= $form->field($model, 'award_status_id')->textInput() ?>

    <?= $form->field($model, 'award_created_at')->textInput() ?>

    <?= $form->field($model, 'award_created_by')->textInput() ?>

    <?= $form->field($model, 'award_updated_at')->textInput() ?>

    <?= $form->field($model, 'award_updated_by')->textInput() ?>

    <?= $form->field($model, 'award_deleted_at')->textInput() ?>

    <?= $form->field($model, 'award_deleted_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
