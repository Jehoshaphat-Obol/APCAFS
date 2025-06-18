<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Profile $model */

$this->title = Yii::t('app', 'Update Profile: {name}', [
    'name' => $model->profile_last_name,
]);
if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('manager') || Yii::$app->user->can('hr'))
{
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profiles'), 'url' => ['index']];
}
$this->params['breadcrumbs'][] = ['label' => $model->profile_last_name, 'url' => ['view', 'id' => $profile->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'regions' => $regions,
    ]) ?>

</div>
