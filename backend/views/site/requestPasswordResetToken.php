<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Request to Reset Password';
?>

<h1><?= Html::encode($this->title) ?></h1>
<p>Please enter your email to receive instructions on how to reset your password.</p>

<?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>
