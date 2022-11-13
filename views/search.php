<?php require_once('../controller/script.php');
if ($_SESSION['page-url'] == "users") {
  if (isset($_GET['key']) && $_GET['key'] != "") {
    $key = addslashes(trim($_GET['key']));
    $keys = explode(" ", $key);
    $quer = "";
    foreach ($keys as $no => $data) {
      $data = strtolower($data);
      $quer .= "username LIKE '%$data%' OR id_user!='$idUser' AND email LIKE '%$data%'";
      if ($no + 1 < count($keys)) {
        $quer .= " AND ";
      }
    }
    $query = "SELECT * FROM users WHERE id_user!='$idUser' AND $quer ORDER BY id_user DESC LIMIT 100";
    $users = mysqli_query($conn, $query);
  }
  if (mysqli_num_rows($users) == 0) { ?>
    <tr>
      <th scope="row" colspan="7">belum ada data pengguna</th>
    </tr>
    <?php } else if (mysqli_num_rows($users) > 0) {
    $no = 1;
    while ($row = mysqli_fetch_assoc($users)) { ?>
      <tr>
        <th scope="row"><?= $no; ?></th>
        <td><?= $row['username'] ?></td>
        <td><?= $row['email'] ?></td>
        <td>
          <div class="badge badge-opacity-success">
            <?php $dateCreate = date_create($row['created_at']);
            echo date_format($dateCreate, "l, d M Y h:i a"); ?>
          </div>
        </td>
        <td>
          <div class="badge badge-opacity-warning">
            <?php $dateUpdate = date_create($row['updated_at']);
            echo date_format($dateUpdate, "l, d M Y h:i a"); ?>
          </div>
        </td>
        <td>
          <button type="button" class="btn btn-warning btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_user'] ?>">
            <i class="bi bi-pencil-square"></i>
          </button>
          <div class="modal fade" id="hapus<?= $row['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0 shadow">
                  <h5 class="modal-title" id="exampleModalLabel">Ubah data <?= $row['username'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="username" class="form-label">Nama</label>
                      <input type="text" name="username" value="<?= $row['username'] ?>" class="form-control" id="username" minlength="3" placeholder="Nama" required>
                    </div>
                    <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" name="email" value="<?= $row['email'] ?>" class="form-control" id="email" placeholder="Email" required>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-center border-top-0">
                    <input type="hidden" name="id-user" value="<?= $row['id_user'] ?>">
                    <input type="hidden" name="usernameOld" value="<?= $row['username'] ?>">
                    <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="ubah-user" class="btn btn-warning btn-sm rounded-0">Ubah</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </td>
        <td>
          <button type="button" class="btn btn-danger btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_user'] ?>">
            <i class="bi bi-trash3"></i>
          </button>
          <div class="modal fade" id="ubah<?= $row['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0 shadow">
                  <h5 class="modal-title" id="exampleModalLabel">Hapus data <?= $row['username'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Anda yakin ingin menghapus <?= $row['username'] ?> ini?
                </div>
                <div class="modal-footer justify-content-center border-top-0">
                  <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Batal</button>
                  <form action="" method="POST">
                    <input type="hidden" name="id-user" value="<?= $row['id_user'] ?>">
                    <input type="hidden" name="username" value="<?= $row['username'] ?>">
                    <button type="submit" name="hapus-user" class="btn btn-danger btn-sm rounded-0">Hapus</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
    <?php $no++;
    }
  }
}
if ($_SESSION['page-url'] == "kategori-fasilitas") {
  if (isset($_GET['key']) && $_GET['key'] != "") {
    $key = addslashes(trim($_GET['key']));
    $keys = explode(" ", $key);
    $quer = "";
    foreach ($keys as $no => $data) {
      $data = strtolower($data);
      $quer .= "nama_kfasilitas LIKE '%$data%'";
      if ($no + 1 < count($keys)) {
        $quer .= " OR ";
      }
    }
    $query = "SELECT * FROM kategori_fasilitas WHERE $quer ORDER BY id_kategori_fasilitas DESC LIMIT 100";
    $kfasilitas = mysqli_query($conn, $query);
  }
  if (mysqli_num_rows($kfasilitas) == 0) { ?>
    <tr>
      <th scope="row" colspan="4">belum ada data kategori</th>
    </tr>
    <?php } else if (mysqli_num_rows($kfasilitas) > 0) {
    $no = 1;
    while ($row = mysqli_fetch_assoc($kfasilitas)) { ?>
      <tr>
        <th scope="row"><?= $no; ?></th>
        <td><?= $row['nama_kfasilitas'] ?></td>
        <td>
          <button type="button" class="btn btn-warning btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_kategori_fasilitas'] ?>">
            <i class="bi bi-pencil-square"></i>
          </button>
          <div class="modal fade" id="ubah<?= $row['id_kategori_fasilitas'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0 shadow">
                  <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $row['nama_kfasilitas'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="nama-kfasilitas" class="form-label">Nama Kategori Fasilitas</label>
                      <input type="text" name="nama" value="<?= $row['nama_kfasilitas'] ?>" class="form-control" id="nama-kfasilitas" placeholder="Nama Kategori Fasilitas" required>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-center border-top-0">
                    <input type="hidden" name="id" value="<?= $row['id_kategori_fasilitas'] ?>">
                    <input type="hidden" name="namaOld" value="<?= $row['nama_kfasilitas'] ?>">
                    <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="ubah-kfasilitas" class="btn btn-warning btn-sm rounded-0">Ubah</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </td>
        <td>
          <button type="button" class="btn btn-danger btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_kategori_fasilitas'] ?>">
            <i class="bi bi-trash3"></i>
          </button>
          <div class="modal fade" id="hapus<?= $row['id_kategori_fasilitas'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0 shadow">
                  <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $row['nama_kfasilitas'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Anda yakin ingin menghapus nama kategori <?= $row['nama_kfasilitas'] ?> ini?
                </div>
                <div class="modal-footer justify-content-center border-top-0">
                  <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Batal</button>
                  <form action="" method="POST">
                    <input type="hidden" name="id" value="<?= $row['id_kategori_fasilitas'] ?>">
                    <input type="hidden" name="namaOld" value="<?= $row['nama_kfasilitas'] ?>">
                    <button type="submit" name="hapus-kfasilitas" class="btn btn-danger btn-sm rounded-0">Hapus</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
    <?php $no++;
    }
  }
}
if ($_SESSION['page-url'] == "kategori-wisata") {
  if (isset($_GET['key']) && $_GET['key'] != "") {
    $key = addslashes(trim($_GET['key']));
    $keys = explode(" ", $key);
    $quer = "";
    foreach ($keys as $no => $data) {
      $data = strtolower($data);
      $quer .= "nama_kwisata LIKE '%$data%'";
      if ($no + 1 < count($keys)) {
        $quer .= " OR ";
      }
    }
    $query = "SELECT * FROM kategori_wisata WHERE $quer ORDER BY id_kategori_wisata DESC LIMIT 100";
    $kwisata = mysqli_query($conn, $query);
  }
  if (mysqli_num_rows($kwisata) == 0) { ?>
    <tr>
      <th scope="row" colspan="4">belum ada data kategori</th>
    </tr>
    <?php } else if (mysqli_num_rows($kwisata) > 0) {
    $no = 1;
    while ($row = mysqli_fetch_assoc($kwisata)) { ?>
      <tr>
        <th scope="row"><?= $no; ?></th>
        <td><?= $row['nama_kwisata'] ?></td>
        <td>
          <a href="wisata?id-add-wisata=<?= $row['id_kategori_wisata'] ?>" class="btn btn-success btn-sm rounded-0"><i class="bi bi-plus-lg"></i> Wisata</a>
        </td>
        <td>
          <a href="wisata?id-view-wisata=<?= $row['id_kategori_wisata'] ?>" class="btn btn-info btn-sm rounded-0"><i class="bi bi-eye"></i> Wisata</a>
        </td>
        <td>
          <button type="button" class="btn btn-warning btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_kategori_wisata'] ?>">
            <i class="bi bi-pencil-square"></i>
          </button>
          <div class="modal fade" id="ubah<?= $row['id_kategori_wisata'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0 shadow">
                  <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $row['nama_kwisata'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="nama-kwisata" class="form-label">Nama Kategori Wisata</label>
                      <input type="text" name="nama" value="<?= $row['nama_kwisata'] ?>" class="form-control" id="nama-kwisata" placeholder="Nama Kategori Wisata" required>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-center border-top-0">
                    <input type="hidden" name="id" value="<?= $row['id_kategori_wisata'] ?>">
                    <input type="hidden" name="namaOld" value="<?= $row['nama_kwisata'] ?>">
                    <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="ubah-kwisata" class="btn btn-warning btn-sm rounded-0">Ubah</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </td>
        <td>
          <button type="button" class="btn btn-danger btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_kategori_wisata'] ?>">
            <i class="bi bi-trash3"></i>
          </button>
          <div class="modal fade" id="hapus<?= $row['id_kategori_wisata'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0 shadow">
                  <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $row['nama_kwisata'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Anda yakin ingin menghapus nama kategori <?= $row['nama_kwisata'] ?> ini?
                </div>
                <div class="modal-footer justify-content-center border-top-0">
                  <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Batal</button>
                  <form action="" method="POST">
                    <input type="hidden" name="id" value="<?= $row['id_kategori_wisata'] ?>">
                    <input type="hidden" name="namaOld" value="<?= $row['nama_kwisata'] ?>">
                    <button type="submit" name="hapus-kwisata" class="btn btn-danger btn-sm rounded-0">Hapus</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
    <?php $no++;
    }
  }
}
if ($_SESSION['page-url'] == "fasilitas") {
  if (isset($_GET['key']) && $_GET['key'] != "") {
    $key = addslashes(trim($_GET['key']));
    $keys = explode(" ", $key);
    $quer = "";
    foreach ($keys as $no => $data) {
      $data = strtolower($data);
      $quer .= "fasilitas.nama_fasilitas LIKE '%$data%' OR kategori_fasilitas.nama_kfasilitas LIKE '%$data%'";
      if ($no + 1 < count($keys)) {
        $quer .= " OR ";
      }
    }
    $query = "SELECT * FROM fasilitas JOIN kategori_fasilitas ON fasilitas.id_kategori_fasilitas=kategori_fasilitas.id_kategori_fasilitas WHERE $quer ORDER BY fasilitas.id_fasilitas DESC LIMIT 100";
    $fasilitas = mysqli_query($conn, $query);
  }
  if (mysqli_num_rows($fasilitas) == 0) { ?>
    <tr>
      <th scope="row" colspan="10">belum ada data fasilitas</th>
    </tr>
    <?php } else if (mysqli_num_rows($fasilitas) > 0) {
    $no = 1;
    while ($row = mysqli_fetch_assoc($fasilitas)) { ?>
      <tr>
        <th scope="row"><?= $no; ?></th>
        <td><?= $row['nama_fasilitas'] ?></td>
        <td><?= $row['nama_kfasilitas'] ?></td>
        <td><?= $row['keterangan'] ?></td>
        <td>
          <div class="badge badge-opacity-success">
            <?php $dateCreate = date_create($row['created_at']);
            echo date_format($dateCreate, "l, d M Y h:i a"); ?>
          </div>
        </td>
        <td>
          <div class="badge badge-opacity-warning">
            <?php $dateUpdate = date_create($row['updated_at']);
            echo date_format($dateUpdate, "l, d M Y h:i a"); ?>
          </div>
        </td>
        <td>
          <a href="wisata?id-add-fasilitas=<?= $row['id_fasilitas'] ?>" class="btn btn-success btn-sm rounded-0"><i class="bi bi-plus-lg"></i> Wisata</a>
        </td>
        <td>
          <a href="wisata?id-view-fasilitas=<?= $row['id_fasilitas'] ?>" class="btn btn-info btn-sm rounded-0"><i class="bi bi-eye"></i> Wisata</a>
        </td>
        <td>
          <button type="button" class="btn btn-warning btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_fasilitas'] ?>">
            <i class="bi bi-pencil-square"></i>
          </button>
          <div class="modal fade" id="ubah<?= $row['id_fasilitas'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0 shadow">
                  <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $row['nama_fasilitas'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="kategori" class="form-label">Kategori</label>
                      <select name="id-kfasilitas" class="form-select" aria-label="Default select example" required>
                        <option selected value="">Pilih Kategori</option>
                        <?php foreach ($select_kfasilitas as $row_kf) : ?>
                          <option value="<?= $row_kf['id_kategori_fasilitas'] ?>"><?= $row_kf['nama_kfasilitas'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="nama" class="form-label">Nama Fasilitas</label>
                      <input type="text" name="nama" value="<?= $row['nama_fasilitas'] ?>" class="form-control" id="nama" placeholder="Nama Fasilitas" required>
                    </div>
                    <div class="mb-3">
                      <label for="keterangan" class="form-label">Keterangan</label>
                      <input type="text" name="keterangan" value="<?= $row['keterangan'] ?>" class="form-control" id="keterangan" placeholder="Keterangan">
                    </div>
                  </div>
                  <div class="modal-footer justify-content-center border-top-0">
                    <input type="hidden" name="id" value="<?= $row['id_fasilitas'] ?>">
                    <input type="hidden" name="namaOld" value="<?= $row['nama_fasilitas'] ?>">
                    <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="ubah-fasilitas" class="btn btn-warning btn-sm rounded-0">Ubah</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </td>
        <td>
          <button type="button" class="btn btn-danger btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_fasilitas'] ?>">
            <i class="bi bi-trash3"></i>
          </button>
          <div class="modal fade" id="hapus<?= $row['id_fasilitas'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0 shadow">
                  <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $row['nama_fasilitas'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Anda yakin ingin menghapus fasilitas <?= $row['nama_fasilitas'] ?> ini?
                </div>
                <div class="modal-footer justify-content-center border-top-0">
                  <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Batal</button>
                  <form action="" method="POST">
                    <input type="hidden" name="id" value="<?= $row['id_fasilitas'] ?>">
                    <input type="hidden" name="namaOld" value="<?= $row['nama_fasilitas'] ?>">
                    <button type="submit" name="hapus-fasilitas" class="btn btn-danger btn-sm rounded-0">Hapus</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
    <?php $no++;
    }
  }
}
if ($_SESSION['page-url'] == "wisata") {
  if (isset($_GET['key']) && $_GET['key'] != "") {
    $key = addslashes(trim($_GET['key']));
    $keys = explode(" ", $key);
    $quer = "";
    foreach ($keys as $no => $data) {
      $data = strtolower($data);
      $quer .= "wisata.nama_wisata LIKE '%$data%' OR kategori_wisata.nama_kwisata LIKE '%$data%'";
      if ($no + 1 < count($keys)) {
        $quer .= " OR ";
      }
    }
    $query = "SELECT * FROM wisata JOIN kategori_wisata ON wisata.id_kategori_wisata=kategori_wisata.id_kategori_wisata JOIN fasilitas ON wisata.id_fasilitas=fasilitas.id_fasilitas JOIN kategori_fasilitas ON fasilitas.id_kategori_fasilitas=kategori_fasilitas.id_kategori_fasilitas WHERE $quer ORDER BY wisata.id_wisata DESC LIMIT 100";
    $wisata = mysqli_query($conn, $query);
  }
  if (mysqli_num_rows($wisata) == 0) { ?>
    <tr>
      <th scope="row" colspan="11">belum ada data wisata</th>
    </tr>
    <?php } else if (mysqli_num_rows($wisata) > 0) {
    $no = 1;
    while ($row = mysqli_fetch_assoc($wisata)) { ?>
      <tr>
        <th scope="row"><?= $no; ?></th>
        <td>
          <div class="d-flex">
            <img src="../assets/images/wisata/<?= $row['image'] ?>" alt="">
            <div class="my-auto">
              <h6 style="margin-left: 10px;"><?= $row['nama_wisata'] ?></h6>
            </div>
          </div>
        </td>
        <td><?= $row['nama_kwisata'] ?></td>
        <td><?= $row['nama_fasilitas'] ?></td>
        <td>
          <button type="button" class="btn btn-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#deskripsi<?= $row['id_wisata'] ?>">
            Lihat
          </button>
          <div class="modal fade" id="deskripsi<?= $row['id_wisata'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header border-bottom-0 shadow">
                  <h5 class="modal-title" id="exampleModalLabel">Deskripsi <?= $row['nama_wisata'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <textarea class="form-control border-0" id="message-text" style="height: 300px;">
                    <?= $row['deskripsi'] ?>
                  </textarea>
                </div>
              </div>
            </div>
          </div>
        </td>
        <td><?= $row['alamat'] ?></td>
        <td>
          <div class="badge badge-opacity-success">
            <?php $dateCreate = date_create($row['created_at']);
            echo date_format($dateCreate, "l, d M Y h:i a"); ?>
          </div>
        </td>
        <td>
          <div class="badge badge-opacity-warning">
            <?php $dateUpdate = date_create($row['updated_at']);
            echo date_format($dateUpdate, "l, d M Y h:i a"); ?>
          </div>
        </td>
        <td>
          <a href="galeri?id=<?= $row['id_wisata'] ?>" class="btn btn-info btn-sm rounded-0"><i class="bi bi-eye"></i> Galeri</a>
        </td>
        <td>
          <a href="lokasi?id=<?= $row['id_wisata'] ?>" class="btn btn-info btn-sm rounded-0"><i class="bi bi-eye"></i> Lokasi</a>
        </td>
        <td>
          <a href="edit-wisata?id=<?= $row['id_wisata'] ?>" class="btn btn-warning btn-sm rounded-0"><i class="bi bi-pencil-square"></i></a>
        </td>
        <td>
          <button type="button" class="btn btn-danger btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_wisata'] ?>">
            <i class="bi bi-trash3"></i>
          </button>
          <div class="modal fade" id="hapus<?= $row['id_wisata'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0 shadow">
                  <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $row['nama_wisata'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Anda yakin ingin menghapus wisata <?= $row['nama_wisata'] ?> ini?
                </div>
                <div class="modal-footer justify-content-center border-top-0">
                  <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Batal</button>
                  <form action="" method="POST">
                    <input type="hidden" name="id" value="<?= $row['id_wisata'] ?>">
                    <input type="hidden" name="namaOld" value="<?= $row['nama_wisata'] ?>">
                    <input type="hidden" name="imageOld" value="<?= $row['image'] ?>">
                    <button type="submit" name="hapus-wisata" class="btn btn-danger btn-sm rounded-0">Hapus</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
<?php $no++;
    }
  }
} ?>