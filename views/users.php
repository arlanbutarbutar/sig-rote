<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION['page-name'] = "Kelola Pengguna";
$_SESSION['page-url'] = "users";
?>

<!DOCTYPE html>
<html lang="en">

<head><?php require_once("../resources/dash-header.php") ?></head>

<body style="font-family: 'Montserrat', sans-serif;">
  <?php if (isset($_SESSION['message-success'])) { ?>
    <div class="message-success" data-message-success="<?= $_SESSION['message-success'] ?>"></div>
  <?php }
  if (isset($_SESSION['message-info'])) { ?>
    <div class="message-info" data-message-info="<?= $_SESSION['message-info'] ?>"></div>
  <?php }
  if (isset($_SESSION['message-warning'])) { ?>
    <div class="message-warning" data-message-warning="<?= $_SESSION['message-warning'] ?>"></div>
  <?php }
  if (isset($_SESSION['message-danger'])) { ?>
    <div class="message-danger" data-message-danger="<?= $_SESSION['message-danger'] ?>"></div>
  <?php } ?>
  <div class="container-scroller">
    <?php require_once("../resources/dash-topbar.php") ?>
    <div class="container-fluid page-body-wrapper">
      <?php require_once("../resources/dash-sidebar.php") ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <h3><?= $_SESSION['page-name'] ?></h3>
                    </li>
                  </ul>
                  <div>
                    <div class="btn-wrapper">
                      <a href="#" class="btn btn-primary text-white me-0 btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#tambah-pengguna">Tambah</a>
                    </div>
                  </div>
                </div>
                <div class="card rounded-0 mt-3">
                  <div class="card-body table-responsive">
                    <table class="table table-striped table-hover table-borderless table-sm text-center">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nama</th>
                          <th scope="col">Email</th>
                          <th scope="col">Tgl Buat</th>
                          <th scope="col">Tgl Ubah</th>
                          <th scope="col" colspan="2">Aksi</th>
                        </tr>
                      </thead>
                      <tbody id="search-page">
                        <?php if (mysqli_num_rows($users) == 0) { ?>
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
                                <button type="button" class="btn btn-warning btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_user'] ?>">
                                  <i class="bi bi-pencil-square"></i>
                                </button>
                                <div class="modal fade" id="ubah<?= $row['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0 shadow">
                                        <h5 class="modal-title" id="exampleModalLabel">Ubah data <?= $row['username'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="" method="POST">
                                        <div class="modal-body">
                                          <div class="mb-3">
                                            <label for="username" class="form-label">Nama <small class="text-danger">*</small></label>
                                            <input type="text" name="username" value="<?= $row['username'] ?>" class="form-control" id="username" minlength="3" placeholder="Nama" required>
                                          </div>
                                          <div class="mb-3">
                                            <label for="email" class="form-label">Email <small class="text-danger">*</small></label>
                                            <input type="email" name="email" value="<?= $row['email'] ?>" class="form-control" id="email" placeholder="Email" required>
                                          </div>
                                        </div>
                                        <div class="modal-footer justify-content-center border-top-0">
                                          <input type="hidden" name="id-user" value="<?= $row['id_user'] ?>">
                                          <input type="hidden" name="usernameOld" value="<?= $row['username'] ?>">
                                          <input type="hidden" name="emailOld" value="<?= $row['email'] ?>">
                                          <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Batal</button>
                                          <button type="submit" name="ubah-user" class="btn btn-warning btn-sm rounded-0">Ubah</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <button type="button" class="btn btn-danger btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_user'] ?>">
                                  <i class="bi bi-trash3"></i>
                                </button>
                                <div class="modal fade" id="hapus<?= $row['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        } ?>
                      </tbody>
                    </table>
                    <?php if ($total_role1 > $data_role1) { ?>
                      <div class="d-flex justify-content-between mt-4 flex-wrap">
                        <p class="text-muted">Showing 1 to <?= $data_role1 ?> of <?= $total_role1 ?> entries</p>
                        <nav class="ml-auto">
                          <ul class="pagination separated pagination-info">
                            <?php if (isset($page_role1)) {
                              if (isset($total_page_role1)) {
                                if ($page_role1 > 1) : ?>
                                  <li class="page-item">
                                    <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role1 - 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="bi bi-arrow-bar-left text-white"></i></a>
                                  </li>
                                  <?php endif;
                                for ($i = 1; $i <= $total_page_role1; $i++) : if ($i <= 4) : if ($i == $page_role1) : ?>
                                      <li class="page-item active">
                                        <a href="<?= $_SESSION['page-url'] ?>?page=<?= $i; ?>/" class="btn btn-primary btn-sm rounded-0 text-white"><?= $i; ?></a>
                                      </li>
                                    <?php else : ?>
                                      <li class="page-item">
                                        <a href="<?= $_SESSION['page-url'] ?>?page=<?= $i; ?>/" class="btn btn-outline-primary btn-sm rounded-0"><?= $i ?></a>
                                      </li>
                                  <?php endif;
                                  endif;
                                endfor;
                                if ($total_page_role1 >= 4) : ?>
                                  <li class="page-item">
                                    <a href="<?= $_SESSION['page-url'] ?>?page=<?php if ($page_role1 > 4) {
                                                                                  echo $page_role1;
                                                                                } else if ($page_role1 <= 4) {
                                                                                  echo '5';
                                                                                } ?>/" class="btn btn-<?php if ($page_role1 <= 4) {
                                                                                                        echo 'outline-';
                                                                                                      } ?>primary btn-sm rounded-0"><?php if ($page_role1 > 4) {
                                                                                                                                      echo $page_role1;
                                                                                                                                    } else if ($page_role1 <= 4) {
                                                                                                                                      echo '5';
                                                                                                                                    } ?></a>
                                  </li>
                                <?php endif;
                                if ($page_role1 < $total_page_role1 && $total_page_role1 >= 4) : ?>
                                  <li class="page-item">
                                    <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role1 + 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="bi bi-arrow-bar-right"></i></a>
                                  </li>
                            <?php endif;
                              }
                            } ?>
                          </ul>
                        </nav>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="tambah-pengguna" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header border-bottom-0 shadow">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="" method="post" name="random_form">
                <div class="modal-body text-center">
                  <div class="mb-3">
                    <label for="username" class="form-label">Nama <small class="text-danger">*</small></label>
                    <input type="text" name="username" class="form-control" id="username" minlength="3" placeholder="Nama" required>
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email <small class="text-danger">*</small></label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label">Password <small class="text-danger">*</small></label>
                    <input type="text" name="password" class="form-control" id="kata-sandi" minlength="8" placeholder="Password" required>
                    <input type="button" value="Generate Password" class="btn btn-link btn-sm text-decoration-none" onclick="random_all();">
                  </div>
                </div>
                <div class="modal-footer border-top-0 justify-content-center">
                  <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" name="tambah-user" class="btn btn-primary btn-sm rounded-0">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
        <script type="text/javascript">
          function random_all() {
            var campur = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
            var panjang = 9;
            var random_all = '';
            for (var i = 0; i < panjang; i++) {
              var hasil = Math.floor(Math.random() * campur.length);
              random_all += campur.substring(hasil, hasil + 1);
            }
            document.random_form.password.value = random_all;
          }
        </script>
</body>

</html>