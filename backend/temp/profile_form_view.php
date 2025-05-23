<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$this->title = 'Create Professional Profile';
$this->registerCssFile('@web/css/multistep-form.css');
$this->registerJsFile('@web/js/multistep-form.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>

<div class="profile-create">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <!-- Progress Sidebar -->
                <div class="progress-sidebar">
                    <h4><?= Html::encode($this->title) ?></h4>
                    <div class="progress-steps">
                        <?php
                        $steps = [
                            1 => ['title' => 'Personal Info', 'icon' => 'fa-user'],
                            2 => ['title' => 'Location & Contact', 'icon' => 'fa-map-marker'],
                            3 => ['title' => 'Education', 'icon' => 'fa-graduation-cap'],
                            4 => ['title' => 'Work Experience', 'icon' => 'fa-briefcase'],
                            5 => ['title' => 'Skills & Languages', 'icon' => 'fa-cogs'],
                            6 => ['title' => 'Awards & Publications', 'icon' => 'fa-trophy'],
                            7 => ['title' => 'Review & Submit', 'icon' => 'fa-check-circle']
                        ];
                        
                        foreach ($steps as $stepNum => $stepInfo):
                            $isActive = $stepNum == $currentStep;
                            $isCompleted = in_array($stepNum, $formData['completed_steps']);
                            $cssClass = $isActive ? 'active' : ($isCompleted ? 'completed' : '');
                        ?>
                        <div class="progress-step <?= $cssClass ?>" data-step="<?= $stepNum ?>">
                            <div class="step-icon">
                                <i class="fa <?= $stepInfo['icon'] ?>"></i>
                            </div>
                            <div class="step-info">
                                <div class="step-number">Step <?= $stepNum ?></div>
                                <div class="step-title"><?= $stepInfo['title'] ?></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            
            <div class="col-md-9">
                <div class="form-container">
                    <?php Pjax::begin(['id' => 'multistep-pjax', 'enablePushState' => false]); ?>
                    
                    <div class="step-content">
                        <?php if ($currentStep == 1): ?>
                            <!-- Step 1: Personal Information -->
                            <div class="step-header">
                                <h3><i class="fa fa-user"></i> Personal Information</h3>
                                <p>Let's start with your basic personal details</p>
                            </div>
                            
                            <?php $form = ActiveForm::begin([
                                'id' => 'step-form',
                                'options' => ['data-pjax' => true, 'class' => 'multistep-form'],
                                'fieldConfig' => [
                                    'template' => '<div class="form-group">{label}{input}{error}</div>',
                                    'inputOptions' => ['class' => 'form-control'],
                                    'errorOptions' => ['class' => 'help-block text-danger'],
                                ],
                            ]); ?>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <?= $form->field(new \stdClass(), 'profile_first_name')->textInput([
                                        'name' => 'profile_first_name',
                                        'value' => $formData['profile']['profile_first_name'] ?? '',
                                        'placeholder' => 'Enter your first name',
                                        'maxlength' => 100,
                                        'required' => true
                                    ])->label('First Name <span class="required">*</span>', ['encode' => false]) ?>
                                </div>
                                <div class="col-md-4">
                                    <?= $form->field(new \stdClass(), 'profile_middle_name')->textInput([
                                        'name' => 'profile_middle_name',
                                        'value' => $formData['profile']['profile_middle_name'] ?? '',
                                        'placeholder' => 'Enter your middle name (optional)',
                                        'maxlength' => 100
                                    ])->label('Middle Name') ?>
                                </div>
                                <div class="col-md-4">
                                    <?= $form->field(new \stdClass(), 'profile_last_name')->textInput([
                                        'name' => 'profile_last_name',
                                        'value' => $formData['profile']['profile_last_name'] ?? '',
                                        'placeholder' => 'Enter your last name',
                                        'maxlength' => 100,
                                        'required' => true
                                    ])->label('Last Name <span class="required">*</span>', ['encode' => false]) ?>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field(new \stdClass(), 'profile_social_media_username')->textInput([
                                        'name' => 'profile_social_media_username',
                                        'value' => $formData['profile']['profile_social_media_username'] ?? '',
                                        'placeholder' => '@username or handle',
                                        'required' => true
                                    ])->label('Social Media Username <span class="required">*</span>', ['encode' => false]) ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field(new \stdClass(), 'profile_date_of_birth')->input('date', [
                                        'name' => 'profile_date_of_birth',
                                        'value' => $formData['profile']['profile_date_of_birth'] ?? '',
                                        'required' => true
                                    ])->label('Date of Birth <span class="required">*</span>', ['encode' => false]) ?>
                                </div>
                            </div>
                            
                            <?= $form->field(new \stdClass(), 'profile_bios')->textarea([
                                'name' => 'profile_bios',
                                'value' => $formData['profile']['profile_bios'] ?? '',
                                'placeholder' => 'Tell us about yourself in a few sentences...',
                                'rows' => 4
                            ])->label('Personal Biography') ?>
                            
                            <?php ActiveForm::end(); ?>
                            
                        <?php elseif ($currentStep == 2): ?>
                            <!-- Step 2: Location & Contact -->
                            <div class="step-header">
                                <h3><i class="fa fa-map-marker"></i> Location & Contact Information</h3>
                                <p>Where are you located and how can we reach you?</p>
                            </div>
                            
                            <?php $form = ActiveForm::begin([
                                'id' => 'step-form',
                                'options' => ['data-pjax' => true, 'class' => 'multistep-form'],
                                'fieldConfig' => [
                                    'template' => '<div class="form-group">{label}{input}{error}</div>',
                                    'inputOptions' => ['class' => 'form-control'],
                                    'errorOptions' => ['class' => 'help-block text-danger'],
                                ],
                            ]); ?>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field(new \stdClass(), 'profile_region_id')->dropDownList(
                                        ArrayHelper::map($regions, 'id', 'region_name'),
                                        [
                                            'name' => 'profile_region_id',
                                            'value' => $formData['profile']['profile_region_id'] ?? '',
                                            'prompt' => 'Select Region',
                                            'required' => true,
                                            'id' => 'region-select'
                                        ]
                                    )->label('Region <span class="required">*</span>', ['encode' => false]) ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field(new \stdClass(), 'profile_district_id')->dropDownList(
                                        ArrayHelper::map($districts, 'id', 'district_name'),
                                        [
                                            'name' => 'profile_district_id',
                                            'value' => $formData['profile']['profile_district_id'] ?? '',
                                            'prompt' => 'Select District',
                                            'required' => true,
                                            'id' => 'district-select'
                                        ]
                                    )->label('District <span class="required">*</span>', ['encode' => false]) ?>
                                </div>
                            </div>
                            
                            <?= $form->field(new \stdClass(), 'profile_local_address')->textInput([
                                'name' => 'profile_local_address',
                                'value' => $formData['profile']['profile_local_address'] ?? '',
                                'placeholder' => 'Enter your local address (optional)'
                            ])->label('Local Address') ?>
                            
                            <div class="phone-numbers-section">
                                <h4>Phone Numbers</h4>
                                <div id="phone-numbers-container">
                                    <?php
                                    $phoneNumbers = $formData['phone_numbers'] ?? [['phone_number' => '']];
                                    foreach ($phoneNumbers as $index => $phone):
                                    ?>
                                    <div class="phone-number-item" data-index="<?= $index ?>">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <?= $form->field(new \stdClass(), "phone_numbers[$index][phone_number]")->textInput([
                                                    'name' => "phone_numbers[$index][phone_number]",
                                                    'value' => $phone['phone_number'] ?? '',
                                                    'placeholder' => 'Enter phone number',
                                                    'maxlength' => 10,
                                                    'pattern' => '[0-9]{10}'
                                                ])->label(false) ?>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger btn-remove-phone" <?= $index == 0 ? 'style="display:none;"' : '' ?>>
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <button type="button" class="btn btn-outline-primary btn-add-phone">
                                    <i class="fa fa-plus"></i> Add Phone Number
                                </button>
                            </div>
                            
                            <?php ActiveForm::end(); ?>
                            
                        <?php elseif ($currentStep == 3): ?>
                            <!-- Step 3: Education -->
                            <div class="step-header">
                                <h3><i class="fa fa-graduation-cap"></i> Education Background</h3>
                                <p>Tell us about your educational qualifications</p>
                            </div>
                            
                            <?php $form = ActiveForm::begin([
                                'id' => 'step-form',
                                'options' => ['data-pjax' => true, 'class' => 'multistep-form'],
                                'fieldConfig' => [
                                    'template' => '<div class="form-group">{label}{input}{error}</div>',
                                    'inputOptions' => ['class' => 'form-control'],
                                    'errorOptions' => ['class' => 'help-block text-danger'],
                                ],
                            ]); ?>
                            
                            <div id="education-container">
                                <?php
                                $educations = $formData['educations'] ?? [[]];
                                foreach ($educations as $index => $education):
                                ?>
                                <div class="education-item card mb-3" data-index="<?= $index ?>">
                                    <div class="card-header">
                                        <h5>Education #<?= $index + 1 ?>
                                            <button type="button" class="btn btn-sm btn-danger btn-remove-education float-right" <?= $index == 0 ? 'style="display:none;"' : '' ?>>
                                                <i class="fa fa-trash"></i> Remove
                                            </button>
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?= $form->field(new \stdClass(), "educations[$index][education_degree_name]")->textInput([
                                                    'name' => "educations[$index][education_degree_name]",
                                                    'value' => $education['education_degree_name'] ?? '',
                                                    'placeholder' => 'e.g., Bachelor of Science',
                                                    'maxlength' => 100
                                                ])->label('Degree Name') ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?= $form->field(new \stdClass(), "educations[$index][education_programme_name]")->textInput([
                                                    'name' => "educations[$index][education_programme_name]",
                                                    'value' => $education['education_programme_name'] ?? '',
                                                    'placeholder' => 'e.g., Computer Science',
                                                    'maxlength' => 200
                                                ])->label('Programme Name') ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <?= $form->field(new \stdClass(), "educations[$index][education_university_name]")->textInput([
                                                    'name' => "educations[$index][education_university_name]",
                                                    'value' => $education['education_university_name'] ?? '',
                                                    'placeholder' => 'University or Institution name'
                                                ])->label('University/Institution') ?>
                                            </div>
                                            <div class="col-md-4">
                                                <?= $form->field(new \stdClass(), "educations[$index][education_graduation_date]")->input('date', [
                                                    'name' => "educations[$index][education_graduation_date]",
                                                    'value' => $education['education_graduation_date'] ?? ''
                                                ])->label('Graduation Date') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            
                            <button type="button" class="btn btn-outline-primary btn-add-education">
                                <i class="fa fa-plus"></i> Add Education
                            </button>
                            
                            <?php ActiveForm::end(); ?>
                            
                        <?php elseif ($currentStep == 4): ?>
                            <!-- Step 4: Work Experience -->
                            <div class="step-header">
                                <h3><i class="fa fa-briefcase"></i> Work Experience</h3>
                                <p>Share your professional work experience</p>
                            </div>
                            
                            <?php $form = ActiveForm::begin([
                                'id' => 'step-form',
                                'options' => ['data-pjax' => true, 'class' => 'multistep-form'],
                                'fieldConfig' => [
                                    'template' => '<div class="form-group">{label}{input}{error}</div>',
                                    'inputOptions' => ['class' => 'form-control'],
                                    'errorOptions' => ['class' => 'help-block text-danger'],
                                ],
                            ]); ?>
                            
                            <div id="experience-container">
                                <?php
                                $experiences = $formData['work_experiences'] ?? [[]];
                                foreach ($experiences as $index => $experience):
                                ?>
                                <div class="experience-item card mb-3" data-index="<?= $index ?>">
                                    <div class="card-header">
                                        <h5>Experience #<?= $index + 1 ?>
                                            <button type="button" class="btn btn-sm btn-danger btn-remove-experience float-right" <?= $index == 0 ? 'style="display:none;"' : '' ?>>
                                                <i class="fa fa-trash"></i> Remove
                                            </button>
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?= $form->field(new \stdClass(), "work_experiences[$index][experience_job_title]")->textInput([
                                                    'name' => "work_experiences[$index][experience_job_title]",
                                                    'value' => $experience['experience_job_title'] ?? '',
                                                    'placeholder' => 'e.g., Software Developer',
                                                    'maxlength' => 100
                                                ])->label('Job Title') ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?= $form->field(new \stdClass(), "work_experiences[$index][experience_company_name]")->textInput([
                                                    'name' => "work_experiences[$index][experience_company_name]",
                                                    'value' => $experience['experience_company_name'] ?? '',
                                                    'placeholder' => 'Company name',
                                                    'maxlength' => 150
                                                ])->label('Company Name') ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?= $form->field(new \stdClass(), "work_experiences[$index][experience_from]")->input('date', [
                                                    'name' => "work_experiences[$index][experience_from]",
                                                    'value' => $experience['experience_from'] ?? ''
                                                ])->label('Start Date') ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?= $form->field(new \stdClass(), "work_experiences[$index][experience_to]")->input('date', [
                                                    'name' => "work_experiences[$index][experience_to]",
                                                    'value' => $experience['experience_to'] ?? ''
                                                ])->label('End Date (Leave blank if current)') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            
                            <button type="button" class="btn btn-outline-primary btn-add-experience">
                                <i class="fa fa-plus"></i> Add Work Experience
                            </button>
                            
                            <?php ActiveForm::end(); ?>
                            
                        <?php elseif ($currentStep == 5): ?>
                            <!-- Step 5: Skills & Languages -->
                            <div class="step-header">
                                <h3><i class="fa fa-cogs"></i> Skills & Languages</h3>
                                <p>What skills do you have and what languages do you speak?</p>
                            </div>
                            
                            <?php $form = ActiveForm::begin([
                                'id' => 'step-form',
                                'options' => ['data-pjax' => true, 'class' => 'multistep-form'],
                                'fieldConfig' => [
                                    'template' => '<div class="form-group">{label}{input}{error}</div>',
                                    'inputOptions' => ['class' => 'form-control'],
                                    'errorOptions' => ['class' => 'help-block text-danger'],
                                ],
                            ]); ?>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="skills-section">
                                        <h4>Skills</h4>
                                        <div id="skills-container">
                                            <?php
                                            $skills = $formData['skills'] ?? [['skill_type' => '', 'skill_name' => '']];
                                            foreach ($skills as $index => $skill):
                                            ?>
                                            <div class="skill-item card mb-2" data-index="<?= $index ?>">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <?= $form->field(new \stdClass(), "skills[$index][skill_type]")->dropDownList([
                                                                'Technical' => 'Technical',
                                                                'Soft Skills' => 'Soft Skills',
                                                                'Language' => 'Language',
                                                                'Creative' => 'Creative',
                                                                'Management' => 'Management',
                                                                'Other' => 'Other'
                                                            ], [
                                                                'name' => "skills[$index][skill_type]",
                                                                'value' => $skill['skill_type'] ?? '',
                                                                'prompt' => 'Select Type'
                                                            ])->label(false) ?>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <?= $form->field(new \stdClass(), "skills[$index][skill_name]")->textInput([
                                                                'name' => "skills[$index][skill_name]",
                                                                'value' => $skill['skill_name'] ?? '',
                                                                'placeholder' => 'Skill name',
                                                                'maxlength' => 200
                                                            ])->label(false) ?>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button type="button" class="btn btn-danger btn-sm btn-remove-skill" <?= $index == 0 ? 'style="display:none;"' : '' ?>>
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <button type="button" class="btn btn-outline-primary btn-add-skill">
                                            <i class="fa fa-plus"></i> Add Skill
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="languages-section">
                                        <h4>Languages</h4>
                                        <div id="languages-container">
                                            <?php
                                            $languages = $formData['languages'] ?? [['language_name' => '']];
                                            foreach ($languages as $index => $language):
                                            ?>
                                            <div class="language-item" data-index="<?= $index ?>">
                                                <div class="row mb-2">
                                                    <div class="col-md-8">
                                                        <?= $form->field(new \stdClass(), "languages[$index][language_name]")->textInput([
                                                            'name' => "languages[$index][language_name]",
                                                            'value' => $language['language_name'] ?? '',
                                                            'placeholder' => 'Language name'
                                                        ])->label(false) ?>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <button type="button" class="btn btn-danger btn-sm btn-remove-language" <?= $index == 0 ? 'style="display:none;"' : '' ?>>
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <button type="button" class="btn btn-outline-primary btn-add-language">
                                            <i class="fa fa-plus"></i> Add Language
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <?php ActiveForm::end(); ?>
                            
                        <?php elseif ($currentStep == 6): ?>
                            <!-- Step 6: Awards & Publications -->
                            <div class="step-header">
                                <h3><i class="fa fa-trophy"></i> Awards & Publications</h3>
                                <p>Share your achievements and published works</p>
                            </div>
                            
                            <?php $form = ActiveForm::begin([
                                'id' => 'step-form',
                                'options' => ['data-pjax' => true, 'class' => 'multistep-form'],
                                'fieldConfig' => [
                                    'template' => '<div class="form-group">{label}{input}{error}</div>',
                                    'inputOptions' => ['class' => 'form-control'],
                                    'errorOptions' => ['class' => 'help-block text-danger'],
                                ],
                            ]); ?>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="awards-section">
                                        <h4>Awards & Certifications</h4>
                                        <div id="awards-container">
                                            <?php
                                            $awards = $formData['awards'] ?? [[]];
                                            foreach ($awards as $index => $award):
                                            ?>
                                            <div class="award-item card mb-3" data-index="<?= $index ?>">
                                                <div class="card-header">
                                                    <h6>Award #<?= $index + 1 ?>
                                                        <button type="button" class="btn btn-sm btn-danger btn-remove-award float-right" <?= $index == 0 ? 'style="display:none;"' : '' ?>>
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </h6>
                                                </div>
                                                <div class="card-body">
                                                    <?= $form->field(new \stdClass(), "awards[$index][award_title]")->textInput([
                                                        'name' => "awards[$index][award_title]",
                                                        'value' => $award['award_title'] ?? '',
                                                        'placeholder' => 'Award title'
                                                    ])->label('Title') ?>
                                                    
                                                    <?= $form->field(new \stdClass(), "awards[$index][award_organization_name]")->textInput([
                                                        'name' => "awards[$index][award_organization_name]",
                                                        'value' => $award['award_organization_name'] ?? '',
                                                        'placeholder' => 'Issuing organization',
                                                        'maxlength' => 200
                                                    ])->label('Organization') ?>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <?= $form->field(new \stdClass(), "awards[$index][award_issue_number]")->textInput([
                                                                'name' => "awards[$index][award_issue_number]",
                                                                'value' => $award['award_issue_number'] ?? '',
                                                                'placeholder' => 'Certificate number',
                                                                'maxlength' => 50
                                                            ])->label('Issue Number') ?>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <?= $form->field(new \stdClass(), "awards[$index][award_date_of_issue]")->input('date', [
                                                                'name' => "awards[$index][award_date_of_issue]",
                                                                'value' => $award['award_date_of_issue'] ?? ''
                                                            ])->label('Date of Issue') ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <button type="button" class="btn btn-outline-primary btn-add-award">
                                            <i class="fa fa-plus"></i> Add Award
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="publications-section">
                                        <h4>Publications</h4>
                                        <div id="publications-container">
                                            <?php
                                            $publications = $formData['publications'] ?? [[]];
                                            foreach ($publications as $index => $publication):
                                            ?>
                                            <div class="publication-item card mb-3" data-index="<?= $index ?>">
                                                <div class="card-header">
                                                    <h6>Publication #<?= $index + 1 ?>
                                                        <button type="button" class="btn btn-sm btn-danger btn-remove-publication float-right" <?= $index == 0 ? 'style="display:none;"' : '' ?>>
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </h6>
                                                </div>
                                                <div class="card-body">
                                                    <?= $form->field(new \stdClass(), "publications[$index][publication_title]")->textInput([
                                                        'name' => "publications[$index][publication_title]",
                                                        'value' => $publication['publication_title'] ?? '',
                                                        'placeholder' => 'Publication title'
                                                    ])->label('Title') ?>
                                                    
                                                    <?= $form->field(new \stdClass(), "publications[$index][publication_publisher_name]")->textInput([
                                                        'name' => "publications[$index][publication_publisher_name]",
                                                        'value' => $publication['publication_publisher_name'] ?? '',
                                                        'placeholder' => 'Publisher name'
                                                    ])->label('Publisher') ?>
                                                    
                                                    <?= $form->field(new \stdClass(), "publications[$index][publication_date_of_publication]")->input('date', [
                                                        'name' => "publications[$index][publication_date_of_publication]",
                                                        'value' => $publication['publication_date_of_publication'] ?? ''
                                                    ])->label('Publication Date') ?>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <button type="button" class="btn btn-outline-primary btn-add-publication">
                                            <i class="fa fa-plus"></i> Add Publication
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <?php ActiveForm::end(); ?>
                            
                        <?php elseif ($currentStep == 7): ?>
                            <!-- Step 7: Review & Submit -->
                            <div class="step-header">
                                <h3><i class="fa fa-check-circle"></i> Review & Submit</h3>
                                <p>Please review your information before submitting</p>
                            </div>
                            
                            <div class="review-section">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Profile Summary</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Personal Information</h6>
                                                <p><strong>Name:</strong> <?= Html::encode(($formData['profile']['profile_first_name'] ?? '') . ' ' . ($formData['profile']['profile_middle_name'] ?? '') . ' ' . ($formData['profile']['profile_last_name'] ?? '')) ?></p>
                                                <p><strong>Social Media:</strong> <?= Html::encode($formData['profile']['profile_social_media_username'] ?? '') ?></p>
                                                <p><strong>Date of Birth:</strong> <?= Html::encode($formData['profile']['profile_date_of_birth'] ?? '') ?></p>
                                                <?php if (!empty($formData['profile']['profile_bios'])): ?>
                                                <p><strong>Biography:</strong> <?= Html::encode(substr($formData['profile']['profile_bios'], 0, 150)) ?>...</p>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Contact Information</h6>
                                                <p><strong>Phone Numbers:</strong> 
                                                <?php 
                                                $phones = array_filter(array_column($formData['phone_numbers'] ?? [], 'phone_number'));
                                                echo Html::encode(implode(', ', $phones)); 
                                                ?>
                                                </p>
                                                <p><strong>Address:</strong> <?= Html::encode($formData['profile']['profile_local_address'] ?? 'Not provided') ?></p>
                                            </div>
                                        </div>
                                        
                                        <hr>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Education (<?= count(array_filter($formData['educations'] ?? [], function($edu) { return !empty($edu['education_degree_name']); })) ?> entries)</h6>
                                                <h6>Work Experience (<?= count(array_filter($formData['work_experiences'] ?? [], function($exp) { return !empty($exp['experience_company_name']); })) ?> entries)</h6>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Skills (<?= count(array_filter($formData['skills'] ?? [], function($skill) { return !empty($skill['skill_name']); })) ?> entries)</h6>
                                                <h6>Languages (<?= count(array_filter($formData['languages'] ?? [], function($lang) { return !empty($lang['language_name']); })) ?> entries)</h6>
                                                <h6>Awards (<?= count(array_filter($formData['awards'] ?? [], function($award) { return !empty($award['award_title']); })) ?> entries)</h6>
                                                <h6>Publications (<?= count(array_filter($formData['publications'] ?? [], function($pub) { return !empty($pub['publication_title']); })) ?> entries)</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <?php $form = ActiveForm::begin([
                                'id' => 'step-form',
                                'options' => ['data-pjax' => true, 'class' => 'multistep-form'],
                            ]); ?>
                            
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" id="terms-agree" required>
                                <label class="form-check-label" for="terms-agree">
                                    I confirm that all information provided is accurate and complete.
                                </label>
                            </div>
                            
                            <?php ActiveForm::end(); ?>
                            
                        <?php endif; ?>
                    </div>
                    
                    <!-- Form Navigation -->
                    <div class="form-navigation mt-4">
                        <div class="row">
                            <div class="col-md-6">
                                <?php if ($currentStep > 1): ?>
                                <button type="button" class="btn btn-secondary btn-previous">
                                    <i class="fa fa-arrow-left"></i> Previous
                                </button>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6 text-right">
                                <?php if ($currentStep < 7): ?>
                                <button type="button" class="btn btn-primary btn-next">
                                    Continue <i class="fa fa-arrow-right"></i>
                                </button>
                                <?php else: ?>
                                <button type="button" class="btn btn-success btn-submit" disabled>
                                    <i class="fa fa-check"></i> Submit Profile
                                </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Region-District dependency
$('#region-select').change(function() {
    var regionId = $(this).val();
    if (regionId) {
        $.get('<?= Url::to(['profile/get-districts']) ?>', {regionId: regionId}, function(data) {
            var districtSelect = $('#district-select');
            districtSelect.empty().append('<option value="">Select District</option>');
            $.each(data, function(i, district) {
                districtSelect.append('<option value="' + district.id + '">' + district.name + '</option>');
            });
        });
    } else {
        $('#district-select').empty().append('<option value="">Select District</option>');
    }
});

// Terms checkbox for final step
$('#terms-agree').change(function() {
    $('.btn-submit').prop('disabled', !this.checked);
});
</script>