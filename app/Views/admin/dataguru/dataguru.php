<?php echo $this->extend('/layout/tamplate_admin'); ?>

<?php echo $this->section('content'); ?>
<?php if (session()->getFlashdata('formImpor')) { ?>
    <script>
        Swal.fire({
            title: 'Impor Data',
            html: '<form method="post" action="<?= base_url() ?>/admin/prosesExcelGuru" enctype="multipart/form-data"><div class="form-group"><div class="mb-3"><div class="alert alert-info" role="alert">Format yang diizinkan <br> <br>- Format .xls dan .xlsx <br>- Field pertama harus NIP <br>- Field nya terdiri dari NIP , Nama , Password dan Kelas , Selain itu data tidak dapat dibaca( urutan field harus sama ).</div><input type="file" name="fileimport" class="form-control" id="file" required accept=".xls, .xlsx" /></p></div><div class="form-group"><button class="btn btn-primary" type="submit">Upload</button></div></form>',
            showConfirmButton: false
        })
    </script>
<?php } elseif (session()->getFlashdata('Details')) { ?>
    <script>
        Swal.fire({
            title: 'Biodata <?= session()->getFlashdata('Details') ?>',
            html: '=<div class="card"><img src="<?= base_url() ?>/img/<?= session()->getFlashdata('Foto') ?>" class="card-img-top" alt="..."><div class="card-body"><h5 class="card-title"><?= session()->getFlashdata('NIP') ?></h5><p class="card-text"><?= session()->getFlashdata('Details') ?> | <?= session()->getFlashdata('Kelas') ?><br><?= session()->getFlashdata('JeNIPKelamin') ?></p></div><ul class="list-group list-group-flush"><li class="list-group-item"><i class="fa-solid fa-envelope"></i><br><?= session()->getFlashdata('Email') ?></li><li class="list-group-item"><i class="fa-solid fa-phone"></i><br><?= session()->getFlashdata('NomorHp') ?></li><li class="list-group-item"><i class="fa-solid fa-location-dot"></i><br><?= session()->getFlashdata('Alamat') ?></li></ul></div>',
            showConfirmButton: false,
            showCloseButton: true,
        })
    </script>
<?php } elseif (session()->getFlashdata('pesan')) { ?>
    <script>
        Swal.fire(
            'Good job !!',
            '<?= session()->getFlashdata('pesan'); ?>',
            'success'
        ).then((result) => {
            if (result.value == true) {
                document.location.href = '<?= base_url() ?>/admin/dataguru'
            }
            document.location.href = '<?= base_url() ?>/admin/dataguru'
        })
    </script>
<?php } elseif (session()->getFlashdata('error')) { ?>
    <script>
        Swal.fire(
            'Woops !!',
            '<?= session()->getFlashdata('error'); ?>',
            'error'
        ).then((result) => {
            if (result.value == true) {
                document.location.href = '<?= base_url() ?>/admin/dataguru'
            }
            document.location.href = '<?= base_url() ?>/admin/dataguru'
        })
    </script>
<?php } elseif (session()->getFlashdata('konfirmasiHapusAkun')) { ?>
    <script>
        Swal.fire({
            title: '<?= session()->getFlashdata('konfirmasiHapusAkun') ?>',
            text: "Data yang telah dihapus tidak akan kembali",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete !'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = '<?= base_url() ?>/admin/hapusAkunCheck'
            }
        })
    </script>
<?php } ?>
<!-- data guru -->
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
        <div class="col text-end">
            <form action="<?= base_url() ?>/admin/hapusAkunCheckGuru" method="post">
                <a href="<?= base_url() ?>/admin/formImporGuru" class="btn btn-success" data-toggle="tooltip" title="Impor Data Guru"><i class="fa-solid fa-file-import"></i></a>
                <a href="<?= base_url() ?>/admin/tambahAkunGuru" class="btn btn-warning" data-toggle="tooltip" title="Tambah Data Guru"><i class="fa-solid fa-user-plus"></i></a>
                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can-arrow-up" data-toggle="tooltip" title="Hapus Data Check"></i></button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table text-center table-striped" style="background-color: aliceblue; margin-top: 10px; vertical-align: middle; ">
                <thead style="background-color: aliceblue; border-top: 2px solid black;">
                    <tr>
                        <th scope="col"><input class="form-check-input" type="checkbox" onclick="pilih_akun(this)" value="" id="flexCheckDefault"></th>
                        <th scope="col" class="text-center">Aksi</th>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">NIP</th>
                        <th scope="col">Nama</th>
                        <th scope="col" class="text-center">Password</th>
                        <th scope="col" class="text-center">Wali Kelas</th>
                    </tr>

                </thead>
                <tbody>
                    <?php $no = 1 + (32 * ($currentPage - 1)); ?>
                    <?php foreach ($guru as $ds) { ?>
                        <tr>
                            <td><input class="form-check-input" type="checkbox" name='pilihan_akun[]' value="<?= $ds['NIP']; ?>" id="flexCheckDefault"></td>
                            <td class="text-center"><a href="<?= base_url() ?>/admin/editAkunGuru?id=<?= $ds['NIP'] ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Edit Data"><i class="fa-solid fa-pen-to-square"></i></a> | <a href="<?= base_url() ?>/admin/hapusAkunGuru?id=<?= $ds['NIP'] ?>&nama=<?= $ds['Nama_guru'] ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus Data"><i class="fa-solid fa-trash"></i></a> | <a href="<?= base_url() ?>/admin/DetailsGuru?id=<?= $ds['NIP'] ?>" class="btn btn-info btn-sm" data-toggle="tooltip" title="Lihat Profil"><i class="fa-solid fa-eye"></i></a></td>
                            <td class="text-center"><?php echo $no++; ?></td>
                            <td class="text-center"><?php echo $ds['NIP']; ?></td>
                            <td><?php echo $ds['Nama_guru']; ?></td>
                            <td class="text-center"><?php echo $ds['Password_guru']; ?></td>
                            <td class="text-center"><?php echo $ds['walikelas']; ?></td>
                        </tr>
                    <?php } ?>
                    </form>
                </tbody>
            </table>
        </div>
        <?= $pager->links('guru', 'data_guru_pagination'); ?>
    </div>
</div>

<script type="text/javascript">
    function pilih_akun(pilih_akun) {
        checkboxes = document.getElementsByName('pilihan_akun[]')
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = pilih_akun.checked;
        }
    }
</script>


<?php echo $this->endSection(); ?>