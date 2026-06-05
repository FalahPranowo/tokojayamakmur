<?php
$host = "localhost";
$dbname = "tokojayamakmur";
$username = "root";
$password = "";
try {
$conn = new PDO(
"mysql:host=$host;port=3307;dbname=$dbname;charset=utf8",
$username,
$password
);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
die("Koneksi database gagal: " . $e->getMessage());
}
