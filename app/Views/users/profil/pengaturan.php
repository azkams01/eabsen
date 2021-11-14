<?php echo $this->extend('/layout/tamplate'); ?>

<?php echo $this->section('content'); ?>

<div class="container" style="width: 50rem; margin-top: 20px; background-color: white; border-radius: 5px;">
  <div class="row">
    <div class="col p-3" style="padding-top: 20px;">
      <strong style="font-size: 23px;">Biodata Diri</strong> <a href="/users/profil"> <button type="button" class="btn btn-secondary" style="float: right;"><i class="fas fa-arrow-left"></i> Kembali</button> </a> <br><br>
      <form style="font-size: 14px;" action="/users/profilProses/<?= akunSiswa()->id ?>" method="post">
        <input type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
        <div class="mb-3">
          <label for="NIS" class="form-label">NIS <font style="color: red;">*</font></label>
          <input type="text" class="form-control" id="NIS" value="<?= akunSiswa()->NIS ?>" name="NIS" style="opacity: 0.6;" readonly>
          <div class="form-text">&nbsp;<i class="fas fa-info-circle"></i> Pastikan NIS sesuai dengan data asli anda</div>
        </div>
        <div class="mb-3">
          <label for="Nama" class="form-label">Nama Lengkap <font style="color: red;">*</font></label>
          <input type="text" class="form-control" id="Nama" value="<?= akunSiswa()->Nama ?>" name="Nama" style="opacity: 0.6;" readonly>
        </div>
        <div class="mb-3">
          <div class="alert alert-info" role="alert">

            Format nama yang diizinkan <br> <br>

            - Mengandung angka atau huruf didalamnya <br>
            - Gunakan huruf besar atau huruf kecil <br>
            - Simbol yang diizinkan (, . ' ‘ ’ ` -)


          </div>
        </div>
        <div class="mb-3">
          <label for="foto" class="form-label">Foto</label>
          <input type="file" class="form-control" name="Foto" id="foto" style="opacity: 0.6;">
        </div>
        <div class="mb-3">
          <label for="Kelas" class="form-label">Kelas <font style="color: red;">*</font></label>
          <input type="text" class="form-control" id="Kelas" name="Kelas" value="XII-RPL-1" style="opacity: 0.6;" readonly>
        </div>
        <div class="mb-3">
          <label for="Kelas" class="form-label">Jenis Kelamin</label>
          <select class="form-select" aria-label="Default select example" name="JenisKelamin" style="opacity: 0.6;">
            <option selected> <?php if (akunSiswa()->JenisKelamin == "") {
                                echo "Pilih Jenis Kelamin";
                              } else {
                                echo akunSiswa()->JenisKelamin;
                              } ?></option>
            <option value="Laki-laki" name="JenisKelamin">Laki-laki</option>
            <option value="Perempuan" name="JenisKelamin">Perempuan</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label" required>Email <font style="color: red;">*</font></label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="Email" value="<?= akunSiswa()->Email ?>" style="opacity: 0.6;" placeholder="Masukan Email">
          <div class="form-text">&nbsp;<i class="fas fa-info-circle"></i> Kami tidak membagikan alamat email Anda kepada siapapun.</div>
        </div>
        <div class="mb-3">
          <label for="inputPassword" class="form-label">Password</label>
          <div class="input-group flex-nowrap">
            <input type="password" class="form-control" id="inputPassword" value="<?= akunSiswa()->Password ?>" name="Password" aria-label="Username" aria-describedby="addon-wrapping" style="opacity: 0.6;" readonly required>
            <button type="button" class="tmbps input-group-text btn btn-info" id="addon-wrapping"><i class="fas fa-eye"></i></button>
          </div>
        </div>
        <div class="mb-3">
          <label for="nomorTelepon" class="form-label" required>Nomor Telepon / Handpone <font style="color: red;">*</font></label>
          <input type="text" class="form-control" id="nomorTelepon" style="opacity: 0.6;" value="<?= akunSiswa()->NomorHp ?>" name="NomorHp" placeholder="Masukan Nomor Telepon">
          <div class="form-text">&nbsp;<i class="fas fa-info-circle"></i> Kami tidak membagikan nomor telepon Anda kepada siapapun.</div>
        </div>
        <div class="mb-3">
          <label for="alamat" class="form-label">Alamat</label>
          <textarea class="form-control" id="alamat" rows="3" placeholder="Masukan Alamat" name="Alamat" style="opacity: 0.6;"><?= akunSiswa()->Alamat ?></textarea>
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

<?php echo $this->endSection(); ?>