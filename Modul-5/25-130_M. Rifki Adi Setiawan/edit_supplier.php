<?php
require_once "koneksi.php";

$id = $_GET['id'];
$stmt = $DBH->prepare("SELECT * FROM supplier WHERE id = ?");
$stmt->execute([$id]);
$supplier = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $update = $DBH->prepare("UPDATE supplier SET nama = ?, telp = ?, alamat = ? WHERE id = ?");
    if ($update->execute([$nama, $telp, $alamat, $id])) {
        header("Location: supplier.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit Supplier</title></head>
<body>
    <h2>Edit Data Master Supplier</h2>
    <form method="POST" action="">
        <table>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?= htmlspecialchars($supplier['nama']) ?>" required></td>
            </tr>
            <tr>
                <td>Telp</td>
                <td><input type="text" name="telp" value="<?= htmlspecialchars($supplier['telp']) ?>" required></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat" value="<?= htmlspecialchars($supplier['alamat']) ?>" required></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" style="background: green; color: white;">Update</button>
                    <a href="supplier.php" style="background: red; color: white; text-decoration: none; padding: 2px 5px;">Batal</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>