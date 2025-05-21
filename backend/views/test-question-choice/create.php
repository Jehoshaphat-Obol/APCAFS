<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TestQuestionChoice $model */

$this->title = Yii::t('app', 'Create Test Question Choice');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Test Question Choices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-question-choice-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
