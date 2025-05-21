<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Education $model */

$this->title = Yii::t('app', 'Create Education');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Educations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="education-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
