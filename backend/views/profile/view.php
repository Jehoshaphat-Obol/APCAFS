<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Profile $model */

$this->title = $model->profile_last_name;
if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('manager') || Yii::$app->user->can('hr'))
{
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profiles'), 'url' => ['index']];
}
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="profile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if(Yii::$app->user->can('super-admin')):?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>

        <?= Html::button('🖨️ Print', ['class' => 'btn btn-outline-primary me-2', 'onclick' => 'window.print()']) ?>
        <?= Html::a('👁️ Preview PDF', ['cv-preview', 'id' => $model->id], ['class' => 'btn btn-outline-success', 'target' => '_blank']) ?>
        <?= Html::a('⬇️ Download PDF', ['profile/pdf', 'id' => $model->id], ['class' => 'btn btn-outline-success']) ?>
    </p>

<div class="container mt-4">
    
    <div class="row">
        <!-- Account Information -->
        <div class="col-md-6 mb-4">
            <div class="bg-white shadow rounded p-4 mb-4 mt-4 h-100">
                <h4 class="border-bottom pb-2 mb-3 text-primary">👤 Account Information</h4>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'user2.username',
                        'user2.email',
                    ],
                    'options' => ['class' => 'table table-borderless table-sm'],
                ]) ?>
            </div>
        </div>

        <!-- Personal Details -->
        <div class="col-md-6 mb-4">
            <div class="bg-white shadow rounded p-4 mb-4 mt-4 h-100">
                <h4 class="border-bottom pb-2 mb-3 text-success">🧍 Personal Details</h4>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'profile_first_name',
                        'profile_middle_name',
                        'profile_last_name',
                        'profile_date_of_birth',
                    ],
                    'options' => ['class' => 'table table-borderless table-sm'],
                ]) ?>
            </div>
        </div>

        <!-- Location Info -->
        <div class="col-md-6 mb-4">
            <div class="bg-white shadow rounded p-4 mb-4 mt-4 h-100">
                <h4 class="border-bottom pb-2 mb-3 text-info">📍 Address & Location</h4>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'region.region_name',
                        'district.district_name',
                        'profile_local_address',
                    ],
                    'options' => ['class' => 'table table-borderless table-sm'],
                ]) ?>
            </div>
        </div>

        <!-- Phones -->
        <div class="col-md-6 mb-4">
            <div class="bg-white shadow rounded p-4 mb-4 mt-4 h-100">
                <h4 class="border-bottom pb-2 mb-3 text-primary">📞 Phone Numbers</h4>
                <ul class="list-group list-group-flush">
                    <?php foreach ($model->phoneNumbers as $phone): ?>
                        <li class="list-group-item">
                            <?= Html::encode($phone->phone_number) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>


        <!-- Social Media -->
        <div class="col-md-6 mb-4">
            <div class="bg-white shadow rounded p-4 mb-4 mt-4 h-100">
                <h4 class="border-bottom pb-2 mb-3 text-warning">💬 Biography & Media</h4>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'profile_social_media_username',
                        'profile_bios:ntext',
                    ],
                    'options' => ['class' => 'table table-borderless table-sm'],
                ]) ?>
            </div>
        </div>

        <!-- Education -->
        <div class="col-md-6 mb-4">
        <div class="bg-white shadow rounded p-4 mb-4 mt-4 h-100">
            <h4 class="border-bottom pb-2 mb-3 text-secondary">🎓 Education</h4>

            <?php if (!empty($model->educations)): ?>
                <ul class="list-group list-group-flush">
                    <?php foreach ($model->educations as $edu): ?>
                        <li class="list-group-item">
                            <p><strong>Degree:</strong> <?= Html::encode($edu->education_degree_name) ?></p>
                            <p><strong>Programme:</strong> <?= Html::encode($edu->education_programme_name) ?></p>
                            <p><strong>University:</strong> <?= Html::encode($edu->education_university_name) ?></p>
                            <p><strong>Graduation Date:</strong> <?= Html::encode($edu->education_graduation_date) ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-muted">No education records found.</p>
            <?php endif; ?>
        </div>
        </div>

        <!-- Experience -->
        <div class="col-md-6 mb-4">
            <div class="bg-white shadow rounded p-4 mb-4 mt-4 h-100">
                <h4 class="border-bottom pb-2 mb-3 text-dark">💼 Experience</h4>
                
                <?php if (!empty($model->workExperiences)): ?>
                    <ul class="list-group list-group-flush">
                    <?php foreach ($model->workExperiences as $exp): ?>
                        <li class="list-group-item">
                            <p><strong>Job Title:</strong> <?= Html::encode($exp->experience_job_title) ?></p>
                            <p><strong>Company:</strong> <?= Html::encode($exp->experience_company_name) ?></p>
                            <p><strong>From:</strong> <?= Html::encode($exp->experience_from) ?> 
                                <strong>To:</strong> <?= Html::encode($exp->experience_to ?: 'Present') ?></p>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-muted">No experience records found.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Skill -->
        <div class="col-md-6 mb-4">
            <div class="bg-white shadow rounded p-4 mb-4 mt-4 h-100">
                <h4 class="border-bottom pb-2 mb-3 text-info">🛠️ Skills</h4>

                <?php if (!empty($model->skills)): ?>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($model->skills as $skill): ?>
                            <li class="list-group-item">
                                <p><strong>Type:</strong> <?= Html::encode($skill->skill_type) ?></p>
                                <p><strong>Name:</strong> <?= Html::encode($skill->skill_name) ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-muted">No skills found.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- awards -->
        <div class="col-md-6 mb-4">
            <div class="bg-white shadow rounded p-4 mb-4 mt-4 h-100">
                <h4 class="border-bottom pb-2 mb-3 text-warning">🏆 Awards</h4>

                <?php if (!empty($model->awards)): ?>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($model->awards as $award): ?>
                            <li class="list-group-item">
                                <p><strong>Title:</strong> <?= Html::encode($award->award_title) ?></p>
                                <p><strong>Organization:</strong> <?= Html::encode($award->award_organization_name) ?></p>
                                <p><strong>Issue Number:</strong> <?= Html::encode($award->award_issue_number) ?></p>
                                <small class="text-muted">
                                    <strong>Date of Issue:</strong> <?= Html::encode($award->award_date_of_issue) ?>
                                </small>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-muted">No award records found.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- languages -->
        <div class="col-md-6 mb-4">
            <div class="bg-white shadow rounded p-4 mb-4 mt-4 h-100">
                <h4 class="border-bottom pb-2 mb-3 text-info">🌐 Languages</h4>

                <?php if (!empty($model->languages)): ?>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($model->languages as $language): ?>
                            <li class="list-group-item">
                                <?= Html::encode($language->language_name) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-muted">No language records found.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- publications -->
        <div class="col-md-6 mb-4">
            <div class="bg-white shadow rounded p-4 mb-4 mt-4 h-100">
                <h4 class="border-bottom pb-2 mb-3 text-primary">📚 Publications</h4>

                <?php if (!empty($model->publications)): ?>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($model->publications as $publication): ?>
                            <li class="list-group-item">
                                <strong><?= Html::encode($publication->publication_title) ?></strong><br>
                                <?= Html::encode($publication->publication_publisher_name) ?><br>
                                <small class="text-muted">
                                    Published on: <?= Html::encode($publication->publication_date_of_publication) ?>
                                </small>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-muted">No publication records found.</p>
                <?php endif; ?>
            </div>
        </div>


        <!-- Referees -->
        <!-- <div class="col-md-12">
            <div class="bg-white shadow rounded p-4 mb-4 mt-4">
                <h4 class="border-bottom pb-2 mb-3 text-danger">📇 Referees</h4>
                <p>Referee information placeholder...</p>
            </div>
        </div> -->

        <!-- System Info -->
        <?php if (Yii::$app->user->can('super-admin') || Yii::$app->user->can('applicant')): ?>
        <div class="col-md-12">
            <div class="bg-light shadow-sm rounded p-4 mb-4 mt-4">
                <h4 class="border-bottom pb-2 mb-3 text-muted">⚙️ System Information</h4>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'attribute' => 'profile_created_at',
                            'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('applicant'),
                        ],
                        [
                            'attribute' => 'profile_created_by',
                            'visible' => Yii::$app->user->can('super-admin'),
                        ],
                        [
                            'attribute' => 'profile_updated_at',
                            'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('applicant'),
                        ],
                        [
                            'attribute' => 'profile_updated_by',
                            'visible' => Yii::$app->user->can('super-admin'),
                        ],
                        [
                            'attribute' => 'profile_deleted_at',
                            'visible' => Yii::$app->user->can('super-admin'),
                        ],
                        [
                            'attribute' => 'profile_deleted_by',
                            'visible' => Yii::$app->user->can('super-admin'),
                        ],
                    ],
                    'options' => ['class' => 'table table-borderless table-sm'],
                ]) ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

</div>
