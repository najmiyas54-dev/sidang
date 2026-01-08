<?php
require_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

if($db) {
    echo "Koneksi database berhasil!";
} else {
    echo "Koneksi database gagal!";
}
?>