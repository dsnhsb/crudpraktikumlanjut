<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST"); 

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["message" => "Method tidak diizinkan."]);
    exit;
}

include_once '../config/Database.php';
include_once '../models/Belanja.php';

$database = new Database();
$db = $database->getConnection();

$belanja = new Belanja($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->nama_barang) && !empty($data->harga) && !empty($data->jumlah)) {
    
    $belanja->nama_barang = $data->nama_barang;
    $belanja->harga = $data->harga;
    $belanja->jumlah = $data->jumlah;

  
    if($belanja->create()) {
        http_response_code(201);  
        echo json_encode(array("message" => "Data belanja berhasil ditambahkan.")); 
    } else {
        http_response_code(503); 
        echo json_encode(array("message" => "Gagal menambahkan data belanja."));
    }
} else {
    http_response_code(400); 
    echo json_encode(array("message" => "Data tidak lengkap."));
}
?>