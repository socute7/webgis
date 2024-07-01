<?php
include 'koneksi.php';

$query = "SELECT * FROM kategori";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $kategoris = [];
    while ($row = $result->fetch_assoc()) {
        $kategoris[] = $row;
    }
    echo json_encode($kategoris);
} else {
    echo json_encode(['error' => 'No categories found']);
}

$conn->close();
?>
