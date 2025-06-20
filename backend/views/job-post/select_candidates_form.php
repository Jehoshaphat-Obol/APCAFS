<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Select Top Candidates';
?>

<h3>Select Top Candidates</h3>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'number')->label('Number of Candidates to Accept') ?>

<div class="form-group">
    <?= Html::submitButton('Proceed', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
