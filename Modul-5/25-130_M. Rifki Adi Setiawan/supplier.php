<?php  
    require_once "koneksi.php";

    $suppliers = $DBH->prepare("SELECT * FROM supplier");
    $suppliers->execute();
    $data = $suppliers->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Rifki - Data Supplier</title>
    <style>
        .wrap { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;}
        .tombol { padding: 10px 15px; border: none; display: inline-block; border-radius: 5px; text-decoration: none; color: white; cursor: pointer; }
        .tambah { background: #5cb85c; }
        .edit { background: #f0ad4e; margin-right: 5px; }
        .hapus { background: #d9534f; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="wrap">
        <h2>Data Master Supplier</h2>
        <a href="tambah_supplier.php" class="tombol tambah">Tambah Data</a>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Telp</th>
            <th>Alamat</th>
            <th>Tindakan</th>
        </tr>
        <?php $no = 1; foreach ($data as $supplier): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($supplier['nama']) ?></td>
                <td><?= htmlspecialchars($supplier['telp']) ?></td>
                <td><?= htmlspecialchars($supplier['alamat']) ?></td>
                <td>
                    <a href="edit_supplier.php?id=<?= $supplier['id'] ?>" class="tombol edit">Edit</a>
                    <!-- Task 6: Popup window saat ditekan tombol hapus -->
                    <a href="hapus_supplier.php?id=<?= $supplier['id'] ?>" class="tombol hapus" onclick="return confirm('Anda yakin akan menghapus supplier ini?');">Hapus</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</body>
</html>