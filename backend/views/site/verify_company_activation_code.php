<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Companies $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = Yii::t('app', 'Verify Company Activation Code');
?>

<h3 class="text-center"><?= Html::encode($this->title) ?></h3>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_activation_code')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Verify Code', ['class' => 'btn btn-success', 'style' => 'width: 100%; background-color: #00786f;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
