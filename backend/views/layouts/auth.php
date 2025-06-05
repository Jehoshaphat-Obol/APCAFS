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
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
<?php $this->beginBody() ?>

<main class="container">
    <div class="row justify-content-center">
        
        <h2 class="text-center">
            <img src="<?= Yii::getAlias('@web') ?>/images/logo/logo_blue.png" alt="Logo" style="height: 350px; margin-top: -100px;">
        </h2>

        <div class="outer-cover col-lg-6 col-md-8 col-sm-10 px-4 py-3 shadow rounded bg-white" style="margin-top: -150px;">
            <?= Alert::widget() ?>
            <?= $content ?>
            <?php if (!empty($this->blocks['register'])): ?>
                <?= $this->blocks['register'] ?>
            <?php elseif (!empty($this->blocks['signin'])): ?>
                <?= $this->blocks['signin'] ?>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
