<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION['page-name'] = "Kategori Wisata";
$_SESSION['page-url'] = "kategori-wisata";
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
                      <a href="#" class="btn btn-primary text-white me-0 btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#tambah-kategori">Tambah</a>
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
                          <th scope="col" colspan="4">Aksi</th>
                        </tr>
                      </thead>
                      <tbody id="search-page">
                        <?php if (mysqli_num_rows($kwisata) == 0) { ?>
                          <tr>
                            <th scope="row" colspan="6">belum ada data kategori</th>
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
                                            <input type="text" name="nama" value="<?= $row['nama_kwisata']?>" class="form-control" id="nama-kwisata" placeholder="Nama Kategori Wisata" required>
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
                        } ?>
                      </tbody>
                    </table>
                    <?php if ($total_role3 > $data_role3) { ?>
                      <div class="d-flex justify-content-between mt-4 flex-wrap">
                        <p class="text-muted">Showing 1 to <?= $data_role3 ?> of <?= $total_role3 ?> entries</p>
                        <nav class="ml-auto">
                          <ul class="pagination separated pagination-info">
                            <?php if (isset($page_role3)) {
                              if (isset($total_page_role3)) {
                                if ($page_role3 > 1) : ?>
                                  <li class="page-item">
                                    <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role3 - 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="bi bi-arrow-bar-left text-white"></i></a>
                                  </li>
                                  <?php endif;
                                for ($i = 1; $i <= $total_page_role3; $i++) : if ($i <= 4) : if ($i == $page_role3) : ?>
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
                                if ($total_page_role3 >= 4) : ?>
                                  <li class="page-item">
                                    <a href="<?= $_SESSION['page-url'] ?>?page=<?php if ($page_role3 > 4) {
                                                                                  echo $page_role3;
                                                                                } else if ($page_role3 <= 4) {
                                                                                  echo '5';
                                                                                } ?>/" class="btn btn-<?php if ($page_role3 <= 4) {
                                                                                                        echo 'outline-';
                                                                                                      } ?>primary btn-sm rounded-0"><?php if ($page_role3 > 4) {
                                                                                                                                      echo $page_role3;
                                                                                                                                    } else if ($page_role3 <= 4) {
                                                                                                                                      echo '5';
                                                                                                                                    } ?></a>
                                  </li>
                                <?php endif;
                                if ($page_role3 < $total_page_role3 && $total_page_role3 >= 4) : ?>
                                  <li class="page-item">
                                    <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role3 + 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="bi bi-arrow-bar-right"></i></a>
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

        <div class="modal fade" id="tambah-kategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header border-bottom-0 shadow">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori Wisata</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="" method="post" name="random_form">
                <div class="modal-body text-center">
                  <div class="mb-3">
                    <label for="nama-kwisata" class="form-label">Nama Kategori Wisata</label>
                    <input type="text" name="nama" class="form-control" id="nama-kwisata" placeholder="Nama Kategori Wisata" required>
                  </div>
                </div>
                <div class="modal-footer border-top-0 justify-content-center">
                  <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" name="tambah-kwisata" class="btn btn-primary btn-sm rounded-0">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>