<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

$this->title = 'Registration';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-register">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Please fill out the following fields to register:</p>
    <div class="row">
        <div>
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
            <?= $form->field($model, 'agreeToTerms')->checkbox([
                'label' => 'I agree to the ' . Html::a('terms and policies', ['site/policy'], ['target' => '_blank']),
                'encode' => false,
            ]) ?>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Register'), ['class' => 'btn btn-success', 'name' => 'signup-button', 'style' => 'width: 100%; background-color: #00786f;']) ?>
            </div>

            <?php ActiveForm::end(); ?>

            <?php $this->beginBlock('register'); ?>
            <div style="color:#999;">
                Already have an account? <?= Html::a('SIGN IN', Url::to(['site/signin'])) ?> Now!!!.
            </div>
            <?php $this->endBlock(); ?>
        </div>
    </div>
</div>