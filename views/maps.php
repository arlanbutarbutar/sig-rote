<?php require_once("../controller/script.php"); ?>

<div class="tab-content tab-content-basic">
  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
    <div class="row">
      <div id="map" class="shadow" style="width: 100%; height: 600px;z-index: 0;"></div>
      <?php
      $ip = $_SERVER['REMOTE_ADDR'];
      $geojson = json_decode(file_get_contents("https://ipinfo.io/180.249.164.30/json"));
      ?>
      <script>
        var map = L.map('map').setView([-10.738853, 123.108472], 11.5);
        var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

        var myIcon = L.icon({
          iconUrl: '../assets/images/loc.png',
          iconSize: [38, 40],
        })

        <?php if (mysqli_num_rows($select_locationMaps) > 0) {
          while ($row_w = mysqli_fetch_assoc($select_locationMaps)) {
            $num_char = 100;
            $text = trim($row_w['deskripsi']);
            $text = preg_replace('#</?strong.*?>#is', '', $text);
            $deskripsi = substr($text, 0, $num_char) . '...';
        ?>
            L.marker([<?= $row_w['latitude'] ?>, <?= $row_w['longitude'] ?>], {
              icon: myIcon
            }).bindPopup("<div><img src='../assets/images/wisata/<?= $row_w['image'] ?>' style='width: 100%;' alt=''><h4 style='margin-top: 5px;'><a><?= $row_w['nama_wisata'] ?></a></h4><p style='margin-top: -5px;'><?= $deskripsi ?></p><small style='letter-spacing: 0;'><?= $row_w['alamat'] ?></small></div>").addTo(map);
        <?php }
        } ?>
      </script>
    </div>
  </div>
</div>