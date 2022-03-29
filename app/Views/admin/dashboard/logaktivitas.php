<?php echo $this->extend('/layout/tamplate_admin'); ?>

<?php echo $this->section('content'); ?>

<?php if (session()->getFlashdata('bookmarkOn')) { ?>
    <script>
        Swal.fire({
            title: 'Keterangan',
            html: ' <br> # Id User : Id dari masing masing user , diantaranya : <br> 1 = Siswa | 2 = Guru | 3 = Piket | 4 = Admin <br> <br> # Username : Setiap Id User memiliki username , untuk siswa menggunakan NIS dan untuk guru menggunakan NIP <br> <br> # Aktivitas : Kegiatan yang dilakukan oleh user , dikondisikan dalam bentuk angka : <br> 0 = Logout | 1 = Login | 2 = Insert | 3 = Update | 4 = Delete . ',
            confirmButtonText: 'Mengerti'
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                document.location.href = '<?= base_url() ?>/admin/logAktivitas'
            } else {
                document.location.href = '<?= base_url() ?>/admin/sessionBookmark'
            }
        })
    </script>
<?php } elseif (session()->getFlashdata('Details')) { ?>
    <script>
        Swal.fire({
            title: 'Biodata <?= session()->getFlashdata('Details') ?>',
            html: '=<div class="card"><img src="<?= base_url() ?>/img/<?= session()->getFlashdata('Foto') ?>" class="card-img-top" alt="..."><div class="card-body"><h5 class="card-title"><?= session()->getFlashdata('NIS') ?></h5><p class="card-text"><?= session()->getFlashdata('Details') ?> | <?= session()->getFlashdata('Kelas') ?><br><?= session()->getFlashdata('JenisKelamin') ?></p></div><ul class="list-group list-group-flush"><li class="list-group-item"><i class="fa-solid fa-envelope"></i><br><?= session()->getFlashdata('Email') ?></li><li class="list-group-item"><i class="fa-solid fa-phone"></i><br><?= session()->getFlashdata('NomorHp') ?></li><li class="list-group-item"><i class="fa-solid fa-location-dot"></i><br><?= session()->getFlashdata('Alamat') ?></li></ul></div>',
            showConfirmButton: false,
            showCloseButton: true,
        })
    </script>
<?php } ?>

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
        <div class="col text-end">
            <a href="<?= base_url() ?>/admin/sessionBookmark" class="btn btn-dark" data-toggle="tooltip" title="Keterangan"><i class="fa-solid fa-bookmark"></i></a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="table-container">
                <table class="table mt-2 text-center table-striped" style="vertical-align: middle;">
                    <thead style="background-color: aliceblue; border-top: 2px solid black; vertical-align:middle;">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Id Log</th>
                            <th scope="col">Id User</th>
                            <th scope="col">Username</th>
                            <th scope="col">Aktivitas</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Alamat(IP,Platform,Browser)</th>
                            <th scope="col">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 + (50 * ($currentPage - 1)); ?>
                        <?php foreach ($log as $la) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $la['id_la']; ?></td>
                                <td><?= $la['id_user']; ?></td>
                                <td>
                                    <?= $la['username']; ?>
                                </td>
                                <td><?= $la['aktivitas']; ?></td>
                                <td><?= $la['deskripsi']; ?></td>
                                <td><?= $la['alamat_akses']; ?></td>
                                <td><?= $la['tanggal']; ?> <?= $la['waktu']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?= $pager->links('log_aktivitas', 'log_aktivitas_pagination'); ?>
        </div>
    </div>
</div>

<?php echo $this->endSection(); ?>