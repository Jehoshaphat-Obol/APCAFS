<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Dashboard');

?>
<h1><?= Html::encode($this->title) ?></h1>
<!-- HR DASHBOARD -->
<?php if(Yii::$app->user->can('hr')): ?>
  <div class="container-fluid py-4 h-100">
    <!-- Summary cards -->
    <div class="row g-4 mb-4">
      <div class="col-md-3">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-body">
            <h6 class="text-muted">Open Job Posts</h6>
            <h3 class="fw-bold">
              <?= $jobs ?>
            </h3>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-body">
            <h6 class="text-muted">Applications Received</h6>
            <h3 class="fw-bold">
              <?= $applications ?>
            </h3>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-body">
            <h6 class="text-muted">Tests Created</h6>
            <h3 class="fw-bold">
              <?= $tests ?>
            </h3>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-body">
            <h6 class="text-muted">CV Processed</h6>
            <h3 class="fw-bold"><?= $processedCount ?>/<?= $totalCount ?></h3>
            <div class="progress mt-2" style="height: 6px;">
              <div class="progress-bar bg-success" role="progressbar" style="width: <?= round($percentage) ?>%"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Job posts table -->
    <div class="card shadow-sm border-0 rounded-4 mb-4">
      <div class="card-header bg-white border-0 fw-bold">
        Recent Job Posts
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead class="table-light">
              <tr>
                <th>Title</th>
                <th>Applications</th>
                <th>Test</th>
                <th>Status</th>
                <th>AI</th>
                <th>Posted</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Software Engineer</td>
                <td>92</td>
                <td>Yes</td>
                <td><span class="badge bg-success">Open</span></td>
                <td><span class="badge bg-success">Processed</span></td>
                <td>2 days ago</td>
              </tr>
              <tr>
                <td>Marketing Analyst</td>
                <td>38</td>
                <td>No</td>
                <td><span class="badge bg-warning">Pending Test</span></td>
                <td><span class="badge bg-secondary">Pending</span></td>
                <td>1 week ago</td>
              </tr>
              <tr>
                <td>HR Intern</td>
                <td>57</td>
                <td>Yes</td>
                <td><span class="badge bg-danger">Closed</span></td>
                <td><span class="badge bg-success">Processed</span></td>
                <td>3 weeks ago</td>
              </tr>
              <tr>
                <td>Graphic Designer</td>
                <td>0</td>
                <td>Yes</td>
                <td><span class="badge bg-primary">Draft</span></td>
                <td><span class="badge bg-secondary">Pending</span></td>
                <td>Today</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<!-- APPLICANTS DASHBOARD  -->
<?php if(Yii::$app->user->can('applicant')): ?>
  <div class="container-fluid py-4 h-100">
    <!-- Top section: Profile and quick actions -->
    <div class="row g-4 mb-4">
      <div class="col-md">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-body">
            <h5 class="card-title mb-2">👤 Profile Completion</h5>
            <div class="progress mb-2" style="height: 6px;">
              <div class="progress-bar bg-info" role="progressbar" style="width: <?= $completionPercentage ?>%;"></div>
            </div>
            <small class="text-muted">
                <?= $completionPercentage < 100 ? "You're almost done!" : "Profile Complete!" ?>
                <?php if ($completionPercentage < 100): ?>
                    <a href="<?= isset($profile) ? \yii\helpers\Url::to(['/profile/update', 'id' => $profile->id]) : \yii\helpers\Url::to(['/profile/create']) ?>">Complete profile</a>
                <?php endif; ?>
            </small>
          </div>
        </div>
      </div>
    </div>

    <!-- Application History -->
    <div class="card shadow-sm border-0 rounded-4">
      <div class="card-header bg-white border-0 fw-bold">
        My Applications
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-borderless table-striped mb-0 align-middle">
            <thead>
              <tr>
                <th>Company</th>
                <th>Job</th>
                <th>Status</th>
                <th>Applied On</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($applications as $app): ?>
                <tr>
                  <td><?= Html::encode($app->company->company_name) ?></td>

                  <td><?= Html::encode($app->jobPost->post_job_title) ?></td>

                  <td>
                    <?php
                    switch ($app->applicant_status_id) {
                        case 10:
                            echo '<span class="badge bg-success">Shortlisted</span>';
                            break;
                        case 11:
                            echo '<span class="badge bg-danger">Rejected</span>';
                            break;
                        default:
                            echo '<span class="badge bg-warning">Application Pending</span>';
                    }
                    ?>
                  </td>

                  <td><?= Yii::$app->formatter->asDate($app->applicant_created_at) ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
<?php endif; ?>

