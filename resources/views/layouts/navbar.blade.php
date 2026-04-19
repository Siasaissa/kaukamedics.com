<!-- Toast Container -->
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999">

    @if(session('success'))
        <div class="toast align-items-center border-0 text-white bg-success"
             role="alert"
             data-bs-delay="4000"
             data-bs-autohide="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="toast align-items-center border-0 text-white bg-danger"
             role="alert"
             data-bs-delay="5000"
             data-bs-autohide="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-times-circle me-2"></i>
                    {{ session('error') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif

    @if(session('info'))
        <div class="toast align-items-center border-0 text-white bg-primary"
             role="alert"
             data-bs-delay="4000"
             data-bs-autohide="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-info-circle me-2"></i>
                    {{ session('info') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif

</div>


<nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              
            </div>
          </div>
          <ul class=" col navbar-nav d-flex align-items-center  justify-content-end">
            <li class="nav-item d-flex align-items-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary btn-sm mb-0 me-3" target="_blank">
                        Logout
                    </button>
               </form>
              
            </li>

                           
                       
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="{{ route('profile.edit') }}" class="nav-link text-body p-0">
                <i class="material-symbols-rounded fixed-plugin-button-nav">settings</i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        let toastElList = [].slice.call(document.querySelectorAll('.toast'))
        toastElList.forEach(function (toastEl) {
            let toast = new bootstrap.Toast(toastEl)
            toast.show()
        })
    });
</script>
