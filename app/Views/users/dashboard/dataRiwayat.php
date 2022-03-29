<?php echo $this->extend('/layout/tamplate'); ?>

<?php echo $this->section('content'); ?>
<?php
if (session()->getFlashdata('pesanKeteranganLampiranRiwayat')) { ?>
    <script>
        Swal.fire(
            '<?= session()->getFlashdata('pesanKeteranganLampiranRiwayat'); ?>',
            '<embed src="<?= base_url() ?>/doc/<?= session()->getFlashdata('pesanSebab') ?>" type="" style="width: 100%;">',
            'info'
        ).then((result) => {
            if (result.value == true) {
                document.location.href = '<?= base_url() ?>/users/dataRiwayat/<?= akunSiswa()->NIS ?>'
            }
            document.location.href = '<?= base_url() ?>/users/dataRiwayat/<?= akunSiswa()->NIS ?>'
        })
    </script>
<?php } elseif (session()->getFlashdata('pesanKeteranganHadir')) { ?>
    <script>
        Swal.fire(
            'Hadir',
            '<?= session()->getFlashdata('pesanKeteranganHadir'); ?>',
            'info'
        ).then((result) => {
            if (result.value == true) {
                document.location.href = '<?= base_url() ?>/users/dataRiwayat/<?= akunSiswa()->NIS ?>'
            }
            document.location.href = '<?= base_url() ?>/users/dataRiwayat/<?= akunSiswa()->NIS ?>'
        })
    </script>
<?php }
?>

<div class="container">
    <div class="row">
        <div class="col">
            <form action="" method="post">
                <div class="input-group flex-nowrap" style="width: 250px; margin-top: 20px;">
                    <input class="form-control " type="search" placeholder="Search" aria-label="Search" name="keyword" style="opacity: 0.8;">
                    <button type="submit" class="tmbps input-group-text btn btn-info" id="addon-wrapping"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <div class="form-text">&nbsp;<i class="fas fa-info-circle"></i> Data yang dicari hanya berdasarkan keyword Id Absen ( 2 digit pertama untuk keterangan seperti "AH" yaitu Absen Hadir , 6 digit kedua untuk tahun , bulan , tanggal dan 3 digit terakhir diambil dari NIS )</div>
            <div class="table-container">
                <table class="table mt-2 text-center table-striped" style="vertical-align: middle;">
                    <thead style="background-color: aliceblue; border-top: 2px solid black;">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Id Absen</th>
                            <th scope="col">Hari</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Jam Masuk</th>
                            <th scope="col"> Jam Pulang</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Detail</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php $no = 1 + (7 * ($currentPage - 1)); ?>
                        <?php foreach ($absen as $hs) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $hs['id_absensi']; ?></td>
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
                                <td>
                                    <?php if ($hs['keterangan_absen'] == "Hadir|Masuk") { ?>
                                        <a href="<?= base_url() ?>/users/pesanKeteranganHadir" class="btn btn-sm btn-success disabled"> <?= $hs['keterangan_absen'] ?> </a>
                                    <?php } elseif ($hs['keterangan_absen'] == "Sakit|Pending" or $hs['keterangan_absen'] == "Izin|Pending") { ?>
                                        <a href="<?= base_url() ?>/users/pesanKeteranganHadir" class="btn btn-sm btn-warning disabled"> <?= $hs['keterangan_absen'] ?> </a>
                                    <?php } elseif ($hs['keterangan_absen'] == "Sakit" or $hs['keterangan_absen'] == "Izin") { ?>
                                        <a class="btn btn-sm btn-warning" href="<?= base_url() ?>/users/pesanKeteranganLampiranRiwayat?tgl_absen=<?= $hs['tgl_absen']; ?>&keterangan=<?= $hs['keterangan_absen']; ?>&id=<?= $hs['id_absensi'] ?>"> <?= $hs['keterangan_absen']; ?> </a>
                                    <?php } else { ?>
                                        <a href="<?= base_url() ?>/users/pesanKeteranganHadir?tgl_absen=<?= $hs['tgl_absen']; ?>&keterangan=<?= $hs['keterangan_absen']; ?>&id=<?= $hs['id_absensi'] ?>" class="btn btn-sm btn-success"> <?= $hs['keterangan_absen'] ?> </a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?= $pager->links('absensi', 'absen_pagination'); ?>
        </div>
    </div>
</div>

<?php echo $this->endSection(); ?>