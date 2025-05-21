<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\DistrictSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="district-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'district_region_id') ?>

    <?= $form->field($model, 'district_name') ?>

    <?= $form->field($model, 'district_status_id') ?>

    <?= $form->field($model, 'district_created_at') ?>

    <?php // echo $form->field($model, 'district_created_by') ?>

    <?php // echo $form->field($model, 'district_updated_at') ?>

    <?php // echo $form->field($model, 'district_updated_by') ?>

    <?php // echo $form->field($model, 'district_deleted_at') ?>

    <?php // echo $form->field($model, 'district_deleted_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
