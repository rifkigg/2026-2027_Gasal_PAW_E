<?php
require_once __DIR__ . "/../conn.php";
require_once __DIR__ . "/../utils.php";
require_once __DIR__ . "/reports.query.php";

$mulai   = parseDate($_GET["mulai"] ?? $_GET["tanggal_mulai"] ?? "");
$selesai = parseDate($_GET["selesai"] ?? $_GET["tanggal_selesai"] ?? "");

if (!$mulai || !$selesai) {
  header("Location: index.php");
  exit();
}

if ($mulai > $selesai) {
  [$mulai, $selesai] = [$selesai, $mulai];
}

$dataTransaksi = getDataTransaksi($conn, $mulai, $selesai);
$rekap   = getDailySalesReport($conn, $mulai, $selesai);
$summary = getSalesCumulativeSummary($conn, $mulai, $selesai);

$total_pelanggan  = $summary['jml'] ?? $summary['jumlah_pelanggan_unik'] ?? 0;
$total_pendapatan = $summary['total_pendapatan_keseluruhan'] ?? 0;

header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=laporan_penjualan_{$mulai}_sd_{$selesai}.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Laporan Penjualan</title>
  <style>
    body { font-family: Arial, sans-serif; font-size: 11pt; }
    h2 { margin-bottom: 4px; color: #1e3a8a; }
    p { margin-top: 0; color: #4b5563; }
    table { border-collapse: collapse; width: 100%; margin-top: 15px; }
    th, td { border: 1px solid #000; padding: 6px 10px; }
    th { background-color: #dbeafe; font-weight: bold; text-align: center; }
    .text-center { text-align: center; }
    .text-right { text-align: right; }
    .currency { mso-number-format: "\"Rp\"\\ #\\,\\#\\#0"; text-align: right; }
  </style>
</head>
<body>
  <h2>Rekap Laporan Penjualan</h2>
  <p>Periode: <?= htmlspecialchars($mulai) ?> sampai <?= htmlspecialchars($selesai) ?></p>

  <table border="1">
    <thead>
      <tr>
        <th class="text-center" style="width: 50px;">No</th>
        <th class="text-center">Tanggal Transaksi</th>
        <th class="text-center">Keterangan</th>
        <th class="text-center">Nama</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($dataTransaksi)): ?>
        <tr>
          <td colspan="3" class="text-center">Tidak ada transaksi pada periode ini.</td>
        </tr>
      <?php else: ?>
        <?php $no = 1; foreach ($dataTransaksi as $row): ?>
        <tr>
          <td class="text-center"><?= $no++; ?></td>
          <td class="currency"><?= $row['waktu_transaksi'] ?></td>
          <td class="currency"><?= $row['keterangan'] ?></td>
          <td class="text-center"><?= $row['nama']; ?></td>
        </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>

  <br>

  <table border="1">
    <thead>
      <tr>
        <th class="text-center" style="width: 50px;">No</th>
        <th class="text-right">Total Pendapatan</th>
        <th class="text-center">Tanggal Transaksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($rekap)): ?>
        <tr>
          <td colspan="3" class="text-center">Tidak ada transaksi pada periode ini.</td>
        </tr>
      <?php else: ?>
        <?php $no = 1; foreach ($rekap as $row): ?>
        <tr>
          <td class="text-center"><?= $no++; ?></td>
          <td class="currency">Rp. <?= number_format($row['total_harian'], 0, ',', '.'); ?></td>
          <td class="text-center"><?= $row['tgl']; ?></td>
        </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>

  <br>

  <table border="1" style="width: 60%;">
    <thead>
      <tr>
        <th style="background-color: #f3f4f6; text-align: left;">Jumlah Pelanggan</th>
        <th style="background-color: #f3f4f6; text-align: left;">Jumlah Pendapatan</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?= $total_pelanggan; ?> Orang</td>
        <td class="currency">Rp. <?= number_format($total_pendapatan, 0, ',', '.'); ?></td>
      </tr>
    </tbody>
  </table>
</body>
</html>
