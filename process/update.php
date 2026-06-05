<?php
require_once '../config/database.php';

try {
    $aksi_stok = $_POST['aksi_stok'];
    $jumlah_stok = isset($_POST['jumlah_stok']) ? intval($_POST['jumlah_stok']) : 0;
    $id_produk = $_POST['id_produk'];

    if ($aksi_stok === 'kurang') {
        $stmt_cek = $conn->prepare("SELECT stok FROM produk WHERE id_produk = :id");
        $stmt_cek->execute([':id' => $id_produk]);
        $produk = $stmt_cek->fetch(PDO::FETCH_ASSOC);

        if ($produk['stok'] < $jumlah_stok) {
            echo "<script>alert('Gagal! Jumlah pengurangan melebihi stok yang ada saat ini.'); window.location='../public/edit.php?id=" . $id_produk . "';</script>";
            exit();
        }

        $query = "UPDATE produk 
                  SET nama_barang = :nama_barang, 
                      harga_jual = :harga_jual, 
                      stok = stok - :jumlah_stok, 
                      id_kategori = :id_kategori 
                  WHERE id_produk = :id_produk";
    } else {
        $query = "UPDATE produk 
                  SET nama_barang = :nama_barang, 
                      harga_jual = :harga_jual, 
                      stok = stok + :jumlah_stok, 
                      id_kategori = :id_kategori 
                  WHERE id_produk = :id_produk";
    }

    $stmt = $conn->prepare($query);
    $stmt->execute([
        ':nama_barang' => $_POST['nama_barang'],
        ':harga_jual'  => $_POST['harga_jual'],
        ':jumlah_stok' => $jumlah_stok,
        ':id_kategori' => $_POST['id_kategori'],
        ':id_produk'   => $id_produk
    ]);

    header("Location: ../public/index.php?status=updated");
    exit();

} catch (PDOException $e) {
    echo "Gagal update data produk: " . $e->getMessage();
}