<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $deletedTests app\models\Companies[] */

$this->title = 'Deleted Job Tests';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bin'), 'url' => ['#']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="test-deleted">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!empty($deletedTests)): ?>
        <table class="table table-hover table-responsive table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Company Name</th>
                    <th>Job Name</th>
                    <th>Posted By</th>
                    <th>Test Address</th>
                    <th>Status</th>
                    <th>Deleted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $key = 0; foreach ($deletedTests as $test): ?>
                    <tr>
                        <td><?= Html::encode(++$key) ?></td>
                        <td><?= Html::encode($test->test_name) ?></td>
                        <td><?= Html::encode($test->test_email) ?></td>
                        <td><?= Html::encode($test->test_phone_number) ?></td>
                        <td><?= Html::encode($test->test_address) ?></td>
                        <td><?php 
                                switch ($test->test_status) {
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
                        <td><?= Html::encode($test->test_deleted_at) ?></td>
                        <td>
                            <?= Html::a('<i class="bi bi-arrow-counterclockwise"></i> Restore', ['restore', 'id' => $test->id], [
                                'class' => 'btn btn-success',
                                'data' => [
                                    'confirm' => 'Are you sure you want to restore this test?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="lead text-center alert alert-warning">No Deleted test(s) found.</p>
    <?php endif ?>
</div>
