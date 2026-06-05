<?php

require_once '../config/database.php';

// PERBAIKAN: Mengubah 'id_barang' menjadi 'id' agar singkron dengan index.php
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    $stmt = $conn->prepare("SELECT nama_barang FROM produk WHERE id_produk = :id");
    $stmt->execute([':id' => $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        die("Data tidak ditemukan.");
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Hapus - dbalfa</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f4f9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 8px 16px rgba(0,0,0,0.1); width: 100%; max-width: 400px; text-align: center; }
        h2 { color: #d32f2f; margin-top: 0; }
        .barang-info { font-weight: bold; color: #333; background: #f9f9f9; padding: 15px; border-radius: 6px; border: 1px dashed #ccc; margin: 20px 0; }
        .btn-group { display: flex; gap: 10px; }
        .btn { flex: 1; padding: 12px; border-radius: 6px; border: none; font-size: 16px; cursor: pointer; text-decoration: none; transition: 0.3s; color: white; }
        .btn-delete { background-color: #dc3545; }
        .btn-delete:hover { background-color: #c82333; }
        .btn-cancel { background-color: #6c757d; }
        .btn-cancel:hover { background-color: #5a6268; }
    </style>
</head>
<body>

<div class="card">
    <h2>Hapus Produk?</h2>
    <p>Apakah kamu yakin ingin menghapus produk ini secara permanen?</p>
    
    <div class="barang-info">
        <?php echo htmlspecialchars($row['nama_barang']); ?> <br>
        <small>(ID: <?php echo htmlspecialchars($id); ?>)</small>
    </div>
    
    <div class="btn-group">
        <a href="../process/delete.php?id=<?php echo urlencode($id); ?>" class="btn btn-delete">Ya, Hapus</a>
        <a href="index.php" class="btn btn-cancel">Batal</a>
    </div>
</div>

</body>
</html>