<!-- COMPANY ADMIN DASHBOARD -->
<?php if(Yii::$app->user->can('company-admin')): ?>
  <div class="container-fluid py-4 h-100">
    <!-- Summary KPIs -->
    <div class="row g-4 mb-4">
      <div class="col-md-4">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-body">
            <h6 class="text-muted">Total Users</h6>
            <h3 class="fw-bold">
              <?= $users ?>
            </h3>
            <small class="text-muted">Includes Admin, HRs and Managers</small>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-body">
            <h6 class="text-muted">Job Posts (Read Only)</h6>
            <h3 class="fw-bold">
              <?= $jobs ?>
            </h3>
            <small class="text-muted">Visible across the company</small>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-body">
            <h6 class="text-muted">Tests Created</h6>
            <h3 class="fw-bold">
              <?= $tests ?>
            </h3>
            <small class="text-muted">Created by HRs</small>
          </div>
        </div>
      </div>
    </div>

    <!-- User Management Table -->
    <div class="card shadow-sm border-0 rounded-4 mb-4">
      <div class="card-header bg-white border-0 fw-bold d-flex justify-content-between align-items-center">
        User Accounts
        <?= Html::a('Add New User', ['user/create'], ['class' => 'btn btn-sm btn-primary']) ?>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
              <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Created</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Anna Mushi</td>
                <td>anna@company.com</td>
                <td>HR</td>
                <td><span class="badge bg-success">Active</span></td>
                <td>2025-05-10</td>
                <td>
                  <div class="btn-group btn-group-sm">
                    <a href="#" class="btn btn-outline-secondary">Edit</a>
                    <a href="#" class="btn btn-outline-danger">Delete</a>
                  </div>
                </td>
              </tr>
              <tr>
                <td>Joseph Kimaro</td>
                <td>joseph@company.com</td>
                <td>Manager</td>
                <td><span class="badge bg-warning">Inactive</span></td>
                <td>2025-04-18</td>
                <td>
                  <div class="btn-group btn-group-sm">
                    <a href="#" class="btn btn-outline-secondary">Edit</a>
                    <a href="#" class="btn btn-outline-danger">Delete</a>
                  </div>
                </td>
              </tr>
              <tr>
                <td>Rachel Lema</td>
                <td>rachel@company.com</td>
                <td>HR</td>
                <td><span class="badge bg-success">Active</span></td>
                <td>2025-06-02</td>
                <td>
                  <div class="btn-group btn-group-sm">
                    <a href="#" class="btn btn-outline-secondary">Edit</a>
                    <a href="#" class="btn btn-outline-danger">Delete</a>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- System Summary Section -->
    <div class="row g-4">
      <div class="col-lg-6">
        <div class="card shadow-sm border-0 rounded-4 h-100">
          <div class="card-header bg-white border-0 fw-bold">
            Job Posts Overview
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <li class="list-group-item px-0">
                📌 <strong>Software Engineer</strong> — 87 applications
              </li>
              <li class="list-group-item px-0">
                🧪 <strong>Graphic Designer</strong> — Test Created
              </li>
              <li class="list-group-item px-0">
                💼 <strong>Marketing Lead</strong> — Closed
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card shadow-sm border-0 rounded-4 h-100">
          <div class="card-header bg-white border-0 fw-bold">
            Application Stats
          </div>
          <div class="card-body">
            <p>Total Applications: <strong>219</strong></p>
            <p>Top Job: <strong>Software Engineer (87)</strong></p>
            <p>Most Applied HR: <strong>Anna Mushi</strong></p>
            <p>Tests Completed: <strong>3 of 4</strong></p>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<!-- MANAGER DASHBOARD -->
