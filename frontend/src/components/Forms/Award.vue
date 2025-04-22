<script>
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
 
  <div class="col-lg-6 mx-auto" >

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Award</h5>

              <!-- Vertical Form -->
              <form class="row g-3">
                <div class="col-12">
                  <label for="FirstName" class="form-label">Award Title</label>
                  <input type="text" class="form-control" id="inputNanme4">
                </div>
                <div class="col-12">
                  <label for="MiddleNanme" class="form-label">Organization Name</label>
                  <input type="text" class="form-control" id="inputNanme4">
                </div>
                <div class="col-12">
                  <label for="LastNanme" class="form-label">Issue Number</label>
                  <input type="text" class="form-control" id="inputNanme4">
                </div>
               
                <div class="col-12">
                 
                  <label for="inputDate" class="col-sm-2 col-form-label">Date of Issue</label>
                  <div class="col-12">
                    <input type="date" class="form-control">
                  </div>
              
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary me-2">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>

          
          </div>

</template>