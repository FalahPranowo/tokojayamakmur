<?php
require_once '../config/database.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM produk WHERE id_produk = :id");
$stmt->execute([':id' => $id]);
$produk = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produk) {
    echo "<script>alert('Produk tidak ditemukan!'); window.location='index.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Toko Jaya Makmur</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 40px 20px;
            color: #334155;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
        }
        .card {
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 450px;
        }
        h2 { margin: 0 0 20px 0; color: #1e293b; font-weight: 700; text-align: center; }
        label { display: block; margin-bottom: 6px; font-weight: 600; color: #475569; font-size: 14px; }
        input, select { width: 100%; padding: 12px; margin-bottom: 20px; border: 1px solid #cbd5e1; border-radius: 8px; box-sizing: border-box; font-family: inherit; font-size: 14px; outline: none; }
        input:focus, select:focus { border-color: #f59e0b; box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.15); }
        input[readonly] { background-color: #f1f5f9; color: #64748b; cursor: not-allowed; }
        .btn-submit { width: 100%; padding: 12px; background-color: #f59e0b; color: white; border: none; border-radius: 8px; font-size: 15px; font-weight: 600; cursor: pointer; }
        .btn-submit:hover { background-color: #d97706; }
        .btn-back { display: block; text-align: center; margin-top: 15px; color: #64748b; text-decoration: none; font-size: 14px; }
    </style>
</head>
<body>

<div class="card">
    <h2>Edit Produk</h2>
    <form action="../process/update.php" method="POST">
        <input type="hidden" name="id_produk" value="<?= $produk['id_produk']; ?>">

        <label>Nama Barang</label>
        <input type="text" name="nama_barang" value="<?= htmlspecialchars($produk['nama_barang']); ?>" required>

        <label>Harga Jual</label>
        <input type="number" name="harga_jual" value="<?= $produk['harga_jual']; ?>" required>

        <label>Stok Saat Ini</label>
        <input type="text" value="<?= $produk['stok']; ?> pcs" readonly>

        <label>Aksi Stok</label>
        <select name="aksi_stok" required>
            <option value="tambah">Tambah Stok (+)</option>
            <option value="kurang">Kurang Stok (-)</option>
        </select>

        <label>Jumlah Perubahan Stok</label>
        <input type="number" name="jumlah_stok" min="0" value="0" required>

        <label>ID Kategori</label>
        <input type="text" name="id_kategori" value="<?= htmlspecialchars($produk['id_kategori']); ?>" required>

        <button type="submit" name="submit_update" class="btn-submit">Simpan Perubahan</button>
        <a href="index.php" class="btn-back">Batal</a>
    </form>
</div>

</body>
</html>