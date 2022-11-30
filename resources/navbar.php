<div class="container-fluid position-relative nav-bar p-0">
  <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
    <nav class="navbar navbar-expand-lg bg-light navbar-light shadow-lg py-3 py-lg-0 pl-3 pl-lg-5">
      <a href="./" class="navbar-brand d-flex">
        <img src="assets/images/logo.png" style="width: 50px;" alt="">
        <h1 class="m-0 text-dark ml-3">Rote Ndao</h1>
      </a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
        <div class="navbar-nav ml-auto py-0">
          <a href="./" class="nav-item nav-link <?php if ($_SESSION['page-url'] == "./") {
                                                  echo "active";
                                                } ?>">Beranda</a>
          <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Profil Daerah</a>
            <div class="dropdown-menu border-0 rounded-0 m-0">
              <a href="penduduk" class="dropdown-item">Penduduk</a>
              <a href="pariwisata" class="dropdown-item">Pariwisata</a>
            </div>
          </div>
          <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Layanan</a>
            <div class="dropdown-menu border-0 rounded-0 m-0">
              <a href="fasilitas" class="dropdown-item">Fasilitas</a>
              <a href="wisata" class="dropdown-item">Wisata</a>
              <a href="pengunjung" class="dropdown-item">Pengunjung</a>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </div>
</div>