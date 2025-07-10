<?= $this->extend('layout/template') ?> 
<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title"><?= isset($warga) ? 'Edit' : 'Tambah' ?> Warga</h3>
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

    <form method="post" action="<?= isset($warga) ? '/warga/update/' . $warga['id'] : '/warga/store' ?>">
      <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="<?= isset($warga) ? esc($warga['nama']) : '' ?>" required>
      </div>
      <div class="mb-3">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control" required><?= isset($warga) ? esc($warga['alamat']) : '' ?></textarea>
      </div>
      <div class="mb-3">
        <label>No HP</label>
        <input type="text" name="no_hp" class="form-control" value="<?= isset($warga) ? esc($warga['no_hp']) : '' ?>" required>
      </div>

      <!-- Dropdown Status Custom No Arrow -->
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
          <?= (isset($warga) && $warga['status']) ? ucfirst($warga['status']) : 'Pilih Status' ?>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownStatusButton">
          <a
            class="dropdown-item <?= (isset($warga) && $warga['status'] === 'aktif') ? 'active' : '' ?>"
            href="#"
            onclick="selectStatus('aktif'); return false;"
          >Aktif</a>
          <a
            class="dropdown-item <?= (isset($warga) && $warga['status'] === 'tidak aktif') ? 'active' : '' ?>"
            href="#"
            onclick="selectStatus('tidak aktif'); return false;"
          >Tidak Aktif</a>
        </div>
      </div>

      <input type="hidden" name="status" id="statusInput" value="<?= isset($warga) ? $warga['status'] : '' ?>" required>

      <script>
        function selectStatus(value) {
          document.getElementById('statusInput').value = value;
          document.getElementById('dropdownStatusButton').textContent =
            value.charAt(0).toUpperCase() + value.slice(1);

          document.querySelectorAll('.dropdown-item').forEach(item => item.classList.remove('active'));
          event.target.classList.add('active');
        }
      </script>

      <button class="btn btn-success" type="submit">
        <i class="fas fa-save"></i> Simpan
      </button>
      <a href="<?= base_url('/warga') ?>" class="btn btn-danger ms-2">
        <i class="fas fa-times"></i> Batal
      </a>
    </form>
  </div>
</div>

<?= $this->endSection() ?>
