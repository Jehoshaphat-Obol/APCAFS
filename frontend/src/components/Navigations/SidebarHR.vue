<template>
  
  <nav>
    <ul>
<!-- Dashboard -->

<!-- Job Management -->
<li class="nav-item dropdown">
<a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#jobManagement" aria-expanded="false">
  <i class="bi bi-briefcase-fill"></i>
  <span class="link-text">Job Management</span>
</a>
<ul id="jobManagement" class="collapse list-unstyled ps-3">
  <li><router-link to="/hr/post-job" class="nav-link"><i class="bi bi-plus-circle"></i> Post New Job</router-link></li>
  <li><router-link to="/hr/manage-jobs" class="nav-link"><i class="bi bi-card-list"></i> Manage Job Listings</router-link></li>
</ul>
</li>

<!-- Applicant Management -->
<li class="nav-item dropdown">
<a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#applicantManagement" aria-expanded="false">
  <i class="bi bi-people-fill"></i>
  <span class="link-text">Applicant Management</span>
</a>
<ul id="applicantManagement" class="collapse list-unstyled ps-3">
  <li><router-link to="/hr/applicants" class="nav-link"><i class="bi bi-eye-fill"></i> View Applicants</router-link></li>
  <li><router-link to="/hr/rankings" class="nav-link"><i class="bi bi-bar-chart-line-fill"></i> View Ranking</router-link></li>
  <li><router-link to="/hr/personality-tests" class="nav-link"><i class="bi bi-emoji-smile-fill"></i> Personality Tests</router-link></li>
</ul>
</li>

<!-- Tests & Assessments -->
<li class="nav-item dropdown">
<a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#testsAssessments" aria-expanded="false">
  <i class="bi bi-file-earmark-text-fill"></i>
  <span class="link-text">Tests & Assessments</span>
</a>
<ul id="testsAssessments" class="collapse list-unstyled ps-3">
  <li><router-link to="/hr/create-test" class="nav-link"><i class="bi bi-pencil-square"></i> Create Test</router-link></li>
  <li><router-link to="/hr/test-results" class="nav-link"><i class="bi bi-bar-chart-fill"></i> View Test Results</router-link></li>
</ul>
</li>


<!-- Settings -->
<li id="setting" class="nav-item">
<router-link to="/hr/settings" class="nav-link">
  <i class="bi bi-gear-fill"></i>
  <span class="link-text">Settings</span>
</router-link>
</li>
</ul>

  </nav>

</template>

<script>
export default {
name: 'SidebarHR'
}
</script>

