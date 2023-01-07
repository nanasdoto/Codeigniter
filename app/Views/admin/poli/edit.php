<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<main id="main" class="main">
    <div class="col-lg-8">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form Edit Data Poli</h5>

                <!-- Vertical Form -->
                <form class="row g-3" action="/poli/updatepoli/<?= $poli['id_poli']; ?>" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_poli" value="<?= $poli['id_poli']; ?>">

                    <div class="col-12">
                        <label for="no_poli" class="form-label">No.Poli</label>
                        <input type="text" class="form-control <?= ($validation->hasError('no_poli')) ? 'is-invalid' : ''; ?>" id="no_poli" name="no_poli" value="<?= (old('no_poli')) ? old('no_poli') : $poli['no_poli'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_poli'); ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="nama_poli" class="form-label">Nama Poli</label>
                        <input type="text" class="form-control <?= ($validation->hasError('nama_poli')) ? 'is-invalid' : ''; ?>" id="nama_poli" name="nama_poli" value="<?= (old('nama_poli')) ? old('nama_poli') : $poli['nama_poli'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_poli'); ?>
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