<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Skill $model */

$this->title = Yii::t('app', 'Create Skill');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Skills'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skill-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
