<nav class="sidebar sidebar-offcanvas shadow" style="background-color: #7ab730;" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='./'">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item nav-category">Kelola Pengguna</li>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='users'">
        <i class="mdi mdi-account-multiple-outline menu-icon"></i>
        <span class="menu-title">Users</span>
      </a>
    </li>
    <li class="nav-item nav-category">Kelola Kategori</li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="menu-icon mdi mdi-floor-plan"></i>
        <span class="menu-title">Kategori</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='kategori-fasilitas'">Fasilitas</a></li>
          <li class="nav-item"> <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='kategori-wisata'">Wisata</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item nav-category">Data SIG</li>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='fasilitas'">
        <i class="mdi mdi-sort-variant menu-icon"></i>
        <span class="menu-title">Fasilitas</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='wisata'">
        <i class="mdi mdi-google-maps menu-icon"></i>
        <span class="menu-title">Wisata</span>
      </a>
    </li>
    <li class="nav-item nav-category"></li>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='../auth/signout'">
        <i class="mdi mdi-logout-variant menu-icon"></i>
        <span class="menu-title">Keluar</span>
      </a>
    </li>
  </ul>
</nav>