<?php require_once("../controller/script.php");
require_once("redirect.php");

if (!isset($_GET['id'])) {
  header("Location: wisata");
  exit();
} else if (isset($_GET['id'])) {
  $id = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['id']))));
  $result_loc = mysqli_query($conn, "SELECT * FROM wisata WHERE id_wisata='$id'");
  $row = mysqli_fetch_assoc($result_loc);
  $_SESSION['page-name'] = "Galeri " . $row['nama_wisata'];
  $_SESSION['page-url'] = "galeri?id=" . $_GET['id'];
}
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
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-lg-4">
              <div class="card rounded-0 shadow">
                <div class="card-body text-center">
                  <h4>Tambah Photo</h4>
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3 mt-3">
                      <label for="image" class="form-label">Upload Photo</label>
                      <input type="file" name="image" id="image" class="form-control" required>
                    </div>
                    <input type="hidden" name="id" value="<?= $row['id_wisata'] ?>">
                    <input type="hidden" name="namaOld" value="<?= $row['nama_wisata'] ?>">
                    <button type="submit" name="tambah-galeri" class="btn btn-primary rounded-0 btn-sm">Upload</button>
                  </form>
                </div>
              </div>
            </div>
            <?php $id_wisata = $row['id_wisata'];
            $galeri = mysqli_query($conn, "SELECT * FROM galeri WHERE id_wisata='$id_wisata'");
            if (mysqli_num_rows($galeri) > 0) {
              while ($row_gw = mysqli_fetch_assoc($galeri)) { ?>
                <div class="col-lg-4">
                  <img src="../assets/images/wisata/album/<?= $row_gw['image_gwisata'] ?>" class="img-thumbnail shadow rounded-0" alt="..." data-bs-toggle="modal" data-bs-target="#image<?= $row_gw['id_galeri'] ?>" style="cursor: pointer;">
                  <div class="modal fade" id="image<?= $row_gw['id_galeri'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0">
                          <h5 class="modal-title" id="exampleModalLabel"></h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                          <img src="../assets/images/wisata/album/<?= $row_gw['image_gwisata'] ?>" style="width: 100%;" class="img-thumbnail" alt="">
                        </div>
                        <div class="modal-footer justify-content-center border-top-0">
                          <form action="" method="post">
                            <input type="hidden" name="id" value="<?= $row_gw['id_galeri'] ?>">
                            <input type="hidden" name="namaOld" value="<?= $row['nama_wisata'] ?>">
                            <input type="hidden" name="imageOld" value="<?= $row_gw['image_gwisata'] ?>">
                            <button type="submit" name="hapus-galeri" class="btn btn-danger rounded-0 btn-sm">Hapus</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            <?php }
            } ?>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>