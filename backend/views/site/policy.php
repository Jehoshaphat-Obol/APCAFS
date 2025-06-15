<?php

use yii\bootstrap5\Html;
?>
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-apcafs">Terms & Privacy Policy</h1>
        <p class="text-muted">Last updated: May 20, 2025</p>
    </div>

    <div class="bg-white p-4 p-md-5 rounded shadow-sm">

        <h3 class="fw-bold">1. Introduction</h3>
        <p>Welcome to APCAFS (AI Powered CV Analysis and Filtering System). This Terms and Privacy Policy explains how we collect, use, and protect your data when you interact with our platform.</p>

        <h3 class="fw-bold">2. AI-Based Data Processing</h3>
        <p>By using APCAFS, you agree that your data, including your CV, job preferences, and other relevant information, will be processed using artificial intelligence models to assess your compatibility with job opportunities. This is essential to deliver our core service: automated CV analysis and ranking.</p>

        <h3 class="fw-bold">3. Use of Personal Data</h3>
        <p>We collect and store information such as your name, contact details, education, work history, test scores, and application history. This data is used for job matching, aptitude test evaluations, and communication purposes.</p>

        <h3 class="fw-bold">4. Social Media Background Checks</h3>
        <p>If you provide your social media handles during registration or later in your profile, we may perform an automated background screening using AI to analyze publicly visible content on those platforms. This analysis helps employers assess digital presence and consistency of professional branding.</p>
        <p><strong>Note:</strong> We do not access or process private messages or content that is not publicly available.</p>

        <h3 class="fw-bold">5. Data Security</h3>
        <p>We implement strong security measures to protect your personal data from unauthorized access, alteration, or disclosure. All sensitive data is encrypted and processed in accordance with data protection standards.</p>

        <h3 class="fw-bold">6. Your Rights</h3>
        <p>You have the right to:</p>
        <ul>
            <li>Access the data we have about you</li>
            <li>Request corrections to your data</li>
            <li>Request deletion of your data (unless legally required to retain it)</li>
            <li>Withdraw consent for processing your social media data</li>
        </ul>

        <h3 class="fw-bold">7. Contact Us</h3>
        <p>If you have any questions, concerns, or complaints about these policies or your data, you can contact us at:</p>
        <p>
            <strong>Email:</strong> support@apcafs.com<br>
            <strong>Phone:</strong> +255 712 345 678<br>
            <strong>Office:</strong> APCAFS HQ, Dar es Salaam, Tanzania
        </p>

        <hr class="my-4">

        <p class="text-muted small mb-0">By continuing to use APCAFS, you confirm that you have read, understood, and agreed to our Terms and Privacy Policy.</p>
        
        <div>
            <?= Html::a('Back', ['site/register'], [
                'class' => 'btn btn-primary',
                'style' => 'width: fit-content; background-color: #00786f; border-color: #00786f;',
            ]) ?>
        </div>
    </div>
</div>