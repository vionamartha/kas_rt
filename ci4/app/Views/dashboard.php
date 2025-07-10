<?= $this->extend('layout/template') ?>

<?= $this->section('title') ?>Dashboard<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

  <form action="<?= base_url('laporan/pdf') ?>" method="get" target="_blank" class="form-inline">
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

    <button type="submit" class="btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
    </button>
  </form>
</div>

<!-- Content Row -->
<div class="row">
  <!-- Kas Bulanan Card -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
              Kas Bulanan
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              Rp <?= number_format(array_sum(array_column($kasBulanan, 'total')), 0, ',', '.') ?>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-wallet fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Kas Tahunan Card -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Kas Tahunan
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              Rp <?= number_format($kasTahunan, 0, ',', '.') ?>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Iuran Tertunggak Card -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Iuran Tertunggak</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?= $tertunggak ?> Warga
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user-clock fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Permohonan Kas Card -->  
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
              Permohonan Kas
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?= $permohonanKas ?>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- Bar Chart -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Kas Bulanan (Bar Chart)</h6>
  </div>
  <div class="card-body">
    <div class="chart-bar" style="height: 350px;">
      <canvas id="myBarChart"></canvas>
    </div>
  </div>
</div>

<!-- Modal Pop-up notifikasi -->
<div class="modal fade" id="welcomeModal" tabindex="-1" role="dialog" aria-labelledby="welcomeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #4e73df; color: white;">
        <h5 class="modal-title" id="welcomeModalLabel">Selamat datang!</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Selamat datang, <span id="user-name"></span>!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
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
  foreach ($kasBulanan as $row) {
    $index = array_search(ucfirst(strtolower($row['bulan'])), $bulanLabels);
    if ($index !== false) {
      $kasData[$index] = (int) $row['total'];
    }
  }
?>

<script>
  const ctx = document.getElementById('myBarChart').getContext('2d');

  const shadesOfBlue = [
    '#4e73df', '#527ee6', '#5888ef', '#6092f8',
    '#669cff', '#6ea7ff', '#75b0ff', '#7cbaff',
    '#82c3ff', '#89cdff', '#8fd6ff', '#96e0ff'
  ];

  const myBarChart = new Chart(ctx, {
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

<!-- Script untuk Modal Pop-up -->
<script>
  window.addEventListener('DOMContentLoaded', (event) => {
    const username = "<?= session()->get('username') ?>"; // Mendapatkan nama pengguna dari session
    if (username && !sessionStorage.getItem('popupShown')) { 
      document.getElementById("user-name").textContent = username;
      $('#welcomeModal').modal('show');

      sessionStorage.setItem('popupShown', 'true');
    }
  });
</script>

<?= $this->endSection() ?>
