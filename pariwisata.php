<?php require_once("controller/script.php");
$_SESSION['page-name'] = "Pariwisata";
$_SESSION['page-url'] = "pariwisata";
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
        <h3 class="display-4 text-white text-uppercase">Pariwisata</h3>
        <div class="d-inline-flex text-white">
          <p class="m-0 text-uppercase"><a class="text-white" href="./">Home</a></p>
          <i class="fa fa-angle-double-right pt-1 px-3"></i>
          <p class="m-0 text-uppercase">Pariwisata</p>
        </div>
      </div>
    </div>
  </div>
  <!-- Carousel End -->

  <!-- Pariwisata Start -->
  <div class="container-fluid py-5" id="data">
    <div class="container pt-5">
      <div class="row">
        <div class="col-lg-6" style="min-height: 500px;">
          <div class="position-relative h-100">
            <img class="position-absolute w-100 h-100" src="assets/images/data-pariwisata.jpg" style="object-fit: cover;">
          </div>
        </div>
        <div class="col-lg-6 pt-5 pb-lg-5">
          <div class="about-text bg-white p-4 p-lg-5 my-lg-5">
            <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Profil</h6>
            <h1 class="mb-3">Pariwisata</h1>
            <p>Visi, misi Kepala Daerah dan Wakil Kepala Daerah Terpilih tahun 2019-2024 adalah Terwujudnya Masyarakat Rote Ndao yang BERMARTABAT secara Berkelanjutan Bertumpu Pada Pariwisata yang di dukung oleh Pertanian dan Perikanan. Adanya potensi yang dimiliki oleh Kabupaten Rote Ndao, tidak menutup kemungkinan dapat berkembangnya berbagai sentra kerajinan rakyat, terutama yang potensial dapat dijual untuk industri pariwisata, misalnya dengan menjual atraksi metode pembuatan kerajinan dari daun lontar, kain tenun khas Rote Ndao, kerang-kerang laut, dan lain sebagainya, sehingga menarik perhatian wisatawan. Pembangunan gedung serbaguna untuk kegiatan pameran bagi produk kerajinan maupun kegiatan seni dan budaya, akan membuat masyarakat umum dan wisatawan mengenal kerajinan dan budaya yang ada di Kabupaten Rote Ndao.</p>
            <div class="row mb-4">
              <div class="col-lg-6">
                <a href="fasilitas" class="text-decoration-none">
                  <div class="d-flex mb-4 mb-lg-0">
                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="height: 100px; width: 100px;">
                      <i class="fas fa-2x fa-stream text-white"></i>
                    </div>
                    <div class="d-flex flex-column">
                      <h5 class="">Fasilitas</h5>
                      <h2 class="m-0"><?= $count_fasilitas ?></h2>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-lg-6">
                <a href="wisata" class="text-decoration-none">
                  <div class="d-flex mb-4 mb-lg-0">
                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="height: 100px; width: 100px;">
                      <i class="fas fa-2x fa-stream text-white"></i>
                    </div>
                    <div class="d-flex flex-column">
                      <h5 class="">Wisata</h5>
                      <h2 class="m-0"><?= $count_wisata ?></h2>
                    </div>
                  </div>
                </a>
              </div>
            </div>
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