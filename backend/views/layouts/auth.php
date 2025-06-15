<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Html;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        main {
            height: 100vh;
        }

        .left-pane {
            background-color: #00786f;
            color: white;
            width: 50%;
        }

        .right-pane {
            background-color: white;
            width: 50%;
        }

        @media (max-width: 992px) {

            /* xs */
            .my-box {
                box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15);
                /* shadow */
            }
        }

        @media (min-width: 992px) {

            /* md and up */
            .my-box {
                box-shadow: none;
            }
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">
    <?php $this->beginBody() ?>

    <main class="d-flex">
        <!-- Left Pane (A): only on large screens -->
        <div class="left-pane d-none d-lg-flex flex-grow-1 justify-content-center align-items-center">
            <h2 class="text-center">
                <img src="<?= Yii::getAlias('@web') ?>/images/logo/logo_white.png" alt="Logo" style="height: 64px; margin-top: -100px;">
                <p>Welcome Back</p>
            </h2>
        </div>

        <!-- Right Pane (B): visible on all screen sizes -->
        <div class="right-pane flex-grow-1 d-flex justify-content-center align-items-center">
            <div class="w-100 p-4" style="max-width: 424px;">
                <div class="d-flex d-lg-none flex-grow-1 justify-content-center align-items-center">
                    <h2 class="text-center">
                        <img src="<?= Yii::getAlias('@web') ?>/images/logo/logo_blue.png" alt="Logo" style="height: 64px;">
                    </h2>
                </div>
                <div class="my-box p-4 rounded">
                    <?= Alert::widget() ?>
                    <?= $content ?>
                    <?php if (!empty($this->blocks['register'])): ?>
                        <?= $this->blocks['register'] ?>
                    <?php elseif (!empty($this->blocks['signin'])): ?>
                        <?= $this->blocks['signin'] ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>