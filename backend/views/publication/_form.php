<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Publication $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="publication-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'publication_profile_id')->textInput() ?>

    <?= $form->field($model, 'publication_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'publication_publisher_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'publication_date_of_publication')->textInput() ?>

    <?= $form->field($model, 'publication_status_id')->textInput() ?>

    <?= $form->field($model, 'publication_created_at')->textInput() ?>

    <?= $form->field($model, 'publication_created_by')->textInput() ?>

    <?= $form->field($model, 'publication_updated_at')->textInput() ?>

    <?= $form->field($model, 'publication_updated_by')->textInput() ?>

    <?= $form->field($model, 'publication_deleted_at')->textInput() ?>

    <?= $form->field($model, 'publication_deleted_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
