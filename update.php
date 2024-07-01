<?php
include_once 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kodedagri = $_POST['kodedagri'];
    $provinsi = $_POST['provinsi'];
    $kabupaten = $_POST['kabupaten'];
    $kecamatan = $_POST['kecamatan'];
    $jumlah = $_POST['jumlah'];

    $query = "UPDATE kepadatan SET provinsi = '$provinsi', kabupaten = '$kabupaten', kecamatan = '$kecamatan', jumlah = '$jumlah' WHERE kodedagri = '$kodedagri'";
    
    if ($conn->query($query) === TRUE) {
        echo "Data updated successfully.";
    } else {
        echo "Error updating data: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
?>
