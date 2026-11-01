<?php
require_once "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $stmt = $DBH->prepare("INSERT INTO supplier (nama, telp, alamat) VALUES (?, ?, ?)");
    if ($stmt->execute([$nama, $telp, $alamat])) {
        header("Location: supplier.php");
        // exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Tambah Supplier</title></head>
<body>
    <h2>Tambah Data Master Supplier Baru</h2>
    <form method="POST" action="">
        <table>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" placeholder="Nama" required></td>
            </tr>
            <tr>
                <td>Telp</td>
                <td><input type="text" name="telp" placeholder="Telp" required></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat" placeholder="Alamat" required></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" style="background: green; color: white;">Simpan</button>
                    <a href="supplier.php" style="background: red; color: white; text-decoration: none; padding: 2px 5px;">Batal</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>