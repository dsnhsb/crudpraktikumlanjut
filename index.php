<?php
require 'connection.php';
$stmt = $pdo->query("SELECT * FROM transaksi ORDER BY id DESC");
$belanja = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sistem Transaksi Belanja</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f4; }
        .container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #2ecc71; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .btn { padding: 8px 12px; text-decoration: none; border-radius: 4px; color: white; }
        .btn-add { background-color: #27ae60; margin-bottom: 15px; display: inline-block; }
        .btn-delete { background-color: #e74c3c; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Daftar Belanja Transaksi</h2>
        <a href="tambah.php" class="btn btn-add"> + Tambah Belanja Baru</a>
        
        <table>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
            <?php $no = 1; foreach($belanja as $row): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['nama_barang']); ?></td>
                <td>Rp <?= number_format($row['harga']); ?></td>
                <td><?= $row['jumlah']; ?></td>
                <td>Rp <?= number_format($row['harga'] * $row['jumlah']); ?></td>
                <td>
                    <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-delete" 
                       onclick="return confirm('Hapus transaksi ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>