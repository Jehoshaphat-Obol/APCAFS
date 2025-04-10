<template>
    <aside class="sidebar sidebar-hr">
      <nav>
        <ul>
  <!-- Dashboard -->
  <li class="nav-item dashboard-item">
    <router-link to="/hr/dashboard" class="nav-link active-link">
      <i class="bi bi-house-door-fill"></i>
      <span class="link-text large">Dashboard</span>
    </router-link>
  </li>


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
  <li class="nav-item">
    <router-link to="/hr/settings" class="nav-link">
      <i class="bi bi-gear-fill"></i>
      <span class="link-text">Settings</span>
    </router-link>
  </li>
</ul>

      </nav>
    </aside>
  </template>
  
  <script>
  export default {
    name: 'SidebarHR'
  }
  </script>
  
  <style scoped>
  
  .sidebar {
    width: 260px;
    background-color: #2c3e50;
    color: white;
    padding: 25px 20px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
  }
  
  .sidebar ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
  }
  
  .nav-item {
    margin-bottom: 20px;
  }
  
  .nav-link {
    display: flex;
    align-items: center;
    color: white;
    text-decoration: none;
    font-size: 17px;
    padding: 10px;
    border-radius: 6px;
    transition: all 0.3s ease;
  }
  
  .nav-link:hover {
    background-color: #13171b;
    
  }
  
  .nav-link i {
    font-size: 20px;
    margin-right: 12px;
  }
  
  .link-text {
    display: inline-block;
  }
  
  .link-text.large {
    font-size: 20px;
    font-weight: bold;
  }
  
  .active-link {
    background-color: #2c3e50;
  font-weight: bold;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
  
  }
  .dashboard-item {
  border-bottom: 1px solid #7f8c8d;
  padding-bottom: 15px;
  margin-bottom: 20px;
}

  </style>
  