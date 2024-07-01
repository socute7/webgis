<?php
session_start();

if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
  header("Location: admin-login.php");
  exit;
}

include_once 'koneksi.php';

$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$kategori = $_POST['kategori'];
$foto = $_POST['foto'];

$query = "INSERT INTO lokasi (nama, alamat, lat, lng, kategori, foto) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssddss", $nama, $alamat, $lat, $lng, $kategori, $foto);

if ($stmt->execute()) {
  echo json_encode(['status' => 'success']);
} else {
  echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan lokasi']);
}

$stmt->close();
$conn->close();
?>
