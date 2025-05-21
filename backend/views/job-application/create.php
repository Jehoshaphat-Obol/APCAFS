<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\JobApplication $model */

$this->title = Yii::t('app', 'Create Job Application');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Job Applications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-application-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
