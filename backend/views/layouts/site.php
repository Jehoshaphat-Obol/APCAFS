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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>APCAFS - AI Powered CV Analysis and Filtering System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --apcafs-color: #00786f;
        }

        body {
            background-color: #f8f9fa;
        }

        .btn-apcafs {
            background-color: var(--apcafs-color);
            color: #fff;
        }

        .btn-apcafs:hover {
            background-color: #00625c;
        }

        .bg-apcafs {
            background-color: var(--apcafs-color);
            color: #fff;
        }

        .section-heading {
            font-size: 2rem;
            font-weight: 600;
        }

        .placeholder-img {
            background: #dee2e6;
            width: 100%;
            height: 100%;
            min-height: 200px;
            border-radius: 0.5rem;
        }

        .hero{
            height: 90dvh;
            display: flex;
            justify-content: center;
            justify-items: center;
            align-items: center;
            align-content: center;
        }

        .hero img {
            position: absolute;
            z-index: -1;
            object-position: top;
        }

        .hero div h1, .hero div p {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php $this->beginBody() ?>
    <?= $content ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>