<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<main id="main" class="main">
    <div class="col-lg-8">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form Tambah Data Dokter</h5>

                <!-- Vertical Form -->
                <form class="row g-3" action="/dokter/save" method="POST">
                    <?= csrf_field(); ?>
                    <div class="col-12">
                        <label for="no_dokter" class="form-label">No.Dokter</label>
                        <input type="text" class="form-control <?= ($validation->hasError('no_dokter')) ? 'is-invalid' : ''; ?>" id="no_dokter" name="no_dokter" value="<?= old('no_dokter'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_dokter'); ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="nama_dokter" class="form-label">Nama Dokter</label>
                        <input type="text" class="form-control <?= ($validation->hasError('nama_dokter')) ? 'is-invalid' : ''; ?>" id="nama_dokter" name="nama_dokter" value="<?= old('nama_dokter'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_dokter'); ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="spesialis" class="form-label">Spesialis</label>
                        <select id="spesialis" class="form-control theSelect" name="spesialis" >
                            <option value="" selected disabled>- Pilih Data Dokter -</option>
                            <option value="Gigi dan Mulut">Gigi dan Mulut</option>
                            <option value="Umum">Umum</option>
                            <option value="Psikater">Psikater</option>
                            <option value="Ibu dan Anak">Ibu dan Anak</option>
                            <option value="Kandungan">Kandungan</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="alamat_dokter" class="form-label">Alamat</label>
                        <input type="text" class="form-control <?= ($validation->hasError('alamat_dokter')) ? 'is-invalid' : ''; ?>" id="alamat_dokter" name="alamat_dokter" value="<?= old('alamat_dokter'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('alamat_dokter'); ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="no_telp" class="form-label">No.Telp</label>
                        <input type="text" class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?>" id="no_telp" name="no_telp" value="<?= old('no_telp'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_telp'); ?>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form><!-- Vertical Form -->

            </div>
        </div>
</main>

<script>
		$(".theSelect").select2();
</script>

<?= $this->endSection(); ?>