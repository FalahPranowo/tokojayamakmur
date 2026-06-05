<?php
require_once '../config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $conn->prepare(
            "DELETE FROM produk WHERE id_produk = :id"
        );

        $stmt->execute([
            ':id' => $id
        ]);

        echo "<script>alert('Produk Berhasil Dihapus'); window.location='../public/index.php';</script>";
        exit();

    } catch (PDOException $e) {
        echo "Gagal hapus data: " . $e->getMessage();
    }
} else {
    header("Location: ../public/index.php");
    exit();
}