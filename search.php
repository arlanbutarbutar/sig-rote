<?php require_once('controller/script.php');
if ($_SESSION['page-url'] == "fasilitas") {
  if (isset($_GET['key']) && $_GET['key'] != "") {
    $key = addslashes(trim($_GET['key']));
    $keys = explode(" ", $key);
    $quer = "";
    foreach ($keys as $no => $data) {
      $data = strtolower($data);
      $quer .= "fasilitas.nama_fasilitas LIKE '%$data%'";
      if ($no + 1 < count($keys)) {
        $quer .= " AND ";
      }
    }
    $query = "SELECT * FROM fasilitas JOIN kategori_fasilitas ON fasilitas.id_kategori_fasilitas=kategori_fasilitas.id_kategori_fasilitas WHERE $quer ORDER BY  fasilitas.id_fasilitas DESC LIMIT 100";
    $frontFasilitas = mysqli_query($conn, $query);
  }
  if (mysqli_num_rows($frontFasilitas) > 0) {
    while ($row_fasilitas = mysqli_fetch_assoc($frontFasilitas)) { ?>
      <div class="col-md-6 mb-4 pb-2">
        <div class="blog-item">
          <div class="bg-white p-4">
            <div class="d-flex mb-2">
              <?php $url_kf = "fasilitas?kategori=" . $row_fasilitas['nama_kfasilitas'];
              $url_kf = str_replace(" ", "-", $url_kf); ?>
              <a class="text-primary text-uppercase text-decoration-none" href="<?= $url_kf ?>"><?= $row_fasilitas['nama_kfasilitas'] ?></a>
            </div>
            <?php $url_w = "wisata?fasilitas=" . $row_fasilitas['nama_fasilitas'];
            $url_w = str_replace(" ", "-", $url_w); ?>
            <a class="h5 m-0 text-decoration-none" href="<?= $url_w ?>" style="font-size: 28px;"><?= $row_fasilitas['nama_fasilitas'] ?></a>
          </div>
        </div>
      </div>
    <?php }
  }
}
if ($_SESSION['page-url'] == "wisata") {
  if (isset($_GET['key']) && $_GET['key'] != "") {
    $key = addslashes(trim($_GET['key']));
    $keys = explode(" ", $key);
    $quer = "";
    foreach ($keys as $no => $data) {
      $data = strtolower($data);
      $quer .= "wisata.nama_wisata LIKE '%$data%'";
      if ($no + 1 < count($keys)) {
        $quer .= " AND ";
      }
    }
    $query = "SELECT * FROM wisata JOIN kategori_wisata ON wisata.id_kategori_wisata=kategori_wisata.id_kategori_wisata JOIN fasilitas ON wisata.id_fasilitas=fasilitas.id_fasilitas WHERE $quer ORDER BY  wisata.id_wisata DESC LIMIT 100";
    $frontWisata = mysqli_query($conn, $query);
  }
  if (mysqli_num_rows($frontWisata) > 0) {
    while ($row_wisata = mysqli_fetch_assoc($frontWisata)) { ?>
      <div class="col-md-6 mb-4 pb-2">
        <div class="blog-item">
          <div class="position-relative">
            <img class="img-fluid w-100" src="assets/images/wisata/<?= $row_wisata['image'] ?>" alt="" style="object-fit: cover;">
          </div>
          <div class="bg-white p-4">
            <div class="d-flex mb-2">
              <?php $url_tkw = "wisata?kategori-wisata=" . $row_wisata['nama_kwisata'];
              $url_tkw = str_replace(" ", "-", $url_tkw); ?>
              <a class="text-primary text-uppercase text-decoration-none" href="<?= $url_tkw ?>"><?= $row_wisata['nama_kwisata'] ?></a>
            </div>
            <?php $url_tw = "wisata?tujuan=" . $row_wisata['nama_wisata'];
            $url_tw = str_replace(" ", "-", $url_tw); ?>
            <a class="h5 m-0 text-decoration-none" href="<?= $url_tw ?>"><?= $row_wisata['nama_wisata'] ?></a>
          </div>
        </div>
      </div>
<?php }
  }
} ?>