<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PhoneNumber $model */

$this->title = Yii::t('app', 'Create Phone Number');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Phone Numbers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phone-number-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
