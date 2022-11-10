<?php
$conn = mysqli_connect("localhost", "root", "", "sig_rote");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
