<?php require_once("controller/script.php");
$_SESSION['page-name'] = "Tentang";
$_SESSION['page-url'] = "tentang";
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
        <h3 class="display-4 text-white text-uppercase">Tentang Wisata Rote Ndao</h3>
        <div class="d-inline-flex text-white">
          <p class="m-0 text-uppercase"><a class="text-white" href="./">Home</a></p>
          <i class="fa fa-angle-double-right pt-1 px-3"></i>
          <p class="m-0 text-uppercase">Tentang Wisata Rote Ndao</p>
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
            <img class="position-absolute w-100" src="assets/images/data-pariwisata.jpg" style="object-fit: cover;">
          </div>
        </div>
        <div class="col-lg-6 pt-5 pb-lg-5">
          <div class="about-text bg-white p-4 p-lg-5 my-lg-5">
            <h6 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">Profil</h6>
            <h1 class="mb-3">Dinas Pariwisata Rote Ndao</h1>
            <h4 class="mb-3 text-center">Struktur Organisasi</h4>
            <style>
              .so-zoom {
                transform: none;
                transition: 0.25s ease-in-out;
              }

              .so-zoom:hover {
                transform: scale(2);
                margin-left: -220px;
                z-index: 9999;
              }
            </style>
            <img class="so-zoom" src="assets/images/struktur-organisasi.jpg" style="width: 100%;" alt="Struktur Organisasi">
            <h6>Visi</h6>
            <p class="text-justify">Terwujudnya masyarakat Rote Ndao yang bermartabat dan berkelanjutan bertumpu pada pariwisata yang didukung oleh pertanian dan perikanan.</p>
            <h6>Misi</h6>
            <ol>
              <li>
                <p class="text-justify">Meningkatkan kualitas sumber daya manusia yang berdaya saing.</p>
              </li>
              <li>
                <p class="text-justify">Meningkatkan pertumbuhan ekonomi dan kesejahteraan masyarakat melalui sektoe pariwisata yang didukung oleh pertanian dan perikanan.</p>
              </li>
              <li>
                <p class="text-justify">Meningkatkan kualitas dan kuantitas pembangunan infastruktur, penataan ruang dan lingkungan hidup yang berkelanjutan.</p>
              </li>
              <li>
                <p class="text-justify">Mewujudkan tata kelola pemerintah yang baik dan bersih serta menigkatkan pelayanan publik dan prima.</p>
              </li>
            </ol>
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