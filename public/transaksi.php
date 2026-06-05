<?php
require_once '../config/database.php';

try {
    $stmt = $conn->query("SELECT id_produk, nama_barang, harga_jual, stok FROM produk WHERE stok > 0 ORDER BY id_produk ASC");
    $produk_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Gagal mengambil data produk: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Kasir - Toko Jaya Makmur</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', Arial, sans-serif; background-color: #f8fafc; margin: 0; padding: 40px 20px; color: #334155; display: flex; justify-content: center; align-items: center; min-height: 80vh; }
        .card { background: white; padding: 35px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); width: 100%; max-width: 450px; }
        h2 { margin: 0 0 5px 0; color: #1e293b; font-weight: 700; text-align: center; }
        p.subtitle { color: #64748b; margin: 0 0 25px 0; font-size: 14px; text-align: center; }
        label { display: block; margin-bottom: 6px; font-weight: 600; color: #475569; font-size: 14px; }
        select, input { width: 100%; padding: 12px; margin-bottom: 20px; border: 1px solid #cbd5e1; border-radius: 8px; box-sizing: border-box; font-family: inherit; font-size: 14px; outline: none; }
        select:focus, input:focus { border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15); }
        .btn-submit { width: 100%; padding: 12px; background-color: #2563eb; color: white; border: none; border-radius: 8px; font-size: 15px; font-weight: 600; cursor: pointer; }
        .btn-submit:hover { background-color: #1d4ed8; }
        .btn-back { display: block; text-align: center; margin-top: 15px; color: #64748b; text-decoration: none; font-size: 14px; }
    </style>
</head>
<body>

<div class="card">
    <h2>Input Transaksi Baru</h2>
    <p class="subtitle">Sistem Penjualan Kasir Toko Jaya Makmur</p>
    
    <form action="../process/transaction.php" method="POST">
        <label for="id_produk">Pilih Produk</label>
        <select name="id_produk" id="id_produk" required>
            <option value="">-- Pilih Barang --</option>
            <?php foreach ($produk_list as $p): ?>
                <option value="<?= trim($p['id_produk']); ?>">
                    <?= htmlspecialchars($p['id_produk']); ?> - <?= htmlspecialchars($p['nama_barang']); ?> (Stok: <?= $p['stok']; ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <label for="jumlah_jual">Jumlah Beli</label>
        <input type="number" name="jumlah_jual" id="jumlah_jual" min="1" placeholder="Masukkan kuantitas barang" required>

        <button type="submit" name="submit_transaksi" class="btn-submit">Proses Transaksi</button>
        <a href="index.php" class="btn-back">Kembali ke Dashboard</a>
    </form>
</div>

</body>
</html>