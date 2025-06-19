<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $deletedPosts app\models\Companies[] */

$this->title = 'Deleted Job Posts';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bin'), 'url' => ['#']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="post-deleted">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!empty($deletedPosts)): ?>
        <table class="table table-hover table-responsive table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Company Name</th>
                    <th>Job Title</th>
                    <th>Job Type</th>
                    <th>Publication Date</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Deleted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $key = 0; foreach ($deletedPosts as $post): ?>
                    <tr>
                        <td><?= Html::encode(++$key) ?></td>
                        <td>
                        <?php 
                            $p_c = $post->company;
                            $p_s = $post->statusLookup;
                        ?>    
                        <?= Html::encode($p_c->company_name) ?></td>
                        <td><?= Html::encode($post->post_job_title) ?></td>
                        <td><?= Html::encode($post->post_job_type) ?></td>
                        <td><?= Html::encode($post->post_publication_date) ?></td>
                        <td><?= Html::encode($post->post_deadline) ?></td>
                        <td><?= Html::encode($p_s->status_name) ?></td>
                        <td><?= Html::encode($post->post_deleted_at) ?></td>
                        <td>
                            <?= Html::a('<i class="bi bi-arrow-counterclockwise"></i> Restore', ['restore', 'id' => $post->id], [
                                'class' => 'btn btn-success',
                                'data' => [
                                    'confirm' => 'Are you sure you want to restore this post?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="lead text-center alert alert-warning">No Deleted post(s) found.</p>
    <?php endif ?>
</div>
