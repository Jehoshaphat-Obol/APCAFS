<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SubscriptionPlan $model */

$this->title = Yii::t('app', 'Create Subscription Plan');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Subscription Plans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscription-plan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
