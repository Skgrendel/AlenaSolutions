
<nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="#!">
        <h2 class="mb-0 text-white"><span class="font-weight-800">{{ config('app.name', 'Laravel') }}</span> <small class="font-14 pl-2 font-weight-500 text-dark">Beta v1.1</small></h2>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <!-- <a href="../dashboards/dashboard.html">
                <img src="assets/img/brand/blue.png">
              </a> -->
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>

        <ul class="navbar-nav align-items-lg-center ml-lg-auto">
          <li class="nav-item">
            <a class="nav-link nav-link-icon disabled" href="https://www.facebook.com/tesla" target="_blank" data-toggle="tooltip" data-original-title="Síguenos en Facebook">
              <i class="fab fa-facebook-square"></i>
              <span class="nav-link-inner--text d-lg-none">Facebook</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-icon disabled" href="https://www.instagram.com/tesla" target="_blank" data-toggle="tooltip" data-original-title="Síguenos en Instagram">
              <i class="fab fa-instagram"></i>
              <span class="nav-link-inner--text d-lg-none">Instagram</span>
            </a>
          </li>

          <li class="nav-item d-none d-lg-block ml-lg-4">
            <a href="#!" target="_blank" class="btn btn-neutral btn-icon disabled">
              <span class="nav-link-inner--text">Soporte</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
