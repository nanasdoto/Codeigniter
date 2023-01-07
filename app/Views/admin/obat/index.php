<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Daftar Obat</h1>
        <div class="col-5 my-2">
            <form action="" method="POST">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari berdasarkan nama obat..." name="keyword">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" name="submit"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <section class="section">
        <div class="row">
            <div class="col-lg">

                <div class="card">
                    <div class="card-body">
                        <div>
                            <a href="/obat/createobat" class="btn btn-outline-primary my-3">Tambah Data Obat</a>
                        </div>

                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-1"></i>
                                <?= session()->getFlashdata('pesan'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">No.Obat</th>
                                    <th scope="col">Nama Obat</th>
                                    <th scope="col">Keterangan Obat</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 + (5 * ($currentPage - 1)); ?>
                                <?php foreach ($obat as $o) : ?>
                                    <tr>
                                        <th scope="row"><?= $no++; ?></th>
                                        <td><?= $o['no_obat']; ?></td>
                                        <td><?= $o['nama_obat']; ?></td>
                                        <td><?= $o['ket_obat']; ?></td>
                                        <td>
                                            <a href="/obat/editobat/<?= $o['id_obat']; ?>" class="btn btn-outline-warning">Edit</a>
                                            <form action="/obat/deleteobat/<?= $o['id_obat']; ?>" method="POST" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('apakah anda yakin?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?= $pager->links('tb_obat', 'pagination'); ?>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<?= $this->endSection(); ?>