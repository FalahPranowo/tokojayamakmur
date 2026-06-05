<?php
require_once '../config/database.php';

try {
    $stmt = $conn->prepare(
        "INSERT INTO produk (id_produk, nama_barang, harga_jual, stok, id_kategori, id_supplier)
         VALUES (:id_produk, :nama_barang, :harga_jual, :stok, :id_kategori, :id_supplier)"
    );

    $stmt->execute([
        ':id_produk'   => $_POST['id_produk'],
        ':nama_barang' => $_POST['nama_barang'],
        ':harga_jual'  => $_POST['harga_jual'],
        ':stok'        => $_POST['stok'],
        ':id_kategori' => $_POST['id_kategori'],
        ':id_supplier' => $_POST['id_supplier']
    ]);

    header("Location: ../public/index.php?status=sukses");
    exit();

} catch (PDOException $e) {
    echo "Gagal menambah data produk: " . $e->getMessage();
}
?>