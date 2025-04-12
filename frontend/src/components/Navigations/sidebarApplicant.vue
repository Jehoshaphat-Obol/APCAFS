<template>
   
  <nav>
    <ul>
      <!-- Dashboard -->
   <li class="nav-item">
    <router-link to="/applicant/dashboard" class="nav-link d-flex align-items-center">
      <i class="bi bi-grid me-2"></i>
      <span class="link-text fw-semibold">Dashboard</span>
    </router-link>
  </li>
  
      <!-- Profile Management -->
      <li class="nav-item dropdown">
        <a href="#" class="nav-link d-flex align-items-center" data-bs-toggle="collapse" data-bs-target="#profileManagement" aria-expanded="false">
          <i class="bi bi-person-circle me-2"></i>
          <span class="link-text">Profile Management</span>
          <i class="bi bi-chevron-down ms-2"></i>
        </a>
        <ul id="profileManagement" class="collapse list-unstyled ps-3">
          <li><router-link to="/applicant/edit-profile" class="nav-link"><i class="bi bi-pencil-square"></i> Edit profile</router-link></li>
          <li><router-link to="/applicant/update-skills" class="nav-link"><i class="bi bi-gear"></i> Update Skills</router-link></li>
        </ul>
      </li>
  
      <!-- My Applications -->
      <li class="nav-item dropdown">
        <a href="#" class="nav-link d-flex align-items-center" data-bs-toggle="collapse" data-bs-target="#myApplications" aria-expanded="false">
          <i class="bi bi-clipboard-check me-2"></i>
          <span class="link-text">My Applications</span>
          <i class="bi bi-chevron-down ms-2"></i>
        </a>
        <ul id="myApplications" class="collapse list-unstyled ps-3">
          <li><router-link to="/applicant/application-status" class="nav-link"><i class="bi bi-check-circle"></i>Application Status</router-link></li>
          <li><router-link to="/applicant/generate-cv" class="nav-link"><i class="bi bi-file-earmark-text"></i> Generate CV</router-link></li>
        </ul>
      </li>
  <!-- Jobs -->
  <li class="nav-item dropdown">
        <a href="#" class="nav-link d-flex align-items-center" data-bs-toggle="collapse" data-bs-target="#jobsMenu" aria-expanded="false">
          <i class="bi bi-briefcase me-2"></i>
          <span class="link-text">Apply Jobs</span>
          <i class="bi bi-chevron-down ms-2"></i>
        </a>
        <ul id="jobsMenu" class="collapse list-unstyled ps-3">
          <li><router-link to="/applicant/apply-job" class="nav-link"><i class="bi bi-send"></i> Apply Job</router-link></li>
          <li><router-link to="/applicant/jobs" class="nav-link"><i class="bi bi-list-task"></i> View Jobs</router-link></li>
        </ul>
      </li>
      <!-- Aptitude Tests -->
      <li class="nav-item dropdown">
        <a href="#" class="nav-link d-flex align-items-center" data-bs-toggle="collapse" data-bs-target="#aptitudeTests" aria-expanded="false">
          <i class="bi bi-emoji-sunglasses me-2"></i>
          <span class="link-text">Aptitude Tests</span>
          <i class="bi bi-chevron-down ms-2"></i>
        </a>
        <ul id="aptitudeTests" class="collapse list-unstyled ps-3">
          <li><router-link to="/applicant/skills-test" class="nav-link"><i class="bi bi-check-square"></i> Skills Test</router-link></li>
          <li><router-link to="/applicant/test-results" class="nav-link"><i class="bi bi-bar-chart-line"></i> View Test Results</router-link></li>
        </ul>
      </li>
    </ul>
  </nav>
    </template>
    
    <script>
    export default {
      name: 'SidebarApplicant'
    }
    </script>
    