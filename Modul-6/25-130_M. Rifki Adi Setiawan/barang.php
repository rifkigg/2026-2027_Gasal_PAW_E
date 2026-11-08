<?php
require_once "koneksi.php";

if (isset($_GET['action']) && $_GET['action'] === 'hapus') {
    $id_barang = $_GET['id'];

    // Cek apakah barang ada di transaksi_detail
    $stmt_cek = $DBH->prepare("SELECT COUNT(*) FROM transaksi_detail WHERE barang_id = ?");
    $stmt_cek->execute([$id_barang]);
    $jumlah_dipakai = $stmt_cek->fetchColumn();

    if ($jumlah_dipakai > 0) {
        // Notifikasi gagal jika barang masih digunakan
        echo "<script>
                alert('Gagal Menghapus! Barang ini masih digunakan pada detail transaksi.');
                window.location.href='barang.php';
              </script>";
        exit;
    } else {
        // Hapus barang jika tidak digunakan
        $stmt_hapus = $DBH->prepare("DELETE FROM barang WHERE id = ?");
        $stmt_hapus->execute([$id_barang]);
        echo "<script>
                alert('Barang berhasil dihapus.');
                window.location.href='barang.php';
              </script>";
        exit;
    }
}

// Fetch all barang
$query = $DBH->prepare("SELECT barang.*, supplier.nama AS nama_supplier FROM barang JOIN supplier ON barang.supplier_id = supplier.id");
$query->execute();
$data_barang = $query->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Master Barang</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .wrap { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .tombol { padding: 8px 12px; text-decoration: none; color: white; border-radius: 4px; font-size: 14px; }
        .kembali { background-color: #6c757d; }
        .hapus { background-color: #d9534f; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="wrap">
        <h2>Data Master Barang</h2>
        <a href="transaksi.php" class="tombol kembali">Kembali ke Transaksi</a>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Harga (Rp)</th>
            <th>Stok</th>
            <th>Supplier</th>
            <th>Aksi</th>
        </tr>
        <?php $no = 1; foreach ($data_barang as $b): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($b['kode_barang']) ?></td>
                <td><?= htmlspecialchars($b['nama_barang']) ?></td>
                <td><?= number_format($b['harga'], 0, ',', '.') ?></td>
                <td><?= htmlspecialchars($b['stok']) ?></td>
                <td><?= htmlspecialchars($b['nama_supplier']) ?></td>
                <td>
                    <a href="barang.php?action=hapus&id=<?= $b['id'] ?>" class="tombol hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>