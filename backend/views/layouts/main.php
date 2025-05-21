<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

// FontAwesome & Chart.js
$this->registerJsFile('https://cdn.jsdelivr.net/npm/chart.js');
$this->registerJsFile('@web/js/fontawesome.min.js');
$this->registerCssFile('@web/css/fontawesome.min.css');

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <!-- Include Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

</head>
<body>
<?php $this->beginBody() ?>

<!-- Sidebar -->
<aside class="sidebar">
    <!-- Sehemu ya Juu ya Sidebar: Logo na Jina la Mtumiaji -->
    <div class="sidebar-header">
        <div class="logo-container">
            <img src="https://images.unsplash.com/photo-1551740740-dc0788032166" alt="Technology Logo" class="logo">
        </div>
        <div class="user-info">
            <span class="user-name"><?= Yii::$app->user->identity->username ?></span>
        </div>
    </div>

    <hr>
    
    <!-- Sehemu ya Chini ya Sidebar: Navigation Items -->
    <div class="sidebar-nav">
        <?= $this->render('_sidebar') ?>
    </div>
</aside>

<!-- Main Container -->
<div class="main-container">
    <!-- Header -->
    <header class="header">
        <div>
            <?= $this->render('_header') ?>
        </div>
    </header>

    <!-- Main Content -->
    <main class="content">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <!-- <div class="outer-cover col-lg-8 col-md-10 col-sm-12 px-4 py-3 shadow rounded bg-white"> -->
                    <?= Alert::widget() ?>
                    <?= $content ?>
                <!-- </div> -->
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <?= $this->render('_footer') ?>
    </footer>
</div>

<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    flatpickr(".flatpickr", {
        dateFormat: "Y-m-d",
        allowInput: true
    });
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
