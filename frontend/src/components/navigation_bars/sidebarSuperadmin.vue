<template>
  <nav>
  <ul>
    <!-- Dashboard -->
    <li class="nav-item mb-1">
      <router-link to="/admin/dashboard" class="nav-link d-flex align-items-center">
        <i class="bi bi-grid me-2"></i>
        <span class="link-text fw-semibold">Dashboard</span>
      </router-link>
    </li>

    <!-- Company Management -->
    <li class="nav-item mb-1 dropdown">
      <a href="#" class="nav-link d-flex align-items-center" data-bs-toggle="collapse" data-bs-target="#companyManagementMenu" aria-expanded="false">
        <i class="bi bi-buildings me-2"></i>
        <span class="link-text">Company Management</span>
        <i class="bi bi-chevron-down ms-2"></i>
      </a>
      <ul id="companyManagementMenu" class="collapse list-unstyled ps-3">
        <li>
          <router-link to="/companies" class="nav-link">
            <i class="bi bi-building"></i> View Registered Companies
          </router-link>
        </li>
        <li>
          <router-link to="/companies/subscriptions" class="nav-link">
            <i class="bi bi-credit-card-2-front"></i> Manage Subscriptions
          </router-link>
        </li>
      </ul>
    </li>

    <!-- User Management -->
    <li class="nav-item mb-1 dropdown">
      <a href="#" class="nav-link d-flex align-items-center" data-bs-toggle="collapse" data-bs-target="#userManagementMenu" aria-expanded="false">
        <i class="bi bi-people me-2"></i>
        <span class="link-text">User Management</span>
        <i class="bi bi-chevron-down ms-2"></i>
      </a>
      <ul id="userManagementMenu" class="collapse list-unstyled ps-3">
        <li>
          <router-link to="/users" class="nav-link">
            <i class="bi bi-person-lines-fill"></i> View All Users
          </router-link>
        </li>
        <li>
          <router-link to="/users/add" class="nav-link">
            <i class="bi bi-person-plus"></i> Add Users
          </router-link>
        </li>
      </ul>
    </li>

    <!-- Job Posts Overview -->
    <li class="nav-item mb-1 dropdown">
      <a href="#" class="nav-link d-flex align-items-center" data-bs-toggle="collapse" data-bs-target="#jobPostsOverviewMenu" aria-expanded="false">
        <i class="bi bi-clipboard-data me-2"></i>
        <span class="link-text">Job Posts Overview</span>
        <i class="bi bi-chevron-down ms-2"></i>
      </a>
      <ul id="jobPostsOverviewMenu" class="collapse list-unstyled ps-3">
        <li>
          <router-link to="/jobs/overview" class="nav-link">
            <i class="bi bi-search"></i> Monitor Job Status
          </router-link>
        </li>
      </ul>
    </li>

    <!-- Settings -->
    <li id="setting" class="nav-item mb-1">
      <router-link to="/settings" class="nav-link d-flex align-items-center">
        <i class="bi bi-gear me-2"></i>
        <span class="link-text">Settings</span>
      </router-link>
    </li>
  </ul>
</nav>

</template>

<script>
export default {
  name: 'SuperAdmin'
}
</script>
