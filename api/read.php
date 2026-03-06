<?php
// Header wajib untuk API agar output berupa JSON dan bisa diakses publik
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET"); // Menggunakan GET sesuai modul

// Cek apakah method yang digunakan adalah GET
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(["message" => "Method tidak diizinkan."]);
    exit;
}

// Import file koneksi dan model belanja
include_once '../config/Database.php';
include_once '../models/Belanja.php';

// Inisialisasi Database dan Model
$database = new Database();
$db = $database->getConnection();
$belanja = new Belanja($db);

// Panggil fungsi read() dari Class Belanja
$stmt = $belanja->read();
$num = $stmt->rowCount();

// Periksa apakah ada data di tabel
if($num > 0) {
    $belanja_arr = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        
        // Susun data ke dalam array sesuai kolom tabel Anda
        $item = array(
            "id" => $id,
            "nama_barang" => $nama_barang,
            "harga" => $harga,
            "jumlah" => $jumlah
        );

        array_push($belanja_arr, $item);
    }

    // Kirim respon sukses 200 OK dengan data JSON
    http_response_code(200);
    echo json_encode($belanja_arr);
} else {
    // Kirim respon 404 jika data kosong
    http_response_code(404);
    echo json_encode(array("message" => "Data belanja tidak ditemukan."));
}
?>