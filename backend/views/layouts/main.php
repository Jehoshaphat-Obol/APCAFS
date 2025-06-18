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
    <style>
        ul.d-flex.flex-column.bg-light.nav-pills.nav {
            background-color: transparent !important;
            color: white;
            gap: 4px;
        }

        .sidebar-nav .shadow {
            box-shadow: none !important;
        }

        aside .nav-pills .nav-link.active {
            color: black;
            font-weight: 500;
            background-color: #ecfdf5;
            border-left: 4px solid #002c22;
        }

        aside .nav-pills .nav-link {
            color: white;
            font-weight: 500;
            border-radius: 8px;
        }

        aside .nav-pills .nav-link:hover {
            color: black;
            background-color: #a4f4cf;
        }

        .sidebar-icons {
            color: inherit;
        }

        .sidebar-header {
            margin-top: 28px;
        }

        .list-group-item-action.active {
            background-color: #002c22;
            border-color: #002c22;
            color: white;
            z-index: 0;
        }

        .list-group-item-action.active .text-muted {
            color: inherit !important;
        }
        .profile-view, .profile-view .row{
            margin-right: unset;
            margin-left: unset;
            padding-right:unset ;
            padding-left:unset ;
        }


    </style>
</head>

<body>
    <?php $this->beginBody() ?>

    <!-- Sidebar -->
    <aside class="sidebar">
        <!-- Sehemu ya Juu ya Sidebar: Logo na Jina la Mtumiaji -->
        <div class="sidebar-header">
            <div class="logo-container">
                <img src="<?= Yii::getAlias('@web') ?>/images/logo/logo_white.png" alt="Technology Logo" style="width: 100%; height: 32px; object-fit: contain;">
            </div>
            <div class="user-info">
                <?php if (!Yii::$app->user->isGuest): ?>
                    <h4 class="user-name"><?= Yii::$app->user->identity->username ?></h4>
                <?php else: ?>
                    <h4 class="user-name">Guest</h4>
                <?php endif; ?>
            </div>
        </div>

        <hr>

        <!-- Sehemu ya Chini ya Sidebar: Navigation Items -->
        <?php if (!Yii::$app->user->isGuest): ?>
            <div class="sidebar-nav">
                <?= $this->render('_sidebar') ?>
            </div>
        <?php endif; ?>
    </aside>

    <!-- Main Container -->
    <div class="main-container">
        <!-- Header -->
        <?= $this->render('_header') ?>

        <!-- Main Content -->
        <main class="content">
            <?php if (!empty($this->params['breadcrumbs'])): ?>
                <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
            <?php endif ?>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <!-- <div class="outer-cover col-lg-8 col-md-10 col-sm-12 px-4 py-3 shadow rounded bg-white"> -->
                    <?= Alert::widget() ?>
                    <?php if(!Yii::$app->user->isGuest): ?>
                        <?= $content ?>
                    <?php endif; ?>
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