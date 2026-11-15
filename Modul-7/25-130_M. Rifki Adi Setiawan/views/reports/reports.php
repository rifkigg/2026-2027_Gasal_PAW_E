<?php

require_once __DIR__ . "/../partials/header.php";
?>

<main class="container my-4">

  <div class="no-print mb-4">
    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <h4 class="card-title fw-bold mb-3 text-dark">
          <i class="bi bi-funnel-fill text-primary me-2"></i>Filter Laporan Penjualan
        </h4>
        <form method="GET" action="index.php" class="row g-3 align-items-end">
          <div class="col-md-4">
            <label for="mulai" class="form-label fw-semibold">Dari Tanggal:</label>
            <input 
              type="date" 
              class="form-control" 
              id="mulai" 
              name="mulai" 
              value="<?= htmlspecialchars($mulai) ?>" 
              required
            >
          </div>
          <div class="col-md-4">
            <label for="selesai" class="form-label fw-semibold">Sampai Tanggal:</label>
            <input 
              type="date" 
              class="form-control" 
              id="selesai" 
              name="selesai" 
              value="<?= htmlspecialchars($selesai) ?>" 
              required
            >
          </div>
          <div class="col-md-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary px-4 fw-semibold flex-grow-1">
              <i class="bi bi-search me-1"></i> Tampilkan
            </button>
            <a href="index.php" class="btn btn-outline-secondary" title="Reset">
              <i class="bi bi-arrow-counterclockwise"></i>
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php if (!$is_filtered): ?>
    <div class="alert alert-info border-0 shadow-sm no-print" role="alert">
      <i class="bi bi-info-circle-fill me-2"></i>
      Pilih rentang tanggal pada form di atas lalu tekan tombol <strong>"Tampilkan"</strong> untuk memuat laporan penjualan.
    </div>
  <?php elseif (empty($rekap)): ?>
    <div class="alert alert-warning border-0 shadow-sm" role="alert">
      <i class="bi bi-exclamation-triangle-fill me-2"></i>
      Tidak ada transaksi penjualan pada rentang tanggal <strong><?= htmlspecialchars($mulai) ?></strong> sampai <strong><?= htmlspecialchars($selesai) ?></strong>.
    </div>
  <?php else: ?>

    <div class="report-header mb-3">
      <h2 class="h3 fw-bold text-dark mb-1">
        Rekap Laporan Penjualan <small class="text-secondary fs-5"><?= htmlspecialchars($mulai) ?> sampai <?= htmlspecialchars($selesai) ?></small>
      </h2>
    </div>

    <div class="no-print d-flex gap-2 mb-4">
      <a href="index.php" class="btn btn-secondary shadow-sm">
        <i class="bi bi-chevron-left me-1"></i> Kembali
      </a>

      <button type="button" class="btn btn-danger text-white shadow-sm" onclick="window.print()">
        <i class="bi bi-printer-fill me-1"></i> Cetak
      </button>
      <a 
        href="./services/reports.export.php?mulai=<?= urlencode($mulai) ?>&selesai=<?= urlencode($selesai) ?>" 
        class="btn btn-success shadow-sm"
      >
        <i class="bi bi-file-earmark-excel-fill me-1"></i> Excel
      </a>
    </div>

    <div class="card shadow-sm mb-4">
      <div class="card-header bg-white py-3 border-bottom">
        <h5 class="card-title mb-0 fw-semibold text-primary">
          <i class="bi bi-bar-chart-line-fill me-2"></i>Grafik Penjualan
        </h5>
      </div>
      <div class="card-body">
        <div style="position: relative; height: 350px; width: 100%;">
          <canvas id="myChart"></canvas>
        </div>
      </div>
    </div>

    <script>
      const ctx = document.getElementById('myChart').getContext('2d');
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: <?= json_encode($labels); ?>,
          datasets: [{
            label: 'Total Penjualan',
            data: <?= json_encode($data_total); ?>
          }]
        }
      });
    </script>

    <div class="card shadow-sm mb-4">
      <div class="card-header bg-white py-3 border-bottom">
        <h5 class="card-title mb-0 fw-semibold text-primary">
          <i class="bi bi-table me-2"></i>Data Transaksi
        </h5>
      </div>
      <div class="card-body p-0">
        <table class="table table-bordered table-striped mb-0">
          <thead class="table-light">
            <tr>
              <th style="width: 70px; text-align: center;">No</th>
              <th style="text-align: center; padding-right: 20px;">Tanggal Transaksi</th>
              <th style="text-align: center; padding-right: 20px;">Keterangan</th>
              <th style="text-align: center;">Nama Pelanggan</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($dataTransaksi as $row_data): ?>
            <tr>
              <td style="text-align: center;"><?= $no++; ?></td>
              <td style="text-align: center; padding-right: 20px; font-weight: 600">
                <?= htmlspecialchars($row_data['waktu_transaksi']); ?>
              </td>
              <td style="text-align: left;"><?= htmlspecialchars($row_data['keterangan']); ?></td>
              <td style="text-align: center;"><?= htmlspecialchars($row_data['nama']); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="card shadow-sm mb-4">
      <div class="card-header bg-white py-3 border-bottom">
        <h5 class="card-title mb-0 fw-semibold text-primary">
          <i class="bi bi-table me-2"></i>Rekapitulasi
        </h5>
      </div>
      <div class="card-body p-0">
        <table class="table table-bordered table-striped mb-0">
          <thead class="table-light">
            <tr>
              <th style="width: 70px; text-align: center;">No</th>
              <th style="text-align: right; padding-right: 20px;">Total Pendapatan</th>
              <th style="text-align: center;">Tanggal Transaksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($rekap as $row): ?>
            <tr>
              <td style="text-align: center;"><?= $no++; ?></td>
              <td style="text-align: right; padding-right: 20px; font-weight: 600; color: #16a34a;">
                Rp. <?= number_format($row['total_harian'], 0, ',', '.'); ?>
              </td>
              <td style="text-align: center;"><?= htmlspecialchars($row['tgl']); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <div class="row text-center g-3">
          <div class="col-md-6">
            <div class="p-3 border rounded bg-light">
              <span class="text-muted d-block small text-uppercase fw-semibold mb-1">Jumlah Pelanggan</span>
              <span class="fs-4 fw-bold text-primary"><?= $total_pelanggan; ?> Orang</span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="p-3 border rounded bg-light">
              <span class="text-muted d-block small text-uppercase fw-semibold mb-1">Jumlah Pendapatan</span>
              <span class="fs-4 fw-bold text-success">Rp. <?= number_format($total_pendapatan, 0, ',', '.'); ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php endif; ?>

</main>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>
