<?php
require 'connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];

    $sql = "INSERT INTO transaksi (nama_barang, harga, jumlah) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$nama, $harga, $jumlah])) {
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Belanja</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; justify-content: center; margin-top: 50px; background-color: #f4f4f4; }
        form { background: white; padding: 30px; border-radius: 8px; width: 300px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #27ae60; color: white; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>
    <form method="POST">
        <h3>Tambah Transaksi</h3>
        <label>Nama Barang:</label>
        <input type="text" name="nama_barang" required>
        <label>Harga Satuan:</label>
        <input type="number" name="harga" required>
        <label>Jumlah:</label>
        <input type="number" name="jumlah" required>
        <button type="submit">Simpan Belanja</button>
        <br><br>
        <a href="index.php" style="text-decoration:none; color: #7f8c8d; font-size: 14px;"> Kembali</a>
    </form>
</body>
</html>