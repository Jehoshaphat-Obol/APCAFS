<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Company $model */

?>
<div class="company-create">

    <h3 class="text-center" style="padding-right: 160px;"><?= Html::encode($this->title) ?></h3>

    <div class="row">
            <?php if ($type === 'company'): ?>
                <?= $this->render('verify_company_activation_code', [
                    'model' => $model,
                    'type' => $type
                ]) ?>
            <?php endif; ?>
    </div>

</div>
