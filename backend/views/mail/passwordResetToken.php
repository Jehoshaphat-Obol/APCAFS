<?php
use yii\helpers\Html;

/* @var $user app\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Hello <?= Html::encode($user->username) ?>,

Click the link below to set your new password:

<?= Html::a(Html::encode($resetLink), $resetLink) ?>
