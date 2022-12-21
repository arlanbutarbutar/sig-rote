<?php require_once("controller/script.php");
$_SESSION['page-name'] = "Wisata";
$_SESSION['page-url'] = "wisata";
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
        <h3 class="display-4 text-white text-uppercase">Wisata</h3>
        <div class="d-inline-flex text-white">
          <p class="m-0 text-uppercase"><a class="text-white" href="./">Home</a></p>
          <i class="fa fa-angle-double-right pt-1 px-3"></i>
          <p class="m-0 text-uppercase">Wisata</p>
        </div>
      </div>
    </div>
  </div>
  <!-- Carousel End -->

  <!-- Blog Start -->
  <div class="container-fluid py-5">
    <div class="container py-5">
      <?php if (!isset($_GET['tujuan'])) { ?>
        <div class="row">
          <div class="col-lg-8">
            <div class="row pb-3" id="search-page">
              <?php if (mysqli_num_rows($frontWisata) > 0) {
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
                          <a class="text-primary text-uppercase text-decoration-none" style="font-size: 12px;" href="<?= $url_tkw ?>"><?= $row_wisata['nama_kwisata'] ?></a>
                        </div>
                        <?php $url_tw = "wisata?tujuan=" . $row_wisata['nama_wisata'];
                        $url_tw = str_replace(" ", "-", $url_tw); ?>
                        <a class="h5 m-0 text-decoration-none" href="<?= $url_tw ?>"><?= $row_wisata['nama_wisata'] ?></a>
                      </div>
                    </div>
                  </div>
                <?php }
              }
              if ($total_front2 > $data_front2) { ?>
                <div class="col-12">
                  <nav aria-label="Page navigation">
                    <ul class="pagination pagination-lg justify-content-center bg-white mb-0" style="padding: 30px;">
                      <?php if (isset($page_front2)) {
                        if (isset($total_page_front2)) {
                          if ($page_front2 > 1) : ?>
                            <li class="page-item">
                              <a class="page-link" href="<?= $_SESSION['page-url'] ?>?page=<?= $page_front2 - 1; ?>/" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                              </a>
                            </li>
                            <?php endif;
                          for ($i = 1; $i <= $total_page_front2; $i++) : if ($i <= 4) : if ($i == $page_front2) : ?>
                                <li class="page-item active"><a class="page-link" href="<?= $_SESSION['page-url'] ?>?page=<?= $i; ?>/"><?= $i ?></a></li>
                              <?php else : ?>
                                <li class="page-item"><a class="page-link" href="<?= $_SESSION['page-url'] ?>?page=<?= $i; ?>/"><?= $i ?></a></li>
                            <?php endif;
                            endif;
                          endfor;
                          if ($total_page_front2 >= 4) : ?>
                            <li class="page-item"><a class="page-link" href="<?= $_SESSION['page-url'] ?>?page=<?php if ($page_front2 > 4) {
                                                                                                                  echo $page_front2;
                                                                                                                } else if ($page_front2 <= 2) {
                                                                                                                  echo '3';
                                                                                                                } ?>/"><?php if ($page_front2 > 2) {
                                                                                                                          echo $page_front2;
                                                                                                                        } else if ($page_front2 <= 2) {
                                                                                                                          echo '3';
                                                                                                                        } ?></a></li>
                          <?php endif;
                          if ($page_front2 < $total_page_front2 && $total_page_front2 >= 4) : ?>
                            <li class="page-item">
                              <a class="page-link" href="<?= $_SESSION['page-url'] ?>?page=<?= $page_front2 + 1; ?>/" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                              </a>
                            </li>
                      <?php endif;
                        }
                      } ?>
                    </ul>
                  </nav>
                </div>
              <?php } ?>
            </div>
          </div>

          <div class="col-lg-4 mt-5 mt-lg-0">

            <!-- Search Form -->
            <div class="mb-5">
              <div class="bg-white" style="padding: 30px;">
                <div class="input-group">
                  <input type="text" id="search" class="form-control p-4" placeholder="Keyword">
                  <div class="input-group-append">
                    <span class="input-group-text bg-primary border-primary text-white"><i class="fa fa-search"></i></span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Category List -->
            <div class="mb-5">
              <h4 class="text-uppercase mb-4">Kategori Wisata</h4>
              <div class="bg-white" style="padding: 30px;">
                <ul class="list-inline m-0">
                  <?php if (mysqli_num_rows($list_kwisata) > 0) {
                    while ($row_lkw = mysqli_fetch_assoc($list_kwisata)) {
                      $id = $row_lkw['id_kategori_wisata'];
                      $count_w = mysqli_query($conn, "SELECT * FROM wisata WHERE id_kategori_wisata='$id'");
                      $count_w = mysqli_num_rows($count_w);
                      $url_kf = "wisata?kategori-wisata=" . $row_lkw['nama_kwisata'];
                      $url_kf = str_replace(" ", "-", $url_kf); ?>
                      <li class="mb-3 d-flex justify-content-between align-items-center">
                        <a class="text-dark" href="<?= $url_kf ?>"><i class="fa fa-angle-right text-primary mr-2"></i> <?= $row_lkw['nama_kwisata'] ?></a>
                        <span class="badge badge-primary badge-pill"><?= $count_w ?></span>
                      </li>
                  <?php }
                  } ?>
                </ul>
              </div>
            </div>
            <div class="mb-5">
              <h4 class="text-uppercase mb-4">Fasilitas</h4>
              <div class="bg-white" style="padding: 30px;">
                <ul class="list-inline m-0">
                  <?php if (mysqli_num_rows($list_fasilitas) > 0) {
                    while ($row_lkf = mysqli_fetch_assoc($list_fasilitas)) {
                      $id = $row_lkf['id_fasilitas'];
                      $count_f = mysqli_query($conn, "SELECT * FROM fasilitas JOIN wisata ON fasilitas.id_fasilitas=wisata.id_fasilitas WHERE fasilitas.id_fasilitas='$id'");
                      $count_f = mysqli_num_rows($count_f);
                      $url_kf = "wisata?fasilitas=" . $row_lkf['nama_fasilitas'];
                      $url_kf = str_replace(" ", "-", $url_kf); ?>
                      <li class="mb-3 d-flex justify-content-between align-items-center">
                        <a class="text-dark" href="<?= $url_kf ?>"><i class="fa fa-angle-right text-primary mr-2"></i> <?= $row_lkf['nama_fasilitas'] ?></a>
                        <span class="badge badge-primary badge-pill"><?= $count_f ?></span>
                      </li>
                  <?php }
                  } ?>
                </ul>
              </div>
            </div>

          </div>
        </div>
      <?php }
      if (isset($_GET['tujuan'])) { ?>
        <div class="row">
          <?php if (mysqli_num_rows($viewWisata) > 0) {
            while ($row_vw = mysqli_fetch_assoc($viewWisata)) { ?>
              <div class="col-lg-8">
                <!-- Blog Detail Start -->
                <div class="pb-3">
                  <div class="blog-item">
                    <div class="position-relative">
                      <img class="img-fluid w-100" src="assets/images/wisata/<?= $row_vw['image'] ?>" alt="" style="object-fit: cover;">
                    </div>
                  </div>
                  <div class="bg-white mb-3" style="padding: 30px;">
                    <div class="d-flex mb-3">
                      <?php $url_tkw = "wisata?kategori-wisata=" . $row_vw['nama_kwisata'];
                      $url_tkw = str_replace(" ", "-", $url_tkw); ?>
                      <a class="text-primary text-uppercase text-decoration-none" href="<?= $url_tkw ?>"><?= $row_vw['nama_kwisata'] ?></a>
                    </div>
                    <h2 class="mb-3"><?= $row_vw['nama_wisata'] ?></h2>
                    <p><?= $row_vw['deskripsi'] ?></p>
                  </div>
                </div>
                <!-- Blog Detail End -->

                <!-- Comment List Start -->
                <div class="bg-white" style="padding: 30px; margin-bottom: 30px;">
                  <div id="map" style="width: 100%; height: 500px;"></div>
                      <?php
                      $ch = curl_init();

                      curl_setopt($ch, CURLOPT_URL, 'https://ipinfo.io/'.$_SERVER["REMOTE_ADDR"].'?token=7ac8e9c9be73ba');
                      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                      
                      $result = curl_exec($ch);
                      if (curl_errno($ch)) {
                        echo 'Error:' . curl_error($ch);
                      }
                      curl_close($ch);
                      $data = json_decode($result);
                      ?>
                  <script>
                    var map = L.map('map');
                    var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

                    L.Routing.control({
                      waypoints: [
                        L.latLng(<?= $data->loc; ?>),
                        L.latLng(<?= $row_vw['latitude'] ?>, <?= $row_vw['longitude'] ?>)
                      ]
                    }).addTo(map);
                  </script>
                </div>
                <!-- Comment List End -->

                <!-- Comment List Start -->
                <div class="bg-white" style="padding: 30px; margin-bottom: 30px;">
                  <h2 class="mb-3">Galeri</h2>
                  <div class="d-flex flex-wrap">
                    <?php $id_wisata = $row_vw['id_wisata'];
                    $takeImage = mysqli_query($conn, "SELECT * FROM galeri WHERE id_wisata='$id_wisata'");
                    if (mysqli_num_rows($takeImage) > 0) {
                      while ($row_tg = mysqli_fetch_assoc($takeImage)) { ?>
                        <img src="assets/images/wisata/album/<?= $row_tg['image_gwisata'] ?>" class="img-thumbnail m-1" style="width: 215px;cursor: pointer;" alt="" data-toggle="modal" data-target="#view-image<?= $row_tg['id_galeri'] ?>">
                        <div class="modal fade" id="view-image<?= $row_tg['id_galeri'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header border-bottom-0">
                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body text-center">
                                <img src="assets/images/wisata/album/<?= $row_tg['image_gwisata'] ?>" class="img-thumbnail m-1" style="width: 100%;">
                              </div>
                            </div>
                          </div>
                        </div>
                    <?php }
                    } ?>
                  </div>
                </div>
                <!-- Comment List End -->
              </div>
          <?php }
          } ?>
          <div class="col-lg-4 mt-5 mt-lg-0">
            <!-- Category List -->
            <div class="mb-5">
              <h4 class="text-uppercase mb-4">Kategori Wisata</h4>
              <div class="bg-white" style="padding: 30px;">
                <ul class="list-inline m-0">
                  <?php if (mysqli_num_rows($list_kwisata) > 0) {
                    while ($row_lkw = mysqli_fetch_assoc($list_kwisata)) {
                      $id = $row_lkw['id_kategori_wisata'];
                      $count_w = mysqli_query($conn, "SELECT * FROM wisata WHERE id_kategori_wisata='$id'");
                      $count_w = mysqli_num_rows($count_w);
                      $url_kf = "wisata?kategori-wisata=" . $row_lkw['nama_kwisata'];
                      $url_kf = str_replace(" ", "-", $url_kf); ?>
                      <li class="mb-3 d-flex justify-content-between align-items-center">
                        <a class="text-dark" href="<?= $url_kf ?>"><i class="fa fa-angle-right text-primary mr-2"></i> <?= $row_lkw['nama_kwisata'] ?></a>
                        <span class="badge badge-primary badge-pill"><?= $count_w ?></span>
                      </li>
                  <?php }
                  } ?>
                </ul>
              </div>
            </div>
            <div class="mb-5">
              <h4 class="text-uppercase mb-4">Fasilitas</h4>
              <div class="bg-white" style="padding: 30px;">
                <ul class="list-inline m-0">
                  <?php if (mysqli_num_rows($list_fasilitas) > 0) {
                    while ($row_lkf = mysqli_fetch_assoc($list_fasilitas)) {
                      $id = $row_lkf['id_fasilitas'];
                      $count_f = mysqli_query($conn, "SELECT * FROM fasilitas JOIN wisata ON fasilitas.id_fasilitas=wisata.id_fasilitas WHERE fasilitas.id_fasilitas='$id'");
                      $count_f = mysqli_num_rows($count_f);
                      $url_kf = "wisata?fasilitas=" . $row_lkf['nama_fasilitas'];
                      $url_kf = str_replace(" ", "-", $url_kf); ?>
                      <li class="mb-3 d-flex justify-content-between align-items-center">
                        <a class="text-dark" href="<?= $url_kf ?>"><i class="fa fa-angle-right text-primary mr-2"></i> <?= $row_lkf['nama_fasilitas'] ?></a>
                        <span class="badge badge-primary badge-pill"><?= $count_f ?></span>
                      </li>
                  <?php }
                  } ?>
                </ul>
              </div>
            </div>

            <!-- Recent Post -->
            <div class="mb-5">
              <h4 class="text-uppercase mb-4">Upload Terbaru</h4>
              <?php if (mysqli_num_rows($recent_post) > 0) {
                while ($row_rp = mysqli_fetch_assoc($recent_post)) { ?>
                  <a class="d-flex align-items-center text-decoration-none bg-white mb-3" href="">
                    <img class="img-fluid" src="assets/images/wisata/<?= $row_rp['image'] ?>" alt="" style="object-fit: cover;width: 75px;height: 75px;">
                    <div class="pl-3">
                      <h6 class="m-1"><?= $row_rp['nama_wisata'] ?></h6>
                    </div>
                  </a>
              <?php }
              } ?>
            </div>

          </div>
        </div>
      <?php } ?>
    </div>
  </div>
  <!-- Blog End -->

  <!-- Footer Start -->
  <?php require_once("resources/footer.php"); ?>
  <script>
    $(document).ready(function() {
      $('#search').on('keyup', function() {
        $.get('search.php?key=' + $('#search').val(), function(data) {
          $('#search-page').html(data);
        });
      });
    });
  </script>
  <!-- Footer End -->
</body>

</html>