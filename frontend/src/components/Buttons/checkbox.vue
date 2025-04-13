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
      <div class="row mb-3">
                  <legend class="col-form-label col-sm-2 pt-0">Checkboxes</legend>
                  <div class="col-sm-10">

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1">
                      <label class="form-check-label" for="gridCheck1">
                        Example checkbox
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" checked="">
                      <label class="form-check-label" for="gridCheck2">
                        Example checkbox 2
                      </label>
                    </div>

                  </div>
                </div>
</template>