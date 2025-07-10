<?= $this->extend('layout/template') ?>   
<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>
<?= $this->section('content') ?>

<h3 class="mb-4 text-gray-800"><?= isset($iuran) ? 'Edit' : 'Tambah' ?> Iuran Kas</h3>

<div class="card shadow mb-4">
  <div class="card-body">
    <form method="post" action="<?= isset($iuran) ? '/iuran/update/' . $iuran['id'] : '/iuran/store' ?>">
      <div class="form-group mb-3">
        <label for="warga_id">Nama Warga</label>
        <select name="warga_id" id="warga_id" class="form-control" required>
          <option value="">-- Pilih Warga --</option>
          <?php foreach ($warga as $w): ?>
            <option value="<?= $w['id'] ?>" 
              <?= (old('warga_id', isset($iuran) ? $iuran['warga_id'] : '') == $w['id']) ? 'selected' : '' ?>>
              <?= esc($w['nama']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group mb-3">
        <label for="bulan">Bulan</label>
        <input type="text" id="bulan" name="bulan" class="form-control" placeholder="Contoh: Januari" required 
          value="<?= old('bulan', isset($iuran) ? $iuran['bulan'] : '') ?>">
      </div>

      <div class="form-group mb-3">
        <label for="tahun">Tahun</label>
        <input type="number" id="tahun" name="tahun" class="form-control" placeholder="Contoh: 2024" required 
          value="<?= old('tahun', isset($iuran) ? $iuran['tahun'] : '') ?>">
      </div>

      <div class="form-group mb-3">
        <label for="jumlah">Jumlah</label>
        <input type="number" id="jumlah" name="jumlah" class="form-control" required 
          value="<?= old('jumlah', isset($iuran) ? $iuran['jumlah'] : '') ?>">
      </div>

      <div class="form-group mb-3">
        <label for="tanggal_bayar">Tanggal Bayar</label>
        <input type="date" id="tanggal_bayar" name="tanggal_bayar" class="form-control" required 
          value="<?= old('tanggal_bayar', isset($iuran) ? $iuran['tanggal_bayar'] : '') ?>">
      </div>

      <div class="form-group mb-4">
        <label for="keterangan">Keterangan</label>
        <textarea id="keterangan" name="keterangan" class="form-control" rows="3"><?= old('keterangan', isset($iuran) ? $iuran['keterangan'] : '') ?></textarea>
      </div>

      <button type="submit" class="btn btn-success">
        <i class="fas fa-save"></i> <?= isset($iuran) ? 'Update' : 'Simpan' ?>
      </button>
  
      <a href="/iuran" class="btn btn-danger ml-2">
        <i class="fas fa-times"></i> Batal
      </a>
    </form>
  </div>
</div>

<?= $this->endSection() ?>
