<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<main id="main" class="main">
    <div class="col-lg-8">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form Tambah Data Obat</h5>

                <!-- Vertical Form -->
                <form class="row g-3" action="/obat/saveobat" method="POST">
                    <?= csrf_field(); ?>
                    <div class="col-12">
                        <label for="no_obat" class="form-label">No.Obat</label>
                        <input type="text" class="form-control <?= ($validation->hasError('no_obat')) ? 'is-invalid' : ''; ?>" id="no_obat" name="no_obat" value="<?= old('no_obat'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_obat'); ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="nama_obat" class="form-label">Nama Obat</label>
                        <input type="text" class="form-control <?= ($validation->hasError('nama_obat')) ? 'is-invalid' : ''; ?>" id="nama_obat" name="nama_obat" value="<?= old('nama_obat'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_obat'); ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="ket_obat" class="form-label">Keterangan Obat</label>
                        <input type="text" class="form-control <?= ($validation->hasError('ket_obat')) ? 'is-invalid' : ''; ?>" id="ket_obat" name="ket_obat" value="<?= old('ket_obat'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('ket_obat'); ?>
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