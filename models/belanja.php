<?php
class Belanja {
    private $conn;
    private $table_name = "transaksi"; 

    public $id;
    public $nama_barang;
    public $harga;
    public $jumlah;

  
    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query); 
        $stmt->execute(); 
        return $stmt;
    }

   
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (nama_barang, harga, jumlah) VALUES (?, ?, ?)";
        
        $stmt = $this->conn->prepare($query); 
        if ($stmt->execute([$this->nama_barang, $this->harga, $this->jumlah])) { 
            return true; 
        }
        return false;
    }
   
    public function update() {
    $query = "UPDATE " . $this->table_name . " SET nama_barang=?, harga=?, jumlah=? WHERE id=?";
    $stmt = $this->conn->prepare($query);
    return $stmt->execute([$this->nama_barang, $this->harga, $this->jumlah, $this->id]);
    }

    public function delete() {
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    return $stmt->execute([$this->id]);
    }
}
?>