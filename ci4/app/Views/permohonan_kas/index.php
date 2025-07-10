<?= $this->extend('layout/template') ?>

<?= $this->section('title') ?>Data Permohonan Kas<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Permohonan Kas</h1>
<a href="/permohonan_kas/create" class="btn btn-primary mb-3">
  <i class="fas fa-plus"></i> Tambah Permohonan Kas
</a>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Daftar Permohonan Kas</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nama Permohonan</th>
            <th>Nama Warga</th> 
            <th>Jumlah Kas</th>
            <th>Status</th>
            <th>Tanggal Permohonan</th>
            <th>Keterangan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($permohonanKas)): ?>
            <?php foreach ($permohonanKas as $p): ?>
              <tr>
                <td><?= esc($p['nama_permohonan']) ?></td>
                <td>
                  <?php 
                    // Menampilkan nama warga yang terkait dengan permohonan kas
                    $warga = (new \App\Models\WargaModel())->find($p['warga_id']);
                    if ($warga) {
                        echo esc($warga['nama']);  // Menampilkan nama warga jika ditemukan
                    } else {
                        echo 'Warga Tidak Ditemukan';  // Menampilkan pesan jika tidak ditemukan
                    }
                  ?>
                </td>
                <td><?= number_format($p['jumlah_kas'], 0, ',', '.') ?></td>
                <td><?= esc($p['status']) ?></td>
                <td><?= esc($p['tanggal_permohonan']) ?></td>
                <td><?= esc($p['keterangan']) ?></td> 
                <td>
                  <a href="/permohonan_kas/edit/<?= $p['id'] ?>" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <button type="button" class="btn btn-danger btn-sm" onclick="showDeleteConfirmation('/permohonan_kas/delete/<?= $p['id'] ?>')">
                    <i class="fas fa-trash"></i> Hapus
                  </button>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="7" class="text-center">Tidak ada data permohonan kas.</td>
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
        <p>Yakin ingin menghapus data permohonan kas ini?</p>
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

  function showDeleteConfirmation(url) {
    currentDeleteUrl = url;
    $('#confirmDeleteModal').modal('show');
  }

  $('#confirmDeleteBtn').click(function() {
    if (currentDeleteUrl) {
      window.location.href = currentDeleteUrl;
    }
  });
</script>

<?= $this->endSection() ?>
