<template>
    <aside class="sidebar sidebar-applicant">
      <nav>
        <ul>
          <li><router-link to="/applicant/dashboard"><i class="bi bi-house-door"></i> Dashboard</router-link></li>
          <li><router-link to="/applicant/jobs"><i class="bi bi-briefcase"></i> Jobs</router-link></li>
          <li><router-link to="/applicant/applications"><i class="bi bi-clipboard-check"></i> Applications</router-link></li>
        </ul>
      </nav>
    </aside>
  </template>
  
  <script>
  export default {
    name: 'SidebarApplicant'
  }
  </script>
  