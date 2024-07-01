<?php
include_once 'koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$kategori = $_POST['kategori'];
$foto = $_POST['foto'];

$query = "UPDATE lokasi SET nama = ?, alamat = ?, lat = ?, lng = ?, kategori = ?, foto = ? WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ssddssi', $nama, $alamat, $lat, $lng, $kategori, $foto, $id);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
