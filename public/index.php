<?php
require_once '../config/database.php';

$stmt = $conn->query("SELECT * FROM produk");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Toko Jaya Makmur</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 40px 20px;
            color: #334155;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        h2 {
            margin: 0;
            color: #1e293b;
            font-weight: 700;
            font-size: 28px;
        }

        .search-box {
            padding: 10px 16px;
            width: 250px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-family: inherit;
            font-size: 14px;
            outline: none;
            transition: 0.3s;
        }

        .search-box:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
        }

        .table-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th, td {
            padding: 16px 20px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
        }

        th {
            background-color: #f8fafc;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        tr:hover {
            background-color: #f8fafc;
            transition: background-color 0.2s ease;
        }

        .badge-stok {
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
            text-align: center;
            min-width: 80px;
        }
        .stok-aman { background-color: #d1fae5; color: #065f46; }      
        .stok-menipis { background-color: #fef3c7; color: #92400e; }   
        .stok-kritis { background-color: #fee2e2; color: #991b1b; }    

        .btn-group-nav {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
        }

        .btn {
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 8px;
            color: white;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            transition: all 0.2s ease;
        }

        .btn-tambah { 
            background-color: #10b981; 
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        }
        .btn-tambah:hover { background-color: #059669; transform: translateY(-1px); }

        .btn-kasir {
            background-color: #2563eb;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }
        .btn-kasir:hover { background-color: #1d4ed8; transform: translateY(-1px); }

        .btn-edit { background-color: #f59e0b; padding: 6px 12px; font-size: 13px; font-weight: 500; }
        .btn-edit:hover { background-color: #d97706; }

        .btn-hapus { background-color: #ef4444; padding: 6px 12px; font-size: 13px; font-weight: 500; }
        .btn-hapus:hover { background-color: #dc2626; }
        
        .action-group {
            display: flex;
            gap: 8px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header-section">
        <div>
            <h2>Toko Jaya Makmur</h2>
            <p style="color: #64748b; margin: 5px 0 0 0; font-size: 14px;">Sistem Manajemen Stok dan Inventori Produk</p>
        </div>
        <input type="text" id="searchInput" class="search-box" placeholder="Cari nama barang...">
    </div>

    <div class="btn-group-nav">
        <a href="tambah.php" class="btn btn-tambah">Tambah Barang</a>
        <a href="transaksi.php" class="btn btn-kasir">Menu Kasir</a>
    </div>

    <div class="table-container">
        <table border="0" id="productTable">
            <thead>
                <tr>
                    <th>ID Produk</th>
                    <th>Nama Barang</th>
                    <th>Harga Jual</th>
                    <th>Sisa Stok</th>
                    <th>ID Kategori</th>
                    <th style="text-align: center;">Aksi Manajemen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                <tr>
                    <td style="font-weight: 600; color: #64748b;"><?= $row['id_produk']; ?></td>
                    <td style="font-weight: 600; color: #1e293b;"><?= $row['nama_barang']; ?></td>
                    <td style="font-weight: 600; color: #10b981;">Rp <?= number_format($row['harga_jual'], 0, ',', '.'); ?></td>
                    
                    <td>
                        <?php 
                        $stok = $row['stok'];
                        if ($stok < 10) {
                            echo "<span class='badge-stok stok-kritis'>$stok pcs</span>";
                        } elseif ($stok >= 10 && $stok <= 50) {
                            echo "<span class='badge-stok stok-menipis'>$stok pcs</span>";
                        } else {
                            echo "<span class='badge-stok stok-aman'>$stok pcs</span>";
                        }
                        ?>
                    </td>
                    
                    <td><span style="background: #f1f5f9; padding: 4px 8px; border-radius: 6px; font-size: 12px; font-weight: 500; color: #475569;"><?= $row['id_kategori']; ?></span></td>
                    
                    <td>
                        <div class="action-group" style="justify-content: center;">
                            <a href="edit.php?id=<?= $row['id_produk']; ?>" class="btn btn-edit">Edit</a>
                            <a href="hapus.php?id=<?= $row['id_produk']; ?>" class="btn btn-hapus" onclick="return confirm('Apakah kamu yakin ingin menghapus produk <?= $row['nama_barang']; ?>?')">Hapus</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toUpperCase();
        let rows = document.querySelectorAll('#productTable tbody tr');
        
        rows.forEach(row => {
            let namaBarang = row.cells[1].textContent || row.cells[1].innerText;
            if (namaBarang.toUpperCase().indexOf(filter) > -1) {
                row.style.display = ""; 
            } else {
                row.style.display = "none"; 
            }
        });
    });
</script>

</body>
</html>