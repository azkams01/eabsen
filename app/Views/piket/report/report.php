<?php echo $this->extend('/layout/tamplate_piket'); ?>

<?php echo $this->section('content'); ?>

<!-- data absen -->
<div class="container">
    <div class="row">
        <div class="col">
            <div class="row mt-4">
                <!-- <div class="col">
                    
                        <input type="date" name="tanggal" class="form-control" value="">
                </div> -->
                <div class="col">
                    <form action="" method="post">
                        <div class="input-group flex-nowrap" style="width: 250px;">
                            <input class="form-control" type="search" placeholder="Keyword data" aria-label="Search" name="keyword" style="opacity: 0.8;">
                            <button type="submit" class="tmbps input-group-text btn btn-info" id="addon-wrapping">Cari</button>
                            &nbsp;<a href="#" class="btn btn-secondary" data-toggle="tooltip" title="Filter Data"><i class="fa-solid fa-filter"></i></a>
                        </div>
                    </form>
                </div>
                <div class="col text-end">
                    <a href="<?= base_url() ?>/piket/export_excel?keyword=<?= $keyword ?>" target="_blank" class="btn btn-primary">Export</a>
                </div>
            </div>
            <div class="form-text">&nbsp;<i class="fas fa-info-circle"></i> Disarankan untuk meng-export menggunakan chrome .</div>
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
                            <th scope="col">Keterangan</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php $no = 1 + (20 * ($currentPage - 1)); ?>
                        <?php foreach ($absen as $hs) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $hs['NIS']; ?></td>
                                <td><?= $hs['Nama_siswa']; ?></td>
                                <td><?= $hs['Kelas']; ?></td>
                                <td><?= $hs['hari_absen']; ?></td>
                                <td><?= $hs['tgl_absen']; ?></td>
                                <td><?= $hs['keterangan_absen']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?= $pager->links('absen', 'absen_pagination'); ?>
        </div>
    </div>
</div>

<?php echo $this->endSection(); ?>