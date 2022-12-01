<?php require_once("controller/script.php");
$_SESSION['page-name'] = "Penduduk";
$_SESSION['page-url'] = "penduduk";
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
  <div class="container-fluid page-header" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(assets/images/penduduk.jpg), no-repeat center center;background-size: cover;">
    <div class="container">
      <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px;">
        <h3 class="display-4 text-white text-uppercase">Penduduk</h3>
        <div class="d-inline-flex text-white">
          <p class="m-0 text-uppercase"><a class="text-white" href="./">Home</a></p>
          <i class="fa fa-angle-double-right pt-1 px-3"></i>
          <p class="m-0 text-uppercase">Penduduk</p>
        </div>
      </div>
    </div>
  </div>
  <!-- Carousel End -->

  <!-- Penduduk Start -->
  <div class="container-fluid py-5" id="data">
    <div class="container pt-5">
      <div class="row">
        <div class="col-lg-6" style="min-height: 500px;">
          <div class="position-relative h-100">
            <img class="position-absolute w-100" src="assets/images/datapenduduk.jpg" style="object-fit: cover;">
          </div>
        </div>
        <div class="col-lg-6 pt-5 pb-lg-5">
          <div class="about-text bg-white p-4 p-lg-5 my-lg-5">
            <h6 class="text-white text-uppercase" style="letter-spacing: 5px;">Profil</h6>
            <h1 class="mb-3">Penduduk</h1>
            <table class="table table-striped table-borderless table-sm">
              <tbody>
                <tr>
                  <th scope="row">Provinsi</th>
                  <td>Nusa Tenggara Timur</td>
                </tr>
                <tr>
                  <th scope="row">Kabupaten/Kota</th>
                  <td>Rote Ndao</td>
                </tr>
                <tr>
                  <th scope="row">Jumlah Kecamatan</th>
                  <td>11</td>
                </tr>
                <tr>
                  <th scope="row">Jumlah Desa</th>
                  <td>112</td>
                </tr>
                <tr>
                  <th scope="row">Jumlah Kelurahan</th>
                  <td>7</td>
                </tr>
                <tr>
                  <th scope="row">Jumlah Penduduk</th>
                  <td>149.317</td>
                </tr>
                <tr>
                  <th scope="row">Jumlah KK</th>
                  <td>40.347</td>
                </tr>
                <tr>
                  <th scope="row">Perpindahan Penduduk</th>
                  <td>688</td>
                </tr>
                <tr>
                  <th scope="row">Laki-Laki</th>
                  <td>75.151</td>
                </tr>
                <tr>
                  <th scope="row">Perempuan</th>
                  <td>74.166</td>
                </tr>
                <tr>
                  <th scope="row">Belum Kawin</th>
                  <td>84.177</td>
                </tr>
                <tr>
                  <th scope="row">Kawin</th>
                  <td>59.274</td>
                </tr>
                <tr>
                  <th scope="row">Pertumbuhan Penduduk thn 2022 (%)</th>
                  <td>0,00</td>
                </tr>
                <tr>
                  <th scope="row">Belum Sekolah</th>
                  <td>32.540</td>
                </tr>
                <tr>
                  <th scope="row">Belum Tamat SD</th>
                  <td>22.284</td>
                </tr>
                <tr>
                  <th scope="row">Tamat SD</th>
                  <td>40.438</td>
                </tr>
                <tr>
                  <th scope="row">SLTP</th>
                  <td>16.706</td>
                </tr>
                <tr>
                  <th scope="row">SLTA</th>
                  <td>30.152</td>
                </tr>
                <tr>
                  <th scope="row">D1 dan D2</th>
                  <td>345</td>
                </tr>
                <tr>
                  <th scope="row">D3</th>
                  <td>1.179</td>
                </tr>
                <tr>
                  <th scope="row">S1</th>
                  <td>5.563</td>
                </tr>
                <tr>
                  <th scope="row">S2</th>
                  <td>105</td>
                </tr>
                <tr>
                  <th scope="row">S3</th>
                  <td>5</td>
                </tr>
              </tbody>
            </table>
            <small>Data diambil dari <a href="https://gis.dukcapil.kemendagri.go.id/peta/?marker=123.07856935304056%2C-10.744832201163561%2C&markertemplate=%7B%22title%22%3A%22NUSA%20TENGGARA%20TIMUR%22%2C%22longitude%22%3A123.07856935304056%2C%22latitude%22%3A-10.744832201163561%2C%22isIncludeShareUrl%22%3Atrue%7D&level=10" target="_blank">https://gis.dukcapil.kemendagri.go.id/</a></small>
            <!-- <a href="https://gis.dukcapil.kemendagri.go.id/peta/?marker=123.07856935304056%2C-10.744832201163561%2C&markertemplate=%7B%22title%22%3A%22NUSA%20TENGGARA%20TIMUR%22%2C%22longitude%22%3A123.07856935304056%2C%22latitude%22%3A-10.744832201163561%2C%22isIncludeShareUrl%22%3Atrue%7D&level=10" class="btn btn-primary mt-4 btn-sm" target="_blank">Data GIS Dukcapil</a> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Penduduk End -->

  <!-- Footer Start -->
  <?php require_once("resources/footer.php"); ?>
  <!-- Footer End -->
</body>

</html>