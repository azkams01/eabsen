<?php echo $this->extend('/layout/tamplate_admin'); ?>

<?php echo $this->section('content'); ?>

<div class="container" style="width: 100%; margin-top: 20px; background-color: white; border-radius: 5px;">
    <div class="row">
        <div class="col p-3" style="padding-top: 20px;">
            <strong style="font-size: 23px;">Biodata Diri</strong> <br><br>
            <form style="font-size: 14px;" action="<?= base_url() ?>/admin/editAkunGuruProses/<?= $id ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
                <input type="hidden" name="fotoLama" value="<?= $akunGuru->Foto_guru ?>">
                <div class=" mb-3">
                    <label for="NIP" class="form-label">NIP <font style="color: red;">*</font></label>
                    <input type="text" class="form-control" id="NIP" value="<?= $akunGuru->NIP ?>" name="NIP" style="opacity: 0.6;" readonly>
                    <div class="form-text">&nbsp;<i class="fas fa-info-circle"></i> Pastikan NIP sesuai dengan data asli anda</div>
                </div>
                <div class="mb-3">
                    <label for="Nama" class="form-label">Nama Lengkap <font style="color: red;">*</font></label>
                    <input type="text" class="form-control" id="Nama" value="<?= $akunGuru->Nama_guru ?>" name="Nama" style="opacity: 0.6;">
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control <?= ($validation->hasError('Foto')) ? 'is-invalid' : ''; ?>" name="Foto" id="foto" style="opacity: 0.6;">
                    <div class="invalid-feedback">
                        <?= $validation->getError('Foto'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="alert alert-info" role="alert">

                        Format foto yang diizinkan <br> <br>

                        - Format .jpg , .jpeg , .png<br>
                        - Ukuran file tidak lebih dari 5mb <br>
                        - Tidak mengandung unsur pornografi


                    </div>
                </div>
                <div class="mb-3">
                    <label for="Kelas" class="form-label">Wali Kelas <font style="color: red;">*</font></label>
                    <input type="text" class="form-control" id="Kelas" name="Kelas" value="<?= $akunGuru->walikelas ?>" style="opacity: 0.6;">
                </div>
                <div class="mb-3">
                    <label for="Kelas" class="form-label">Jenis Kelamin</label>
                    <select class="form-select" aria-label="Default select example" name="JenisKelamin" style="opacity: 0.6;">
                        <option selected> <?php if ($akunGuru->JenisKelamin_guru == "") {
                                                echo "Pilih Jenis Kelamin";
                                            } else {
                                                echo $akunGuru->JenisKelamin_guru;
                                            } ?></option>
                        <option value="Laki-laki" name="JenisKelamin">Laki-laki</option>
                        <option value="Perempuan" name="JenisKelamin">Perempuan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email <font style="color: red;">*</font></label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="Email" value="<?= $akunGuru->Email_guru ?>" style="opacity: 0.6;" placeholder="Masukan Email">
                    <div class="form-text">&nbsp;<i class="fas fa-info-circle"></i> Kami tidak membagikan alamat email Anda kepada siapapun.</div>
                </div>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Password</label>
                    <div class="input-group flex-nowrap">
                        <input type="password" class="form-control" id="inputPassword" minlength="8" maxlength="10" value="<?= $akunGuru->Password_guru ?>" name="Password" aria-label="Username" aria-describedby="addon-wrapping" style="opacity: 0.6;">
                        <button type="button" class="tmbps input-group-text btn btn-info" id="addon-wrapping"><i class="fas fa-eye"></i></button>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="nomorTelepon" class="form-label">Nomor Telepon / Handpone <font style="color: red;">*</font></label>
                    <input type="text" class="form-control" id="nomorTelepon" style="opacity: 0.6;" value="<?= $akunGuru->NomorHp_guru ?>" name="NomorHp" placeholder="Masukan Nomor Telepon">
                    <div class="form-text">&nbsp;<i class="fas fa-info-circle"></i> Kami tidak membagikan nomor telepon Anda kepada siapapun.</div>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" rows="3" placeholder="Masukan Alamat" name="Alamat" style="opacity: 0.6;"><?= $akunGuru->Alamat_guru ?></textarea>
                </div>

                <br>
                <p style="color: red; font-size: 12px; opacity: 0.8;">
                    *) Wajib diisi
                </p>
                <button type="submit" class="btn btn-sm btn-primary" style="width: 100%;">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Untuk Melihat isi password di profil

    const lihatpassword = document.querySelector('.tmbps')
    const password = document.getElementById('inputPassword')
    lihatpassword.addEventListener('click', function() {
        if (password.getAttribute("type") === "password") {
            password.setAttribute('type', 'text')
        } else {
            password.setAttribute('type', 'password')
        }
    })
</script>

<?php echo $this->endSection(); ?>