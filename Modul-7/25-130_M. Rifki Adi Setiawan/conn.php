<?php
$host     = "localhost";
$port     = 3306;
$username = "root";
$password = "";
$database = "toko";

try {
  $conn = new PDO(
    "mysql:host={$host};port={$port};dbname={$database};charset=utf8mb4",
    $username,
    $password,
    [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES   => false,
    ]
  );

  // Menyediakan alias $DBH untuk kompatibilitas jika dibutuhkan
  $DBH = $conn;
} catch (PDOException $e) {
  die("Koneksi Database Gagal: " . $e->getMessage());
}
