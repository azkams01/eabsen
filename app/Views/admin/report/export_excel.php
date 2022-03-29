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
                <th scope="col">No</th>
                <th scope="col">NIS</th>
                <th scope="col">Nama</th>
                <th scope="col">Kelas</th>
                <th scope="col">Jumlah Hadir</th>
                <th scope="col">Jumlah Sakit</th>
                <th scope="col">Jumlah Izin</th>
            </tr>
        </thead>
        <tbody class="tabel-data-absen">
            <?php $no = 1; ?>
            <?php foreach ($history as $hs) { ?>
                <?php $pisah = explode(" ", $hs['Nama_siswa']); ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $hs['NIS']; ?></td>
                    <td><?= $hs['Nama_siswa']; ?></td>
                    <td><?= $hs['Kelas']; ?></td>
                    <td><?= dataHadir($hs['NIS']); ?></td>
                    <td><?= dataSakit($hs['NIS']); ?></td>
                    <td><?= dataIzin($hs['NIS']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>



</body>

</html>