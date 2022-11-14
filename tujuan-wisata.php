<?php require_once("controller/script.php");
$_SESSION['page-name'] = "Tujuan Wisata";
$_SESSION['page-url'] = "tujuan-wisata";
if (!isset($_SESSION['tujuan-wisata'])) {
  header("Location: ./");
  exit();
} else if (isset($_SESSION['tujuan-wisata'])) {
  $loc = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['tujuan-wisata']['loc']))));
  $id_wisata = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['tujuan-wisata']['id-wisata']))));
  $destinasi = mysqli_query($conn, "SELECT * FROM wisata WHERE id_wisata='$id_wisata'");
}
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
  <?php if (mysqli_num_rows($destinasi) > 0) {
    while ($row = mysqli_fetch_assoc($destinasi)) {
      $url = "wisata?tujuan=" . $row['nama_wisata'];
      $url = str_replace(" ", "-", $url); ?>
      <div class="container-fluid p-0 m-0">
        <div id="map" style="width: 100%; height: 700px;z-index: 0;margin-top: -40px;"></div>
        <script>
          var map = L.map('map').setView([<?= $loc; ?>], 10);
          var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

          var myIcon = L.icon({
            iconUrl: 'assets/images/loc.png',
            iconSize: [38, 40],
          })

          <?php if (mysqli_num_rows($select_locationMaps) > 0) {
            while ($row_w = mysqli_fetch_assoc($select_locationMaps)) {
              $image = $row_w['image'];
              $nama = $row_w['nama_wisata'];
              $deskripsi = $row_w['deskripsi'];
              $url_w = "wisata?tujuan=" . $row_w['nama_wisata'];
              $url_w = str_replace(" ", "-", $url_w);
          ?>
              L.marker([<?= $row_w['latitude'] ?>, <?= $row_w['longitude'] ?>], {
                icon: myIcon
              }).bindPopup("<div><img src='assets/images/wisata/<?= $image ?>' style='width: 100%;' alt=''><h4 style='margin-top: 5px;'><a href='<?= $url_w ?> '><?= $nama ?></a></h4><p style='margin-top: -5px;'><?= $deskripsi ?></p><small style='letter-spacing: 0;'><?= $row_w['alamat'] ?></small><br><button type='submit' class='btn btn-primary btn-sm mt-3' onclick='return gass(<?= $row_w['latitude'] ?>, <?= $row_w['longitude'] ?>)'>Gass...</button></div>").addTo(map);
          <?php }
          } ?>

          var control = L.Routing.control({
            waypoints: [
              L.latLng(<?= $loc; ?>),
              L.latLng(<?= $row['latitude'] ?>, <?= $row['longitude'] ?>)
            ],
            routeWhileDragging: true
          })
          control.addTo(map);

          function gass(lat, lng) {
            var latLng=L.latLng(lat, lng);
            control.spliceWaypoints(control.getWaypoints().length - 1, 1, latLng);
          }
        </script>
      </div>
  <?php }
  } ?>
  <!-- Carousel End -->

  <!-- code -->

  <!-- Footer Start -->
  <?php require_once("resources/footer.php"); ?>
  <!-- Footer End -->
</body>

</html>