<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PublicationSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="publication-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'publication_profile_id') ?>

    <?= $form->field($model, 'publication_title') ?>

    <?= $form->field($model, 'publication_publisher_name') ?>

    <?= $form->field($model, 'publication_date_of_publication') ?>

    <?php // echo $form->field($model, 'publication_status_id') ?>

    <?php // echo $form->field($model, 'publication_created_at') ?>

    <?php // echo $form->field($model, 'publication_created_by') ?>

    <?php // echo $form->field($model, 'publication_updated_at') ?>

    <?php // echo $form->field($model, 'publication_updated_by') ?>

    <?php // echo $form->field($model, 'publication_deleted_at') ?>

    <?php // echo $form->field($model, 'publication_deleted_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
