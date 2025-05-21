<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ProfileSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'profile_user_id') ?>

    <?= $form->field($model, 'profile_first_name') ?>

    <?= $form->field($model, 'profile_middle_name') ?>

    <?= $form->field($model, 'profile_last_name') ?>

    <?php // echo $form->field($model, 'profile_social_media_username') ?>

    <?php // echo $form->field($model, 'profile_date_of_birth') ?>

    <?php // echo $form->field($model, 'profile_bios') ?>

    <?php // echo $form->field($model, 'profile_region_id') ?>

    <?php // echo $form->field($model, 'profile_district_id') ?>

    <?php // echo $form->field($model, 'profile_local_address') ?>

    <?php // echo $form->field($model, 'profile_status_id') ?>

    <?php // echo $form->field($model, 'profile_created_at') ?>

    <?php // echo $form->field($model, 'profile_created_by') ?>

    <?php // echo $form->field($model, 'profile_updated_at') ?>

    <?php // echo $form->field($model, 'profile_updated_by') ?>

    <?php // echo $form->field($model, 'profile_deleted_at') ?>

    <?php // echo $form->field($model, 'profile_deleted_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
