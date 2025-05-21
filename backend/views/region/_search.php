<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\RegionSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="region-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'region_name') ?>

    <?= $form->field($model, 'region_status_id') ?>

    <?= $form->field($model, 'region_created_at') ?>

    <?= $form->field($model, 'region_created_by') ?>

    <?php // echo $form->field($model, 'region_updated_at') ?>

    <?php // echo $form->field($model, 'region_updated_by') ?>

    <?php // echo $form->field($model, 'region_deleted_at') ?>

    <?php // echo $form->field($model, 'region_deleted_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
