<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\StatusLookupSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="status-lookup-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'status_code') ?>

    <?= $form->field($model, 'status_name') ?>

    <?= $form->field($model, 'status_description') ?>

    <?= $form->field($model, 'status_created_at') ?>

    <?php // echo $form->field($model, 'status_updated_at') ?>

    <?php // echo $form->field($model, 'status_deleted_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
