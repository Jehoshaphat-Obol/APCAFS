<script setup>
    import HelloWorld from './components/HelloWorld.vue'

    import "./assets/vendors/bootstrap/css/bootstrap.min.css"
    import "./assets/vendors/bootstrap-icons/bootstrap-icons.css"
    import "./assets/vendors/boxicons/css/boxicons.min.css"
    import "./assets/vendors/quill/quill.snow.css"
    import "./assets/vendors/quill/quill.bubble.css"
    import "./assets/vendors/remixicon/remixicon.css"
    import "./assets/vendors/simple-datatables/style.css"
  
    import "./assets/css/style.css"


  import "./assets/vendors/apexcharts/apexcharts.min.js"
  import "./assets/vendors/bootstrap/js/bootstrap.bundle.min.js"
  import "./assets/vendors/chart.js/chart.umd.js"
  import "./assets/vendors/echarts/echarts.min.js"
  import "./assets/vendors/quill/quill.js"
  import "./assets/vendors/simple-datatables/simple-datatables.js"
  import "./assets/vendors/tinymce/tinymce.min.js"
  import "./assets/vendors/php-email-form/validate.js"

  import "./assets/js/main.js"

</script>
<template>
  <div>
    <a href="https://vite.dev" target="_blank">
      <img src="/vite.svg" class="logo" alt="Vite logo" />
    </a>
    <a href="https://vuejs.org/" target="_blank">
      <img src="./assets/vue.svg" class="logo vue" alt="Vue logo" />
    </a>
  </div>
  <HelloWorld msg="Vite + Vue" />

</template>

<style scoped>
.logo {
  height: 6em;
  padding: 1.5em;
  will-change: filter;
  transition: filter 300ms;
}
.logo:hover {
  filter: drop-shadow(0 0 2em #646cffaa);
}
.logo.vue:hover {
  filter: drop-shadow(0 0 2em #42b883aa);
}
</style>
