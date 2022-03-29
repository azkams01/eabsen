<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Absen.xls");
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
    <table border=1 cellspacing="2" cellpadding="2" class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Hari</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody class="tabel-data-absen">
            <?php

            foreach ($absen as $da) {

            ?>
                <tr>
                    <td><?php echo $da["NIS"] ?></td>
                    <td><?php echo $da["Nama_siswa"] ?></td>
                    <td><?php echo $da["Kelas"] ?></td>
                    <td><?php echo $da["hari_absen"] ?></td>
                    <td><?php echo $da["tgl_absen"] ?></td>
                    <td><?php echo $da["keterangan_absen"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>



</body>

</html>