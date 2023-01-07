<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<main id="main" class="main">
    <div class="col-lg-8">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form Tambah Data Tindakan</h5>

                <!-- Vertical Form -->
                <form class="row g-3" action="/tindakan/savetindakan" method="POST">
                    <?= csrf_field(); ?>
                    <div class="col-12">
                        <label for="no_tindakan" class="form-label">No.Tindakan</label>
                        <input type="text" class="form-control <?= ($validation->hasError('no_tindakan')) ? 'is-invalid' : ''; ?>" id="no_tindakan" name="no_tindakan" autofocus value="<?= old('no_tindakan'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_tindakan'); ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="nama_tindakan" class="form-label">Nama Tindakan</label>
                        <input type="text" class="form-control <?= ($validation->hasError('nama_tindakan')) ? 'is-invalid' : ''; ?>" id="nama_tindakan" name="nama_tindakan" value="<?= old('nama_tindakan'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_tindakan'); ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="harga" name="harga" value="<?= old('harga'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('harga'); ?>
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