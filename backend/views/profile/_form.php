<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/** @var yii\web\View $this */
/** @var app\models\Profile $model */
/** @var yii\widgets\ActiveForm $form */
?>

<?php $form = ActiveForm::begin(); ?>

<div class="container py-5">
    <div class="accordion" id="basicAccordion">
        <div id="form-alert-container"></div>
        <!-- Item 1 (open by default) -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Personal Information
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#basicAccordion">
                <div class="accordion-body">


                    <?= $form->field($model, 'profile_first_name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'profile_middle_name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'profile_last_name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'profile_social_media_username')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'profile_date_of_birth')->textInput([
                        'class' => 'form-control flatpickr',
                        'placeholder' => 'Choose Date...'
                    ]) ?>

                    <?= $form->field($model, 'profile_bios')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'profile_region_id')->dropDownList(
                        ArrayHelper::map(
                            $regions,
                            'id',
                            'region_name'
                        ),
                        [
                            'prompt' => 'Choose Region',
                            'id' => 'region-id',
                            'onchange' => 'loadDistricts(this.value);'
                        ]
                    ) ?>

                    <?php
                    $districtItems = [];

                    if (!empty($model->profile_region_id)) {
                        $districtItems = ArrayHelper::map(
                            \app\models\District::find()->where(['district_region_id' => $model->profile_region_id])->all(),
                            'id',
                            'district_name'
                        );
                    }

                    echo $form->field($model, 'profile_district_id')->dropDownList(
                        $districtItems,
                        [
                            'prompt' => 'Choose District',
                            'id' => 'district-id'
                        ]
                    );
                    ?>



                    <?= $form->field($model, 'profile_local_address')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Phone Numbers
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#basicAccordion">
                <div class="accordion-body">
                    <div id="phones-container">
                        <?php if (!empty($model->phone_number)): ?>
                            <?php foreach ($model->phone_number as $index => $phone): ?>
                                <div class="phone-item card mb-3 p-3 border rounded shadow-sm">
                                    <button type="button" class="btn-close float-end" onclick="removePhone(this)"></button>
                                    <div class="form-group">
                                        <?= $form->field($model, "phone_number[$index][phone_number]")
                                            ->textInput([
                                                'class' => 'form-control',
                                                'required' => true,
                                                'value' => $phone['phone_number']
                                            ]) ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <button type="button" class="btn btn-secondary" onclick="addPhoneNumber()">Add Phone Number</button>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Experience
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                data-bs-parent="#basicAccordion">
                <div class="accordion-body">
                    <div id="experience-container">
                        <!-- Experience items zitawekwa hapa kwa JS -->
                        <?php if (!empty($model->experiences)): ?>
                            <?php foreach ($model->experiences as $index => $exp): ?>
                                <div class="experience-item card mb-3 p-3 border rounded shadow-sm">
                                    <button type="button" class="btn-close float-end" onclick="removeExperience(this)"></button>

                                    <?= $form->field($model, "experiences[$index][experience_job_title]")
                                        ->textInput(['class' => 'form-control', 'required' => true, 'value' => $exp['experience_job_title']]) ?>

                                    <?= $form->field($model, "experiences[$index][experience_company_name]")
                                        ->textInput(['class' => 'form-control', 'required' => true, 'value' => $exp['experience_company_name']]) ?>

                                    <?= $form->field($model, "experiences[$index][experience_from]")
                                        ->textInput(['class' => 'form-control flatpickr', 'required' => true, 'value' => $exp['experience_from']]) ?>

                                    <?= $form->field($model, "experiences[$index][experience_to]")
                                        ->textInput(['class' => 'form-control flatpickr', 'required' => true, 'value' => $exp['experience_to']]) ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <button type="button" class="btn btn-secondary" onclick="addExperience()">Add Working Experience</button>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Education
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                data-bs-parent="#basicAccordion">
                <div class="accordion-body">
                    <div id="education-container">
                        <!-- Education items zitaongezwa hapa na JS -->
                        <?php if (!empty($model->educations)): ?>
                            <?php foreach ($model->educations as $index => $edu): ?>
                                <div class="education-item card mb-3 p-3 border rounded shadow-sm">
                                    <button type="button" class="btn-close float-end" onclick="removeEducation(this)"></button>

                                    <?= $form->field($model, "educations[$index][education_degree_name]")
                                        ->dropDownList([
                                            'Certificate' => 'Certificate',
                                            'Diploma' => 'Diploma',
                                            'Bachelor' => 'Bachelor',
                                            'Master' => 'Master',
                                            'PhD' => 'PhD',
                                            'Postdoc' => 'Postdoc',
                                        ], [
                                            'prompt' => 'Select Degree Level',
                                            'class' => 'form-control',
                                            'required' => true,
                                            'value' => $edu['education_degree_name']
                                        ]) ?>

                                    <?= $form->field($model, "educations[$index][education_programme_name]")
                                        ->textInput(['class' => 'form-control', 'required' => true, 'value' => $edu['education_programme_name']]) ?>

                                    <?= $form->field($model, "educations[$index][education_university_name]")
                                        ->textInput(['class' => 'form-control', 'required' => true, 'value' => $edu['education_university_name']]) ?>

                                    <?= $form->field($model, "educations[$index][education_graduation_date]")
                                        ->textInput(['class' => 'form-control flatpickr', 'required' => true, 'value' => $edu['education_graduation_date']]) ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <button type="button" class="btn btn-secondary mt-2" onclick="addEducation()">Add Education</button>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    Skill
                </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                data-bs-parent="#basicAccordion">
                <div class="accordion-body">
                    <div id="skill-container">
                        <!-- Skill items zitaongezwa hapa kwa JS -->
                        <?php if (!empty($model->skills)): ?>
                            <?php foreach ($model->skills as $index => $skill): ?>
                                <div class="skill-item card mb-3 p-3 border rounded shadow-sm">
                                    <button type="button" class="btn-close float-end" onclick="removeSkill(this)"></button>

                                    <?= $form->field($model, "skills[$index][skill_type]")
                                        ->dropDownList([
                                            'Technical' => 'Technical',
                                            'Soft' => 'Soft',
                                            'Language' => 'Language',
                                        ], [
                                            'prompt' => 'Select Skill Type',
                                            'class' => 'form-control',
                                            'required' => true,
                                            'value' => $skill['skill_type']
                                        ]) ?>

                                    <?= $form->field($model, "skills[$index][skill_name]")
                                        ->textInput(['class' => 'form-control', 'required' => true, 'value' => $skill['skill_name']]) ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <button type="button" class="btn btn-secondary mt-2" onclick="addSkill()">Add Skill</button>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    Awards
                </button>
            </h2>
            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                data-bs-parent="#basicAccordion">
                <div class="accordion-body">
                    <div id="award-container">
                        <!-- Award items zitaongezwa hapa na JS -->
                        <?php if (!empty($model->awards)): ?>
                            <?php foreach ($model->awards as $index => $award): ?>
                                <div class="award-item card mb-3 p-3 border rounded shadow-sm">
                                    <button type="button" class="btn-close float-end" onclick="removeAward(this)"></button>

                                    <?= $form->field($model, "awards[$index][award_title]")
                                        ->textInput(['class' => 'form-control', 'required' => true, 'value' => $award['award_title']]) ?>

                                    <?= $form->field($model, "awards[$index][award_organization_name]")
                                        ->textInput(['class' => 'form-control', 'required' => true, 'value' => $award['award_organization_name']]) ?>

                                    <?= $form->field($model, "awards[$index][award_issue_number]")
                                        ->textInput(['class' => 'form-control', 'value' => $award['award_issue_number']]) ?>

                                    <?= $form->field($model, "awards[$index][award_date_of_issue]")
                                        ->textInput(['class' => 'form-control flatpickr', 'value' => $award['award_date_of_issue']]) ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <button type="button" class="btn btn-secondary mt-2" onclick="addAward()">Add Award</button>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSeven">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                    Languages
                </button>
            </h2>
            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                data-bs-parent="#basicAccordion">
                <div class="accordion-body">
                    <div id="language-container">
                        <!-- Language items zitaongezwa hapa kwa JS -->
                        <?php if (!empty($model->languages)): ?>
                            <?php foreach ($model->languages as $index => $lang): ?>
                                <div class="language-item card mb-3 p-3 border rounded shadow-sm">
                                    <button type="button" class="btn-close float-end" onclick="removeLanguage(this)"></button>

                                    <?= $form->field($model, "languages[$index][language_name]")
                                        ->dropDownList([
                                            'English' => 'English',
                                            'Swahili' => 'Swahili',
                                            'French' => 'French',
                                            'Spanish' => 'Spanish',
                                            'Arabic' => 'Arabic',
                                        ], [
                                            'prompt' => 'Select Language',
                                            'class' => 'form-control',
                                            'required' => true,
                                            'value' => $lang['language_name']
                                        ]) ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <button type="button" class="btn btn-secondary mt-2" onclick="addLanguage()">Add Language</button>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingEight">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                    Publication
                </button>
            </h2>
            <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight"
                data-bs-parent="#basicAccordion">
                <div class="accordion-body">
                    <div id="publication-container">
                        <!-- Publication items zitaongezwa hapa kwa JS -->
                        <?php if (!empty($model->publications)): ?>
                            <?php foreach ($model->publications as $index => $pub): ?>
                                <div class="publication-item card mb-3 p-3 border rounded shadow-sm">
                                    <button type="button" class="btn-close float-end" onclick="removePublication(this)"></button>

                                    <?= $form->field($model, "publications[$index][publication_title]")
                                        ->textInput(['class' => 'form-control', 'required' => true, 'value' => $pub['publication_title']]) ?>

                                    <?= $form->field($model, "publications[$index][publication_publisher_name]")
                                        ->textInput(['class' => 'form-control', 'required' => true, 'value' => $pub['publication_publisher_name']]) ?>

                                    <?= $form->field($model, "publications[$index][publication_date_of_publication]")
                                        ->textInput(['class' => 'form-control flatpickr', 'required' => true, 'value' => $pub['publication_date_of_publication']]) ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <button type="button" class="btn btn-secondary mt-2" onclick="addPublication()">Add Publication</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="profile-form">
    <!-- Template ya namba ya simu -->
    <template id="phone-template">
        <div class="phone-item card mb-3 p-3 border rounded shadow-sm">
            <button type="button" class="btn-close float-end" onclick="removePhone(this)"></button>

            <div class="form-group">
                <?= $form->field($model, "phone_number[__index__][phone_number]")
                    ->textInput([
                        'class' => 'form-control',
                        'required' => true,
                        'maxlength' => true
                    ]) ?>
            </div>
        </div>
    </template>

    <!-- Template ya experience -->
    <template id="experience-template">
        <div class="experience-item card mb-3 p-3 border rounded shadow-sm">
            <button type="button" class="btn-close float-end" onclick="removeExperience(this)"></button>

            <?= $form->field($model, "experiences[__index__][experience_job_title]")
                ->textInput(['class' => 'form-control', 'required' => true])
                ->label('Job Title') ?>

            <?= $form->field($model, "experiences[__index__][experience_company_name]")
                ->textInput(['class' => 'form-control', 'required' => true])
                ->label('Company Name') ?>

            <?= $form->field($model, "experiences[__index__][experience_from]")
                ->textInput([
                    'class' => 'form-control flatpickr',
                    'placeholder' => 'Choose Date...',
                    'required' => true
                ])
                ->label('From') ?>

            <?= $form->field($model, "experiences[__index__][experience_to]")
                ->textInput([
                    'class' => 'form-control flatpickr',
                    'placeholder' => 'Choose Date...',
                    'required' => true
                ])
                ->label('To') ?>

        </div>
    </template>

    <!-- Template ya Education -->
    <template id="education-template">
        <div class="education-item card mb-3 p-3 border rounded shadow-sm">
            <button type="button" class="btn-close float-end" onclick="removeEducation(this)"></button>

            <?= $form->field($model, "educations[__index__][education_degree_name]")
                ->dropDownList([
                    'Certificate' => 'Certificate',
                    'Diploma' => 'Diploma',
                    'Bachelor' => 'Bachelor',
                    'Master' => 'Master',
                    'PhD' => 'PhD',
                    'Postdoc' => 'Postdoc',
                ], [
                    'prompt' => 'Select Degree Level',
                    'class' => 'form-control',
                    'required' => true,
                ])
                ->label('Degree Name') ?>


            <?= $form->field($model, "educations[__index__][education_programme_name]")
                ->textInput(['class' => 'form-control', 'required' => true])
                ->label('Programme Name') ?>

            <?= $form->field($model, "educations[__index__][education_university_name]")
                ->textInput(['class' => 'form-control', 'required' => true])
                ->label('University Name') ?>

            <?= $form->field($model, "educations[__index__][education_graduation_date]")
                ->textInput([
                    'class' => 'form-control flatpickr',
                    'placeholder' => 'Choose Date...',
                    'required' => true
                ])
                ->label('Graduation Date') ?>

        </div>
    </template>

    <!-- Template ya Skill -->
    <template id="skill-template">
        <div class="skill-item card mb-3 p-3 border rounded shadow-sm">
            <button type="button" class="btn-close float-end" onclick="removeSkill(this)"></button>

            <?= $form->field($model, "skills[__index__][skill_type]")
                ->dropDownList(
                    [
                        'Technical' => 'Technical',
                        'Soft' => 'Soft',
                        'Language' => 'Language',
                    ],
                    ['prompt' => 'Select Skill Type', 'class' => 'form-control', 'required' => true]
                )
                ->label('Skill Type') ?>

            <?= $form->field($model, "skills[__index__][skill_name]")
                ->textInput(['class' => 'form-control', 'required' => true])
                ->label('Skill Name') ?>

        </div>
    </template>

    <!-- Template ya Award -->
    <template id="award-template">
        <div class="award-item card mb-3 p-3 border rounded shadow-sm">
            <button type="button" class="btn-close float-end" onclick="removeAward(this)"></button>

            <?= $form->field($model, "awards[__index__][award_title]")
                ->textInput(['class' => 'form-control', 'maxlength' => true, 'required' => true])
                ->label('Award Title') ?>

            <?= $form->field($model, "awards[__index__][award_organization_name]")
                ->textInput(['class' => 'form-control', 'maxlength' => true, 'required' => true])
                ->label('Organization Name') ?>

            <?= $form->field($model, "awards[__index__][award_issue_number]")
                ->textInput(['class' => 'form-control', 'maxlength' => true])
                ->label('Issue Number') ?>

            <?= $form->field($model, "awards[__index__][award_date_of_issue]")
                ->textInput([
                    'class' => 'form-control flatpickr',
                    'placeholder' => 'Choose Date...',
                    'autocomplete' => 'off',
                ])
                ->label('Date of Issue') ?>

        </div>
    </template>

    <!-- Template ya Language -->
    <template id="language-template">
        <div class="language-item card mb-3 p-3 border rounded shadow-sm">
            <button type="button" class="btn-close float-end" onclick="removeLanguage(this)"></button>

            <?= $form->field($model, "languages[__index__][language_name]")
                ->dropDownList(
                    [
                        'English' => 'English',
                        'Swahili' => 'Swahili',
                        'French' => 'French',
                        'Spanish' => 'Spanish',
                        'Arabic' => 'Arabic',
                    ],
                    ['prompt' => 'Select Language', 'class' => 'form-control', 'required' => true]
                )
                ->label('Language Name') ?>

        </div>
    </template>

    <!-- Template ya Publication -->
    <template id="publication-template">
        <div class="publication-item card mb-3 p-3 border rounded shadow-sm">
            <button type="button" class="btn-close float-end" onclick="removePublication(this)"></button>

            <?= $form->field($model, "publications[__index__][publication_title]")
                ->textInput([
                    'class' => 'form-control',
                    'maxlength' => true,
                    'required' => true,
                ])
                ->label('Publication Title') ?>

            <?= $form->field($model, "publications[__index__][publication_publisher_name]")
                ->textInput([
                    'class' => 'form-control',
                    'maxlength' => true,
                    'required' => true,
                ])
                ->label('Publisher Name') ?>

            <?= $form->field($model, "publications[__index__][publication_date_of_publication]")
                ->textInput([
                    'class' => 'form-control flatpickr',
                    'placeholder' => 'Choose Date...',
                    'required' => true,
                ])
                ->label('Date of Publication') ?>

        </div>
    </template>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success mt-3']) ?>
    </div>


