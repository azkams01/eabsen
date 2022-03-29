<?php echo $this->extend('/layout/tamplate_admin'); ?>

<?php echo $this->section('content'); ?>

<div class="container" style="width: 100%; margin-top: 20px; background-color: white; border-radius: 5px;">
    <div class="row">
        <div class="col p-3" style="padding-top: 20px;">
            <strong style="font-size: 23px;">Tambah Data Siswa</strong> <a href="<?= base_url() ?>/users/profil"> </a> <br><br>
            <form style="font-size: 14px;" action="<?= base_url() ?>/admin/tambahAkunSiswaProses" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
                <div class="mb-3">
                    <label for="NIS" class="form-label">NIS <font style="color: red;">*</font></label>
                    <input type="text" class="form-control" placeholder="190*******" id="NIS" value="" name="NIS" minlength="10" maxlength="10" style="opacity: 0.6;" required>
                </div>
                <div class="mb-3">
                    <label for="Nama" class="form-label">Nama Lengkap Siswa<font style="color: red;">*</font></label>
                    <input type="text" class="form-control" id="Nama" placeholder="DIDIN CAHYADI" value="" name="Nama" style="opacity: 0.6;" required>
                </div>
                <div class="mb-3">
                    <label for="Kelas" class="form-label">Kelas <font style="color: red;">*</font></label>
                    <input type="text" class="form-control" id="Kelas" placeholder="XII-AKL-2" name="Kelas" value="" style="opacity: 0.6;" required>
                </div>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Password <font style="color: red;">*</font></label>
                    <div class="input-group flex-nowrap">
                        <input type="text" class="form-control" placeholder="123******" id="inputPassword" value="" name="Password" minlength="8" maxlength="8" aria-label="Username" aria-describedby="addon-wrapping" style="opacity: 0.6;" required>
                        <button type="button" class="tmbps input-group-text btn btn-info" id="addon-wrapping">Set Default</button>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary" style="width: 100%;">Simpan</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Untuk Melihat isi password di profil

    const lihatpassword = document.querySelector('.tmbps')
    const password = document.getElementById('inputPassword')
    lihatpassword.addEventListener('click', function() {
        password.setAttribute('value', '12345678')
    })
</script>


<?php echo $this->endSection(); ?>