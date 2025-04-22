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
              <h5 class="card-title">user registration</h5>

              <!-- Vertical Form -->
              <form class="row g-3">
                <div class="col-12">
                  <label for="FirstName" class="form-label">First Name</label>
                  <input type="text" class="form-control" id="inputNanme4">
                </div>
                <div class="col-12">
                  <label for="MiddleNanme" class="form-label">Middle Name</label>
                  <input type="text" class="form-control" id="inputNanme4">
                </div>
                <div class="col-12">
                  <label for="LastNanme" class="form-label">Last Name</label>
                  <input type="text" class="form-control" id="inputNanme4">
                </div>
                <div class="col-12">
                  <label for="SocialName" class="form-label">Social Media User Name</label>
                  <input type="text" class="form-control" id="inputNanme4">
                </div>
                <div class="col-12">
                 
                  <label for="inputDate" class="col-sm-2 col-form-label">Date of Birth</label>
                  <div class="col-12">
                    <input type="date" class="form-control">
                  </div>
              
                </div>

                <div class="col-12"> 
                  <label for="Text Area" class="col-sm-2 col-form-label">Enter Bio</label>
                  <div class="col-12"> 
                    <textarea class="form-control" style="height: 100px"></textarea>
                  </div>
                </div>
             
                <div class="col-12">
                  <label for="inputAddress" class="form-label">Local Address</label>
                  <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="Region">
                </div>
                <div class="col-md-4">
                  <select id="inputState" class="form-select">
                    <option selected="">Choose...</option>
                    <option>...</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <input type="text" class="form-control" placeholder="Zip">
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