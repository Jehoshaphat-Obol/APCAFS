<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TestQuestion $model */

$this->title = Yii::t('app', 'Create Test Question');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Test Questions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-question-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
