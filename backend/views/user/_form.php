<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Users $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="users-form">

    <?php if(Yii::$app->user->can('super-admin')): ?>
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'company_id')->dropDownList(
            ArrayHelper::map($companies, 'id', 'company_name'),
            ['prompt' => 'Select Company']) ?>

        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'roles')->dropDownList($model->getRolesList(), ['prompt' => 'Select Role']) ?> <!-- Hapa tunaongeza dropDownList -->

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    <?php endif; ?>

    <?php if(Yii::$app->user->can('company-admin')): ?>
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'roles')->dropDownList(
            Yii::$app->user->identity->getRolesList(), 
            ['prompt' => 'Select Role']
        ) ?>


        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    <?php endif; ?>
    
</div>
