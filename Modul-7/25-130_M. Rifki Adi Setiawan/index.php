<?php
require_once __DIR__ . "/conn.php";
require_once __DIR__ . "/utils.php";
require_once __DIR__ . "/services/reports.query.php";

$dateBounds = getTransactionDateBounds($conn);
$rawMulai   = $_GET["mulai"] ?? $_GET["tanggal_mulai"] ?? null;
$rawSelesai = $_GET["selesai"] ?? $_GET["tanggal_selesai"] ?? null;

$is_filtered = ($rawMulai !== null && $rawSelesai !== null && $rawMulai !== '' && $rawSelesai !== '');

$mulai   = parseDate($rawMulai) ?: ($dateBounds['min_date'] ?? date('Y-m-01'));
$selesai = parseDate($rawSelesai) ?: ($dateBounds['max_date'] ?? date('Y-m-d'));

$dataTransaksi = getDataTransaksi($conn, $mulai, $selesai);

if ($mulai > $selesai) {
  [$mulai, $selesai] = [$selesai, $mulai];
}

$labels           = [];
$data_total       = [];
$rekap            = [];
$total_pendapatan = 0;
$total_pelanggan  = 0;

if ($is_filtered) {
  $rekap = getDailySalesReport($conn, $mulai, $selesai);

  $summary = getSalesCumulativeSummary($conn, $mulai, $selesai);
  $total_pelanggan  = $summary['jml'] ?? $summary['jumlah_pelanggan_unik'] ?? 0;
  $total_pendapatan = $summary['total_pendapatan_keseluruhan'] ?? 0;

  foreach ($rekap as $row) {
    $labels[]     = $row['tgl'];
    $data_total[] = $row['total_harian'];
  }
}

require_once __DIR__ . "/views/reports/reports.php";
