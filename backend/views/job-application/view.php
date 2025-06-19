<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\JobApplication $model */

$this->title = $model->user2->username . ' apply for ' . $model->jobPost->post_job_title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Job Applications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="job-application-view">

    <p>
        <?php if (!(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('manager') || Yii::$app->user->can('hr') || Yii::$app->user->can('applicant'))): ?>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>
    <!-- PERSONALITY ASSESSMENT WIDGET STARTS HERE -->
    <?php
    $traits = [];
    // echo "<pre>";
    // print_r($profile);
    // echo "</pre>";
    // return false;
    if (!empty($profile->personalityAssessments) && is_array($profile->personalityAssessments)) {
        $personality_assessment = $profile->personalityAssessments[0];
        $traits = [
            'Mind' => [
                'left' => 'Extraverted',
                'right' => 'Introverted',
                'value' => $personality_assessment->personality_IE_score,
                'color' => 'primary'
            ],
            'Energy' => [
                'left' => 'Observant',
                'right' => 'Intuitive',
                'value' => $personality_assessment->personality_NS_score,
                'color' => 'warning'
            ],
            'Nature' => [
                'left' => 'Thinking',
                'right' => 'Feeling',
                'value' => $personality_assessment->personality_TF_score,
                'color' => 'success'
            ],
            'Tactics' => [
                'left' => 'Prospecting',
                'right' => 'Judging',
                'value' => $personality_assessment->personality_JB_score,
                'color' => 'danger'
            ],
        ];
    }

    // Map trait descriptions
    $traitDescriptions = [
        // Mind
        'Introverted' => 'Prefers solitary activities and often excels in focused, independent tasks. In team settings, tends to favor deep collaboration with smaller groups over large social interactions.',
        'Extraverted' => 'Is energized by social interaction and thrives in collaborative environments. Often excels in roles that involve frequent communication, public speaking, or team leadership.',

        // Energy
        'Intuitive' => 'Is visionary and driven by ideas, often thinking in abstract or conceptual ways. Suited for roles that demand innovation, strategic thinking, or long-term planning.',
        'Observant' => 'Pays close attention to concrete details and current realities. Excels in practical roles requiring accuracy, organization, or hands-on experience such as operations or administration.',

        // Nature
        'Feeling' => 'Prioritizes empathy and human values when making decisions. May be especially effective in roles involving customer service, human resources, or caregiving.',
        'Thinking' => 'Approaches problems with logic and objectivity. Analytical roles such as engineering, data science, or finance often suit this trait.',

        // Tactics
        'Judging' => 'Prefers order, structure, and planning. Tends to be dependable and punctual, making this individual ideal for project management or roles requiring consistency.',
        'Prospecting' => 'Values flexibility and adaptability, thriving in dynamic or fast-paced environments such as startups or creative fields.',

        // Identity (optional extension)
        'Assertive' => 'Is self-assured and stress-resistant. Likely to take initiative and perform steadily under pressure.',
        'Turbulent' => 'Is self-aware and perfectionistic, often striving for improvement and sensitive to feedback. This can drive high achievement but may also lead to stress sensitivity.',
    ];



    // Determine full personality
    $personalityCode = '';
    $personalityDesc = [
        'INTJ' => 'The Architect: Imaginative and strategic thinkers with a plan for everything. Often seen in leadership, R&D, and high-level strategic roles. 
        Strengths: Rational, independent, high achievers, strategic thinkers. 
        Weaknesses: Arrogant, overly critical, emotionally detached, can struggle with teamwork.',

        'INTP' => 'The Logician: Innovative inventors with an unquenchable thirst for knowledge. Thrive in data analysis, research, and system design. 
        Strengths: Analytical, objective, open-minded, inventive. 
        Weaknesses: Prone to overthinking, socially withdrawn, struggles with follow-through, emotionally distant.',

        'ENTJ' => 'The Commander: Bold, imaginative, and strong-willed leaders, always finding a way—or making one. Natural CEOs and team leads. 
        Strengths: Decisive, efficient, strategic, inspiring. 
        Weaknesses: Impatient, stubborn, intolerant, can be overly controlling.',

        'ENTP' => 'The Debater: Smart and curious thinkers who cannot resist an intellectual challenge. Excel in innovation, consulting, and entrepreneurship. 
        Strengths: Energetic, original, charismatic, quick thinkers. 
        Weaknesses: Argumentative, easily bored, dislikes routines, may lack focus.',

        'INFJ' => 'The Advocate: Quiet and mystical, yet very inspiring and tireless idealists. Thrive in mentoring, counseling, or cause-driven work. 
        Strengths: Insightful, principled, passionate, empathetic. 
        Weaknesses: Sensitive to criticism, perfectionistic, can be overly reserved or idealistic.',

        'INFP' => 'The Mediator: Poetic, kind, and altruistic individuals, always eager to help a good cause. Great in writing, design, or nonprofit roles. 
        Strengths: Empathetic, idealistic, creative, loyal. 
        Weaknesses: Overly idealistic, prone to burnout, indecisive, may avoid conflict.',

        'ENFJ' => 'The Protagonist: Charismatic and inspiring leaders, able to mesmerize their listeners. Excel in HR, education, or public-facing leadership. 
        Strengths: Persuasive, altruistic, natural leaders, emotionally intelligent. 
        Weaknesses: Overly selfless, too sensitive, struggles with boundaries, approval-seeking.',

        'ENFP' => 'The Campaigner: Enthusiastic, creative, and sociable free spirits, who always find a reason to smile. Often thrive in marketing, branding, or creative strategy. 
        Strengths: Energetic, warm, imaginative, highly adaptable. 
        Weaknesses: Easily distracted, disorganized, emotionally intense, may overcommit.',

        'ISTJ' => 'The Logistician: Practical and fact-minded individuals, whose reliability cannot be doubted. Suited for auditing, administration, or military roles. 
        Strengths: Responsible, detail-oriented, dependable, logical. 
        Weaknesses: Rigid, insensitive, resistant to change, can be judgmental.',

        'ISFJ' => 'The Defender: Very dedicated and warm protectors, always ready to defend their loved ones. Excel in supportive, structured environments like healthcare or education. 
        Strengths: Loyal, practical, meticulous, caring. 
        Weaknesses: Overly humble, avoids confrontation, dislikes change, prone to burnout.',

        'ESTJ' => 'The Executive: Excellent administrators, unsurpassed at managing things or people. Ideal for operations, logistics, or public service. 
        Strengths: Organized, reliable, strong-willed, leadership-oriented. 
        Weaknesses: Inflexible, critical, emotionally blunt, resistant to unconventional ideas.',

        'ESFJ' => 'The Consul: Extraordinarily caring, social, and popular people, always eager to help. Strong fits for customer success or community engagement roles. 
        Strengths: Supportive, loyal, sociable, attentive to others. 
        Weaknesses: Needs approval, avoids conflict, overly self-sacrificing, sensitive to criticism.',

        'ISTP' => 'The Virtuoso: Bold and practical experimenters, masters of all kinds of tools. Thrive in engineering, mechanics, and technical trades. 
        Strengths: Independent, resourceful, cool under pressure, practical. 
        Weaknesses: Risk-prone, emotionally detached, dislikes commitment, can be insensitive.',

        'ISFP' => 'The Adventurer: Flexible and charming artists, always ready to explore and experience something new. Creative fields like fashion, design, or culinary arts are ideal. 
        Strengths: Artistic, gentle, spontaneous, adaptable. 
        Weaknesses: Easily stressed, avoids conflict, unpredictable, may struggle with long-term planning.',

        'ESTP' => 'The Entrepreneur: Smart, energetic, and very perceptive people, who truly enjoy living on the edge. Do well in sales, crisis management, and high-energy roles. 
        Strengths: Bold, direct, perceptive, action-oriented. 
        Weaknesses: Impulsive, impatient, may overlook long-term consequences, risk-prone.',

        'ESFP' => 'The Entertainer: Spontaneous, energetic, and enthusiastic people – life is never boring around them. Thrive in performing arts, event management, or hospitality. 
        Strengths: Fun-loving, outgoing, empathetic, generous. 
        Weaknesses: Easily bored, struggles with planning, dislikes routine, may avoid deeper issues.',
    ];


    if (!empty($traits)) {
        $personalityCode = '';
        foreach ($traits as $axis => $trait) {
            $dominantTrait = $trait['value'] > 50 ? $trait['left'] : $trait['right'];
            $initialsMap = [
                'Mind' => ['Introverted' => 'I', 'Extraverted' => 'E'],
                'Energy' => ['Intuitive' => 'N', 'Observant' => 'S'],
                'Nature' => ['Feeling' => 'F', 'Thinking' => 'T'],
                'Tactics' => ['Judging' => 'J', 'Prospecting' => 'P'],
            ];
            $personalityCode .= $initialsMap[$axis][$dominantTrait];
        }
    }
    ?>

    <div class="card shadow-sm p-2 pb-0 mb-3">
        <div class="card-body">
            <h5 class="card-title">Personality Traits</h5>

            <div class="row">
                <!-- Trigger Sections -->
                <div class="list-group mb-4 col-md-6" id="traitTabs" role="tablist">
                    <?php
                    $i = 0;
                    foreach ($traits as $axis => $trait):
                        $dominant = $trait['value'] > 50 ? $trait['left'] : $trait['right'];
                        $inverse = 100 - $trait['value'];
                        $tabId = strtolower($axis);
                        $isActive = $i === 0 ? 'active' : '';
                    ?>
                        <div
                            class="list-group-item list-group-item-action <?= $isActive ?>"
                            data-bs-toggle="list"
                            data-bs-target="#tab-<?= $tabId ?>"
                            role="tab">
                            <div class="d-flex justify-content-between small fw-bold mb-1">
                                <span><?= $trait['left'] ?></span>
                                <span><?= $trait['right'] ?></span>
                            </div>
                            <div class="position-relative" style="height: 24px;">
                                <div class="progress" style="height: 8px;">
                                    <div
                                        class="progress-bar bg-<?= $trait['color'] ?>"
                                        style="width: <?= $trait['value'] ?>%;"></div>
                                </div>
                                <div class="position-absolute top-0 translate-middle-y text-nowrap"
                                    style="left: calc(<?= $trait['value'] ?>%); top: 12px;">
                                    <span class="badge rounded-pill bg-<?= $trait['color'] ?>">
                                        <?= $trait['value'] ?>%
                                    </span>
                                </div>
                            </div>
                            <div class="text-start small text-muted mt-1">
                                <strong><?= $axis ?>:</strong> Dominant trait is <strong><?= $dominant ?></strong>
                            </div>
                        </div>
                    <?php
                        $i++;
                    endforeach; ?>
                </div>


                <!-- Tab Content -->
                <div class="tab-content col-md-6">
                    <?php
                    $i = 0;
                    foreach ($traits as $axis => $trait):
                        $dominant = $trait['value'] > 50 ? $trait['left'] : $trait['right'];
                        $tabId = strtolower($axis);
                        $isActive = $i === 0 ? 'show active' : '';
                    ?>
                        <div class="tab-pane fade <?= $isActive ?>" id="tab-<?= $tabId ?>" role="tabpanel">
                            <h5 class="fw-bold"><?= $dominant ?> (<?= $axis ?>)</h5>
                            <p><?= $traitDescriptions[$dominant] ?? 'Description not found.' ?></p>

                            <hr>
                            <h6 class="text-muted">Personality Type: <strong><?= $personalityCode ?></strong></h6>
                            <p><?= $personalityDesc[$personalityCode] ?? 'No description available for this type.' ?></p>
                        </div>
                    <?php
                        $i++;
                    endforeach;
                    ?>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- PERSONALITY ASSESSMENT WIDGET ENDS HERE -->

