<?php require_once("../controller/script.php");
require_once("redirect.php");

if (!isset($_GET['id'])) {
  header("Location: wisata");
  exit();
} else if (isset($_GET['id'])) {
  $id = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['id']))));
  $result_loc = mysqli_query($conn, "SELECT * FROM wisata WHERE id_wisata='$id'");
  $row = mysqli_fetch_assoc($result_loc);
  $_SESSION['page-name'] = "Lokasi " . $row['nama_wisata'];
  $_SESSION['page-url'] = "lokasi?id=" . $_GET['id'];
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
                <div class="card rounded-0 mt-3">
                  <div class="card-body table-responsive">
                    <div id="map" style="width: 100%; height: 500px;"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
        <script>
          var map = L.map('map').setView([<?= $row['latitude'] ?>, <?= $row['longitude'] ?>], 12);
          var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

          L.marker([<?= $row['latitude'] ?>, <?= $row['longitude'] ?>]).bindPopup("<div><img src='../assets/images/wisata/<?= $row['image'] ?>' style='width: 100%;' alt=''><h4 style='margin-top: 5px;'><?= $row['nama_wisata'] ?></h4><p style='margin-top: -5px;'><?= $row['deskripsi'] ?></p></div>").addTo(map);
        </script>
</body>

</html>