<?php

use yii\helpers\Html;
use app\models\StaffProfile;

/** @var yii\web\View $this */
/** @var app\models\StaffProfile $model */

$this->title = Yii::t('app', 'Create Staff Profile');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Staff Profiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-profile-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php 
        $staff = StaffProfile::findOne(['staff_user_id' => Yii::$app->user->id]);
        var_dump($staff);
    ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
