<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laporan Penjualan dan Grafik - Modul 7</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    body {
      background-color: #f8fafc;
      font-family: system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
      color: #1e293b;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 15px;
    }

    th, td {
      border: 1px solid #cbd5e1;
      padding: 8px 12px;
      text-align: left;
    }

    th {
      background-color: #f1f5f9;
      font-weight: 600;
    }

    .card {
      border: 1px solid #e2e8f0;
      border-radius: 8px;
    }

    .summary-box {
      border: 1px solid #cbd5e1;
      border-radius: 6px;
      padding: 12px 18px;
      background-color: #f8fafc;
      margin-top: 15px;
      display: inline-block;
      width: 100%;
    }

    /* Aturan CSS @media print sesuai contoh halaman 3 & 4 PDF */
    @media print {
      .no-print {
        display: none !important;
      }

      body {
        background-color: #ffffff !important;
        color: #000000 !important;
        font-size: 11pt;
        margin: 0;
        padding: 10mm;
      }

      .container {
        max-width: 100% !important;
        width: 100% !important;
        padding: 0 !important;
        margin: 0 !important;
      }

      table {
        border-collapse: collapse !important;
        width: 100% !important;
        margin-top: 15px !important;
      }

      th, td {
        border: 1px solid #000000 !important;
        padding: 6px 10px !important;
      }

      th {
        background-color: #f2f2f2 !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
      }

      .summary-box {
        border: 1px solid #000000 !important;
        background-color: #ffffff !important;
      }

      canvas {
        max-width: 100% !important;
        height: auto !important;
      }
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4 no-print">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">
      <i class="bi bi-shop me-2"></i>Sistem Toko 
    </a>
  </div>
</nav>
