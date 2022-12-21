<?php require_once("controller/script.php");
$_SESSION['page-name'] = "";
$_SESSION['page-url'] = "./";
?>

<!DOCTYPE html>
<html lang="en">

<head><?php require_once("resources/header.php"); ?></head>

<body>
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
  <!-- Topbar Start -->
  <?php require_once("resources/topbar.php"); ?>
  <!-- Topbar End -->

  <!-- Navbar Start -->
  <?php require_once("resources/navbar.php"); ?>
  <!-- Navbar End -->

  <!-- Carousel Start -->
  <div class="container-fluid p-0">
    <div id="header-carousel" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="w-100" src="assets/images/carousel-1.jpg" alt="Image">
          <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
            <div class="p-3" style="max-width: 900px;">
              <h4 class="text-white text-uppercase mb-md-3">Selamat datang di</h4>
              <h1 class="display-3 text-white mb-md-4">Dinas Pariwisata Rote Ndao</h1>
              <a href="wisata" class="btn btn-primary py-md-3 px-md-5 mt-2">Lihat Wisata</a>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <img class="w-100" src="assets/images/carousel-2.jpg" alt="Image">
          <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
            <div class="p-3" style="max-width: 900px;">
              <h4 class="text-white text-uppercase mb-md-3">Selamat datang di</h4>
              <h1 class="display-3 text-white mb-md-4">Dinas Pariwisata Rote Ndao</h1>
              <a href="wisata" class="btn btn-primary py-md-3 px-md-5 mt-2">Lihat Wisata</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Carousel End -->

  <!-- Booking Start -->
  <div class="container-fluid booking mt-5 pb-5">
    <div class="container pb-5">
      <div class="bg-light shadow" style="padding: 30px;">
        <form action="tujuan-wisata.php" method="post">
          <div class="row align-items-center" style="min-height: 60px;">
            <div class="col-md-10">
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3 mb-md-0">
                    <div class="date" id="date1">
                      <label for="lokasi-saya">Lokasi Saya</label>
                      <?php
                      $ip = $_SERVER['REMOTE_ADDR'];
                      $geolocation_json = json_decode(file_get_contents("https://ipinfo.io/{$ip}/json"));
                      ?>
                      <input type="hidden" name="loc" value="<?= $geolocation_json->loc; ?>" />
                      <input type="text" id="lokasi-saya" class="form-control p-4" value="<?= $geolocation_json->city . ", " . $geolocation_json->region . ", " . $geolocation_json->country; ?>" placeholder="Lokasi Saya" readonly />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3 mb-md-0">
                    <label for="tujuan-wisata">Tujuan Wisata</label>
                    <select name="id-wisata" class="custom-select px-4" style="height: 47px;" required>
                      <option selected value="">Pilih Tujuan Wisata</option>
                      <?php foreach ($select_wisata as $row_sw) : ?>
                        <option value="<?= $row_sw['id_wisata'] ?>"><?= $row_sw['nama_wisata'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-2">
              <button class="btn btn-primary btn-block" type="submit" style="height: 47px; margin-top: -2px;">Cari</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Booking End -->

  <!-- Registration Start -->
  <!-- style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(assets/images/data-pengunjung.png), no-repeat center center;background-size: cover;object-fit: cover;" -->
  <div class="container-fluid">
    <div class="container py-5">
      <div class="row align-items-center">
        <div class="col-md-12 mb-5 mb-lg-0">
          <div class="mb-4">
            <h1 class="text-dark text-center mt-5"><span>Data Kunjungan Wisatawan</span> Mancanegara Dan Nusantara Tahun 2017-2021</h1>
          </div>
        </div>
        <div class="col-md-12">
          <div class="card border-0">
            <div class="card-body rounded-bottom bg-white p-5 data-pengunjung" style="overflow-x: auto;">
              <?php require_once("dataTable-pengunjung.php") ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Registration End -->

  <!-- Blog Start -->
  <div class="container-fluid py-5">
    <div class="container pt-5 pb-3">
      <div class="text-center mb-3 pb-3">
        <h1>Tempat Wisata</h1>
      </div>
      <div class="row pb-3">
        <?php if (mysqli_num_rows($tujuan_wisata) > 0) {
          while ($row_tw = mysqli_fetch_assoc($tujuan_wisata)) { ?>
            <div class="col-lg-4 col-md-6 mb-4 pb-2">
              <div class="blog-item">
                <div class="position-relative">
                  <img class="img-fluid w-100" src="assets/images/wisata/<?= $row_tw['image'] ?>" alt="" style="object-fit: cover;">
                  <div class="blog-date">
                    <h6 class="font-weight-bold mb-n1">01</h6>
                    <small class="text-white text-uppercase"></small>
                  </div>
                </div>
                <div class="bg-white p-4">
                  <div class="d-flex mb-2">
                    <?php $url_tkw = "wisata?kategori-wisata=" . $row_tw['nama_kwisata'];
                    $url_tkw = str_replace(" ", "-", $url_tkw); ?>
                    <a class="text-primary text-uppercase text-decoration-none" href="<?= $url_tkw ?>"><?= $row_tw['nama_kwisata'] ?></a>
                  </div>
                  <?php $url_tw = "wisata?tujuan=" . $row_tw['nama_wisata'];
                  $url_tw = str_replace(" ", "-", $url_tw); ?>
                  <a class="h5 m-0 text-decoration-none" href="<?= $url_tw ?>"><?= $row_tw['nama_wisata'] ?></a>
                </div>
              </div>
            </div>
        <?php }
        } ?>
      </div>
      <div class="row">
        <div class="col-md-12 text-center justify-content-center">
          <?php if (mysqli_num_rows($fasilitas_wisata) > 9) { ?>
            <a href="wisata" class="btn btn-primary btn-sm py-md-3 px-md-5 mt-2">Wisata Lain</a>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
  <!-- Blog End -->

  <!-- Footer Start -->
  <?php require_once("resources/footer.php"); ?>
  <script>
    (function() {
      function scrollH(e) {
        e.preventDefault();
        e = window.event || e;
        let delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
        document.querySelector('.data-pengunjung').scrollLeft -= (delta * 40);
      }
      if (document.querySelector('.data-pengunjung').addEventListener) {
        document.querySelector('.data-pengunjung').addEventListener('mousewheel', scrollH, false);
        document.querySelector('.data-pengunjung').addEventListener('DOMMouseScroll', scrollH, false);
      }
    })();
  </script>
  <!-- Footer End -->
</body>

</html>