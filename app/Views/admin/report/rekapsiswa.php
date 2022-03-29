<?php echo $this->extend('/layout/tamplate_admin'); ?>

<?php echo $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <br>
            <div class="form-text"> NIS : <?= $data_siswa->NIS ?> <br> Nama : <?= $data_siswa->Nama_siswa ?> <br> Kelas : <?= $data_siswa->Kelas ?> <br> Hadir : <?= dataHadir($NIS) ?> , Sakit : <?= dataSakit($NIS) ?> , Izin : <?= dataIzin($NIS) ?> </div>
            <div class="row mt-4">
                <div class="col">
                    <form action="" method="post">
                        <div class="input-group flex-nowrap" style="width: 250px;">
                            <input class="form-control " type="search" placeholder="Tanggal/Keterangan" aria-label="Search" name="keyword" style="opacity: 0.8;">
                            <button type="submit" class="tmbps input-group-text btn btn-info" id="addon-wrapping" data-toggle="tooltip" title="Cari"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col text-end">
                    <a href="<?= base_url() ?>/admin/export_excel_rekap?keyword=<?= $keyword ?>&NIS=<?= $data_siswa->NIS ?>&Nama=<?= $data_siswa->Nama_siswa ?>&Kelas=<?= $data_siswa->Kelas ?>&Hadir=<?= dataHadir($NIS) ?>&Sakit=<?= dataSakit($NIS) ?>&Izin=<?= dataIzin($NIS) ?>" target="_blank" data-toggle="tooltip" title="Export" class="btn btn-warning"><i class="fa-solid fa-file-export"></i></a>
                </div>
            </div>
            <div class="table-container">
                <table class="table mt-2 text-center table-striped" style="vertical-align: middle;">
                    <thead style="background-color: aliceblue; border-top: 2px solid black;">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Hari</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Jam Masuk</th>
                            <th scope="col">Jam Pulang</th>
                            <th scope="col">Keterangan</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php $no = 1 + (30 * ($currentPage - 1)); ?>
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
            </div>
            <?= $pager->links('absensi', 'absen_pagination'); ?>
        </div>
    </div>
</div>

<?php echo $this->endSection(); ?>