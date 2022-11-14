<?php
error_reporting(~E_NOTICE & ~E_DEPRECATED);
if (!isset($_SESSION[''])) {
  session_start();
}
require_once("db_connect.php");
require_once("time.php");
require_once("functions.php");
if (isset($_SESSION['time-message'])) {
  if ((time() - $_SESSION['time-message']) > 2) {
    if (isset($_SESSION['message-success'])) {
      unset($_SESSION['message-success']);
    }
    if (isset($_SESSION['message-info'])) {
      unset($_SESSION['message-info']);
    }
    if (isset($_SESSION['message-warning'])) {
      unset($_SESSION['message-warning']);
    }
    if (isset($_SESSION['message-danger'])) {
      unset($_SESSION['message-danger']);
    }
    if (isset($_SESSION['message-dark'])) {
      unset($_SESSION['message-dark']);
    }
    unset($_SESSION['time-alert']);
  }
}

$baseURL = "http://$_SERVER[HTTP_HOST]/apps/sig-rote/";

$kategori_wisata = mysqli_query($conn, "SELECT * FROM kategori_wisata ORDER BY id_kategori_wisata DESC");
$fasilitas_wisata = mysqli_query($conn, "SELECT * FROM fasilitas JOIN wisata ON fasilitas.id_fasilitas ORDER BY fasilitas.id_fasilitas DESC LIMIT 9");
$tujuan_wisata = mysqli_query($conn, "SELECT * FROM wisata JOIN kategori_wisata ON wisata.id_kategori_wisata=kategori_wisata.id_kategori_wisata ORDER BY wisata.id_wisata DESC LIMIT 3");
$select_locationMaps = mysqli_query($conn, "SELECT * FROM wisata");
$count_wisata = mysqli_query($conn, "SELECT * FROM wisata");
$count_wisata = mysqli_num_rows($count_wisata);
$count_fasilitas = mysqli_query($conn, "SELECT * FROM fasilitas");
$count_fasilitas = mysqli_num_rows($count_fasilitas);

if (!isset($_GET['kategori'])) {
  $data_front1 = 25;
  $result_front1 = mysqli_query($conn, "SELECT * FROM fasilitas JOIN kategori_fasilitas ON fasilitas.id_kategori_fasilitas=kategori_fasilitas.id_kategori_fasilitas");
  $total_front1 = mysqli_num_rows($result_front1);
  $total_page_front1 = ceil($total_front1 / $data_front1);
  $page_front1 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
  $awal_data_front1 = ($page_front1 > 1) ? ($page_front1 * $data_front1) - $data_front1 : 0;
  $frontFasilitas = mysqli_query($conn, "SELECT * FROM fasilitas JOIN kategori_fasilitas ON fasilitas.id_kategori_fasilitas=kategori_fasilitas.id_kategori_fasilitas ORDER BY fasilitas.id_fasilitas DESC LIMIT $awal_data_front1, $data_front1");
} else if (isset($_GET['kategori'])) {
  $keyword = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['kategori']))));
  $keyword = str_replace("-", " ", $keyword);
  $data_front1 = 25;
  $result_front1 = mysqli_query($conn, "SELECT * FROM fasilitas JOIN kategori_fasilitas ON fasilitas.id_kategori_fasilitas=kategori_fasilitas.id_kategori_fasilitas");
  $total_front1 = mysqli_num_rows($result_front1);
  $total_page_front1 = ceil($total_front1 / $data_front1);
  $page_front1 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
  $awal_data_front1 = ($page_front1 > 1) ? ($page_front1 * $data_front1) - $data_front1 : 0;
  $frontFasilitas = mysqli_query($conn, "SELECT * FROM fasilitas JOIN kategori_fasilitas ON fasilitas.id_kategori_fasilitas=kategori_fasilitas.id_kategori_fasilitas WHERE kategori_fasilitas.nama_kfasilitas='$keyword' ORDER BY fasilitas.id_fasilitas DESC LIMIT $awal_data_front1, $data_front1");
}

$list_kfasilitas = mysqli_query($conn, "SELECT * FROM kategori_fasilitas ORDER BY id_kategori_fasilitas DESC");

