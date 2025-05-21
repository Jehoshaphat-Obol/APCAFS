<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TestResultSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="test-result-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'result_company_id') ?>

    <?= $form->field($model, 'result_test_id') ?>

    <?= $form->field($model, 'result_user_id') ?>

    <?= $form->field($model, 'result_score') ?>

    <?php // echo $form->field($model, 'result_status_id') ?>

    <?php // echo $form->field($model, 'result_created_at') ?>

    <?php // echo $form->field($model, 'result_created_by') ?>

    <?php // echo $form->field($model, 'result_updated_at') ?>

    <?php // echo $form->field($model, 'result_updated_by') ?>

    <?php // echo $form->field($model, 'result_deleted_at') ?>

    <?php // echo $form->field($model, 'result_deleted_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
