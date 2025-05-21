<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var yii\widgets\ActiveForm $form */

$this->title = Yii::t('app', 'Change Password');
// $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User'), 'url' => ['Change Password']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-form">
    <h1><?= Html::encode($this->title) ?></h1>


    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'oldPassword')->passwordInput() ?>
        <?= $form->field($model, 'newPassword')->passwordInput() ?>
        <?= $form->field($model, 'confirmPassword')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
