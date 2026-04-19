@include('layouts.adminhead')

<body class="g-sidenav-show bg-gray-100">
  @include('layouts.aside')
  
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    @include('layouts.navbar')
    <!-- End Navbar -->
    
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Profile</h6>
              </div>
            </div>
            
            <div class="card-body">
              <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                  <!-- Update Profile -->
                  <div class="card mb-4">
                    <div class="card-header bg-gradient-info">
                      <h6 class="text-white mb-0">Update Profile Information</h6>
                    </div>
                    <div class="card-body">
                      @include('profile.partials.update-profile-information-form')
                    </div>
                  </div>

                  <!-- Update Password -->
                  <div class="card mb-4">
                    <div class="card-header bg-gradient-info">
                      <h6 class="text-white mb-0">Update Password</h6>
                    </div>
                    <div class="card-body">
                      @include('profile.partials.update-password-form')
                    </div>
                  </div>

                  <!-- Delete Account -->
                  <div class="card">
                    <div class="card-header bg-gradient-danger">
                      <h6 class="text-white mb-0">Delete Account</h6>
                    </div>
                    <div class="card-body">
                      @include('profile.partials.delete-user-form')
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Footer -->
      @include('layouts.adminfooter')
    </div>
  </main>

  <!-- Core JS Files -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  
  <script>
    // Scrollbar initialization for sidenav
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      };
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  
  <!-- Control Center for Material Dashboard -->
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>
</html>