if (!isset($_GET['kategori-wisata'])) {
  if (!isset($_GET['fasilitas'])) {
    $data_front2 = 25;
    $result_front2 = mysqli_query($conn, "SELECT * FROM wisata JOIN kategori_wisata ON wisata.id_kategori_wisata=kategori_wisata.id_kategori_wisata JOIN fasilitas ON wisata.id_fasilitas=fasilitas.id_fasilitas");
    $total_front2 = mysqli_num_rows($result_front2);
    $total_page_front2 = ceil($total_front2 / $data_front2);
    $page_front2 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $awal_data_front2 = ($page_front2 > 1) ? ($page_front2 * $data_front2) - $data_front2 : 0;
    $frontWisata = mysqli_query($conn, "SELECT * FROM wisata JOIN kategori_wisata ON wisata.id_kategori_wisata=kategori_wisata.id_kategori_wisata JOIN fasilitas ON wisata.id_fasilitas=fasilitas.id_fasilitas ORDER BY wisata.id_wisata DESC LIMIT $awal_data_front2, $data_front2");
  } else if (isset($_GET['fasilitas'])) {
    $keyword = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['fasilitas']))));
    $keyword = str_replace("-", " ", $keyword);
    $data_front2 = 25;
    $result_front2 = mysqli_query($conn, "SELECT * FROM wisata JOIN kategori_wisata ON wisata.id_kategori_wisata=kategori_wisata.id_kategori_wisata JOIN fasilitas ON wisata.id_fasilitas=fasilitas.id_fasilitas");
    $total_front2 = mysqli_num_rows($result_front2);
    $total_page_front2 = ceil($total_front2 / $data_front2);
    $page_front2 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $awal_data_front2 = ($page_front2 > 1) ? ($page_front2 * $data_front2) - $data_front2 : 0;
    $frontWisata = mysqli_query($conn, "SELECT * FROM wisata JOIN kategori_wisata ON wisata.id_kategori_wisata=kategori_wisata.id_kategori_wisata JOIN fasilitas ON wisata.id_fasilitas=fasilitas.id_fasilitas WHERE fasilitas.nama_fasilitas='$keyword' ORDER BY wisata.id_wisata DESC LIMIT $awal_data_front2, $data_front2");
  }
} else if (isset($_GET['kategori-wisata'])) {
  $keyword = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['kategori-wisata']))));
  $keyword = str_replace("-", " ", $keyword);
  $data_front2 = 25;
  $result_front2 = mysqli_query($conn, "SELECT * FROM wisata JOIN kategori_wisata ON wisata.id_kategori_wisata=kategori_wisata.id_kategori_wisata JOIN fasilitas ON wisata.id_fasilitas=fasilitas.id_fasilitas");
  $total_front2 = mysqli_num_rows($result_front2);
  $total_page_front2 = ceil($total_front2 / $data_front2);
  $page_front2 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
  $awal_data_front2 = ($page_front2 > 1) ? ($page_front2 * $data_front2) - $data_front2 : 0;
  $frontWisata = mysqli_query($conn, "SELECT * FROM wisata JOIN kategori_wisata ON wisata.id_kategori_wisata=kategori_wisata.id_kategori_wisata JOIN fasilitas ON wisata.id_fasilitas=fasilitas.id_fasilitas WHERE kategori_wisata.nama_kwisata='$keyword' ORDER BY wisata.id_wisata DESC LIMIT $awal_data_front2, $data_front2");
}
if (isset($_GET['tujuan'])) {
  $keyword = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['tujuan']))));
  $keyword = str_replace("-", " ", $keyword);
  $viewWisata = mysqli_query($conn, "SELECT * FROM wisata JOIN kategori_wisata ON wisata.id_kategori_wisata=kategori_wisata.id_kategori_wisata JOIN fasilitas ON wisata.id_fasilitas=fasilitas.id_fasilitas WHERE wisata.nama_wisata='$keyword'");
}

$list_kwisata = mysqli_query($conn, "SELECT * FROM kategori_wisata ORDER BY id_kategori_wisata DESC");
$list_fasilitas = mysqli_query($conn, "SELECT * FROM fasilitas ORDER BY id_fasilitas DESC");

$recent_post = mysqli_query($conn, "SELECT * FROM wisata ORDER BY id_wisata DESC LIMIT 5");

$select_wisata = mysqli_query($conn, "SELECT * FROM wisata ORDER BY wisata.id_wisata DESC");
if (isset($_POST['loc'])) {
  if ($_POST['id-wisata'] == 0) {
    $_SESSION['message-danger'] = "Maaf, anda belum memilih tujuan wisata anda!";
    $_SESSION['time-message'] = time();
    header("Location: ./");
    return false;
  }
  $_SESSION['tujuan-wisata'] = [
    'loc' => htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['loc'])))),
    'id-wisata' => htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['id-wisata']))))
  ];
  header("Location: tujuan-wisata");
  exit();
}

