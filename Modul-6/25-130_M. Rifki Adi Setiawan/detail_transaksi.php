<?php
require_once "koneksi.php";

$transaksi_id = $_GET['id'] ?? null;
if (!$transaksi_id) {
    header("Location: transaksi.php");
    exit;
}

$stmt_master = $DBH->prepare("
    SELECT transaksi.*, pelanggan.nama AS nama_pelanggan 
    FROM transaksi 
    JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id 
    WHERE transaksi.id = ?
");
$stmt_master->execute([$transaksi_id]);
$master = $stmt_master->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah_detail'])) {
    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];

    $stmt_barang = $DBH->prepare("SELECT harga FROM barang WHERE id = ?");
    $stmt_barang->execute([$barang_id]);
    $harga = $stmt_barang->fetchColumn();

    // Insert ke tabel detail
    $stmt_insert = $DBH->prepare("INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES (?, ?, ?, ?)");
    $stmt_insert->execute([$transaksi_id, $barang_id, $harga, $qty]);

    // Update Total Transaksi
    $stmt_update_total = $DBH->prepare("
        UPDATE transaksi 
        SET total = (SELECT COALESCE(SUM(harga * qty), 0) FROM transaksi_detail WHERE transaksi_id = ?) 
        WHERE id = ?
    ");
    $stmt_update_total->execute([$transaksi_id, $transaksi_id]);

    header("Location: detail_transaksi.php?id=" . $transaksi_id);
    exit;
}

// Filter barang yang BELUM diinput 
$stmt_opt_barang = $DBH->prepare("
    SELECT * FROM barang 
    WHERE id NOT IN (SELECT barang_id FROM transaksi_detail WHERE transaksi_id = ?)
");
$stmt_opt_barang->execute([$transaksi_id]);
$list_barang = $stmt_opt_barang->fetchAll();

// Ambil list detail transaksi yang sudah tersimpan
$stmt_detail = $DBH->prepare("
    SELECT transaksi_detail.*, barang.nama_barang, barang.kode_barang 
    FROM transaksi_detail 
    JOIN barang ON transaksi_detail.barang_id = barang.id 
    WHERE transaksi_detail.transaksi_id = ?
");
$stmt_detail->execute([$transaksi_id]);
$details = $stmt_detail->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Form Master-Detail Transaksi</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .card { background: #f9f9f9; padding: 15px; border: 1px solid #ddd; margin-bottom: 20px; border-radius: 5px; }
        .tombol { padding: 8px 12px; text-decoration: none; color: white; border-radius: 4px; font-size: 14px; border: none; cursor: pointer; }
        .kembali { background-color: #6c757d; }
        .simpan { background-color: #5cb85c; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .form-group { margin-bottom: 10px; }
    </style>
</head>
<body>
    <a href="transaksi.php" class="tombol kembali">Kembali ke Data Transaksi</a>

    <!-- Informasi Master -->
    
    <div class="card">
        <p><strong>Waktu Transaksi:</strong> <?= htmlspecialchars($master['waktu_transaksi']) ?></p>
        <p><strong>Pelanggan:</strong> <?= htmlspecialchars($master['nama_pelanggan']) ?></p>
        <p><strong>Keterangan:</strong> <?= htmlspecialchars($master['keterangan']) ?></p>
        <p><strong>Total Transaksi:</strong> Rp<?= number_format($master['total'], 0, ',', '.') ?></p>
    </div>

    <!-- Form Input Detail (Tugas 2) -->
    <h3>Input Barang Ke Transaksi</h3>
    <div class="card">
        <form method="POST">
            <div class="form-group">
                <label>Pilih Barang:</label><br>
                <select name="barang_id" required style="padding: 8px; width: 300px;">
                    <option value="">-- Pilih Barang --</option>
                    <?php foreach ($list_barang as $b): ?>
                        <option value="<?= $b['id'] ?>">
                            <?= htmlspecialchars($b['kode_barang']) ?> - <?= htmlspecialchars($b['nama_barang']) ?> (Rp<?= number_format($b['harga'], 0, ',', '.') ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (empty($list_barang)): ?>
                    <small style="color: red;">* Semua barang sudah diinputkan ke transaksi ini.</small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label>Jumlah (Qty):</label><br>
                <input type="number" name="qty" min="1" required style="padding: 7px; width: 100px;">
            </div>
            <button type="submit" name="tambah_detail" class="tombol simpan" <?= empty($list_barang) ? 'disabled' : '' ?>>Simpan Detail</button>
        </form>
    </div>

    <!-- Tabel Data Detail -->
    <h3>Detail Items Transaksi</h3>
    <table>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga Satuan (Rp)</th>
            <th>Qty</th>
            <th>Subtotal (Rp)</th>
        </tr>
        <?php $no = 1; foreach ($details as $d): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($d['kode_barang']) ?></td>
                <td><?= htmlspecialchars($d['nama_barang']) ?></td>
                <td><?= number_format($d['harga'], 0, ',', '.') ?></td>
                <td><?= htmlspecialchars($d['qty']) ?></td>
                <td><?= number_format($d['harga'] * $d['qty'], 0, ',', '.') ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>