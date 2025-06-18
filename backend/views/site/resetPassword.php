<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Set New Password';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton('Change Password', ['class' => 'btn btn-success']) ?>
    </div>
<?php ActiveForm::end(); ?>
