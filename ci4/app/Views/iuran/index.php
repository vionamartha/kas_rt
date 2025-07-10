<?= $this->extend('layout/template') ?>

<?= $this->section('title') ?>Data Iuran Kas<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="h3 mb-2 text-gray-800">Data Iuran Kas</h1>
<a href="/iuran/create" class="btn btn-primary mb-3">
  <i class="fas fa-plus"></i> Tambah Iuran
</a>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Daftar Iuran Kas</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nama Warga</th>
            <th>Bulan</th>
            <th>Tahun</th>
            <th>Jumlah</th>
            <th>Tanggal Bayar</th>
            <th>Keterangan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($iuran)): ?>
            <?php foreach ($iuran as $i): ?>
              <tr>
                <td><?= esc($i['nama']) ?></td>
                <td><?= esc($i['bulan']) ?></td>
                <td><?= esc($i['tahun']) ?></td>
                <td><?= number_format($i['jumlah'], 0, ',', '.') ?></td>
                <td><?= esc($i['tanggal_bayar']) ?></td>
                <td><?= esc($i['keterangan']) ?></td>
                <td>
                  <a href="/iuran/edit/<?= $i['id'] ?>" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <!-- Tombol Hapus untuk memanggil modal -->
                  <button type="button" class="btn btn-danger btn-sm" onclick="showDeleteConfirmation('/iuran/delete/<?= $i['id'] ?>')">
                    <i class="fas fa-trash"></i> Hapus
                  </button>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="7" class="text-center">Belum ada data iuran.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #dc3545; color: white;">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Yakin ingin menghapus data ini?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  // Script Modal Konfirmasi Hapus
  let currentDeleteUrl = '';

  // Fungsi untuk menampilkan modal konfirmasi hapus
  function showDeleteConfirmation(url) {
    currentDeleteUrl = url;
    $('#confirmDeleteModal').modal('show');
  }

  // Menangani tombol hapus di modal
  $('#confirmDeleteBtn').click(function() {
    if (currentDeleteUrl) {
      window.location.href = currentDeleteUrl;  
    }
  });
</script>

<?= $this->endSection() ?>
