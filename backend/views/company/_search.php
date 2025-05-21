<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CompanySearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="company-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'company_name') ?>

    <?= $form->field($model, 'company_phone_number') ?>

    <?= $form->field($model, 'company_email') ?>

    <?= $form->field($model, 'company_address') ?>

    <?php // echo $form->field($model, 'company_website_url') ?>

    <?php // echo $form->field($model, 'company_user_size') ?>

    <?php // echo $form->field($model, 'company_activation_code') ?>

    <?php // echo $form->field($model, 'company_activation_code_date') ?>

    <?php // echo $form->field($model, 'company_status_id') ?>

    <?php // echo $form->field($model, 'company_created_at') ?>

    <?php // echo $form->field($model, 'company_updated_at') ?>

    <?php // echo $form->field($model, 'company_deleted_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
