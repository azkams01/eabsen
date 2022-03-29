<?php echo $this->extend('/layout/tamplate'); ?>

<?php echo $this->section('content'); ?>

<?php if (session()->getFlashdata('pesan')) { ?>
    <script>
        Swal.fire(
            'Baguss !!',
            'Data Telah Tersimpan , Udah Bisa Absen Ya :)',
            'success'
        ).then((result) => {
            if (result.value == true) {
                document.location.href = '<?= base_url() ?>/users/absen'
            }
            document.location.href = '<?= base_url() ?>/users/absen'
        })
    </script>
<?php } ?>

<div class="container" style="width: 100%; margin-top: 20px;">
    <div class="row">
        <div class="col">
            <div class="card mb-3">
                <!-- <img src="<?= base_url() ?>/img/header-profil.jpg" class="card-img-top gambar-profil" alt="..." style="height: 200px;"> -->
                <div class="card-body profil-mode-dekstop">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="<?= base_url() ?>/img/<?php echo akunSiswa()->Foto_siswa ?>" class="img-thumbnail" alt="..." style="border-radius: 20px;">
                        </div>
                        <div class="col-md-10 profil-hp">
                            <h5 class="card-title" style="padding-top: 10px;"><?php echo akunSiswa()->Nama_siswa ?></h5>
                            <p class="card-text"><?php echo akunSiswa()->NIS ?></p>
                            <a href="<?= base_url() ?>/users/pengaturan"><button type="button" class="btn btn-secondary btn-sm"><i class="fas fa-cog"></i> Pengaturan</button></a>
                        </div>
                    </div>
                </div>
                <div class="card-body text-center profil-mode-hp">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="<?= base_url() ?>/img/<?php echo akunSiswa()->Foto_siswa ?>" class="img-thumbnail" alt="..." style="border-radius: 20px;">
                        </div>
                        <div class="col-md-10 profil-hp">
                            <h5 class="card-title" style="padding-top: 10px;"><?php echo akunSiswa()->Nama_siswa ?></h5>
                            <p class="card-text"><?php echo akunSiswa()->NIS ?></p>
                            <a href="<?= base_url() ?>/users/pengaturan"><button type="button" class="btn btn-secondary btn-sm"><i class="fas fa-cog"></i> Pengaturan</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Profil
                </div>

                <!-- Baris 1 -->

                <div class="card-body" style="font-size: 13px;">
                    <div class="row" style="border-bottom: 1px solid rgb(73, 73, 73,0.3);">
                        <div class="col">
                            <div class="row">
                                <div class="col-md-1">
                                    <p style="padding-top: 7px; opacity: 0.6;"><i class="far fa-id-badge"></i></p>
                                </div>
                                <div class="col">
                                    <p>
                                        <font style="opacity: 0.5;">Nomor Induk Siswa</font><br> <strong style="opacity: 0.7;"><?= akunSiswa()->NIS; ?></strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-md-1">
                                    <p style="padding-top: 8px; opacity: 0.6;"><i class="fas fa-envelope"></i></p>
                                </div>
                                <div class="col">
                                    <p>
                                        <font style="opacity: 0.5;">Email</font><br> <strong style="opacity: 0.7;">
                                            <?php if (akunSiswa()->Email_siswa == "") {
                                                echo "Tidak Ada Data";
                                            } else {
                                                echo akunSiswa()->Email_siswa;
                                            } ?></strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-md-1">
                                    <p style="padding-top: 8px; opacity: 0.6;"><i class="fas fa-phone-square-alt"></i></p>
                                </div>
                                <div class="col">
                                    <p>
                                        <font style="opacity: 0.5;">Nomor</font><br> <strong style="opacity: 0.7;">
                                            <?php if (akunSiswa()->NomorHp_siswa == "0") {
                                                echo "Tidak Ada Data";
                                            } else {
                                                echo akunSiswa()->NomorHp_siswa;
                                            } ?></strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Baris 2 -->

                    <div class="row" style="padding-top: 15px;">
                        <div class="col">
                            <div class="row">
                                <div class="col-md-1">
                                    <p style="padding-top: 7px; opacity: 0.6;"><i class="fas fa-map-marker-alt"></i></p>
                                </div>
                                <div class="col">
                                    <p>
                                        <font style="opacity: 0.5;">Alamat</font><br> <strong style="opacity: 0.7;">
                                            <?php if (akunSiswa()->Alamat_siswa == "") {
                                                echo "Tidak Ada Data";
                                            } else {
                                                echo akunSiswa()->Alamat_siswa;
                                            } ?></strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-md-1">
                                    <p style="padding-top: 8px; opacity: 0.6;"><i class="fas fa-venus-mars"></i></p>
                                </div>
                                <div class="col">
                                    <p>
                                        <font style="opacity: 0.5;">Jenis Kelamin</font><br> <strong style="opacity: 0.7;">
                                            <?php if (akunSiswa()->JenisKelamin_siswa == "") {
                                                echo "Tidak Ada Data";
                                            } else {
                                                echo akunSiswa()->JenisKelamin_siswa;
                                            } ?></strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-md-1">
                                    <p style="padding-top: 8px; opacity: 0.6;"><i class="fas fa-graduation-cap"></i></p>
                                </div>
                                <div class="col">
                                    <p>
                                        <font style="opacity: 0.5;">Kelas</font><br> <strong style="opacity: 0.7;">
                                            <?php if (akunSiswa()->Kelas == "") {
                                                echo "Tidak Ada Data";
                                            } else {
                                                echo akunSiswa()->Kelas;
                                            } ?></strong></strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<?php echo $this->endSection(); ?>