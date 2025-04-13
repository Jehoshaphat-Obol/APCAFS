<template>
  <main>
    <div class="container">
      <!-- Login Section -->
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
  
              <!-- Login Card -->
              <div class="card mb-3">
                <div class="card-body">
  
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>
  
                  <!-- Login Form -->
                  <form class="row g-3">
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" class="form-control" id="yourUsername" required />
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>
  
                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" class="form-control" id="yourPassword" required />
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>
  
                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rememberMe" />
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>
  
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Don't have an account? <a href="/register">Create an account</a></p>
                    </div>
                  </form>
  
                </div>
              </div>End Login Card
  
            </div>
          </div>
        </div>
      </section><!-- End Login Section -->
    </div>
  </main>
</template>

<script>
export default {
  name: 'LoginPage',
}
</script>

<style scoped>
/* Add any custom styles you may need here */
</style>
