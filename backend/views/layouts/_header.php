<?php 
/** User: ProgDesn */
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Html;

?>

<!-- Custom header section -->
<div class="bg-light shadow-sm py-3 px-4 d-flex justify-content-between align-items-center w-100">
    
    <!-- Brand Label (Left) -->
    <div class="navbar-brand m-0 fw-bold text-dark">
        <?= Html::a(Yii::$app->name, Yii::$app->homeUrl, ['class' => 'text-decoration-none text-dark']) ?>
    </div>

    <!-- Login/Logout Button (Right) -->
    <div>
        <?php if (Yii::$app->user->isGuest): ?>
            <?= Html::a(
                '<i class="bi bi-box-arrow-in-right"></i> signin',
                ['/site/signin'],
                ['class' => 'btn btn-link text-dark text-decoration-none']
            ) ?>
        <?php else: ?>
            <?= Html::beginForm(['/site/logout'], 'post', ['class' => 'd-inline']) ?>
                <?= Html::submitButton(
                    '<i class="bi bi-box-arrow-right"></i> Logout',
                    ['class' => 'btn btn-link text-dark text-decoration-none']
                ) ?>
            <?= Html::endForm() ?>
        <?php endif; ?>
    </div>

</div>