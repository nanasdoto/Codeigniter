<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<main id="main" class="main">
    <div class="col-lg-8">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form Edit Data Pasien</h5>

                <!-- Vertical Form -->
                <form class="row g-3" action="/pasien/updatepasien/<?= $pasien['id_pasien']; ?>" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_pasien" value="<?= $pasien['id_pasien']; ?>">

                    <div class="col-12">
                        <label for="no_pasien" class="form-label">No.Pasien</label>
                        <input type="text" class="form-control <?= ($validation->hasError('no_pasien')) ? 'is-invalid' : ''; ?>" id="no_pasien" name="no_pasien" value="<?= (old('no_pasien')) ? old('no_pasien') : $pasien['no_pasien'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_pasien'); ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="nama_pasien" class="form-label">Nama pasien</label>
                        <input type="text" class="form-control <?= ($validation->hasError('nama_pasien')) ? 'is-invalid' : ''; ?>" id="nama_pasien" name="nama_pasien" value="<?= (old('nama_pasien')) ? old('nama_pasien') : $pasien['nama_pasien'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_pasien'); ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <input type="text" class="form-control <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : ''; ?>" id="jenis_kelamin" name="jenis_kelamin" value="<?= (old('jenis_kelamin')) ? old('jenis_kelamin') : $pasien['jenis_kelamin'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('jenis_kelamin'); ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" value="<?= (old('alamat')) ? old('alamat') : $pasien['alamat'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('alamat'); ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="no_telp" class="form-label">No.Telp</label>
                        <input type="text" class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?>" id="no_telp" name="no_telp" value="<?= (old('no_telp')) ? old('no_telp') : $pasien['no_telp'] ?>">
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

<?= $this->endSection(); ?>