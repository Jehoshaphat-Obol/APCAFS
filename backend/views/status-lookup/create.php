<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\StatusLookup $model */

$this->title = Yii::t('app', 'Create Status Lookup');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Status Lookups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-lookup-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
