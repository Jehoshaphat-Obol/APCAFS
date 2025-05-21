<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\StaffProfileSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="staff-profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'staff_company_id') ?>

    <?= $form->field($model, 'staff_user_id') ?>

    <?= $form->field($model, 'staff_first_name') ?>

    <?= $form->field($model, 'staff_middle_name') ?>

    <?php // echo $form->field($model, 'staff_last_name') ?>

    <?php // echo $form->field($model, 'staff_phone_number') ?>

    <?php // echo $form->field($model, 'staff_status_id') ?>

    <?php // echo $form->field($model, 'staff_created_at') ?>

    <?php // echo $form->field($model, 'staff_created_by') ?>

    <?php // echo $form->field($model, 'staff_updated_at') ?>

    <?php // echo $form->field($model, 'staff_updated_by') ?>

    <?php // echo $form->field($model, 'staff_deleted_at') ?>

    <?php // echo $form->field($model, 'staff_deleted_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
