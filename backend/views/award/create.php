<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Award $model */

$this->title = Yii::t('app', 'Create Award');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Awards'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="award-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
