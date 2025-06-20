<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $deletedApplications app\models\Companies[] */

$this->title = 'Deleted Job Application';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bin'), 'url' => ['#']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="applicant-deleted">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!empty($deletedApplications)): ?>
        <table class="table table-hover table-responsive table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Company</th>
                    <th>Job Post</th>
                    <th>Username</th>
                    <th>Applicant Score</th>
                    <th>Status</th>
                    <th>Deleted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $key = 0; foreach ($deletedApplications as $applicant): ?>
                    <tr>
                        <?php
                            $a_c = $applicant->company;
                            $a_p = $applicant->jobPost;
                            $a_u = $applicant->user;
                            $a_s = $applicant->statusLookup;
                        ?>
                        <td><?= Html::encode(++$key) ?></td>
                        <td><?= Html::encode($a_c->company_name) ?></td>
                        <td><?= Html::encode($a_p->post_job_title) ?></td>
                        <td><?= Html::encode($a_u->username) ?></td>
                        <td><?= Html::encode($applicant->applicant_score) ?></td>
                        <td><?= Html::encode($a_s->status_name) ?></td>
                        <td><?= Html::encode($applicant->applicant_deleted_at) ?></td>
                        <td>
                            <?= Html::a('<i class="bi bi-arrow-counterclockwise"></i> Restore', ['restore', 'id' => $applicant->id], [
                                'class' => 'btn btn-success',
                                'data' => [
                                    'confirm' => 'Are you sure you want to restore this applicant?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="lead text-center alert alert-warning">No Deleted applicant(s) found.</p>
    <?php endif ?>
</div>
