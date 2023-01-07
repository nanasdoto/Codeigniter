<html>

<head>
    <style>
        body {
            font-family: arial;
        }

        table {
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <center>
        <h2 style="margin-top:50px;">
            Data Rekam Medis Puskesmas Kedungwuni II
        </h2>
    </center>
    <table border="1" cellspacing="" cellpadding="4" width="100%">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">No.Rekam Medis</th>
                <th scope="col">Nama Pasien</th>
                <th scope="col">Alamat</th>
                <th scope="col">Keluhan</th>
                <th scope="col">Dokter</th>
                <th scope="col">Diagnosa</th>
                <th scope="col">Poli</th>
                <th scope="col">Tindakan</th>
                <th scope="col">Harga</th>
                <th scope="col">Tanggal Periksa</th>
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
                        <td><?= $r->tgl_periksa ?></td>
                    </tr>
                <?php endforeach; ?>
        </tbody>
    </table>

    <script type="text/javascript">
        window.print();
    </script>

</body>

</html>