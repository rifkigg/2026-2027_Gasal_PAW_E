<?php
require_once "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $DBH->prepare("DELETE FROM supplier WHERE id = ?");
    if ($stmt->execute([$id])) {
        header("Location: supplier.php");
        // exit;
    }
}
?>