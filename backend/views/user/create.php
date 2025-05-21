<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = Yii::t('app', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if($company->companyUserCheckLimit()):?>
        <?= $this->render('_form', [
            'model' => $model,
            'companies' => $companies,
            'company' => $company
        ]) ?>
    <?php else: ?>
        <p class="lead text-center alert alert-warning">
            <?= Html::encode("Umefikia kikomo cha utengenezaji wa Users, wasiliana na admini wako ili uweze kuendelea kutengeneza Users wapya") ?>
        </p>
    <?php endif; ?>

</div>
