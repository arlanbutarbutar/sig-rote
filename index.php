<?php require_once("controller/script.php");
$_SESSION['page-name'] = "";
// $_SESSION['page-url'] = "./";
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

  <!-- Kategori Wisata Start -->
  <div class="container-fluid">
    <div class="container pt-5 pb-3">
      <div class="text-center mb-3 pb-3">
        <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;"></h6>
        <h1>Kategori Wisata</h1>
      </div>
      <div class="row flex-nowrap kategori-wisata">
        <?php if (mysqli_num_rows($kategori_wisata) > 0) {
          while ($row_kw = mysqli_fetch_assoc($kategori_wisata)) { ?>
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="service-item bg-white text-center mb-2 py-5 px-4">
                <i class="fa fa-2x fa-route mx-auto mb-4"></i>
                <h5 class="mb-2"><?= $row_kw['nama_kwisata'] ?></h5>
              </div>
            </div>
        <?php }
        } ?>
      </div>
    </div>
  </div>
  <!-- Kategori Wisata End -->

  <!-- Wisata Start -->
  <div class="container-fluid">
    <div class="container pt-5 pb-3">
      <div class="text-center mb-3 pb-3">
        <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;"></h6>
        <h1>Fasilitas Wisata</h1>
      </div>
      <div class="row">
        <?php if (mysqli_num_rows($fasilitas_wisata) > 0) {
          while ($row_fw = mysqli_fetch_assoc($fasilitas_wisata)) { ?>
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="destination-item position-relative overflow-hidden mb-2">
                <img class="img-fluid" src="assets/images/wisata/<?= $row_fw['image'] ?>" alt="">
                <a class="destination-overlay text-white text-decoration-none">
                  <h5 class="text-white"><?= $row_fw['nama_fasilitas'] ?></h5>
                </a>
              </div>
            </div>
          <?php }
        }
        if (mysqli_num_rows($fasilitas_wisata) > 9) { ?>
          <a href="fasilitas" class="btn btn-primary btn-sm py-md-3 px-md-5 mt-2 mx-auto">Fasilitas Lain</a>
        <?php } ?>
      </div>
    </div>
  </div>
  <!-- Wisata Start -->

  <!-- Blog Start -->
  <div class="container-fluid py-5">
    <div class="container pt-5 pb-3">
      <div class="text-center mb-3 pb-3">
        <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Tujuan</h6>
        <h1>Jelajahi Destinasi Teratas</h1>
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
        }
        if (mysqli_num_rows($fasilitas_wisata) > 9) { ?>
          <a href="wisata" class="btn btn-primary btn-sm py-md-3 px-md-5 mt-2 mx-auto">Wisata Lain</a>
        <?php } ?>
      </div>
    </div>
  </div>
  <!-- Blog End -->

  <!-- Maps Start -->
  <div id="map" style="width: 100%; height: 500px;"></div>
  <!-- Maps End -->

  <!-- Footer Start -->
  <?php require_once("resources/footer.php"); ?>
  <script>
    (function() {
      function scrollH(e) {
        e.preventDefault();
        e = window.event || e;
        let delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
        document.querySelector('.kategori-wisata').scrollLeft -= (delta * 40);
      }
      if (document.querySelector('.kategori-wisata').addEventListener) {
        document.querySelector('.kategori-wisata').addEventListener('mousewheel', scrollH, false);
        document.querySelector('.kategori-wisata').addEventListener('DOMMouseScroll', scrollH, false);
      }
    })();
  </script>
  <script>
    var map = L.map('map').setView([-10.7329607, 123.111856], 12);
    var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

    <?php if (mysqli_num_rows($select_locationMaps) > 0) {
      while ($row = mysqli_fetch_assoc($select_locationMaps)) {
        $image = $row['image'];
        $nama = $row['nama_wisata'];
        $deskripsi = $row['deskripsi'];
        $url = "wisata?tujuan=" . $row['nama_wisata'];
        $url = str_replace(" ", "-", $url);
    ?>
        L.marker([<?= $row['latitude'] ?>, <?= $row['longitude'] ?>]).bindPopup("<div><img src='assets/images/wisata/<?= $image ?>' style='width: 100%;' alt=''><h4 style='margin-top: 5px;'><a href='<?= $url ?> '><?= $nama ?></a></h4><p style='margin-top: -5px;'><?= $deskripsi ?></p><small style='letter-spacing: 0;'><?= $row['alamat'] ?></small></div>").addTo(map);
    <?php }
    } ?>
  </script>
  <!-- Footer End -->
</body>

</html>