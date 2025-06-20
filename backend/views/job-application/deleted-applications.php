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
                <?php $key = 0;
                foreach ($deletedApplications as $applicant): ?>
                    <tr>
                        <?php
                        $a_c = $applicant->company ?? null;
                        $a_p = $applicant->jobPost ?? null;
                        $a_u = $applicant->user ?? null;
                        $a_s = $applicant->statusLookup ?? null;
                        ?>
                        <td><?= Html::encode(++$key) ?></td>

                        <td>
                            <?= $a_c && !empty($a_c->company_name)
                                ? Html::encode($a_c->company_name)
                                : '<em>No company found</em>' ?>
                        </td>

                        <td>
                            <?= $a_p && !empty($a_p->post_job_title)
                                ? Html::encode($a_p->post_job_title)
                                : '<em>No job title</em>' ?>
                        </td>

                        <td>
                            <?= $a_u && !empty($a_u->username)
                                ? Html::encode($a_u->username)
                                : '<em>No username</em>' ?>
                        </td>

                        <td>
                            <?= isset($applicant->applicant_score)
                                ? Html::encode($applicant->applicant_score)
                                : '<em>No score</em>' ?>
                        </td>

                        <td>
                            <?= $a_s && !empty($a_s->status_name)
                                ? Html::encode($a_s->status_name)
                                : '<em>No status</em>' ?>
                        </td>

                        <td>
                            <?= !empty($applicant->applicant_deleted_at)
                                ? Html::encode($applicant->applicant_deleted_at)
                                : '<em>Not deleted</em>' ?>
                        </td>
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