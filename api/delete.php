<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE"); // Gunakan DELETE [cite: 458]

include_once '../config/Database.php';
include_once '../models/Belanja.php';

$database = new Database();
$db = $database->getConnection();
$belanja = new Belanja($db);

$data = json_decode(file_get_contents("php://input"));
$belanja->id = $data->id; // Hanya butuh ID untuk menghapus [cite: 469]

if($belanja->delete()) {
    http_response_code(200);
    echo json_encode(["message" => "Data belanja berhasil dihapus."]);
} else {
    http_response_code(503);
    echo json_encode(["message" => "Gagal menghapus data."]);
}
?>