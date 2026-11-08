<?php  
require_once "koneksi.php";

$query =$DBH->prepare("
    SELECT transaksi.*, pelanggan.nama AS nama_pelanggan 
    FROM transaksi 
    JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id
");
$query->execute();
$data_transaksi =$query->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Master Transaksi</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .wrap { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .tombol { padding: 8px 12px; text-decoration: none; color: white; border-radius: 4px; font-size: 14px; }
        .detail { background-color: #0275d8; }
        .tambah { background-color: #5cb85c; }
        .barang { background-color: #6f42c1; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="wrap">
        <h2>Data Master Transaksi</h2>
        <div>
            <a href="barang.php" class="tombol barang">Kelola Barang</a>
        </div>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Waktu Transaksi</th>
            <th>Pelanggan</th>
            <th>Keterangan</th>
            <th>Total (Rp)</th>
            <th>Aksi</th>
        </tr>
        <?php $no = 1; foreach ($data_transaksi as$row): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['waktu_transaksi']) ?></td>
                <td><?= htmlspecialchars($row['nama_pelanggan']) ?></td>
                <td><?= htmlspecialchars($row['keterangan']) ?></td>
                <td><?= number_format($row['total'], 0, ',', '.') ?></td>
                <td>
                    <a href="detail_transaksi.php?id=<?= $row['id'] ?>" class="tombol detail">Kelola Detail</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>