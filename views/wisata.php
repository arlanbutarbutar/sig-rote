<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION['page-name'] = "Wisata";
$_SESSION['page-url'] = "wisata";
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
                  <div>
                    <div class="btn-wrapper">
                      <!-- <a href="export-wisata" class="btn btn-primary text-white me-0 rounded-0 btn-sm"><i class="bi bi-file-earmark-arrow-down-fill"></i> Export</a> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php if (!isset($_GET['id-view-wisata']) && !isset($_GET['id-view-fasilitas'])) { ?>
            <div class="row">
              <div class="col-lg-8 mt-3">
                <div class="card rounded-0 shadow">
                  <div class="card-body">
                    <div id="map" style="width: 100%; height: 760px;"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 mt-3">
                <div>
                  <div class="card rounded-0 shadow">
                    <div class="card-body text-center">
                      <h4>Tambah Wisata</h4>
                      <form class="mt-3" action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                          <label for="kwisata" class="form-label">Kategori Wisata</label>
                          <select name="id-kwisata" class="form-select" aria-label="Default select example" required>
                            <?php if (isset($_GET['id-add-wisata'])) {
                              $id = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['id-add-wisata']))));
                              $selection1_kwisata = mysqli_query($conn, "SELECT * FROM kategori_wisata WHERE id_kategori_wisata='$id'");
                              foreach ($selection1_kwisata as $row_s1kw) :
                            ?>
                                <option selected value="<?= $row_s1kw['id_kategori_wisata'] ?>"><?= $row_s1kw['nama_kwisata'] ?></option>
                              <?php endforeach;
                              $selection2_kwisata = mysqli_query($conn, "SELECT * FROM kategori_wisata WHERE id_kategori_wisata!='$id'");
                              foreach ($selection2_kwisata as $row_s2kw) : ?>
                                <option value="<?= $row_s2kw['id_wisata'] ?>"><?= $row_s2kw['nama_kwisata'] ?></option>
                              <?php endforeach;
                            } else if (!isset($_GET['id-add-wisata'])) { ?>
                              <option selected value="">Pilih Kategori Wisata</option>
                              <?php foreach ($select_kwisata as $row_kw) : ?>
                                <option value="<?= $row_kw['id_kategori_wisata'] ?>"><?= $row_kw['nama_kwisata'] ?></option>
                            <?php endforeach;
                            } ?>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="kfasilitas" class="form-label">Kategori Fasilitas</label>
                          <select name="id-fasilitas" class="form-select" aria-label="Default select example" required>
                            <?php if (isset($_GET['id-add-fasilitas'])) {
                              $id = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['id-add-fasilitas']))));
                              $selection1_kfasilitas = mysqli_query($conn, "SELECT * FROM fasilitas WHERE id_fasilitas='$id'");
                              foreach ($selection1_kfasilitas as $row_s1kf) :
                            ?>
                                <option selected value="<?= $row_s1kf['id_fasilitas'] ?>"><?= $row_s1kf['nama_fasilitas'] ?></option>
                              <?php endforeach;
                              $selection2_kfasilitas = mysqli_query($conn, "SELECT * FROM fasilitas WHERE id_fasilitas!='$id'");
                              foreach ($selection2_kfasilitas as $row_s2kf) : ?>
                                <option value="<?= $row_s2kf['id_fasilitas'] ?>"><?= $row_s2kf['nama_fasilitas'] ?></option>
                              <?php endforeach;
                            } else if (!isset($_GET['id-add-fasilitas'])) { ?>
                              <option selected value="">Pilih Fasilitas</option>
                              <?php foreach ($select_fasilitas as $row_f) : ?>
                                <option value="<?= $row_f['id_fasilitas'] ?>"><?= $row_f['nama_fasilitas'] ?></option>
                            <?php endforeach;
                            } ?>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="image" class="form-label">Photo</label>
                          <input name="image" class="form-control" type="file" id="image" required>
                        </div>
                        <div class="mb-3">
                          <label for="nama" class="form-label">Nama</label>
                          <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" required>
                        </div>
                        <div class="mb-3">
                          <label for="deskripsi" class="form-label">Deskripsi</label>
                          <textarea name="deskripsi" class="form-control" id="deskripsi" rows="10" style="height: 100px;" required></textarea>
                        </div>
                        <div class="mb-3">
                          <label for="alamat" class="form-label">Alamat</label>
                          <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat" required>
                        </div>
                        <div class="mb-3">
                          <label for="latitude" class="form-label">Latitude</label>
                          <input type="text" name="latitude" class="form-control" id="latitude" placeholder="Latitude" required>
                        </div>
                        <div class="mb-3">
                          <label for="longitude" class="form-label">Longitude</label>
                          <input type="text" name="longitude" class="form-control" id="longitude" placeholder="Longitude" required>
                        </div>
                        <div class="mb-3">
                          <button type="submit" name="tambah-wisata" class="btn btn-primary rounded-0 btn-sm">Tambah</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
          <div class="row">
            <div class="col-md-12">
              <div class="card rounded-0 mt-3">
                <div class="card-body table-responsive">
                  <table class="table table-striped table-hover table-borderless table-sm text-center">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Wisata</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Fasilitas</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Tgl buat</th>
                        <th scope="col">Tgl ubah</th>
                        <th scope="col" colspan="3">Aksi</th>
                      </tr>
                    </thead>
                    <tbody id="search-page">
                      <?php if (mysqli_num_rows($wisata) == 0) { ?>
                        <tr>
                          <th scope="row" colspan="11">belum ada data wisata</th>
                        </tr>
                        <?php } else if (mysqli_num_rows($wisata) > 0) {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($wisata)) { ?>
                          <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td>
                              <div class="d-flex">
                                <img src="../assets/images/wisata/<?= $row['image'] ?>" alt="">
                                <div class="my-auto">
                                  <h6 style="margin-left: 10px;"><?= $row['nama_wisata'] ?></h6>
                                </div>
                              </div>
                            </td>
                            <td><?= $row['nama_kwisata'] ?></td>
                            <td><?= $row['nama_fasilitas'] ?></td>
                            <td>
                              <button type="button" class="btn btn-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#deskripsi<?= $row['id_wisata'] ?>">
                                Lihat
                              </button>
                              <div class="modal fade" id="deskripsi<?= $row['id_wisata'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header border-bottom-0 shadow">
                                      <h5 class="modal-title" id="exampleModalLabel">Deskripsi <?= $row['nama_wisata'] ?></h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <textarea class="form-control border-0" id="message-text" style="height: 300px;">
                                        <?= $row['deskripsi'] ?>
                                      </textarea>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td><?= $row['alamat'] ?></td>
                            <td>
                              <div class="badge badge-opacity-success">
                                <?php $dateCreate = date_create($row['created_at']);
                                echo date_format($dateCreate, "l, d M Y h:i a"); ?>
                              </div>
                            </td>
                            <td>
                              <div class="badge badge-opacity-warning">
                                <?php $dateUpdate = date_create($row['updated_at']);
                                echo date_format($dateUpdate, "l, d M Y h:i a"); ?>
                              </div>
                            </td>
                            <td>
                              <a href="galeri?id=<?= $row['id_wisata'] ?>" class="btn btn-info btn-sm rounded-0"><i class="bi bi-eye"></i> Galeri</a>
                            </td>
                            <td>
                              <a href="lokasi?id=<?= $row['id_wisata'] ?>" class="btn btn-info btn-sm rounded-0"><i class="bi bi-eye"></i> Lokasi</a>
                            </td>
                            <td>
                              <a href="edit-wisata?id=<?= $row['id_wisata'] ?>" class="btn btn-warning btn-sm rounded-0"><i class="bi bi-pencil-square"></i></a>
                            </td>
                            <td>
                              <button type="button" class="btn btn-danger btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_wisata'] ?>">
                                <i class="bi bi-trash3"></i>
                              </button>
                              <div class="modal fade" id="hapus<?= $row['id_wisata'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header border-bottom-0 shadow">
                                      <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $row['nama_wisata'] ?></h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      Anda yakin ingin menghapus wisata <?= $row['nama_wisata'] ?> ini?
                                    </div>
                                    <div class="modal-footer justify-content-center border-top-0">
                                      <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Batal</button>
                                      <form action="" method="POST">
                                        <input type="hidden" name="id" value="<?= $row['id_wisata'] ?>">
                                        <input type="hidden" name="namaOld" value="<?= $row['nama_wisata'] ?>">
                                        <input type="hidden" name="imageOld" value="<?= $row['image'] ?>">
                                        <button type="submit" name="hapus-wisata" class="btn btn-danger btn-sm rounded-0">Hapus</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                      <?php $no++;
                        }
                      } ?>
                    </tbody>
                  </table>
                  <?php if ($total_role5 > $data_role5) { ?>
                    <div class="d-flex justify-content-between mt-4 flex-wrap">
                      <p class="text-muted">Showing 1 to <?= $data_role5 ?> of <?= $total_role5 ?> entries</p>
                      <nav class="ml-auto">
                        <ul class="pagination separated pagination-info">
                          <?php if (isset($page_role5)) {
                            if (isset($total_page_role5)) {
                              if ($page_role5 > 1) : ?>
                                <li class="page-item">
                                  <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role5 - 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="bi bi-arrow-bar-left text-white"></i></a>
                                </li>
                                <?php endif;
                              for ($i = 1; $i <= $total_page_role5; $i++) : if ($i <= 4) : if ($i == $page_role5) : ?>
                                    <li class="page-item active">
                                      <a href="<?= $_SESSION['page-url'] ?>?page=<?= $i; ?>/" class="btn btn-primary btn-sm rounded-0 text-white"><?= $i; ?></a>
                                    </li>
                                  <?php else : ?>
                                    <li class="page-item">
                                      <a href="<?= $_SESSION['page-url'] ?>?page=<?= $i; ?>/" class="btn btn-outline-primary btn-sm rounded-0"><?= $i ?></a>
                                    </li>
                                <?php endif;
                                endif;
                              endfor;
                              if ($total_page_role5 >= 4) : ?>
                                <li class="page-item">
                                  <a href="<?= $_SESSION['page-url'] ?>?page=<?php if ($page_role5 > 4) {
                                                                                echo $page_role5;
                                                                              } else if ($page_role5 <= 4) {
                                                                                echo '5';
                                                                              } ?>/" class="btn btn-<?php if ($page_role5 <= 4) {
                                                                                                      echo 'outline-';
                                                                                                    } ?>primary btn-sm rounded-0"><?php if ($page_role5 > 4) {
                                                                                                                                    echo $page_role5;
                                                                                                                                  } else if ($page_role5 <= 4) {
                                                                                                                                    echo '5';
                                                                                                                                  } ?></a>
                                </li>
                              <?php endif;
                              if ($page_role5 < $total_page_role5 && $total_page_role5 >= 4) : ?>
                                <li class="page-item">
                                  <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role5 + 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="bi bi-arrow-bar-right"></i></a>
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
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
        <script>
          var map = L.map('map').setView([-10.7329607, 123.111856], 12);
          var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

          // get coordinat location
          var latInput = document.querySelector("[name=latitude]");
          var lngInput = document.querySelector("[name=longitude]");
          var curLocation = [-10.7329607, 123.111856];
          map.attributionControl.setPrefix(false);
          var marker = new L.marker(curLocation, {
            draggable: 'true',
          });
          marker.on('dragend', function(event) {
            var position = marker.getLatLng();
            marker.setLatLng(position, {
              draggable: 'true',
            }).bindPopup(position).update();
            $("#latitude").val(position.lat);
            $("#longitude").val(position.lng);
          });
          map.addLayer(marker);

          map.on("click", function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
            if (!marker) {
              marker = L.marker(e.latlng).addTo(map);
            } else {
              marker.setLatLng(e.latlng);
            }
            latInput.value = lat;
            lngInput.value = lng;
          });
        </script>
        <script>
          //<![CDATA[
          shortcut = {
            all_shortcuts: {},
            add: function(a, b, c) {
              var d = {
                type: "keydown",
                propagate: !1,
                disable_in_input: !1,
                target: document,
                keycode: !1
              };
              if (c)
                for (var e in d) "undefined" == typeof c[e] && (c[e] = d[e]);
              else c = d;
              d = c.target, "string" == typeof c.target && (d = document.getElementById(c.target)), a = a.toLowerCase(), e = function(d) {
                d = d || window.event;
                if (c.disable_in_input) {
                  var e;
                  d.target ? e = d.target : d.srcElement && (e = d.srcElement), 3 == e.nodeType && (e = e.parentNode);
                  if ("INPUT" == e.tagName || "TEXTAREA" == e.tagName) return
                }
                d.keyCode ? code = d.keyCode : d.which && (code = d.which), e = String.fromCharCode(code).toLowerCase(), 188 == code && (e = ","), 190 == code && (e = ".");
                var f = a.split("+"),
                  g = 0,
                  h = {
                    "`": "~",
                    1: "!",
                    2: "@",
                    3: "#",
                    4: "$",
                    5: "%",
                    6: "^",
                    7: "&",
                    8: "*",
                    9: "(",
                    0: ")",
                    "-": "_",
                    "=": "+",
                    ";": ":",
                    "'": '"',
                    ",": "<",
                    ".": ">",
                    "/": "?",
                    "\\": "|"
                  },
                  i = {
                    esc: 27,
                    escape: 27,
                    tab: 9,
                    space: 32,
                    "return": 13,
                    enter: 13,
                    backspace: 8,
                    scrolllock: 145,
                    scroll_lock: 145,
                    scroll: 145,
                    capslock: 20,
                    caps_lock: 20,
                    caps: 20,
                    numlock: 144,
                    num_lock: 144,
                    num: 144,
                    pause: 19,
                    "break": 19,
                    insert: 45,
                    home: 36,
                    "delete": 46,
                    end: 35,
                    pageup: 33,
                    page_up: 33,
                    pu: 33,
                    pagedown: 34,
                    page_down: 34,
                    pd: 34,
                    left: 37,
                    up: 38,
                    right: 39,
                    down: 40,
                    f1: 112,
                    f2: 113,
                    f3: 114,
                    f4: 115,
                    f5: 116,
                    f6: 117,
                    f7: 118,
                    f8: 119,
                    f9: 120,
                    f10: 121,
                    f11: 122,
                    f12: 123
                  },
                  j = !1,
                  l = !1,
                  m = !1,
                  n = !1,
                  o = !1,
                  p = !1,
                  q = !1,
                  r = !1;
                d.ctrlKey && (n = !0), d.shiftKey && (l = !0), d.altKey && (p = !0), d.metaKey && (r = !0);
                for (var s = 0; k = f[s], s < f.length; s++) "ctrl" == k || "control" == k ? (g++, m = !0) : "shift" == k ? (g++, j = !0) : "alt" == k ? (g++, o = !0) : "meta" == k ? (g++, q = !0) : 1 < k.length ? i[k] == code && g++ : c.keycode ? c.keycode == code && g++ : e == k ? g++ : h[e] && d.shiftKey && (e = h[e], e == k && g++);
                if (g == f.length && n == m && l == j && p == o && r == q && (b(d), !c.propagate)) return d.cancelBubble = !0, d.returnValue = !1, d.stopPropagation && (d.stopPropagation(), d.preventDefault()), !1
              }, this.all_shortcuts[a] = {
                callback: e,
                target: d,
                event: c.type
              }, d.addEventListener ? d.addEventListener(c.type, e, !1) : d.attachEvent ? d.attachEvent("on" + c.type, e) : d["on" + c.type] = e
            },
            remove: function(a) {
              var a = a.toLowerCase(),
                b = this.all_shortcuts[a];
              delete this.all_shortcuts[a];
              if (b) {
                var a = b.event,
                  c = b.target,
                  b = b.callback;
                c.detachEvent ? c.detachEvent("on" + a, b) : c.removeEventListener ? c.removeEventListener(a, b, !1) : c["on" + a] = !1
              }
            }
          }, shortcut.add("enter", function() {
            Swal.fire({
              icon: 'warning',
              title: 'Peringatan!',
              text: 'Anda tidak diperkenankan menggunakan fitur enter pada keyboard untuk mengisi deskripsi wisata.',
            })
          });
          //]]>
        </script>
</body>

</html>