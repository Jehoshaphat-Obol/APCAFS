<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PersonalityAssessment $model */

$this->title = Yii::t('app', 'Create Personality Assessment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Personality Assessments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personality-assessment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
