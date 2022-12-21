<?php require_once("controller/script.php");
$_SESSION['page-name'] = "Galeri";
$_SESSION['page-url'] = "galeri";
?>

<!DOCTYPE html>
<html lang="en">

<head><?php require_once("resources/header.php"); ?></head>

<body>
  <!-- Topbar Start -->
  <?php require_once("resources/topbar.php"); ?>
  <!-- Topbar End -->

  <!-- Navbar Start -->
  <?php require_once("resources/navbar.php"); ?>
  <!-- Navbar End -->

  <!-- Carousel Start -->
  <div class="container-fluid page-header" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(assets/images/pariwisata.jpg), no-repeat center center;background-size: cover;">
    <div class="container">
      <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px;">
        <h3 class="display-4 text-white text-uppercase">Galeri</h3>
        <div class="d-inline-flex text-white">
          <p class="m-0 text-uppercase"><a class="text-white" href="./">Home</a></p>
          <i class="fa fa-angle-double-right pt-1 px-3"></i>
          <p class="m-0 text-uppercase">Galeri</p>
        </div>
      </div>
    </div>
  </div>
  <!-- Carousel End -->

  <!-- Pariwisata Start -->
  <div class="container-fluid py-5" id="data">
    <div class="container pt-5">
      <div class="row">
        <div class="col-md-12">
          <div class="d-flex flex-wrap">
            <?php $takeImage = mysqli_query($conn, "SELECT * FROM galeri JOIN wisata ON galeri.id_wisata=wisata.id_wisata");
            if (mysqli_num_rows($takeImage) > 0) {
              while ($row_tg = mysqli_fetch_assoc($takeImage)) { ?>
                <img src="assets/images/wisata/album/<?= $row_tg['image_gwisata'] ?>" class="img-thumbnail m-1" style="width: 260px;cursor: pointer;" alt="" data-toggle="modal" data-target="#view-image<?= $row_tg['id_galeri'] ?>">
                <div class="modal fade" id="view-image<?= $row_tg['id_galeri'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header border-bottom-0">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <img src="assets/images/wisata/album/<?= $row_tg['image_gwisata'] ?>" class="img-thumbnail m-1" style="width: 100%;">
                        <h5 class="ml-3 mt-3"><?= $row_tg['nama_wisata'] ?></h5>
                        <p class="ml-3"><?= $row_tg['deskripsi'] ?></p>
                      </div>
                    </div>
                  </div>
                </div>
            <?php }
            } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Pariwisata End -->

  <!-- Footer Start -->
  <?php require_once("resources/footer.php"); ?>
  <!-- Footer End -->
</body>

</html>