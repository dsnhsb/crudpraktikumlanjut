<?php
class Database {
    // Pengaturan koneksi database
    private $host = "localhost";
    private $db_name = "toko_belanja"; // GANTI ini jika nama database kamu berbeda
    private $username = "root";
    private $password = ""; // Kosongkan jika menggunakan Laragon standar
    public $conn;

    // Fungsi untuk mendapatkan koneksi database [cite: 297]
    public function getConnection() {
        $this->conn = null;
        try {
            // Menggunakan PDO untuk koneksi yang lebih aman [cite: 300]
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // [cite: 302]
        } catch(PDOException $exception) {
            echo "Koneksi Gagal: " . $exception->getMessage(); // [cite: 305]
        }
        return $this->conn; // [cite: 307]
    }
}
?>