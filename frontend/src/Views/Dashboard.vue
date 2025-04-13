<template>
  <AdminLayout>
    <div class="text-center">
      <h1>Welcome to the Dashboard</h1>
      <p>This is the main content of your dashboard.</p>
    </div>
  </AdminLayout>
</template>

<script>
import AdminLayout from "../layouts/AdminLayout.vue";

export default {
  name: "Dashboard",
  components: {
    AdminLayout,
  },
}
</script>
