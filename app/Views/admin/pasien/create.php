<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<main id="main" class="main">
    <div class="col-lg-8">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form Tambah Data Pasien</h5>

                <form class="row g-3" action="/pasien/savepasien" method="POST">
                    <?= csrf_field(); ?>
                    <div class="col-12">
                        <label for="no_pasien" class="form-label">No.Pasien</label>
                        <input type="text" class="form-control <?= ($validation->hasError('no_pasien')) ? 'is-invalid' : ''; ?>" id="no_pasien" name="no_pasien" value="<?= old('no_pasien'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_pasien'); ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="nama_pasien" class="form-label">Nama Pasien</label>
                        <input type="text" class="form-control <?= ($validation->hasError('nama_pasien')) ? 'is-invalid' : ''; ?>" id="nama_pasien" name="nama_pasien" value="<?= old('nama_pasien'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_pasien'); ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <fieldset class="row">
                            <legend class="col-form-label pt-0">Jenis Kelamin</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : ''; ?>" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="L" checked>
                                    <label class="form-check-label" for="jenis_kelamin">
                                        Laki-laki
                                    </label>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('jenis_kelamin'); ?>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : ''; ?>" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="P">
                                    <label class="form-check-label" for="jenis_kelamin">
                                        Perempuan
                                    </label>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('jenis_kelamin'); ?>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" value="<?= old('alamat'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('alamat'); ?>
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
                </form>

            </div>
        </div>
</main>

<?= $this->endSection(); ?>