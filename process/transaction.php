<?php
require_once '../config/database.php';

if (isset($_POST['submit_transaksi'])) {
    $id_produk = trim($_POST['id_produk']);
    $jumlah_jual = intval($_POST['jumlah_jual']);

    try {
        $stmt_produk = $conn->prepare("SELECT harga_jual, stok FROM produk WHERE TRIM(id_produk) = :id");
        $stmt_produk->execute([':id' => $id_produk]);
        $produk = $stmt_produk->fetch(PDO::FETCH_ASSOC);

        if (!$produk) {
            echo "<script>alert('Error: ID Produk (" . $id_produk . ") tidak ditemukan di tabel produk!'); window.location='../public/transaksi.php';</script>";
            exit();
        }

        if ($produk['stok'] < $jumlah_jual) {
            echo "<script>alert('Stok tidak mencukupi! Sisa stok saat ini: " . $produk['stok'] . " pcs'); window.location='../public/transaksi.php';</script>";
            exit();
        }

        $total_harga = $produk['harga_jual'] * $jumlah_jual;
        $id_transaksi = strtoupper(substr(uniqid('TR'), 0, 10));

        $conn->beginTransaction();

        $stmt_update_stok = $conn->prepare("UPDATE produk SET stok = stok - :jumlah WHERE TRIM(id_produk) = :id");
        $stmt_update_stok->execute([
            ':jumlah' => $jumlah_jual,
            ':id' => $id_produk
        ]);

        $stmt_insert_penjualan = $conn->prepare("INSERT INTO transaksi (id_transaksi, id_produk, jumlah_beli, total_bayar) VALUES (:id_transaksi, :id_produk, :jumlah_beli, :total_bayar)");
        $stmt_insert_penjualan->execute([
            ':id_transaksi' => $id_transaksi,
            ':id_produk'    => $id_produk,
            ':jumlah_beli'  => $jumlah_jual,
            ':total_bayar'  => $total_harga
        ]);

        $conn->commit();

        echo "<script>alert('Transaksi berhasil diproses!'); window.location='../public/index.php';</script>";
        exit();

    } catch (PDOException $e) {
        if ($conn->inTransaction()) {
            $conn->rollBack();
        }
        die("Gagal memproses transaksi. Pesan Error: " . $e->getMessage());
    }
} else {
    header("Location: ../public/index.php");
    exit();
}