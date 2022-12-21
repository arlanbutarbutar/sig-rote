<?php require_once("controller/script.php");
$_SESSION['page-name'] = "Peta";
$_SESSION['page-url'] = "peta";
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
        <h3 class="display-4 text-white text-uppercase">Peta</h3>
        <div class="d-inline-flex text-white">
          <p class="m-0 text-uppercase"><a class="text-white" href="./">Home</a></p>
          <i class="fa fa-angle-double-right pt-1 px-3"></i>
          <p class="m-0 text-uppercase">Peta</p>
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
          <div id="map" style="width: 100%; height: 500px;"></div>
        </div>
      </div>
      <div class="row mt-5" id="lokasi">
        <div class="col-md-12">
          <h1 class="text-center mt-5">Lokasi</h1>
          <div class="table-responsive">
            <table class="table table-striped table-hover table-sm mb-5 text-center">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama Wisata</th>
                  <th scope="col">Alamat</th>
                  <th scope="col">Kategori</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                if (mysqli_num_rows($lokasi_wisata) == 0) { ?>
                  <tr>
                    <th scope="row" colspan="4">belum ada data lokasi</th>
                  </tr>
                  <?php } else if (mysqli_num_rows($lokasi_wisata) > 0) {
                  while ($data_lokasi = mysqli_fetch_assoc($lokasi_wisata)) { ?>
                    <tr>
                      <th scope="row"><?= $no; ?></th>
                      <td><?= $data_lokasi['nama_wisata'] ?></td>
                      <td><?= $data_lokasi['alamat'] ?></td>
                      <td><?= $data_lokasi['nama_kwisata'] ?></td>
                    </tr>
                <?php $no++;
                  }
                } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Pariwisata End -->

  <!-- Footer Start -->
  <?php require_once("resources/footer.php"); ?>
  <script>
    var map = L.map('map').setView([-10.738853, 123.108472], 11.5);
    var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

    var myIcon = L.icon({
      iconUrl: 'assets/images/loc.png',
      iconSize: [38, 40],
    })

    <?php if (mysqli_num_rows($peta_wisata) > 0) {
      while ($row_w = mysqli_fetch_assoc($peta_wisata)) {
        $num_char = 100;
        $text = trim($row_w['deskripsi']);
        $text = preg_replace('#</?strong.*?>#is', '', $text);
        $deskripsi = substr($text, 0, $num_char) . '...';
    ?>
        L.marker([<?= $row_w['latitude'] ?>, <?= $row_w['longitude'] ?>], {
          icon: myIcon
        }).bindPopup("<div><img src='assets/images/wisata/<?= $row_w['image'] ?>' style='width: 250px;' alt=''><h4 style='margin-top: 5px;'><a><?= $row_w['nama_wisata'] ?></a></h4><p style='margin-top: -5px;'><?= $deskripsi ?></p><small style='letter-spacing: 0;'><?= $row_w['alamat'] ?></small></div>").addTo(map);
    <?php }
    } ?>
  </script>
  <!-- Footer End -->
</body>

</html>