<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Daftar Rekam Medis</h1>
        <!-- <div class="col-5 my-2">
            <form action="" method="POST">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari berdasarkan nama ..." name="keyword">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" name="submit"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </form>
        </div> -->
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg">

                <div class="card">
                    <div class="card-body">
                        <a href="/admin/createrekammedis" class="btn btn-outline-primary my-3">Tambah Data Rekam Medis</a>
                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-1"></i>
                                <?= session()->getFlashdata('pesan'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <a href="<?= base_url('admin/print'); ?>" class="btn btn-danger"><i class="bi bi-printer"></i>Cetak</a>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">No.Rekam Medis</th>
                                    <th scope="col">Nama Pasien</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Keluhan</th>
                                    <th scope="col">Dokter</th>
                                    <th scope="col">Diagnosa</th>
                                    <th scope="col">Poli</th>
                                    <th scope="col">Tindakan</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Obat</th>
                                    <th scope="col">Tanggal Periksa</th>
                                    <!-- <th scope="col">Aksi</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1?>
                                <?php foreach ($rekammedis as $r) : ?>
                                    <tr>
                                        <th scope="row"><?= $no++; ?></th>
                                        <td><?= $r->no_rm ?></td>
                                        <td><?= $r->nama_pasien ?></td>
                                        <td><?= $r->alamat ?></td>
                                        <td><?= $r->keluhan ?></td>
                                        <td><?= $r->nama_dokter ?></td>
                                        <td><?= $r->diagnosa ?></td>
                                        <td><?= $r->nama_poli ?></td>
                                        <td><?= $r->nama_tindakan ?></td>
                                        <td><?= $r->harga ?></td>
                                        <td><?= $r->nama_obat ?></td>
                                        <td><?= $r->tgl_periksa ?></td>                             
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<?= $this->endSection(); ?>