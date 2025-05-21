<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\AwardSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="award-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'award_profile_id') ?>

    <?= $form->field($model, 'award_title') ?>

    <?= $form->field($model, 'award_organization_name') ?>

    <?= $form->field($model, 'award_issue_number') ?>

    <?php // echo $form->field($model, 'award_date_of_issue') ?>

    <?php // echo $form->field($model, 'award_status_id') ?>

    <?php // echo $form->field($model, 'award_created_at') ?>

    <?php // echo $form->field($model, 'award_created_by') ?>

    <?php // echo $form->field($model, 'award_updated_at') ?>

    <?php // echo $form->field($model, 'award_updated_by') ?>

    <?php // echo $form->field($model, 'award_deleted_at') ?>

    <?php // echo $form->field($model, 'award_deleted_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
