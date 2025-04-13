<script setup>
    import "../../assets/vendors/bootstrap/css/bootstrap.min.css"
    import "../../assets/vendors/bootstrap-icons/bootstrap-icons.css"
    import "../../assets/vendors/boxicons/css/boxicons.min.css"
    import "../../assets/vendors/quill/quill.snow.css"
    import "../../assets/vendors/quill/quill.bubble.css"
    import "../../assets/vendors/remixicon/remixicon.css"
    import "../../assets/vendors/simple-datatables/style.css"
  
    import "../../assets/css/style.css"


  import "../../assets/vendors/apexcharts/apexcharts.min.js"
  import "../../assets/vendors/bootstrap/js/bootstrap.bundle.min.js"
  import "../../assets/vendors/chart.js/chart.umd.js"
  import "../../assets/vendors/echarts/echarts.min.js"
  import "../../assets/vendors/quill/quill.js"
  import "../../assets/vendors/simple-datatables/simple-datatables.js"
  import "../../assets/vendors/tinymce/tinymce.min.js"
  import "../../assets/vendors/php-email-form/validate.js"

  import "../../assets/js/main.js"

 
</script>
<template>
    <div class="col-lg-6">

<div class="card">
  <div class="card-body">

    <h5 class="card-title">Default</h5>

    <div class="alert alert-primary alert-dismissible fade show" role="alert">
      A simple primary alertâcheck it out!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert alert-secondary alert-dismissible fade show" role="alert">
      A simple secondary alertâcheck it out!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
      A simple success alertâcheck it out!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      A simple danger alertâcheck it out!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      A simple warning alertâcheck it out!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert alert-info alert-dismissible fade show" role="alert">
      A simple info alertâcheck it out!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert alert-light border-light alert-dismissible fade show" role="alert">
      A simple light alertâcheck it out!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert alert-dark alert-dismissible fade show" role="alert">
      A simple dark alertâcheck it out!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

  </div>
</div>

<div class="card">
  <div class="card-body">
    <h5 class="card-title">With Icon</h5>

    <div class="alert alert-primary alert-dismissible fade show" role="alert">
      <i class="bi bi-star me-1"></i>
      A simple primary alert with iconâcheck it out!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert alert-secondary alert-dismissible fade show" role="alert">
      <i class="bi bi-collection me-1"></i>
      A simple secondary alert with iconâcheck it out!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle me-1"></i>
      A simple success alert with iconâcheck it out!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="bi bi-exclamation-octagon me-1"></i>
      A simple danger alert with iconâcheck it out!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <i class="bi bi-exclamation-triangle me-1"></i>
      A simple warning alert with iconâcheck it out!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert alert-info alert-dismissible fade show" role="alert">
      <i class="bi bi-info-circle me-1"></i>
      A simple info alert with iconâcheck it out!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert alert-dark alert-dismissible fade show" role="alert">
      <i class="bi bi-folder me-1"></i>
      A simple dark alert with iconâcheck it out!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

  </div>
</div>

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Outlined</h5>

    <div class="alert border-primary alert-dismissible fade show" role="alert">
      A simple primary outlined alertâcheck it out!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert border-secondary alert-dismissible fade show" role="alert">
      A simple secondary outlined alertâcheck it out!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert border-success alert-dismissible fade show" role="alert">
      A simple success outlined alertâcheck it out!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert border-danger alert-dismissible fade show" role="alert">
      A simple danger outlined alertâcheck it out!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert border-warning alert-dismissible fade show" role="alert">
      A simple warning outlined alertâcheck it out!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert border-info alert-dismissible fade show" role="alert">
      A simple info outlined alertâcheck it out!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert border-light alert-dismissible fade show" role="alert">
      A simple light outlined alertâcheck it out!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert border-dark alert-dismissible fade show" role="alert">
      A simple dark outlined alertâcheck it out!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

  </div>
</div>

</div>
</template>