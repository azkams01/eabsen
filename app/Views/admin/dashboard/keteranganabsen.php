<?php echo $this->extend('/layout/tamplate_admin'); ?>

<?php echo $this->section('content'); ?>

<div class="container">
    <div class="row mt-3">
        <div class="col-md-3">
            <form action="" method="post">
                <div class="input-group flex-nowrap">
                    <input class="form-control " type="search" placeholder="Search" aria-label="Search" name="keyword" style="opacity: 0.8;">
                    <button type="submit" class="tmbps input-group-text btn btn-info" id="addon-wrapping" data-toggle="tooltip" title="Cari"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
        <div class="form-text">&nbsp;<i class="fas fa-info-circle"></i> Data yang dicari hanya berdasarkan keyword Nama dan Kelas</div>
    </div>
    <div class="row">
        <div class="col">
            <div class="table-container">
                <table class="table mt-2 text-center table-striped" style="vertical-align: middle;">
                    <thead style="background-color: aliceblue; border-top: 2px solid black;">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Id Absen</th>
                            <th scope="col">NIS</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Jam Masuk</th>
                            <th scope="col">Jam Pulang</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 + (50 * ($currentPage - 1)); ?>
                        <?php foreach ($data as $ds) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $ds['id_absensi']; ?></td>
                                <td><?= $ds['NIS']; ?></td>
                                <td><?= $ds['Nama_siswa']; ?></td>
                                <td><?= $ds['Kelas']; ?></td>
                                <td>
                                    <?php if ($ds['keterangan_absen'] == "Sakit|Pending" or $ds['keterangan_absen'] == "Izin|Pending" or $ds['keterangan_absen'] == "Sakit" or $ds['keterangan_absen'] == "Izin") { ?>
                                        -
                                    <?php } else { ?>
                                        <?= $ds['jam_masuk']; ?>
                                    <?php } ?>
                                </td>
                                <td> <?php if ($ds['keterangan_absen'] == "Sakit|Pending" or $ds['keterangan_absen'] == "Izin|Pending" or $ds['keterangan_absen'] == "Sakit" or $ds['keterangan_absen'] == "Izin") { ?>
                                        -
                                    <?php } else { ?>
                                        <?= $ds['jam_pulang']; ?>
                                    <?php } ?></td>
                                <td><?= $ds['keterangan_absen']; ?></td>
                                <td>
                                    <?php if ($ds['keterangan_absen'] == "Hadir|Masuk") { ?>
                                        <?= $ds['keterangan_desc'] ?>
                                    <?php } elseif ($ds['keterangan_absen'] == "Sakit|Pending" or $ds['keterangan_absen'] == "Izin|Pending") { ?>
                                        <button class="btn btn-sm btn-warning disabled"> <?= $ds['keterangan_absen'] ?> </button>
                                    <?php } elseif ($ds['keterangan_absen'] == "Sakit" or $ds['keterangan_absen'] == "Izin") { ?>
                                        <a class="btn btn-sm btn-warning" href="<?= base_url() ?>/admin/pesanKeteranganLampiran?tgl_absen=<?= $ds['tgl_absen']; ?>&keterangan=<?= $ds['keterangan_absen']; ?>&id=<?= $ds['id_absensi'] ?>"> <?= $ds['keterangan_absen']; ?> </a>
                                    <?php } else { ?>
                                        <?= $ds['keterangan_desc'] ?>
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