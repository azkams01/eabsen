<?php echo $this->extend('/layout/tamplate_admin'); ?>

<?php echo $this->section('content'); ?>

<?php if (session()->getFlashdata('formFilter')) { ?>
    <script>
        Swal.fire({
            title: 'Filter Report',
            html: '<form action="<?= base_url() ?>/admin/filterReport" method="post"><br> <input type="text" name="Kelas" placeholder="XII-RPL-1" class="form-control p-2 text-center" required="required"><div class="form-text">&nbsp;<i class="fas fa-info-circle"></i> Masukan nama kelas yang ingin anda cari dengan keyword yang benar contoh "XII-RPL-1".</div> <br> <input type="date" name = "tgl_absen" class="form-control p-2 text-center" required="required"><div class="form-text">&nbsp;<i class="fas fa-info-circle"></i> Sesuaikan tanggal dengan keterangan libur.</div> <br> <div class="mb-3"><select class="form-select" name="Keterangan"><option value="Hadir" name="Keterangan">Hadir</option><option value="Sakit" name="Keterangan">Sakit</option><option value="Izin" name="Keterangan">Izin</option></select></div> <br> <button type = "submit" class="btn btn-sm btn-primary" >Kirim</button></form > ',
            showCloseButton: true,
            showConfirmButton: false
        })
    </script>
<?php } ?>
<!-- data absen -->
<div class="container">
    <div class="row">
        <div class="col">
            <div class="row mt-4">
                <div class="col">
                    <form action="" method="post">
                        <div class="input-group flex-nowrap" style="width: 250px;">
                            <input class="form-control " type="search" placeholder="Search" aria-label="Search" name="keyword" style="opacity: 0.8;">
                            <button type="submit" class="tmbps input-group-text btn btn-info" id="addon-wrapping" data-toggle="tooltip" title="Cari"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col text-end">
                    <a href="<?= base_url() ?>/admin/aturFilterReport" data-toggle="tooltip" title="Filter Kehadiran Kelas" class="btn btn-secondary"><i class="fa-solid fa-filter"></i></a>
                    <a href="<?= base_url() ?>/admin/export_excel?keyword=<?= $keyword ?>" target="_blank" data-toggle="tooltip" title="Export" class="btn btn-warning"><i class="fa-solid fa-file-export"></i></a>
                </div>
            </div>
            <div class="table-container">
                <table class="table mt-2 text-center table-striped" style="vertical-align: middle;">
                    <thead style="background-color: aliceblue; border-top: 2px solid black;">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">NIS</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Jumlah Hadir</th>
                            <th scope="col">Jumlah Sakit</th>
                            <th scope="col">Jumlah Izin</th>
                            <th scope="col">Rekap Siswa</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php $no = 1 + (20 * ($currentPage - 1)); ?>
                        <?php foreach ($history as $hs) { ?>
                            <?php $pisah = explode(" ", $hs['Nama_siswa']); ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $hs['NIS']; ?></td>
                                <td><?= $hs['Nama_siswa']; ?></td>
                                <td><?= $hs['Kelas']; ?></td>
                                <td><?= dataHadir($hs['NIS']); ?></td>
                                <td><?= dataSakit($hs['NIS']); ?></td>
                                <td><?= dataIzin($hs['NIS']); ?></td>
                                <td><a href="<?= base_url() ?>/admin/rekapsiswa?NIS=<?= $hs['NIS'] ?>" data-toggle="tooltip" title="Lihat Rekap Data <?= $pisah[0]; ?>" class="btn btn-sm btn-primary" style="position: relative; z-index: 2;"><i class="far fa-eye"></i></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?= $pager->links('siswa', 'data_siswa_pagination'); ?>
        </div>
    </div>
</div>


<?php echo $this->endSection(); ?>