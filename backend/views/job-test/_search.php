<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\JobTestSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="job-test-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'test_company_id') ?>

    <?= $form->field($model, 'test_job_post_id') ?>

    <?= $form->field($model, 'test_user_id') ?>

    <?= $form->field($model, 'test_identification') ?>

    <?php // echo $form->field($model, 'test_duration') ?>

    <?php // echo $form->field($model, 'test_status_id') ?>

    <?php // echo $form->field($model, 'test_created_at') ?>

    <?php // echo $form->field($model, 'test_created_by') ?>

    <?php // echo $form->field($model, 'test_updated_at') ?>

    <?php // echo $form->field($model, 'test_updated_by') ?>

    <?php // echo $form->field($model, 'test_deleted_at') ?>

    <?php // echo $form->field($model, 'test_deleted_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
