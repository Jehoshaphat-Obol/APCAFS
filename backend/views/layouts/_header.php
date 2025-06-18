<?php 
/** User: ProgDesn */
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Html;

NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    // 'options' => ['class' => 'navbar-expand-md navbar-dark shadow fixed-top']
]);

// Wrapper div for flex alignment
echo Html::beginTag('div', ['class' => 'd-flex justify-content-between text-dark align-items-center w-100']);
// echo $navItems[] = $this->render('_sidebar');

// Logout icon HTML (Bootstrap Icons)
$logoutIcon = Html::tag('i', '', ['class' => 'bi bi-box-arrow-right']);

// Login/Logout buttons
$navItems[] = Yii::$app->user->isGuest
    ? ['label' => 'Signin', 'url' => ['/site/signin']]
    : Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
            $logoutIcon . ' Logout',
            ['class' => 'nav-link btn btn-link logout text-dark']
        )
        . Html::endForm();

// Render Nav items
echo Nav::widget([
    'options' => ['class' => 'navbar-nav ml-auto text-light'],
    'items' => $navItems,
]);

echo Html::endTag('div');

NavBar::end();
?>
