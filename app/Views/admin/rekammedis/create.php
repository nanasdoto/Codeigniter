<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<main id="main" class="main">
    <div class="col-lg-8">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form Tambah Data Rekam Medis</h5>

                <!-- Vertical Form -->
                <form class="row g-3" action="/admin/saverekammedis" method="POST">
                    <?= csrf_field(); ?>
                    <div class="col-12">
                        <label for="no_rm" class="form-label">No.Rekam Medis</label>
                        <input type="text" class="form-control <?= ($validation->hasError('no_rm')) ? 'is-invalid' : ''; ?>" id="no_rm" name="no_rm" value="<?= $no_rm;?>" readonly>
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_rm'); ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="pasien">Pasien</label>
                        <select id="id_pasien" name="id_pasien" class="form-select theSelect">
                            <option value="" hidden selected>- Pilih Data Pasien -</option>
                            <?php foreach ($pasien as $p) : ?>
                                <option value="<?= $p['id_pasien']; ?>"><?= $p['nama_pasien']; ?> - <?= $p['alamat']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="keluhan" class="form-label">Keluhan</label>
                        <input type="text" class="form-control <?= ($validation->hasError('keluhan')) ? 'is-invalid' : ''; ?>" id="keluhan" name="keluhan" value="<?= old('keluhan'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('keluhan'); ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="id_dokter" class="form-label">Dokter</label>
                        <select id="id_dokter" name="id_dokter" class="form-select theSelect">
                            <option value="" hidden selected>- Pilih Data Dokter -</option>
                            <?php foreach ($dokter as $d) : ?>
                                <option value="<?= $d['id_dokter']; ?>"><?= $d['nama_dokter']; ?> - <?= $d['spesialis']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="diagnosa" class="form-label">Diagnosa</label>
                        <input type="text" class="form-control <?= ($validation->hasError('diagnosa')) ? 'is-invalid' : ''; ?>" id="diagnosa" name="diagnosa" value="<?= old('diagnosa'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('diagnosa'); ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="inputState" class="form-label">Poli</label>
                        <select id="id_poli" name="id_poli" class="form-select theSelect">
                            <option value="" hidden selected>- Pilih Data Poli -</option>
                            <?php foreach ($poli as $p) : ?>
                                <option value="<?= $p['id_poli']; ?>"><?= $p['nama_poli']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="tindakan" class="form-label">Tindakan</label>
                        <select id="id_tindakan" name="id_tindakan" class="form-select theSelect">
                            <option value="" selected>- Pilih Data Tindakan -</option>
                            <?php foreach ($tindakan as $value) : ?>
                                <option value="<?= $value['id_tindakan']; ?>"><?= $value['nama_tindakan']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control" name="harga" id="harga" value="<?= old('harga'); ?>" readonly>
                    </div>
                    <div class="col-12">
                        <label for="obat" class="form-label">Obat</label>
                        <select id="id_obat" name="id_obat" class="form-select theSelect">
                            <option value="" selected>- Pilih Data Obat -</option>
                            <?php foreach ($obat as $value) : ?>
                                <option value="<?= $value['id_obat']; ?>"><?= $value['nama_obat']; ?> - <?= $value['ket_obat']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="tgl_periksa" class="form-label">Tanggal Periksa</label>
                        <input type="date" class="form-control <?= ($validation->hasError('tgl_periksa')) ? 'is-invalid' : ''; ?>" id="tgl_periksa" name="tgl_periksa" value="<?= date('Y-m-d'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tgl_periksa'); ?>
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
    $('#id_tindakan').on('change', (event) => {
        getTindakan(event.target.value).then(tb_tindakan => {
            $('#harga').val(tb_tindakan.harga);
        });
    });

    async function getTindakan(id_tindakan) {
        let response = await fetch('/api/home/' + id_tindakan)
        let data = await response.json();

        return data;
    }
</script>

<script>
	$(".theSelect").select2();
</script>

<?= $this->endSection(); ?>