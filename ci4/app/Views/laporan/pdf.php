<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Laporan Iuran Kas RT</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

    body {
      font-family: 'Roboto', sans-serif;
      font-size: 14px;
      color: #333;
      margin: 30px;
    }

    .header-rt {
      border-bottom: 3px solid #4e73df;
      padding-bottom: 10px;
      margin-bottom: 25px;
      text-align: center;
      line-height: 1.3;
    }

    .header-rt h1 {
      margin: 0;
      color: #4e73df;
      font-weight: 700;
      font-size: 28px;
    }

    .header-rt p {
      margin: 4px 0;
      font-weight: 500;
      color: #666;
      font-size: 13px;
    }

    .title {
      text-align: center;
      margin-bottom: 15px;
    }
    .title h2 {
      margin: 0;
      font-weight: 700;
      color: #4e73df;
      font-size: 24px;
    }
    .title h4 {
      margin: 5px 0 0 0;
      font-weight: 500;
      color: #666;
      font-size: 16px;
    }

    table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0 10px;
      margin-bottom: 30px;
    }

    thead th {
      background-color: #4e73df;
      color: #fff;
      font-weight: 600;
      padding: 12px 10px;
      text-align: center;
      border-radius: 8px 8px 0 0;
      letter-spacing: 0.05em;
      text-transform: uppercase;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    tbody tr {
      background-color: #f9faff;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
      border-radius: 6px;
      transition: background-color 0.3s ease;
    }

    tbody tr:hover {
      background-color: #e8f0fe;
    }

    tbody td {
      padding: 12px 10px;
      text-align: center;
      color: #555;
      font-weight: 500;
      border-bottom: 1px solid #dde6f4;
    }

    tbody tr:last-child td {
      border-bottom: none;
      border-radius: 0 0 8px 8px;
    }

    .summary-table {
      width: 50%;
      margin: 0 auto 50px auto;
      font-size: 15px;
      font-weight: 600;
      color: #4e73df;
    }

    .summary-table td {
      padding: 8px 10px;
      text-align: left;
    }

    .summary-table td.value {
      text-align: right;
    }

    .ttd {
      width: 100%;
      text-align: right;
      padding-right: 60px;
      font-weight: 600;
      color: #4e73df;
    }

    .ttd .jabatan {
      margin-bottom: 80px;
      font-size: 16px;
    }

    .ttd .nama {
      font-size: 14px;
      border-top: 2px solid #4e73df;
      display: inline-block;
      padding-top: 6px;
    }
  </style>
</head>
<body>

  <div class="header-rt">
    <h1>RT 05/RW 03 Kelurahan Maju Jaya</h1>
    <p>Jl. Merdeka No. 10, Kecamatan Sejahtera, Kota Bahagia</p>
    <p>Telepon: (021) 1234567 | Email: rt05@majujaya.id</p>
  </div>

  <div class="title">
    <h2>LAPORAN IURAN KAS RT</h2>
    <h4>Bulan: <?= isset($laporan[0]['bulan']) ? $laporan[0]['bulan'] : '-' ?> | Tahun: <?= isset($laporan[0]['tahun']) ? $laporan[0]['tahun'] : '-' ?></h4>
  </div>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Bulan</th>
        <th>Tahun</th>
        <th>Total (Rp)</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $grandTotal = 0;
        $jumlahPembayar = 0;
        foreach ($laporan as $i => $row):
          $grandTotal += $row['total'];
          $jumlahPembayar++;
      ?>
        <tr>
          <td><?= $i + 1 ?></td>
          <td><?= esc($row['bulan']) ?></td>
          <td><?= esc($row['tahun']) ?></td>
          <td><?= number_format($row['total'], 0, ',', '.') ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <table class="summary-table">
    <tr>
      <td>Total Iuran Bulan Ini:</td>
      <td class="value">Rp <?= number_format($grandTotal, 0, ',', '.') ?></td>
    </tr>
    <tr>
      <td>Jumlah Warga yang Membayar:</td>
      <td class="value"><?= isset($laporan[0]['jumlah_warga']) ? $laporan[0]['jumlah_warga'] : 0 ?> Orang</td>
    </tr>
  </table>

  <div class="ttd">
    <div class="jabatan">Ketua RT</div>
    <div class="nama">(Nama Ketua RT)</div>
  </div>

</body>
</html>
