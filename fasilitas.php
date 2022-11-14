<?php require_once("controller/script.php");
$_SESSION['page-name'] = "Fasilitas";
$_SESSION['page-url'] = "fasilitas";
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
  <div class="container-fluid page-header" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(assets/images/carousel-2.jpg), no-repeat center center;background-size: cover;">
    <div class="container">
      <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px;">
        <h3 class="display-4 text-white text-uppercase">Fasilitas</h3>
        <div class="d-inline-flex text-white">
          <p class="m-0 text-uppercase"><a class="text-white" href="./">Home</a></p>
          <i class="fa fa-angle-double-right pt-1 px-3"></i>
          <p class="m-0 text-uppercase">Fasilitas</p>
        </div>
      </div>
    </div>
  </div>
  <!-- Carousel End -->

  <!-- Blog Start -->
  <div class="container-fluid py-5">
    <div class="container py-5">
      <div class="row">
        <div class="col-lg-8">
          <div class="row pb-3" id="search-page">
            <?php if (mysqli_num_rows($frontFasilitas) > 0) {
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
            if ($total_front1 > $data_front1) { ?>
              <div class="col-12">
                <nav aria-label="Page navigation">
                  <ul class="pagination pagination-lg justify-content-center bg-white mb-0" style="padding: 30px;">
                    <?php if (isset($page_front1)) {
                      if (isset($total_page_front1)) {
                        if ($page_front1 > 1) : ?>
                          <li class="page-item">
                            <a class="page-link" href="<?= $_SESSION['page-url'] ?>?page=<?= $page_front1 - 1; ?>/" aria-label="Previous">
                              <span aria-hidden="true">&laquo;</span>
                              <span class="sr-only">Previous</span>
                            </a>
                          </li>
                          <?php endif;
                        for ($i = 1; $i <= $total_page_front1; $i++) : if ($i <= 4) : if ($i == $page_front1) : ?>
                              <li class="page-item active"><a class="page-link" href="<?= $_SESSION['page-url'] ?>?page=<?= $i; ?>/"><?= $i ?></a></li>
                            <?php else : ?>
                              <li class="page-item"><a class="page-link" href="<?= $_SESSION['page-url'] ?>?page=<?= $i; ?>/"><?= $i ?></a></li>
                          <?php endif;
                          endif;
                        endfor;
                        if ($total_page_front1 >= 4) : ?>
                          <li class="page-item"><a class="page-link" href="<?= $_SESSION['page-url'] ?>?page=<?php if ($page_front1 > 4) {
                                                                                                                echo $page_front1;
                                                                                                              } else if ($page_front1 <= 2) {
                                                                                                                echo '3';
                                                                                                              } ?>/"><?php if ($page_front1 > 2) {
                                                                                                                        echo $page_front1;
                                                                                                                      } else if ($page_front1 <= 2) {
                                                                                                                        echo '3';
                                                                                                                      } ?></a></li>
                        <?php endif;
                        if ($page_front1 < $total_page_front1 && $total_page_front1 >= 4) : ?>
                          <li class="page-item">
                            <a class="page-link" href="<?= $_SESSION['page-url'] ?>?page=<?= $page_front1 + 1; ?>/" aria-label="Next">
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
            <h4 class="text-uppercase mb-4">Kategori</h4>
            <div class="bg-white" style="padding: 30px;">
              <ul class="list-inline m-0">
                <?php if (mysqli_num_rows($list_kfasilitas) > 0) {
                  while ($row_lkf = mysqli_fetch_assoc($list_kfasilitas)) {
                    $id = $row_lkf['id_kategori_fasilitas'];
                    $count_f = mysqli_query($conn, "SELECT * FROM fasilitas WHERE id_kategori_fasilitas='$id'");
                    $count_f = mysqli_num_rows($count_f);
                    $url_kf = "fasilitas?kategori=" . $row_lkf['nama_kfasilitas'];
                    $url_kf = str_replace(" ", "-", $url_kf); ?>
                    <li class="mb-3 d-flex justify-content-between align-items-center">
                      <a class="text-dark" href="<?= $url_kf ?>"><i class="fa fa-angle-right text-primary mr-2"></i> <?= $row_lkf['nama_kfasilitas'] ?></a>
                      <span class="badge badge-primary badge-pill"><?= $count_f ?></span>
                    </li>
                <?php }
                } ?>
              </ul>
            </div>
          </div>

        </div>
      </div>
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