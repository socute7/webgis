<?php
$conn = new mysqli("localhost", "root", "", "batubara");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
