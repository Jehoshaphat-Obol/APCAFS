<template>
  <nav>
    <ul>
      <!-- Dashboard -->
      <li class="nav-item mb-1">
        <router-link to="/hr/dashboard" class="nav-link d-flex align-items-center">
          <i class="bi bi-grid me-2"></i>
          <span class="link-text fw-semibold">Dashboard</span>
        </router-link>
      </li>
  
      <!-- Job Management -->
      <li class="nav-item mb-1 dropdown">
        <a href="#" class="nav-link d-flex align-items-center" data-bs-toggle="collapse" data-bs-target="#jobManagement" aria-expanded="false">
          <i class="bi bi-briefcase me-2"></i>
          <span class="link-text">Job Management</span>
          <i class="bi bi-chevron-down ms-2"></i>
        </a>
        <ul id="jobManagement" class="collapse list-unstyled ps-3">
          <li><router-link to="/hr/post-job" class="nav-link"><i class="bi bi-plus-circle"></i> Post New Job</router-link></li>
          <li><router-link to="/hr/manage-jobs" class="nav-link"><i class="bi bi-card-list"></i> Manage Job Listings</router-link></li>
        </ul>
      </li>
  
      <!-- Applicant Management -->
      <li class="nav-item mb-1 dropdown">
        <a href="#" class="nav-link d-flex align-items-center" data-bs-toggle="collapse" data-bs-target="#applicantManagement" aria-expanded="false">
          <i class="bi bi-people me-2"></i>
          <span class="link-text">Applicant Management</span>
          <i class="bi bi-chevron-down ms-2"></i>
        </a>
        <ul id="applicantManagement" class="collapse list-unstyled ps-3">
          <li><router-link to="/hr/applicants" class="nav-link"><i class="bi bi-eye"></i> View Applicants</router-link></li>
          <li><router-link to="/hr/rankings" class="nav-link"><i class="bi bi-bar-chart-line"></i> View Ranking</router-link></li>
          <li><router-link to="/hr/personality-tests" class="nav-link"><i class="bi bi-emoji-smile"></i> Personality Tests</router-link></li>
        </ul>
      </li>
  
      <!-- Tests & Assessments -->
      <li class="nav-item mb-1 dropdown">
        <a href="#" class="nav-link d-flex align-items-center" data-bs-toggle="collapse" data-bs-target="#testsAssessments" aria-expanded="false">
          <i class="bi bi-file-earmark-text me-2"></i>
          <span class="link-text">Tests & Assessments</span>
          <i class="bi bi-chevron-down ms-2"></i>
        </a>
        <ul id="testsAssessments" class="collapse list-unstyled ps-3">
          <li><router-link to="/hr/create-test" class="nav-link"><i class="bi bi-pencil-square"></i> Create Test</router-link></li>
          <li><router-link to="/hr/test-results" class="nav-link"><i class="bi bi-bar-chart"></i> View Test Results</router-link></li>
        </ul>
      </li>
  
      <!-- Settings -->
      <li id="setting" class="nav-item mb-1">
        <router-link to="/hr/settings" class="nav-link d-flex align-items-center">
          <i class="bi bi-gear me-2"></i>
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
  
  