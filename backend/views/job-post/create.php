<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\JobPost $model */

$this->title = Yii::t('app', 'Create Job Post');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Job Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-post-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'status' => $status,
    ]) ?>

</div>