if (!isset($_SESSION['data-user'])) {
  if (isset($_POST['masuk'])) {
    if (masuk($_POST) > 0) {
      header("Location: ../views/");
      exit();
    }
  }
}

if (isset($_SESSION['data-user'])) {
  $idUser = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['data-user']['id']))));

  $profile = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$idUser'");
  if (isset($_POST['ubah-profile'])) {
    if (edit_profile($_POST) > 0) {
      $_SESSION['message-success'] = "Profil akun anda berhasil di ubah.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }

  $countKFasilitas = mysqli_query($conn, "SELECT * FROM kategori_fasilitas");
  $countKFasilitas = mysqli_num_rows($countKFasilitas);
  $countKWisata = mysqli_query($conn, "SELECT * FROM kategori_wisata");
  $countKWisata = mysqli_num_rows($countKWisata);
  $countFasilitas = mysqli_query($conn, "SELECT * FROM fasilitas");
  $countFasilitas = mysqli_num_rows($countFasilitas);
  $countWisata = mysqli_query($conn, "SELECT * FROM wisata");
  $countWisata = mysqli_num_rows($countWisata);
  
  $wisataOverview = mysqli_query($conn, "SELECT * FROM wisata JOIN kategori_wisata ON wisata.id_kategori_wisata=kategori_wisata.id_kategori_wisata JOIN fasilitas ON wisata.id_fasilitas=fasilitas.id_fasilitas JOIN kategori_fasilitas ON fasilitas.id_kategori_fasilitas=kategori_fasilitas.id_kategori_fasilitas ORDER BY wisata.id_wisata DESC LIMIT 25");

  $data_role1 = 25;
  $result_role1 = mysqli_query($conn, "SELECT * FROM users WHERE id_user!='$idUser'");
  $total_role1 = mysqli_num_rows($result_role1);
  $total_page_role1 = ceil($total_role1 / $data_role1);
  $page_role1 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
  $awal_data_role1 = ($page_role1 > 1) ? ($page_role1 * $data_role1) - $data_role1 : 0;
  $users = mysqli_query($conn, "SELECT * FROM users WHERE id_user!='$idUser' ORDER BY id_user DESC LIMIT $awal_data_role1, $data_role1");
  if (isset($_POST['tambah-user'])) {
    if (add_user($_POST) > 0) {
      $_SESSION['message-success'] = "Pengguna " . $_POST['username'] . " berhasil ditambahkan.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['ubah-user'])) {
    if (edit_user($_POST) > 0) {
      $_SESSION['message-success'] = "Pengguna " . $_POST['usernameOld'] . " berhasil diubah.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['hapus-user'])) {
    if (delete_user($_POST) > 0) {
      $_SESSION['message-success'] = "Pengguna " . $_POST['username'] . " berhasil dihapus.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }

  $data_role2 = 25;
  $result_role2 = mysqli_query($conn, "SELECT * FROM kategori_fasilitas");
  $total_role2 = mysqli_num_rows($result_role2);
  $total_page_role2 = ceil($total_role2 / $data_role2);
  $page_role2 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
  $awal_data_role2 = ($page_role2 > 1) ? ($page_role2 * $data_role2) - $data_role2 : 0;
  $kfasilitas = mysqli_query($conn, "SELECT * FROM kategori_fasilitas ORDER BY id_kategori_fasilitas DESC LIMIT $awal_data_role2, $data_role2");
  if (isset($_POST['tambah-kfasilitas'])) {
    if (add_kfasilitas($_POST) > 0) {
      $_SESSION['message-success'] = "Nama kategori fasilitas berhasil ditambahkan.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['ubah-kfasilitas'])) {
    if (edit_kfasilitas($_POST) > 0) {
      $_SESSION['message-success'] = "Nama kategori fasilitas " . $_POST['namaOld'] . " berhasil diubah.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['hapus-kfasilitas'])) {
    if (delete_kfasilitas($_POST) > 0) {
      $_SESSION['message-success'] = "Nama kategori fasilitas " . $_POST['namaOld'] . " berhasil dihapus.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }

  $data_role3 = 25;
  $result_role3 = mysqli_query($conn, "SELECT * FROM kategori_wisata");
  $total_role3 = mysqli_num_rows($result_role3);
  $total_page_role3 = ceil($total_role3 / $data_role3);
  $page_role3 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
  $awal_data_role3 = ($page_role3 > 1) ? ($page_role3 * $data_role3) - $data_role3 : 0;
  $kwisata = mysqli_query($conn, "SELECT * FROM kategori_wisata ORDER BY id_kategori_wisata DESC LIMIT $awal_data_role3, $data_role3");
  if (isset($_POST['tambah-kwisata'])) {
    if (add_kwisata($_POST) > 0) {
      $_SESSION['message-success'] = "Nama kategori wisata berhasil ditambahkan.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['ubah-kwisata'])) {
    if (edit_kwisata($_POST) > 0) {
      $_SESSION['message-success'] = "Nama kategori wisata " . $_POST['namaOld'] . " berhasil diubah.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['hapus-kwisata'])) {
    if (delete_kwisata($_POST) > 0) {
      $_SESSION['message-success'] = "Nama kategori wisata " . $_POST['namaOld'] . " berhasil dihapus.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }

  $data_role4 = 25;
  $result_role4 = mysqli_query($conn, "SELECT * FROM fasilitas JOIN kategori_fasilitas ON fasilitas.id_kategori_fasilitas=kategori_fasilitas.id_kategori_fasilitas");
  $total_role4 = mysqli_num_rows($result_role4);
  $total_page_role4 = ceil($total_role4 / $data_role4);
  $page_role4 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
  $awal_data_role4 = ($page_role4 > 1) ? ($page_role4 * $data_role4) - $data_role4 : 0;
  $fasilitas = mysqli_query($conn, "SELECT * FROM fasilitas JOIN kategori_fasilitas ON fasilitas.id_kategori_fasilitas=kategori_fasilitas.id_kategori_fasilitas ORDER BY fasilitas.id_fasilitas DESC LIMIT $awal_data_role4, $data_role4");
  $select_kfasilitas = mysqli_query($conn, "SELECT * FROM kategori_fasilitas");
  if (isset($_POST['tambah-fasilitas'])) {
    if (add_fasilitas($_POST) > 0) {
      $_SESSION['message-success'] = "Fasilitas berhasil ditambahkan.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['ubah-fasilitas'])) {
    if (edit_fasilitas($_POST) > 0) {
      $_SESSION['message-success'] = "Fasilitas " . $_POST['namaOld'] . " berhasil diubah.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['hapus-fasilitas'])) {
    if (delete_fasilitas($_POST) > 0) {
      $_SESSION['message-success'] = "Fasilitas " . $_POST['namaOld'] . " berhasil dihapus.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }

  $data_role5 = 25;
  $result_role5 = mysqli_query($conn, "SELECT * FROM wisata JOIN kategori_wisata ON wisata.id_kategori_wisata=kategori_wisata.id_kategori_wisata");
  $total_role5 = mysqli_num_rows($result_role5);
  $total_page_role5 = ceil($total_role5 / $data_role5);
  $page_role5 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
  $awal_data_role5 = ($page_role5 > 1) ? ($page_role5 * $data_role5) - $data_role5 : 0;
  $wisata = mysqli_query($conn, "SELECT * FROM wisata JOIN kategori_wisata ON wisata.id_kategori_wisata=kategori_wisata.id_kategori_wisata JOIN fasilitas ON wisata.id_fasilitas=fasilitas.id_fasilitas JOIN kategori_fasilitas ON fasilitas.id_kategori_fasilitas=kategori_fasilitas.id_kategori_fasilitas ORDER BY wisata.id_wisata DESC LIMIT $awal_data_role5, $data_role5");
  $select_kwisata = mysqli_query($conn, "SELECT * FROM kategori_wisata");
  $select_fasilitas = mysqli_query($conn, "SELECT * FROM fasilitas");
  if (isset($_POST['tambah-wisata'])) {
    if (add_wisata($_POST) > 0) {
      $_SESSION['message-success'] = "Wisata berhasil ditambahkan.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['ubah-wisata'])) {
    if (edit_wisata($_POST) > 0) {
      $_SESSION['message-success'] = "Wisata " . $_POST['namaOld'] . " berhasil diubah.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['hapus-wisata'])) {
    if (delete_wisata($_POST) > 0) {
      $_SESSION['message-success'] = "Wisata " . $_POST['namaOld'] . " berhasil dihapus.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }

  if (isset($_POST['tambah-galeri'])) {
    if (add_galeri($_POST) > 0) {
      $_SESSION['message-success'] = "Photo telah ditambahkan ke galeri " . $_POST['namaOld'] . ".";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['hapus-galeri'])) {
    if (delete_galeri($_POST) > 0) {
      $_SESSION['message-success'] = "Photo telah dihapus dari galeri " . $_POST['namaOld'] . ".";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
}
