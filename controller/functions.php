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
          'id' => $row['id_admin'],
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
}