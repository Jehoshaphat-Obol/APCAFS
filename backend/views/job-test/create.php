<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\JobTest $model */

$this->title = Yii::t('app', 'Create Job Test');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Job Tests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-test-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'status' => $status,
        'jobs' => $jobs,
    ]) ?>

</div>
