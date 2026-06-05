<?php

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk Baru</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #eceff1; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 8px 16px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        h2 { text-align: center; color: #2e7d32; margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: 600; color: #444; }
        input { width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; transition: 0.3s; }
        input:focus { border-color: #4CAF50; outline: none; box-shadow: 0 0 8px rgba(76, 175, 80, 0.2); }
        button { width: 100%; padding: 12px; background: #4CAF50; color: white; border: none; border-radius: 6px; font-size: 16px; cursor: pointer; transition: 0.3s; }
        button:hover { background: #45a049; }
        .btn-back { display: block; text-align: center; margin-top: 15px; color: #777; text-decoration: none; font-size: 14px; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Tambah Produk</h2>
        <form action="../process/insert.php" method="POST">
            <label>ID Produk</label>
            <input type="text" name="id_produk" placeholder="Contoh: P005" required>
            
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" placeholder="Nama Produk" required>
            
            <label>Harga Jual</label>
            <input type="number" name="harga_jual" placeholder="Rp" required>
            
            <label>Stok</label>
            <input type="number" name="stok" placeholder="0" required>
            
            <label>Kategori</label>
            <input type="text" name="id_kategori" placeholder="Contoh: K01" required>

            <label>ID Supplier</label>
            <input type="text" name="id_supplier" placeholder="Contoh: S01" required>
            
            <button type="submit" name="submit">Simpan Produk</button>
            
            <a href="index.php" class="btn-back">← Kembali ke Daftar</a>
        </form>
    </div>
</body>
</html>