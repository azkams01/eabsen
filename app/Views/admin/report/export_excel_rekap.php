<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Absen $Nama.xls");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Excel</title>
</head>
<style>
    body {
        font-family: sans-serif;
    }

    table {
        margin: auto;
        border-collapse: collapse;
    }

    table thead,
    table tbody {
        border: 1px solid #3c3c3c;
        padding: 3px 8px;

    }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="form-text"> NIS : <?= $NIS ?> <br> Nama : <?= $Nama ?> <br> Kelas : <?= $Kelas ?> <br> Hadir : <?= $Hadir ?> , Sakit : <?= $Sakit ?> , Izin : <?= $Izin ?> </div>
    <table border=1 cellspacing="2" cellpadding="2" class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Hari</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Jam Masuk</th>
                <th scope="col">Jam Pulang</th>
                <th scope="col">Keterangan</th>
            </tr>
        </thead>
        <tbody class="tabel-data-absen">
            <?php $no = 1; ?>
            <?php foreach ($absen as $hs) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $hs['hari_absen']; ?></td>
                    <td><?= $hs['tgl_absen']; ?></td>
                    <td>
                        <?php if ($hs['keterangan_absen'] == "Sakit|Pending" or $hs['keterangan_absen'] == "Izin|Pending" or $hs['keterangan_absen'] == "Sakit" or $hs['keterangan_absen'] == "Izin") { ?>
                            -
                        <?php } else { ?>
                            <?= $hs['jam_masuk']; ?>
                        <?php } ?>
                    </td>
                    <td> <?php if ($hs['keterangan_absen'] == "Sakit|Pending" or $hs['keterangan_absen'] == "Izin|Pending" or $hs['keterangan_absen'] == "Sakit" or $hs['keterangan_absen'] == "Izin") { ?>
                            -
                        <?php } else { ?>
                            <?= $hs['jam_pulang']; ?>
                        <?php } ?></td>
                    <td><?= $hs['keterangan_absen'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>



</body>

</html>