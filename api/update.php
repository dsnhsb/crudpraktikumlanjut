<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT"); // Gunakan PUT untuk update [cite: 429]

include_once '../config/Database.php';
include_once '../models/Belanja.php';

$database = new Database();
$db = $database->getConnection();
$belanja = new Belanja($db);

// Ambil data JSON dari body request
$data = json_decode(file_get_contents("php://input"));

// Set properti objek belanja berdasarkan input [cite: 440-443]
$belanja->id = $data->id;
$belanja->nama_barang = $data->nama_barang;
$belanja->harga = $data->harga;
$belanja->jumlah = $data->jumlah;

if($belanja->update()) {
    http_response_code(200);
    echo json_encode(["message" => "Data belanja berhasil diperbarui."]);
} else {
    http_response_code(503);
    echo json_encode(["message" => "Gagal memperbarui data."]);
}
?>