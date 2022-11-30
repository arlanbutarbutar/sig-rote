<?php require_once("controller/script.php");
$_SESSION['page-name'] = "Pengunjung";
$_SESSION['page-url'] = "pengunjung";
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
  <div class="container-fluid page-header" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(assets/images/pengunjung.jpg), no-repeat center center;background-size: cover;">
    <div class="container">
      <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px;">
        <h3 class="display-4 text-white text-uppercase">Pengunjung</h3>
        <div class="d-inline-flex text-white">
          <p class="m-0 text-uppercase"><a class="text-white" href="./">Home</a></p>
          <i class="fa fa-angle-double-right pt-1 px-3"></i>
          <p class="m-0 text-uppercase">Pengunjung</p>
        </div>
      </div>
    </div>
  </div>
  <!-- Carousel End -->

  <!-- Registration Start -->
  <div class="container-fluid" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(assets/images/data-pengunjung.png), no-repeat center center;background-size: cover;object-fit: cover;">
    <div class="container py-5">
      <div class="row align-items-center">
        <div class="col-lg-4 mb-5 mb-lg-0">
          <div class="mb-4">
            <h6 class="text-white text-uppercase" style="letter-spacing: 5px;">Rote Ndao</h6>
            <h1 class="text-white"><span class="text-white">Data Kunjungan Wisatawan</span> Mancanegara Dan Nusantara Tahun 2017-2021</h1>
          </div>
        </div>
        <div class="col-lg-8">
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