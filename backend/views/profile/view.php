<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Profile $model */

$this->title = $model->profile_last_name;
if (Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('manager') || Yii::$app->user->can('hr')) {
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profiles'), 'url' => ['index']];
}
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="profile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if (Yii::$app->user->can('super-admin')): ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>


    <div class="row">
        <div class="col-md-4 row align-items-start align-content-start">
            <!-- Account Information -->
            <div>
                <div class="bg-white shadow rounded px-1 pt-2">
                    <h4 class="border-bottom mb-3">Account Information</h4>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'user2.username',
                            'user2.email',
                        ],
                        'options' => ['class' => 'table table-striped table-sm'],
                    ]) ?>
                </div>
            </div>

            <!-- Personal Details -->
            <div>
                <div class="bg-white shadow rounded px-1 pt-2">
                    <h4 class="border-bottom mb-3">Personal Details</h4>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'profile_first_name',
                            'profile_middle_name',
                            'profile_last_name',
                            'profile_date_of_birth',
                        ],
                        'options' => ['class' => 'table table-striped table-sm'],
                    ]) ?>
                </div>
            </div>

            <!-- Location Info -->
            <div>
                <div class="bg-white shadow rounded px-1 pt-2 mb-4">
                    <h4 class="border-bottom pb-2 mb-3">Address & Location</h4>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'region.region_name',
                            'district.district_name',
                            'profile_local_address',
                        ],
                        'options' => ['class' => 'table table-striped table-sm'],
                    ]) ?>
                </div>
            </div>

            <!-- Phone number -->
            <div>
                <div class="bg-white shadow rounded px-1 pt-2">
                    <h4 class="border-bottom pb-2 mb-3">Phone Numbers</h4>

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'label' => 'Phone Numbers',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    if (empty($model->phoneNumbers)) {
                                        return '<em>No phone numbers available</em>';
                                    }
                                    $listItems = array_map(function ($phone) {
                                        return Html::encode($phone->phone_number);
                                    }, $model->phoneNumbers);
                                    return '<ul class="list-group list-group-flush mb-0">' .
                                        implode('', array_map(fn($item) => "<li class='list-group-item px-0'>{$item}</li>", $listItems)) .
                                        '</ul>';
                                },
                            ],
                        ],
                        'options' => ['class' => 'table table-borderless table-sm'],
                    ]) ?>
                </div>
            </div>


            <!-- languages -->
            <div class="mb-3">
                <div class="bg-white shadow rounded p-4 px-1 pt-2">
                    <h4 class="border-bottom pb-2 mb-3">Languages</h4>

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

            <!-- System Info -->
            <?php if (Yii::$app->user->can('super-admin') || Yii::$app->user->can('applicant')): ?>
                <div class="col-md-12">
                    <div class="bg-white shadow-sm rounded px-1 pt-2">
                        <h4 class="border-bottom pb-2 mb-3">System Information</h4>
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
                            'options' => ['class' => 'table table-striped table-sm'],
                        ]) ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <!-- Social Media -->
        <div class="col-md-8 row">
            <!-- Biography -->
            <div>
                <div class="bg-white shadow rounded px-1 pt-2">
                    <h4 class="border-bottom pb-2 mb-3">Biography & Media</h4>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'profile_social_media_username',
                            'profile_bios:ntext',
                        ],
                        'options' => ['class' => 'table table-striped table-sm'],
                    ]) ?>
                </div>
            </div>

            <!-- Education -->
            <div class="">
                <div class="bg-white shadow rounded px-1 pt-2">
                    <h4 class="border-bottom pb-2 mb-3">Education</h4>

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'label' => 'Education Records',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    if (empty($model->educations)) {
                                        return '<p class="text-muted mb-0">No education records found.</p>';
                                    }

                                    $listItems = array_map(function ($edu) {
                                        return '
                                <li class="list-group-item px-0 py-2">
                                    <p class="mb-1"><strong>Degree:</strong> ' . Html::encode($edu->education_degree_name) . '</p>
                                    <p class="mb-1"><strong>Programme:</strong> ' . Html::encode($edu->education_programme_name) . '</p>
                                    <p class="mb-1"><strong>University:</strong> ' . Html::encode($edu->education_university_name) . '</p>
                                    <p class="mb-0"><strong>Graduation Date:</strong> ' . Html::encode($edu->education_graduation_date) . '</p>
                                </li>';
                                    }, $model->educations);

                                    return '<ul class="list-group list-group-flush mb-0">' . implode('', $listItems) . '</ul>';
                                },
                            ],
                        ],
                        'options' => ['class' => 'table table-borderless table-sm'],
                    ]) ?>
                </div>
            </div>

            <!-- Experience -->
            <div class="mb-3">
                <div class="bg-white shadow rounded px-1 pt-2">
                    <h4 class="border-bottom pb-2 mb-3">Experience</h4>

                    <?php if (!empty($model->workExperiences)): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($model->workExperiences as $exp): ?>
                                <li class="list-group-item">
                                    <p><strong>Job Title:</strong> <?= Html::encode($exp->experience_job_title) ?></p>
                                    <p><strong>Company:</strong> <?= Html::encode($exp->experience_company_name) ?></p>
                                    <p><strong>From:</strong> <?= Html::encode($exp->experience_from) ?>
                                        <strong>To:</strong> <?= Html::encode($exp->experience_to ?: 'Present') ?>
                                    </p>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted">No experience records found.</p>
                    <?php endif; ?>
                </div>
            </div>



            <!-- Skill -->
            <div class="mb-3">
                <div class="bg-white shadow rounded px-1 pt-2">
                    <h4 class="border-bottom pb-2 mb-3">Skills</h4>

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
            <div class="mb-3">
                <div class="bg-white shadow rounded p-4 px-1 pt-2">
                    <h4 class="border-bottom pb-2 mb-3">Awards</h4>

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

            <!-- publications -->
            <div class="mb-3">
                <div class="bg-white shadow rounded p-4 px-1 pt-2">
                    <h4 class="border-bottom pb-2 mb-3">Publications</h4>

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
        </div>

    </div>

</div>