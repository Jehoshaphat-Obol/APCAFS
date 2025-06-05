<?php
use yii\helpers\Html;

/** @var $model app\models\Profile */

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CV Preview</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12pt;
            line-height: 1.5;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h3 {
            border-bottom: 1px solid #ccc;
            padding-bottom: 4px;
        }
        .info {
            margin-left: 15px;
        }
    </style>
</head>
<body>

    <h2>CV - <?= Html::encode($model->profile_first_name . ' ' . $model->profile_last_name) ?></h2>

    <div class="section">
        <h3>Account Information</h3>
        <div class="info">
            <p><strong>Username:</strong> <?= Html::encode($model->user2->username) ?></p>
            <p><strong>Email:</strong> <?= Html::encode($model->user2->email) ?></p>
        </div>
    </div>

    <div class="section">
        <h3>Personal Details</h3>
        <div class="info">
            <p><strong>First Name:</strong> <?= Html::encode($model->profile_first_name) ?></p>
            <p><strong>Middle Name:</strong> <?= Html::encode($model->profile_middle_name) ?></p>
            <p><strong>Last Name:</strong> <?= Html::encode($model->profile_last_name) ?></p>
            <p><strong>Date of Birth:</strong> <?= Html::encode($model->profile_date_of_birth) ?></p>
        </div>
    </div>

    <div class="section">
        <h3>Address & Location</h3>
        <div class="info">
            <p><strong>Region:</strong> <?= Html::encode($model->region->region_name) ?></p>
            <p><strong>District:</strong> <?= Html::encode($model->district->district_name) ?></p>
            <p><strong>Local Address:</strong> <?= Html::encode($model->profile_local_address) ?></p>
        </div>
    </div>

    <div class="section">
        <h3>Bio & Social</h3>
        <div class="info">
            <p><strong>Social Media:</strong> <?= Html::encode($model->profile_social_media_username) ?></p>
            <p><strong>Bio:</strong><br><?= nl2br(Html::encode($model->profile_bios)) ?></p>
        </div>
    </div>

</body>
</html>
