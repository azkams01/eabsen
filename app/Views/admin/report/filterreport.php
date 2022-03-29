<?php echo $this->extend('/layout/tamplate_admin'); ?>

<?php echo $this->section('content'); ?>

<?php if ($Kelas == null) { ?>
    <script>
        document.location.href = '<?= base_url() ?>/admin/report'
    </script>
<?php } ?>

<div class="container">
    <div class="row">
        <div class="col">
            <br>
            <div class="col text-end">
                <a href="<?= base_url() ?>/admin/export_excel_filter?Kelas=<?= $Kelas ?>&tgl_absen=<?= $tgl_absen ?>&Keterangan=<?= $keterangan ?>" target="_blank" data-toggle="tooltip" title="Export" class="btn btn-warning"><i class="fa-solid fa-file-export"></i></a>
            </div>
            <div class="table-container">
                <table class="table mt-2 text-center table-striped" style="vertical-align: middle;">
                    <thead style="background-color: aliceblue; border-top: 2px solid black;">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">NIS</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Hari</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Jam Masuk</th>
                            <th scope="col">Jam Pulang</th>
                            <th scope="col">Keterangan</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($history as $hs) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $hs['NIS']; ?></td>
                                <td><?= $hs['Nama_siswa']; ?></td>
                                <td><?= $hs['Kelas']; ?></td>
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
            </div>
        </div>
    </div>
</div>

<?php echo $this->endSection(); ?>