</div>
<?php ActiveForm::end(); ?>

<script>
    let debounceTimer;
    const cache = {
        districts: {},
    };
    let phoneIndex = 0;
    let experienceIndex = 0;
    let educationIndex = 0;
    let skillIndex = 0;
    let awardIndex = 0;
    let languageIndex = 0;
    let publicationIndex = 0;

    document.addEventListener('DOMContentLoaded', function() {
        const alertContainer = document.getElementById('form-alert-container');

        document.querySelectorAll('.accordion-button').forEach(button => {
            button.addEventListener('click', function(e) {
                const targetCollapse = document.querySelector(button.dataset.bsTarget);
                const currentlyOpen = document.querySelector('.accordion-collapse.show');

                // If clicking already open accordion, allow default behavior
                if (targetCollapse && targetCollapse.classList.contains('show')) return;

                if (currentlyOpen) {
                    const form = currentlyOpen.querySelector('form');

                    if (form) {
                        const requiredFields = form.querySelectorAll('input[required], textarea[required], select[required]');
                        let valid = true;
                        alertContainer.innerHTML = ''; // Clear previous alerts

                        requiredFields.forEach(field => {
                            if (!field.value.trim()) {
                                field.classList.add('is-invalid');
                                valid = false;
                            } else {
                                field.classList.remove('is-invalid');
                            }
                        });

                        if (!valid) {
                            e.preventDefault(); // Stop accordion switch
                            alertContainer.innerHTML = `
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Please fill in all required fields before proceeding.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `;

                            // Optionally scroll to first invalid field
                            const firstInvalid = currentlyOpen.querySelector('.is-invalid');
                            if (firstInvalid) {
                                firstInvalid.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'center'
                                });
                                firstInvalid.focus();
                            }

                            return;
                        }
                    }
                }
            });
        });
    });



    // hii ni kwa ajili ya kuload district
    function loadDistricts(regionId) {
        if (!regionId || isNaN(regionId)) {
            $('#district-id').html('<option value="">Choose Districts</option>');
            return;
        }

        // Cheki kama tayari data ipo kwenye cache
        if (cache.districts[regionId]) {
            $('#district-id').html(cache.districts[regionId]);
            return;
        }

        clearTimeout(debounceTimer);
        $('#district-id').html('<option>Loading...</option>');

        // Debounce kwa sekunde 300ms kabla ya kufanya maombi
        debounceTimer = setTimeout(function() {
            $.ajax({
                url: '/profile/get-districts', // URL sahihi ya controller action
                data: {
                    region_id: regionId
                },
                dataType: 'json', // Rudisha data kama JSON
                success: function(data) {
                    var options = '<option value="">Choose District</option>';

                    if (data.length > 0) {
                        // Jenga <option> tags kwa kila district
                        data.forEach(function(district) {
                            options += '<option value="' + district.id + '">' + district.district_name + '</option>';
                        });
                    } else {
                        options = '<option value="">No districts available</option>';
                    }

                    // Cache response ili lisirudie tena maombi kwa software hiyo hiyo
                    cache.districts[regionId] = options;

                    // Onyesha options kwenye select field
                    $('#district-id').html(options);
                },
                complete: function() {
                    $('#district-loading-spinner').hide();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error fetching districts:", textStatus, errorThrown);
                    $('#district-id').html('<option value="">Error loading districts</option>');
                    $('#district-loading-spinner').hide();
                }
            });
        }, 300); // Debounce kwa 300ms
    }


    // hii ni kwa ajili ya namba ya simu
    function addPhoneNumber() {
        const template = document.querySelector('#phone-template').innerHTML;
        const rendered = template.replace(/__index__/g, phoneIndex++);
        const container = document.querySelector('#phones-container');
        container.insertAdjacentHTML('beforeend', rendered);
    }

    function removePhone(button) {
        button.closest('.phone-item').remove();
    }

    // hii ni kwa ajili ya working experience
    function addExperience() {
        const template = document.querySelector('#experience-template').innerHTML;
        const rendered = template.replace(/__index__/g, experienceIndex++);
        const container = document.querySelector('#experience-container');
        container.insertAdjacentHTML('beforeend', rendered);

        // Initialize flatpickr on new inputs
        flatpickr(".flatpickr");
    }

    function removeExperience(button) {
        button.closest('.experience-item').remove();
    }

    // hii ni kwa ajili ya education
    function addEducation() {
        const template = document.getElementById('education-template').innerHTML;
        const container = document.getElementById('education-container');
        const html = template.replace(/__index__/g, educationIndex++);
        container.insertAdjacentHTML('beforeend', html);

        // Initialize Flatpickr again after adding new date inputs
        flatpickr('.flatpickr', {});
    }

    function removeEducation(button) {
        button.closest('.education-item').remove();
    }

    // hii ni kwa ajili ya skill
    function addSkill() {
        const container = document.getElementById('skill-container');
        const template = document.getElementById('skill-template').innerHTML;
        const newItemHtml = template.replace(/__index__/g, skillIndex);
        container.insertAdjacentHTML('beforeend', newItemHtml);
        skillIndex++;
    }

    function removeSkill(button) {
        const item = button.closest('.skill-item');
        if (item) {
            item.remove();
        }
    }

    // hii ni kwa ajili ya award
    function addAward() {
        const template = document.getElementById('award-template').innerHTML;
        const rendered = template.replace(/__index__/g, awardIndex++);
        document.getElementById('award-container').insertAdjacentHTML('beforeend', rendered);

        // Reinitialize Flatpickr for new date inputs
        flatpickr('.flatpickr');
    }

    function removeAward(button) {
        button.closest('.award-item').remove();
    }

    // hii ni kwa ajili ya language
    function addLanguage() {
        const template = document.getElementById('language-template').innerHTML;
        const rendered = template.replace(/__index__/g, languageIndex++);
        document.getElementById('language-container').insertAdjacentHTML('beforeend', rendered);
    }

    function removeLanguage(button) {
        button.closest('.language-item').remove();
    }

    // hii ni kwa ajili ya publication
    function addPublication() {
        const template = document.getElementById('publication-template').innerHTML;
        const rendered = template.replace(/__index__/g, publicationIndex++);
        document.getElementById('publication-container').insertAdjacentHTML('beforeend', rendered);

        // Initialize flatpickr for new element
        flatpickr('.flatpickr', {});
    }

    function removePublication(button) {
        button.closest('.publication-item').remove();
    }

    document.addEventListener("DOMContentLoaded", function() {
        flatpickr('.flatpickr');
    });
</script>