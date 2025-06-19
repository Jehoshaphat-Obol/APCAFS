<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $deletedUsers app\models\User[] */

$this->title = 'Deleted Users';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bin'), 'url' => ['#']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="branch-deleted">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!empty($deletedUsers)): ?>
        <table class="table table-hover table-responsive table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Company</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $key = 0; foreach ($deletedUsers as $user): ?>
                    <tr>
                        <td><?= Html::encode(++$key) ?></td>
                        <td><?= Html::encode($user->username) ?></td>
                        <td><?= Html::encode($user->email) ?></td>
                        <td>
                        <?php
                            $u_c = $user->company;
                            if (empty($u_c->company_name))
                            {
                                echo 'no company found';
                            } else {
                                echo Html::encode($u_c->company_name);
                            }
                        ?>
                        </td>
                        <td>
                        <?php
                            $u_s = $user->userStatus
                        ?>    
                        <?= Html::encode($u_s->status_name) ?></td>
                        <td>
                            <?= Html::a('<i class="bi bi-arrow-counterclockwise"></i> Restore', ['restore', 'id' => $user->id], [
                                'class' => 'btn btn-success',
                                'data' => [
                                    'confirm' => 'Are you sure you want to restore this branch?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="lead text-center alert alert-warning">No Deleted User(s) found.</p>
    <?php endif ?>
</div>
