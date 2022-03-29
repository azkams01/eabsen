<?php echo $this->extend('/layout/tamplate_guru'); ?>

<?php echo $this->section('content'); ?>

<?php if (session()->getFlashdata('Details')) { ?>
    <script>
        Swal.fire({
            title: 'Biodata <?= session()->getFlashdata('Details') ?>',
            html: '=<div class="card"><img src="<?= base_url() ?>/img/<?= session()->getFlashdata('Foto') ?>" class="card-img-top" alt="..."><div class="card-body"><h5 class="card-title"><?= session()->getFlashdata('NIS') ?></h5><p class="card-text"><?= session()->getFlashdata('Details') ?> | <?= session()->getFlashdata('Kelas') ?><br><?= session()->getFlashdata('JenisKelamin') ?></p></div><ul class="list-group list-group-flush"><li class="list-group-item"><i class="fa-solid fa-envelope"></i><br><?= session()->getFlashdata('Email') ?></li><li class="list-group-item"><i class="fa-solid fa-phone"></i><br><?= session()->getFlashdata('NomorHp') ?></li><li class="list-group-item"><i class="fa-solid fa-location-dot"></i><br><?= session()->getFlashdata('Alamat') ?></li></ul></div>',
            showConfirmButton: false,
            showCloseButton: true,
        })
    </script>
<?php } ?>

<!-- data siswa -->
<div class="container mt-3">
    <div class="row">
        <div class="col">
            <form action="" method="post">
                <div class="input-group flex-nowrap" style="width: 250px;">
                    <input class="form-control " type="search" placeholder="Search" aria-label="Search" name="keyword" style="opacity: 0.8;">
                    <button type="submit" class="tmbps input-group-text btn btn-info" id="addon-wrapping" data-toggle="tooltip" title="Cari"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
        <div class="form-text">&nbsp;<i class="fas fa-info-circle"></i> Data yang dicari hanya berdasarkan keyword Nama dan NIS</div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table text-center table-striped" style="background-color: aliceblue; margin-top: 10px; vertical-align: middle; ">
                <thead style="background-color: aliceblue; border-top: 2px solid black;">
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">NIS</th>
                        <th scope="col">Nama</th>
                        <th scope="col" class="text-center">Detail</th>
                    </tr>

                </thead>
                <tbody>
                    <?php $no = 1 + (10 * ($currentPage - 1)); ?>
                    <?php foreach ($akun_siswa as $ds) { ?>
                        <tr>
                            <td class="text-center"><?php echo $no++; ?></td>
                            <td class="text-center"><?php echo $ds['NIS']; ?></td>
                            <td><?php echo $ds['Nama_siswa']; ?></td>
                            <td class="text-center"><a href="<?= base_url() ?>/guru/Details?id=<?= $ds['NIS'] ?>" class="btn btn-info btn-sm" data-toggle="tooltip" title="Lihat Profil"><i class="fa-solid fa-eye"></i></a></td>
                        </tr>
                    <?php } ?>
                    </form>
                </tbody>
            </table>
        </div>
        <?= $pager->links('siswa', 'data_siswa_pagination'); ?>
    </div>
</div>
<?php echo $this->endSection(); ?>