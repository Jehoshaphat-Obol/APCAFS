<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PhoneNumberSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="phone-number-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'phone_profile_id') ?>

    <?= $form->field($model, 'phone_number') ?>

    <?= $form->field($model, 'phone_status_id') ?>

    <?= $form->field($model, 'phone_created_at') ?>

    <?php // echo $form->field($model, 'phone_created_by') ?>

    <?php // echo $form->field($model, 'phone_updated_at') ?>

    <?php // echo $form->field($model, 'phone_updated_by') ?>

    <?php // echo $form->field($model, 'phone_deleted_at') ?>

    <?php // echo $form->field($model, 'phone_deleted_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