<?php if(Yii::$app->user->can('manager')): ?>
  <div class="container-fluid py-4 h-100">
    <!-- Summary Cards -->
    <div class="row g-4 mb-4">
      <div class="col-md-3">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-body">
            <h6 class="text-muted">Job Posts</h6>
            <h3 class="fw-bold">8</h3>
            <small class="text-muted">Across all departments</small>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-body">
            <h6 class="text-muted">Applications</h6>
            <h3 class="fw-bold">152</h3>
            <small class="text-muted">Tracked automatically by AI</small>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-body">
            <h6 class="text-muted">Aptitude Tests</h6>
            <h3 class="fw-bold">6</h3>
            <small class="text-muted">Created by HRs</small>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-body">
            <h6 class="text-muted">Users</h6>
            <h3 class="fw-bold">14</h3>
            <small class="text-muted">HRs + Admins + Managers</small>
          </div>
        </div>
      </div>
    </div>

    <!-- Application Trends -->
    <div class="row g-4 mb-4">
      <div class="col-lg-6">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-header bg-white fw-bold border-0">
            Recent Applications
          </div>
          <div class="card-body p-0">
            <table class="table table-striped table-borderless align-middle mb-0">
              <thead>
                <tr>
                  <th>Candidate</th>
                  <th>Job Title</th>
                  <th>Status</th>
                  <th>AI Score</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Faith John</td>
                  <td>Software Engineer</td>
                  <td><span class="badge bg-info">Shortlisted</span></td>
                  <td>85%</td>
                </tr>
                <tr>
                  <td>Michael M.</td>
                  <td>Marketing Lead</td>
                  <td><span class="badge bg-danger">Rejected</span></td>
                  <td>52%</td>
                </tr>
                <tr>
                  <td>Asha W.</td>
                  <td>Graphic Designer</td>
                  <td><span class="badge bg-warning">Test Pending</span></td>
                  <td>–</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Most Active Job Posts -->
      <div class="col-lg-6">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-header bg-white fw-bold border-0">
            Most Active Job Posts
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <li class="list-group-item px-0">📌 <strong>Software Engineer</strong> — 57 Applications</li>
              <li class="list-group-item px-0">🎨 <strong>Graphic Designer</strong> — 32 Applications</li>
              <li class="list-group-item px-0">📈 <strong>Marketing Lead</strong> — 18 Applications</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Test Overview -->
    <div class="card shadow-sm border-0 rounded-4 mb-4">
      <div class="card-header bg-white fw-bold border-0">
        Aptitude Test Overview
      </div>
      <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th>Test Title</th>
              <th>Related Job</th>
              <th>Questions</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Developer Aptitude Test</td>
              <td>Software Engineer</td>
              <td>25</td>
              <td><span class="badge bg-success">Active</span></td>
            </tr>
            <tr>
              <td>Marketing Fundamentals</td>
              <td>Marketing Lead</td>
              <td>20</td>
              <td><span class="badge bg-secondary">Archived</span></td>
            </tr>
            <tr>
              <td>Design Challenge</td>
              <td>Graphic Designer</td>
              <td>18</td>
              <td><span class="badge bg-success">Active</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
<?php endif; ?>

<!-- SUPER-ADMIN DASHBORD -->
<?php if(Yii::$app->user->can('super-admin')): ?>
  <div class="container-fluid py-4 h-100">
    <!-- KPI Cards -->
    <div class="row g-4 mb-4">
      <div class="col-md-3">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-body">
            <h6 class="text-muted">Total Companies</h6>
            <h3 class="fw-bold">
              <?= $companies - 1 ?>
            </h3>
            <small class="text-muted">Across all industries</small>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-body">
            <h6 class="text-muted">Active Subscriptions</h6>
            <h3 class="fw-bold">
              <?= $subscribedCompany ?>
            </h3>
            <small class="text-muted"><?= $unSubscribedCompany ?> companies unsubscribed</small>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-body">
            <h6 class="text-muted">Total Users</h6>
            <h3 class="fw-bold">
              <?= $users ?>
            </h3>
            <small class="text-muted">Across all companies</small>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-body">
            <h6 class="text-muted">Open Support Tickets</h6>
            <h3 class="fw-bold">5</h3>
            <small class="text-muted">Pending attention</small>
          </div>
        </div>
      </div>
    </div>

    <!-- Companies Table -->
    <div class="card shadow-sm border-0 rounded-4 mb-4">
      <div class="card-header bg-white fw-bold d-flex justify-content-between">
        Registered Companies
        <?= Html::a('<i class="bi bi-building-add"></i> Add New Company', ['company/create'], [
            'class' => 'btn btn-sm btn-primary',
            'title' => 'Unda kampuni mpya',
        ]) ?>


      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => ['class' => 'table table-hover align-middle mb-0'],
                'headerRowOptions' => ['class' => 'table-light'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                      'attribute' => 'subscription_company_id',
                      'value' => 'company.company_name'
                    ],
                    
                    [
                        'attribute' => 'subscription_plan_id',
                        'value' => function ($model) {
                            return $model->subscriptionPlan ? $model->subscriptionPlan->subscription_plan_duration. ' ' . $model->subscriptionPlan->subscription_plan_duration_type : '(not set)';
                        },
                        'label' => 'Subscription Plan',
                    ],
                    'subscription_start_date',
                    'subscription_end_date',
                    [
                      'attribute' => 'subscription_status_id',
                      'value' => 'statusLookup.status_name',
                    ]
                ],
            ]); ?>
        </div>
    </div>
  </div>
  </div>
<?php endif; ?>