  <!-- Hero -->
  <section class="text-white py-5 hero">
    <div class="container-sm align-items-center d-flex text-center text-lg-start" style="flex-flow: column;">
      <h1 class="display-5 fw-bold"  style="max-width: 720px;">AI Powered CV Screening & Profile Analysis System</h1>
      <p class="lead mt-3"  style="max-width: 480px;">Let APCAFS streamline your hiring process by automatically analyzing and ranking candidates for you.</p>
      <?= \yii\helpers\Html::a('Register as Applicant', ['/site/register'], ['class' => 'btn btn-lg btn-light mt-4',  "style"=>"max-width: 320px;"]) ?>
    </div>
    <img src="<?= Yii::getAlias('@web') ?>/images/logo/hr.png" alt="" style="height: 100%; width: 100%; object-fit: cover;">
  </section>

  <!-- Features -->
  <section class="py-5">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="section-heading">Why Choose APCAFS?</h2>
        <p class="text-muted">Designed to simplify hiring and elevate talent selection through AI.</p>
      </div>
      <div class="row g-4 container-sm">
        <div class="col-md-6">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-body text-center">
              <h5 class="card-title fw-bold">Smart CV Filtering</h5>
              <p class="card-text">AI scans and ranks CVs instantly, ensuring only the best-fit candidates reach the next stage.</p>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-body text-center">
              <h5 class="card-title fw-bold">Insightful Reports</h5>
              <p class="card-text">Visual dashboards and smart analytics give employers deep hiring insights at a glance.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-4 bg-dark text-white text-center">
    <div class="container">
      <p class="mb-0">&copy; 2025 APCAFS. All rights reserved.</p>
    </div>
  </footer>