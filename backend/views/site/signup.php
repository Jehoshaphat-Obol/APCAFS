<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

$this->title = 'Administrator Account Setup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-form">
    <h3 class="text-center"><?= Html::encode($this->title) ?></h3>

            <?php $form = ActiveForm::begin([
                'id' => 'form-signup',
                'fieldConfig' => [
                        'template' => "{label}\n{input}\n{error}",
                        'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                        'inputOptions' => ['class' => 'col-lg-3 form-control'],
                        'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                    ],
                ]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'company_id')->hiddenInput()->label(false) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Create Admin'), ['class' => 'btn btn-success', 'name' => 'signup-button', 'style' => 'width: 100%; background-color: #00786f;']) ?>
                </div>

            <?php ActiveForm::end(); ?>
</div>
