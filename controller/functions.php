<?php
if (!isset($_SESSION['data-user'])) {
  function masuk($data)
  {
    global $conn;
    $email = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
    $password = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password']))));

    // check account
    $checkAccount = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($checkAccount) == 0) {
      $_SESSION['message-danger'] = "Maaf, akun yang anda masukan belum terdaftar.";
      $_SESSION['time-message'] = time();
      return false;
    } else if (mysqli_num_rows($checkAccount) > 0) {
      $row = mysqli_fetch_assoc($checkAccount);
      if (password_verify($password, $row['password'])) {
        $_SESSION['data-user'] = [
          'id' => $row['id_user'],
          'email' => $row['email'],
          'username' => $row['username'],
        ];
      } else {
        $_SESSION['message-danger'] = "Maaf, kata sandi yang anda masukan salah.";
        $_SESSION['time-message'] = time();
        return false;
      }
    }
  }
}

if (isset($_SESSION['data-user'])) {
  function edit_profile($data)
  {
    global $conn, $idUser;
    $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['username']))));
    $password = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password']))));
    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "UPDATE users SET username='$username', password='$password' WHERE id_user='$idUser'");
    return mysqli_affected_rows($conn);
  }
  function add_user($data)
  {
    global $conn;
    $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['username']))));
    $email = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
    $checkEmail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($checkEmail) > 0) {
      $_SESSION['message-danger'] = "Maaf, email yang anda masukan sudah terdaftar.";
      $_SESSION['time-message'] = time();
      return false;
    }
    $password = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password']))));
    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO users(username,email,password) VALUES('$username','$email','$password')");
    return mysqli_affected_rows($conn);
  }
  function edit_user($data)
  {
    global $conn, $time;
    $id_user = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
    $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['username']))));
    $email = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
    $emailOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['emailOld']))));
    if ($email != $emailOld) {
      $checkEmail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
      if (mysqli_num_rows($checkEmail) > 0) {
        $_SESSION['message-danger'] = "Maaf, email yang anda masukan sudah terdaftar.";
        $_SESSION['time-message'] = time();
        return false;
      }
    }
    $updated_at = date("Y-m-d " . $time);
    mysqli_query($conn, "UPDATE users SET username='$username', email='$email', updated_at='$updated_at' WHERE id_user='$id_user'");
    return mysqli_affected_rows($conn);
  }
  function delete_user($data)
  {
    global $conn;
    $id_user = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
    mysqli_query($conn, "DELETE FROM users WHERE id_user='$id_user'");
    return mysqli_affected_rows($conn);
  }
  function add_kfasilitas($data)
  {
    global $conn;
    $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
    $checkNama = mysqli_query($conn, "SELECT * FROM kategori_fasilitas WHERE nama_kfasilitas='$nama'");
    if (mysqli_num_rows($checkNama) > 0) {
      $_SESSION['message-danger'] = "Maaf, nama kategori fasilitas " . $nama . " sudah ada.";
      $_SESSION['time-message'] = time();
      return false;
    }
    mysqli_query($conn, "INSERT INTO kategori_fasilitas(nama_kfasilitas) VALUES('$nama')");
    return mysqli_affected_rows($conn);
  }
  function edit_kfasilitas($data)
  {
    global $conn;
    $id = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id']))));
    $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
    $namaOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['namaOld']))));
    if ($nama != $namaOld) {
      $checkNama = mysqli_query($conn, "SELECT * FROM kategori_fasilitas WHERE nama_kfasilitas='$nama'");
      if (mysqli_num_rows($checkNama) > 0) {
        $_SESSION['message-danger'] = "Maaf, nama kategori fasilitas " . $nama . " sudah ada.";
        $_SESSION['time-message'] = time();
        return false;
      }
    }
    mysqli_query($conn, "UPDATE kategori_fasilitas SET nama_kfasilitas='$nama' WHERE id_kategori_fasilitas='$id'");
    return mysqli_affected_rows($conn);
  }
  function delete_kfasilitas($data)
  {
    global $conn;
    $id = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id']))));
    mysqli_query($conn, "DELETE FROM kategori_fasilitas WHERE id_kategori_fasilitas='$id'");
    return mysqli_affected_rows($conn);
  }
  function add_fasilitas($data)
  {
    global $conn;
    $id_kfasilitas = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-kfasilitas']))));
    $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
    $checkNama = mysqli_query($conn, "SELECT * FROM fasilitas WHERE nama_fasilitas='$nama'");
    if (mysqli_num_rows($checkNama) > 0) {
      $_SESSION['message-danger'] = "Maaf, nama fasilitas " . $nama . " sudah ada.";
      $_SESSION['time-message'] = time();
      return false;
    }
    $keterangan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['keterangan']))));
    if (empty($keterangan)) {
      $keterangan = "-";
    }
    mysqli_query($conn, "INSERT INTO fasilitas(id_kategori_fasilitas,nama_fasilitas,keterangan) VALUES('$id_kfasilitas','$nama','$keterangan')");
    return mysqli_affected_rows($conn);
  }
  function edit_fasilitas($data)
  {
    global $conn, $time;
    $id = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id']))));
    $id_kfasilitas = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-kfasilitas']))));
    $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
    $namaOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['namaOld']))));
    if ($nama != $namaOld) {
      $checkNama = mysqli_query($conn, "SELECT * FROM fasilitas WHERE nama_fasilitas='$nama'");
      if (mysqli_num_rows($checkNama) > 0) {
        $_SESSION['message-danger'] = "Maaf, nama fasilitas " . $nama . " sudah ada.";
        $_SESSION['time-message'] = time();
        return false;
      }
    }
    $keterangan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['keterangan']))));
    if (empty($keterangan)) {
      $keterangan = "-";
    }
    $updated_at = date("Y-m-d " . $time);
    mysqli_query($conn, "UPDATE fasilitas SET id_kategori_fasilitas='$id_kfasilitas', nama_fasilitas='$nama', keterangan='$keterangan', updated_at='$updated_at' WHERE id_fasilitas='$id'");
    return mysqli_affected_rows($conn);
  }
  function delete_fasilitas($data)
  {
    global $conn;
    $id = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id']))));
    mysqli_query($conn, "DELETE FROM fasilitas WHERE id_fasilitas='$id'");
    return mysqli_affected_rows($conn);
  }
  function add_kwisata($data)
  {
    global $conn;
    $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
    $checkNama = mysqli_query($conn, "SELECT * FROM kategori_wisata WHERE nama_kwisata='$nama'");
    if (mysqli_num_rows($checkNama) > 0) {
      $_SESSION['message-danger'] = "Maaf, nama kategori wisata " . $nama . " sudah ada.";
      $_SESSION['time-message'] = time();
      return false;
    }
    mysqli_query($conn, "INSERT INTO kategori_wisata(nama_kwisata) VALUES('$nama')");
    return mysqli_affected_rows($conn);
  }
  function edit_kwisata($data)
  {
    global $conn;
    $id = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id']))));
    $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
    $namaOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['namaOld']))));
    if ($nama != $namaOld) {
      $checkNama = mysqli_query($conn, "SELECT * FROM kategori_wisata WHERE nama_kwisata='$nama'");
      if (mysqli_num_rows($checkNama) > 0) {
        $_SESSION['message-danger'] = "Maaf, nama kategori wisata " . $nama . " sudah ada.";
        $_SESSION['time-message'] = time();
        return false;
      }
    }
    mysqli_query($conn, "UPDATE kategori_wisata SET nama_kwisata='$nama' WHERE id_kategori_wisata='$id'");
    return mysqli_affected_rows($conn);
  }
  function delete_kwisata($data)
  {
    global $conn;
    $id = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id']))));
    mysqli_query($conn, "DELETE FROM kategori_wisata WHERE id_kategori_wisata='$id'");
    return mysqli_affected_rows($conn);
  }
  function imageWisata()
  {
    $namaFile = $_FILES["image"]["name"];
    $ukuranFile = $_FILES["image"]["size"];
    $error = $_FILES["image"]["error"];
    $tmpName = $_FILES["image"]["tmp_name"];
    if ($error === 4) {
      $_SESSION['message-danger'] = "Pilih gambar terlebih dahulu!";
      $_SESSION['time-message'] = time();
      return false;
    }
    $ekstensiGambarValid = ['jpg', 'png', 'jpeg', 'heic'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
      $_SESSION['message-danger'] = "Maaf, file kamu bukan gambar!";
      $_SESSION['time-message'] = time();
      return false;
    }
    if ($ukuranFile > 2000000) {
      $_SESSION['message-danger'] = "Maaf, ukuran gambar terlalu besar! (2 MB)";
      $_SESSION['time-message'] = time();
      return false;
    }
    $namaFile_encrypt = crc32($namaFile);
    $encrypt = $namaFile_encrypt . "." . $ekstensiGambar;
    move_uploaded_file($tmpName, '../assets/images/wisata/' . $encrypt);
    return $encrypt;
  }
  function add_wisata($data)
  {
    global $conn;
    $id_kwisata = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-kwisata']))));
    $id_fasilitas = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-fasilitas']))));
    $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
    $checkNama = mysqli_query($conn, "SELECT * FROM wisata WHERE nama_wisata='$nama'");
    if (mysqli_num_rows($checkNama) > 0) {
      $_SESSION['message-danger'] = "Maaf, nama wisata " . $nama . " sudah ada.";
      $_SESSION['time-message'] = time();
      return false;
    }
    $alamat = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['alamat']))));
    $deskripsi = $data['deskripsi'];
    $longitude = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['longitude']))));
    $latitude = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['latitude']))));
    $image = imageWisata();
    if (!$image) {
      return false;
    }
    mysqli_query($conn, "INSERT INTO wisata(id_kategori_wisata,id_fasilitas,image,nama_wisata,deskripsi,alamat,longitude,latitude) VALUES('$id_kwisata','$id_fasilitas','$image','$nama','$deskripsi','$alamat','$longitude','$latitude')");
    return mysqli_affected_rows($conn);
  }
  function edit_wisata($data)
  {
    global $conn, $time;
    $id = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id']))));
    $id_kwisata = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-kwisata']))));
    $id_fasilitas = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-fasilitas']))));
    $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
    $namaOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['namaOld']))));
    if ($nama != $namaOld) {
      $checkNama = mysqli_query($conn, "SELECT * FROM wisata WHERE nama_wisata='$nama'");
      if (mysqli_num_rows($checkNama) > 0) {
        $_SESSION['message-danger'] = "Maaf, nama wisata " . $nama . " sudah ada.";
        $_SESSION['time-message'] = time();
        return false;
      }
    }
    $alamat = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['alamat']))));
    $deskripsi = $data['deskripsi'];
    $longitude = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['longitude']))));
    $latitude = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['latitude']))));
    $imageOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['imageOld']))));
    if (!empty($_FILES['image']["name"])) {
      $image = imageWisata();
      if (!$image) {
        return false;
      } else {
        unlink('../assets/images/wisata/' . $imageOld);
      }
    } else {
      $image = $imageOld;
    }
    $updated_at = date("Y-m-d " . $time);
    mysqli_query($conn, "UPDATE wisata SET id_kategori_wisata='$id_kwisata', id_fasilitas='$id_fasilitas', image='$image', nama_wisata='$nama', deskripsi='$deskripsi', alamat='$alamat', longitude='$longitude', latitude='$latitude', updated_at='$updated_at' WHERE id_wisata='$id'");
    return mysqli_affected_rows($conn);
  }
  function delete_wisata($data)
  {
    global $conn;
    $id = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id']))));
    $imageOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['imageOld']))));
    unlink('../assets/images/wisata/' . $imageOld);
    mysqli_query($conn, "DELETE FROM wisata WHERE id_wisata='$id'");
    return mysqli_affected_rows($conn);
  }
  function imageGaleri()
  {
    $namaFile = $_FILES["image"]["name"];
    $ukuranFile = $_FILES["image"]["size"];
    $error = $_FILES["image"]["error"];
    $tmpName = $_FILES["image"]["tmp_name"];
    if ($error === 4) {
      $_SESSION['message-danger'] = "Pilih gambar terlebih dahulu!";
      $_SESSION['time-message'] = time();
      return false;
    }
    $ekstensiGambarValid = ['jpg', 'png', 'jpeg', 'heic'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
      $_SESSION['message-danger'] = "Maaf, file kamu bukan gambar!";
      $_SESSION['time-message'] = time();
      return false;
    }
    if ($ukuranFile > 2000000) {
      $_SESSION['message-danger'] = "Maaf, ukuran gambar terlalu besar! (2 MB)";
      $_SESSION['time-message'] = time();
      return false;
    }
    $namaFile_encrypt = crc32($namaFile);
    $encrypt = $namaFile_encrypt . "." . $ekstensiGambar;
    move_uploaded_file($tmpName, '../assets/images/wisata/album/' . $encrypt);
    return $encrypt;
  }
  function add_galeri($data)
  {
    global $conn;
    $id = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id']))));
    $image = imageGaleri();
    if (!$image) {
      return false;
    }
    mysqli_query($conn, "INSERT INTO galeri(id_wisata,image_gwisata) VALUES('$id','$image')");
    return mysqli_affected_rows($conn);
  }
  function delete_galeri($data)
  {
    global $conn;
    $id = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id']))));
    $imageOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['imageOld']))));
    unlink('../assets/images/wisata/album/' . $imageOld);
    mysqli_query($conn, "DELETE FROM galeri WHERE id_galeri='$id'");
    return mysqli_affected_rows($conn);
  }
}