<div class="profile-view">
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
                        'model' => $profile,
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
                        'model' => $profile,
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
                        'model' => $profile,
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

                    <?php if (!empty($profile->languages)): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($profile->languages as $language): ?>
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
        </div>
        <!-- Social Media -->
        <div class="col-md-8 row">
            <div>
                <div class="bg-white shadow rounded px-1 pt-2">
                    <h4 class="border-bottom pb-2 mb-3">Application Details</h4>

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',

                            // Kampuni
                            [
                                'attribute' => 'applicant_company_id',
                                'value' => $model->company->company_name ?? null,
                                'label' => 'Company',
                            ],

                            // Job Post
                            [
                                'attribute' => 'applicant_job_post_id',
                                'value' => $model->jobPost->post_job_title ?? null,
                                'label' => 'Job Title',
                            ],

                            // Muombaji
                            [
                                'attribute' => 'applicant_user_id',
                                'value' => $model->user2->username ?? null,
                                'label' => 'Applicant Username',
                            ],

                            // Alama
                            'applicant_score',

                            // Status
                            [
                                'attribute' => 'applicant_status_id',
                                'value' => $model->statusLookup->status_name ?? null,
                                'label' => 'Status',
                            ],

                            // Tarehe ya kuundwa
                            [
                                'attribute' => 'applicant_created_at',
                                'format' => ['date', 'php:d M Y H:i'],
                                'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'),
                            ],

                            // Aliyeunda
                            [
                                'attribute' => 'applicant_created_by',
                                'value' => $model->user->username ?? null,
                                'label' => 'Created By',
                                'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'),
                            ],

                            // Tarehe ya kusasishwa
                            [
                                'attribute' => 'applicant_updated_at',
                                'format' => ['date', 'php:d M Y H:i'],
                                'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'),
                            ],

                            // Aliyesasisha
                            [
                                'attribute' => 'applicant_updated_by',
                                'value' => $model->user1->username ?? null,
                                'label' => 'Updated By',
                                'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'),
                            ],

                            // Tarehe ya kufutwa
                            [
                                'attribute' => 'applicant_deleted_at',
                                'format' => ['date', 'php:d M Y H:i'],
                                'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'),
                            ],

                            // Aliyefuta
                            [
                                'attribute' => 'applicant_deleted_by',
                                'value' => $model->user0->username ?? null,
                                'label' => 'Deleted By',
                                'visible' => Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin'),
                            ],
                        ],
                    ]) ?>
                </div>
            </div>

            <!-- Biography -->
            <div>
                <div class="bg-white shadow rounded px-1 pt-2">
                    <h4 class="border-bottom pb-2 mb-3">Biography & Media</h4>
                    <?= DetailView::widget([
                        'model' => $profile,
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
                        'model' => $profile,
                        'attributes' => [
                            [
                                'label' => 'Education Records',
                                'format' => 'raw',
                                'value' => function ($profile) {
                                    if (empty($profile->educations)) {
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
                                    }, $profile->educations);

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

                    <?php if (!empty($profile->workExperiences)): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($profile->workExperiences as $exp): ?>
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

                    <?php if (!empty($profile->skills)): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($profile->skills as $skill): ?>
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

                    <?php if (!empty($profile->awards)): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($profile->awards as $award): ?>
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

                    <?php if (!empty($profile->publications)): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($profile->publications as $publication): ?>
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