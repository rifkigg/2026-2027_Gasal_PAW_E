<?php
function getDailySalesReport(PDO $conn, string $mulai, string $selesai): array
{
  $sql = <<<SQL
    SELECT 
      DATE(waktu_transaksi) AS tgl,
      waktu_transaksi,
      SUM(total) AS total_harian,
      SUM(total) AS total_pendapatan,
      COUNT(id) AS jumlah_transaksi
    FROM transaksi
    WHERE waktu_transaksi BETWEEN :mulai AND :selesai
    GROUP BY DATE(waktu_transaksi)
    ORDER BY tgl ASC;
  SQL;

  $stmt = $conn->prepare($sql);
  $stmt->execute([
    ':mulai'   => $mulai,
    ':selesai' => $selesai
  ]);

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getSalesCumulativeSummary(PDO $conn, string $mulai, string $selesai)
{
  $sql = <<<SQL
    SELECT 
      COUNT(DISTINCT pelanggan_id) AS jml,
      COUNT(DISTINCT pelanggan_id) AS jumlah_pelanggan_unik,
      COALESCE(SUM(total), 0) AS total_pendapatan,
      COALESCE(SUM(total), 0) AS total_pendapatan_keseluruhan,
      COUNT(id) AS total_transaksi
    FROM transaksi
    WHERE waktu_transaksi BETWEEN :mulai AND :selesai;
  SQL;

  $stmt = $conn->prepare($sql);
  $stmt->execute([
    ':mulai'   => $mulai,
    ':selesai' => $selesai
  ]);

  $summary = $stmt->fetch(PDO::FETCH_ASSOC);

  return $summary ?: [
    'jml'                          => 0,
    'jumlah_pelanggan_unik'        => 0,
    'total_pendapatan'             => 0,
    'total_pendapatan_keseluruhan' => 0,
    'total_transaksi'              => 0
  ];
}

function getTransactionDateBounds(PDO $conn)
{
  $sql = "SELECT MIN(waktu_transaksi) AS min_date, MAX(waktu_transaksi) AS max_date FROM transaksi";
  $stmt = $conn->query($sql);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  return [
    'min_date' => $row['min_date'] ?? date('Y-m-01'),
    'max_date' => $row['max_date'] ?? date('Y-m-d')
  ];
}

function getDataTransaksi(PDO $conn, string $mulai, string $selesai)
{
  $sql = <<<SQL
    SELECT transaksi.*, pelanggan.nama 
    FROM transaksi 
    JOIN pelanggan 
    ON transaksi.pelanggan_id = pelanggan.id 
    WHERE transaksi.waktu_transaksi BETWEEN :mulai AND :selesai;
  SQL;

  $stmt = $conn->prepare($sql);
  $stmt->execute([
    ':mulai'   => $mulai,
    ':selesai' => $selesai
  ]);

  $dataTransaksi = $stmt->fetchAll(PDO::FETCH_ASSOC);

  return $dataTransaksi;
}