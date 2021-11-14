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
                document.location.href = '/users/profil'
            }
            document.location.href = '/users/profil'
        })
    </script>
    ";
<?php } ?>

<div class="container" style="width: 50rem; margin-top: 20px;">
    <div class="row">
        <div class="col">
            <div class="card mb-3">
                <img src="/img/header-profil.jpg" class="card-img-top" alt="..." style="height: 200px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="/img/<?php echo akunSiswa()->Foto ?>" class="img-thumbnail" alt="..." style="border-radius: 20px;">
                        </div>
                        <div class="col-md-10">
                            <h5 class="card-title"><?php echo akunSiswa()->Nama ?></h5>
                            <p class="card-text"><?php echo akunSiswa()->NIS ?></p>
                            <a href="/users/pengaturan"><button type="button" class="btn btn-secondary btn-sm"><i class="fas fa-cog"></i> Pengaturan</button></a>
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
                                        <font style="opacity: 0.5;">Nomor Induk Siswa</font><br> <strong style="opacity: 0.7;">1906510222</strong>
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
                                            <?php if (akunSiswa()->Email == "") {
                                                echo "Tidak Ada Data";
                                            } else {
                                                echo akunSiswa()->Email;
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
                                            <?php if (akunSiswa()->NomorHp == "0") {
                                                echo "Tidak Ada Data";
                                            } else {
                                                echo akunSiswa()->NomorHp;
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
                                            <?php if (akunSiswa()->Alamat == "") {
                                                echo "Tidak Ada Data";
                                            } else {
                                                echo akunSiswa()->Alamat;
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
                                            <?php if (akunSiswa()->JenisKelamin == "") {
                                                echo "Tidak Ada Data";
                                            } else {
                                                echo akunSiswa()->JenisKelamin;
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