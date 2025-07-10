<?= $this->extend('layout/template') ?>

<?= $this->section('title') ?>Laporan Kas<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Form Generate Report -->
<form action="<?= base_url('laporan/pdf') ?>" method="get" target="_blank" class="form-inline mb-3">
  <select name="bulan" class="form-control mr-2" required>
    <option value="">Pilih Bulan</option>
    <?php
      $bulanList = [
        'Januari','Februari','Maret','April','Mei','Juni',
        'Juli','Agustus','September','Oktober','November','Desember'
      ];
      foreach ($bulanList as $b) {
        echo "<option value=\"$b\">$b</option>";
      }
    ?>
  </select>

  <select name="tahun" class="form-control mr-2" required>
    <option value="">Pilih Tahun</option>
    <?php for ($y = date('Y'); $y >= 2020; $y--): ?>
      <option value="<?= $y ?>"><?= $y ?></option>
    <?php endfor; ?>
  </select>

  <button type="submit" class="btn btn-primary">
    <i class="fas fa-download"></i> Generate Report
  </button>
</form>

<h3>Laporan Kas</h3>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Kas Bulanan (Bar Chart)</h6>
  </div>
  <div class="card-body">
    <div class="chart-bar" style="height: 350px;">
      <canvas id="laporanBarChart"></canvas>
    </div>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php
  $bulanLabels = [
    'Januari','Februari','Maret','April',
    'Mei','Juni','Juli','Agustus',
    'September','Oktober','November','Desember'
  ];

  $kasData = array_fill(0, 12, 0);
  foreach ($laporan as $row) {
    $index = array_search(ucfirst(strtolower($row['bulan'])), $bulanLabels);
    if ($index !== false) {
      $kasData[$index] = (int) $row['total'];
    }
  }
?>

<script>
  const ctx = document.getElementById('laporanBarChart').getContext('2d');

  const shadesOfBlue = [
    '#4e73df', '#527ee6', '#5888ef', '#6092f8',
    '#669cff', '#6ea7ff', '#75b0ff', '#7cbaff',
    '#82c3ff', '#89cdff', '#8fd6ff', '#96e0ff'
  ];

  const laporanBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?= json_encode($bulanLabels) ?>,
      datasets: [{
        label: 'Kas Bulanan (Rp)',
        backgroundColor: shadesOfBlue,
        hoverBackgroundColor: '#2e59d9',
        borderColor: '#4e73df',
        data: <?= json_encode($kasData) ?>,
      }]
    },
    options: {
      maintainAspectRatio: false,
      scales: {
        x: {
          grid: { display: false }
        },
        y: {
          beginAtZero: true,
          ticks: {
            callback: function(value) {
              return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
          }
        }
      },
      plugins: {
        legend: {
          display: true,
          labels: {
            color: '#4e73df',
            font: { weight: 'bold', size: 14 }
          }
        }
      }
    }
  });
</script>

<?= $this->endSection() ?>
