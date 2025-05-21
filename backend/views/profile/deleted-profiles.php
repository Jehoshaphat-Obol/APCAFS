<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $deletedCompanies app\models\Companies[] */

$this->title = 'Deleted Companies';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bin'), 'url' => ['#']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="Company-deleted">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!empty($deletedCompanies)): ?>
        <table class="table table-hover table-responsive table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Company Name</th>
                    <th>Company Email</th>
                    <th>Company Phone</th>
                    <th>Company Address</th>
                    <th>Status</th>
                    <th>Deleted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $key = 0; foreach ($deletedCompanies as $company): ?>
                    <tr>
                        <td><?= Html::encode(++$key) ?></td>
                        <td><?= Html::encode($company->company_name) ?></td>
                        <td><?= Html::encode($company->company_email) ?></td>
                        <td><?= Html::encode($company->company_phone_number) ?></td>
                        <td><?= Html::encode($company->company_address) ?></td>
                        <td><?php 
                                switch ($company->company_status) {
                                    case 10:
                                        // $class = 'badge badge-success';
                                        $label = 'active';
                                        break;
                                    case 11:
                                        // $class = 'badge badge-warning';
                                        $label = 'inactive';
                                        break;
                                    case 0:
                                        // $class = 'badge badge-danger';
                                        $label = 'deleted';
                                        break;
                                    default:
                                        $class = 'badge badge-secondary';
                                        $label = 'unknown';
                                }
                                echo Html::tag('span', Html::encode($label));
                            ?>
                        </td>
                        <td><?= Html::encode($company->company_deleted_at) ?></td>
                        <td>
                            <?= Html::a('<i class="bi bi-arrow-counterclockwise"></i> Restore', ['restore', 'id' => $company->id], [
                                'class' => 'btn btn-success',
                                'data' => [
                                    'confirm' => 'Are you sure you want to restore this Company?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="lead text-center alert alert-warning">No Deleted Company(s) found.</p>
    <?php endif ?>
</div>
