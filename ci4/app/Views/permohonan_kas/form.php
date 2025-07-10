<?= $this->extend('layout/template') ?> 
<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title"><?= isset($permohonanKas) ? 'Edit' : 'Tambah' ?> Permohonan Kas</h3>
  </div>
  <div class="card-body">
    <?php if (session()->getFlashdata('errors')): ?>
      <div class="alert alert-danger">
        <ul>
          <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <li><?= $error ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form method="post" action="<?= isset($permohonanKas) ? '/permohonan_kas/update/' . $permohonanKas['id'] : '/permohonan_kas/store' ?>">
      
      <!-- Input Nama Permohonan -->
      <div class="mb-3">
        <label>Nama Permohonan</label>
        <input type="text" name="nama_permohonan" class="form-control" 
          value="<?= isset($permohonanKas) ? esc($permohonanKas['nama_permohonan']) : '' ?>" required>
      </div>

      <!-- Input Jumlah Kas -->
      <div class="mb-3">
        <label>Jumlah Kas</label>
        <input type="number" name="jumlah_kas" class="form-control" 
          value="<?= isset($permohonanKas) ? esc($permohonanKas['jumlah_kas']) : '' ?>" required>
      </div>

      <!-- Dropdown Status -->
      <div class="dropdown no-arrow mb-4">
        <button
          class="btn btn-secondary dropdown-toggle"
          type="button"
          id="dropdownStatusButton"
          data-toggle="dropdown"
          aria-haspopup="true"
          aria-expanded="false"
          style="box-shadow:none;"
        >
          <?= (isset($permohonanKas) && $permohonanKas['status']) ? ucfirst($permohonanKas['status']) : 'Pilih Status' ?>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownStatusButton">
          <a
            class="dropdown-item <?= (isset($permohonanKas) && $permohonanKas['status'] === 'Pending') ? 'active' : '' ?>"
            href="#"
            onclick="selectStatus('Pending'); return false;"
          >Pending</a>
          <a
            class="dropdown-item <?= (isset($permohonanKas) && $permohonanKas['status'] === 'Disetujui') ? 'active' : '' ?>"
            href="#"
            onclick="selectStatus('Disetujui'); return false;"
          >Disetujui</a>
          <a
            class="dropdown-item <?= (isset($permohonanKas) && $permohonanKas['status'] === 'Ditolak') ? 'active' : '' ?>"
            href="#"
            onclick="selectStatus('Ditolak'); return false;"
          >Ditolak</a>
        </div>
      </div>

      <!-- Input Hidden Status -->
      <input type="hidden" name="status" id="statusInput" 
        value="<?= isset($permohonanKas) ? esc($permohonanKas['status']) : '' ?>" required>

      <!-- Tanggal Permohonan -->
      <div class="mb-3">
        <label>Tanggal Permohonan</label>
        <input type="date" name="tanggal_permohonan" class="form-control" 
          value="<?= isset($permohonanKas) ? esc($permohonanKas['tanggal_permohonan']) : '' ?>" required>
      </div>

      <!-- Keterangan -->
      <div class="mb-3">
        <label>Keterangan</label>
        <textarea name="keterangan" class="form-control"><?= isset($permohonanKas) ? esc($permohonanKas['keterangan']) : '' ?></textarea>
      </div>

      <!-- Dropdown Pilih Warga -->
      <div class="mb-3">
        <label for="warga_id">Pilih Warga</label>
        <select class="form-control" id="warga_id" name="warga_id" required>
          <option value="">Pilih Warga</option>
          <?php foreach($warga as $w): ?>
            <option value="<?= $w['id']; ?>" <?= (isset($permohonanKas) && $permohonanKas['warga_id'] == $w['id']) ? 'selected' : '' ?>>
              <?= $w['nama']; ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <button class="btn btn-success" type="submit">
        <i class="fas fa-save"></i> Simpan
      </button>
      <a href="<?= base_url('/permohonan_kas') ?>" class="btn btn-danger ms-2">
        <i class="fas fa-times"></i> Batal
      </a>
    </form>
  </div>
</div>

<script>
  function selectStatus(value) {
    document.getElementById('statusInput').value = value;
    document.getElementById('dropdownStatusButton').textContent =
      value.charAt(0).toUpperCase() + value.slice(1);

    document.querySelectorAll('.dropdown-item').forEach(item => item.classList.remove('active'));
    event.target.classList.add('active');
  }
</script>

<?= $this->endSection() ?>
