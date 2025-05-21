<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CompanySubscription $model */

$this->title = Yii::t('app', 'Create Company Subscription');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Company Subscriptions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-subscription-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
