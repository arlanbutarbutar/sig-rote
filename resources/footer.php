<section class="container-fluid footer_section">
  <p>
    &copy; <?= date("Y"); ?> All Rights Reserved By
    <a href="https://netmedia-framecode.com/">Netmedia Framecode</a>
  </p>
</section>

<script type="text/javascript" src="assets/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.js"></script>

<script>
  var map = L.map('map').setView([-8.7878764207942, 120.97297277227273], 14);
  var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

  <?php if (mysqli_num_rows($tbl_lokasi) > 0) {
    while ($row = mysqli_fetch_assoc($tbl_lokasi)) {
      $image = $row['foto_wisata'];
      $nama = $row['nama_lokasi'];
      $deskripsi = $row['deskripsi_lokasi'];
  ?>
      L.marker([<?= $row['latitude'] ?>, <?= $row['longitude'] ?>]).bindPopup("<div><img src='assets/images/wisata/<?= $image ?>' style='width: 100%;' alt=''><h4 style='margin-top: 5px;'><?= $nama ?></h4><p style='margin-top: -5px;'><?= $deskripsi ?></p></div>").addTo(map);
  <?php }
  } ?>
</script>