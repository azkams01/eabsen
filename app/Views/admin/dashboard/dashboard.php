<?php echo $this->extend('/layout/tamplate_admin'); ?>

<?php echo $this->section('content'); ?>


<?php if (session()->getFlashdata('pesan')) { ?>
    <script>
        Swal.fire(
            'Good job !!',
            '<?= session()->getFlashdata('pesan'); ?>',
            'success'
        ).then((result) => {
            if (result.value == true) {
                document.location.href = '<?= base_url() ?>/admin/dashboard'
            }
            document.location.href = '<?= base_url() ?>/admin/dashboard'
        })
    </script>
<?php } elseif (session()->getFlashdata('gagal')) { ?>
    <script>
        Swal.fire(
            'Woopss ..',
            '<?= session()->getFlashdata('gagal'); ?>',
            'error'
        ).then((result) => {
            if (result.value == true) {
                document.location.href = '<?= base_url() ?>/admin/dashboard'
            }
            document.location.href = '<?= base_url() ?>/admin/dashboard'
        })
    </script>
<?php } elseif (session()->getFlashdata('konfirmasi')) { ?>
    <script>
        Swal.fire({
            title: '<?= session()->getFlashdata('konfirmasi') ?>',
            text: "Data yang telah direstart tidak akan kembali",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, restart !'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = '<?= base_url() ?>/admin/restartAbsen'
            }
        })
    </script>
<?php } elseif (session()->getFlashdata('konfirmasiPesan')) { ?>
    <script>
        Swal.fire({
            title: '<?= session()->getFlashdata('konfirmasiPesan') ?>',
            text: "Data yang telah dihapus tidak akan kembali",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete !'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = '<?= base_url() ?>/admin/pesanSaranHapusSemua?konfirmasi=berhasil'
            }
        })
    </script>
<?php } elseif (session()->getFlashdata('formLibur')) { ?>
    <script>
        Swal.fire({
            title: '<?= id_libur() ?>',
            html: '<form action="<?= base_url() ?>/admin/aturLiburProses" method="post"><br> <input type="text" name="keterangan" placeholder="Masukan keterangan libur" class="form-control p-2 text-center" required="required" autofocus> <br> <input type="date" name = "tgl_libur" class="form-control p-2 text-center" required="required"><div class="form-text">&nbsp;<i class="fas fa-info-circle"></i> Sesuaikan tanggal dengan keterangan libur.</div> <br> <button type = "submit" class="btn btn-sm btn-primary" >Kirim</button> </form > ',
            showCloseButton: true,
            showConfirmButton: false
        })
    </script>
<?php } elseif (session()->getFlashdata('formTenggat')) { ?>
    <script>
        Swal.fire({
            title: '<?= id_ta() ?>',
            html: '<form action="<?= base_url() ?>/admin/aturTenggatProses" method="post"><br> <input type="date" name = "tgl_absen" class="form-control p-2 text-center" required="required"><div class="form-text">&nbsp;<i class="fas fa-info-circle"></i> Tentukan tanggal yang ingin menggunakan tenggat absen yang baru.</div><br> <h5>Tenggat Masuk</h5> <br> <div class="container"><div class="row"><div class="col"><input type="text" class="form-control p-2 text-center" placeholder="06:00:00" name="batas_masuk_awal" minlength="8" maxlength="8" required="required"></div><div class="col">-</div><div class="col"><input type="text" class="form-control p-2 text-center" placeholder="08:00:00" name="batas_masuk_akhir" minlength="8" maxlength="8" required="required"></div></div></div><br> <h5>Tenggat Pulang</h5> <br> <div class="container"><div class="row"><div class="col"><input type="text" class="form-control p-2 text-center" placeholder="10:00:00" name="batas_pulang_awal" minlength="8" maxlength="8" required="required"></div><div class="col">-</div><div class="col"><input type="text" class="form-control p-2 text-center" placeholder="12:00:00" name="batas_pulang_akhir" minlength="8" maxlength="8" required="required"></div></div></div><div class="form-text">&nbsp;<i class="fas fa-info-circle"></i> Masukan tenggat absen dengan benar sesuai contoh didalam kurung supaya sistem dapat membacanya.</div> <br> <button type = "submit" class="btn btn-sm btn-primary" name = "submit"" >Kirim</button> </form > ',
            showCloseButton: true,
            showConfirmButton: false
        })
    </script>
<?php } ?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <a href="<?= base_url() ?>/admin/konfirmasiRestart" class="btn btn-success btn-sm" style="width: 100%;">Restart Absen</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card mt-2">
                <div class="card-header" style="border-top: 4px solid darkcyan;">
                    <div class="row">
                        <div class="col-sm-10"><input type="text" readonly class="form-control-plaintext" value="Pemberitahuan"></div>
                        <div class="col-sm-2" style="padding-top: 4px;"><a href="<?= base_url() ?>/admin/pemberitahuanTambah" class="btn btn-warning btn-sm" style="position: relative; z-index: 2; float: right;" data-toggle="tooltip" title="Tambah Pemberitahuan"><i class="fa-solid fa-bullhorn"></i></a></div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="table-container">
                        <table class="table table-borderless" style="margin: -10px; opacity: 0.9; font-size: 15px;">
                            <thead style="border-bottom: 1px solid darkcyan;">
                                <tr>
                                    <th>Aksi</th>
                                    <th>No</th>
                                    <th>id Pemberitahuan</th>
                                    <th>Informasi</th>
                                    <th>Narasumber</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($pemberitahuan as $pb) { ?>
                                    <tr>
                                        <td class="col-sm-2"><a href="<?= base_url() ?>/admin/pemberitahuanEdit/<?= $pb['id_pemberitahuan']; ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Edit Pemberitahuan"><i class="fa-solid fa-pen-to-square"></i></a> | <a href="<?= base_url() ?>/admin/pemberitahuanHapus/<?= $pb['id_pemberitahuan']; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus Pemberitahuan"><i class="fa-solid fa-trash"></i></a></td>
                                        <td><?= $no++ ?></td>
                                        <td><?= $pb['id_pemberitahuan']; ?></td>
                                        <td><?= $pb['informasi']; ?></td>
                                        <td><?= $pb['narasumber']; ?></td>
                                        <td><?= $pb['tgl_info']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="form-text">&nbsp;<i class="fas fa-info-circle"></i> Pemberitahuan berguna untuk menambahkan informasi penting yang dapat dilihat oleh siswa dan guru.</div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col mt-2">
            <div class="card card-2-users">
                <img src="<?= base_url() ?>/img/head-hadir.png" class="card-img-top" alt="...">
                <div class="card-img-overlay">
                    <div class="row">
                        <p class="card-title" style="opacity: 0.7; "><?= $data_hadir ?></p>
                    </div>

                </div>
                <div class="card-body">
                    <h5 class="card-title">Data Siswa Hadir</h5>
                    <p class="card-text">Berikut adalah data siswa yang hadir hari ini</p>
                    <a href="<?= base_url() ?>/admin/keteranganAbsen?keterangan=Hadir" data-toggle="tooltip" title="Lihat Data Siswa Hadir" class="btn btn-primary" style="position: relative; z-index: 2;"><i class="far fa-eye"></i></a>
                </div>
            </div>
        </div>
        <div class="col mt-2">
            <div class="card card-2-users">
                <img src="<?= base_url() ?>/img/head-sakit.png" class="card-img-top" alt="...">
                <div class="card-img-overlay">
                    <p class="card-title" style="opacity: 0.7; "><?= $data_sakit ?></p>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Data Siswa Sakit</h5>
                    <p class="card-text">Berikut adalah data siswa yang Sakit hari ini</p>
                    <a href="<?= base_url() ?>/admin/keteranganAbsen?keterangan=Sakit" data-toggle="tooltip" title="Lihat Data Siswa Sakit " class="btn btn-primary" style="position: relative; z-index: 2;"><i class="far fa-eye"></i></a>
                </div>
            </div>
        </div>
        <div class="col mt-2">
            <div class="card card-2-users">
                <img src="<?= base_url() ?>/img/head-history.png" class="card-img-top" alt="...">
                <div class="card-img-overlay">
                    <p class="card-title" style="opacity: 0.7; "><?= $data_izin ?></p>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Data Siswa Izin</h5>
                    <p class="card-text">Berikut adalah data siswa yang Izin hari ini</p>
                    <a href="<?= base_url() ?>/admin/keteranganAbsen?keterangan=Izin" data-toggle="tooltip" title="Lihat Data Siswa Izin " class="btn btn-primary" style="position: relative; z-index: 2;"><i class="far fa-eye"></i></a>
                </div>
            </div>
        </div>
        <div class="col mt-2">
            <div class="card card-2-users">
                <img src="<?= base_url() ?>/img/head-belum-absen.png" class="card-img-top" alt="...">
                <div class="card-img-overlay">
                    <p class="card-title" style="opacity: 0.7; "></p>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Log Aktivitas</h5>
                    <p class="card-text">Record aktivitas user selama 1 minggu.</p>
                    <a href="<?= base_url() ?>/admin/sessionBookmark" data-toggle="tooltip" title="Lihat Log Aktivitas" class="btn btn-primary" style="position: relative; z-index: 2;"><i class="far fa-eye"></i></a>
                </div>
            </div>
        </div>
        <div class="form-text">&nbsp;<i class="fas fa-info-circle"></i> Jumlah siswa yang belum absen hari ini : <?= $data_belum_absen ?> siswa.</div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card mt-2">
                <div class="card-header" style="border-top: 4px solid darkcyan;">
                    <div class="row">
                        <div class="col-sm-10"><input type="text" readonly class="form-control-plaintext" value="Atur Tenggat Absen"></div>
                        <div class="col-sm-2" style="padding-top: 4px;"><a href="<?= base_url() ?>/admin/aturTenggatTambah" class="btn btn-warning btn-sm" style="position: relative; z-index: 2; float: right;" data-toggle="tooltip" title="Tambah Tenggat Absen"><i class="far fa-calendar-plus"></i></a></div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="table-container">
                        <table class="table table-borderless text-center" style="margin: -10px; opacity: 0.9; font-size: 15px;">
                            <thead style="border-bottom: 1px solid darkcyan;">
                                <tr>
                                    <th>Aksi</th>
                                    <th>Id Tenggat</th>
                                    <th>Tanggal Absen</th>
                                    <th>Tenggat Masuk</th>
                                    <th>Tenggat Pulang</th>
                                </tr>
                            </thead>
                            <tbody style="vertical-align: middle;">
                                <?php foreach ($tenggatAbsen as $ta) { ?>
                                    <tr>
                                        <td class="col-sm-2"><a href="<?= base_url() ?>/admin/aturTenggatHapus/<?= $ta['id_ta']; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus Tenggat Absen"> <i class="fas fa-trash"></i></a></td>
                                        <td><?= $ta['id_ta']; ?></td>
                                        <td><?= $ta['tgl_tenggat']; ?></td>
                                        <td><?= $ta['bm_awal']; ?> - <?= $ta['bm_akhir']; ?></td>
                                        <td><?= $ta['bp_awal']; ?> - <?= $ta['bp_akhir']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="form-text">&nbsp;<i class="fas fa-info-circle"></i> Atur Tenggat Absen berguna untuk mengatur batas absen siswa (tenggat absen default dari 06:00 - 07:15 untuk jam masuk dan 10:00 - 15:00 untuk jam pulang ).</div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card mt-2">
                <div class="card-header" style="border-top: 4px solid darkcyan;">
                    <div class="row">
                        <div class="col-sm-10"><input type="text" readonly class="form-control-plaintext" value="Atur Tanggal Libur"></div>
                        <div class="col-sm-2" style="padding-top: 4px;"><a href="<?= base_url() ?>/admin/aturLiburTambah" class="btn btn-warning btn-sm" style="position: relative; z-index: 2; float: right;" data-toggle="tooltip" title="Tambah Tanggal Libur"><i class="far fa-calendar-plus"></i></a></div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="table-container">
                        <table class="table table-borderless text-center" style="margin: -10px; opacity: 0.9; font-size: 15px;">
                            <thead style="border-bottom: 1px solid darkcyan;">
                                <tr>
                                    <th>Aksi</th>
                                    <th>Id Libur</th>
                                    <th>Keterangan Libur</th>
                                    <th>Tanggal Libur</th>
                                </tr>
                            </thead>
                            <tbody style="vertical-align: middle;">
                                <?php foreach ($tanggalLibur as $tl) { ?>
                                    <tr>
                                        <td class="col-sm-2"><a href="<?= base_url() ?>/admin/aturLiburHapus/<?= $tl['id_libur']; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus Tanggal Libur"> <i class="fas fa-trash"></i></a></td>
                                        <td><?= $tl['id_libur']; ?></td>
                                        <td><?= $tl['keterangan_libur']; ?></td>
                                        <td><?= $tl['tgl_libur']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="form-text">&nbsp;<i class="fas fa-info-circle"></i> Atur Tanggal Libur berguna untuk menambahkan hari libur , seperti tanggal merah atau acara acara besar lainnya (default libur hanya sabtu dan minggu).</div>
        </div>
        <div class="col">
            <div class="card mt-2">
                <div class="card-header" style="border-top: 4px solid darkcyan;">
                    <form action="<?= base_url() ?>/admin/pesanSaranHapusSemua" method="post">
                        <div class="row">
                            <div class="col-sm-8"><input type="text" readonly class="form-control-plaintext" value="Pesan Saran"></div>
                            <div class="col-sm-4" style="padding-top: 4px;"><button type="submit" class="btn btn-danger btn-sm" style="position: relative; z-index: 2; float: right;" data-toggle="tooltip" title="Hapus Data Yang Di Check"><i class="fa-solid fa-trash-can-arrow-up"></i></button></div>
                        </div>
                </div>
                <div class="card-body p-4">
                    <div class="table-container">
                        <table class="table table-borderless text-center" style="margin: -10px; opacity: 0.9; font-size: 15px;">
                            <thead style="border-bottom: 1px solid darkcyan;">
                                <tr>
                                    <th><input class="form-check-input" type="checkbox" onclick="pilih_akun(this)" value="" id="flexCheckDefault"></th>
                                    <th>Aksi</th>
                                    <th>Id Pesan</th>
                                    <th>Pengirim</th>
                                    <th>Pesan</th>
                                </tr>
                            </thead>
                            <tbody style="vertical-align: middle;">
                                <?php foreach ($pesanSaran as $ps) { ?>
                                    <tr>
                                        <td><input class="form-check-input" type="checkbox" name='pilihan_akun[]' value="<?= $ps['id_ps']; ?>" id="flexCheckDefault"></td>
                                        <td class="col-sm-2"><a href="<?= base_url() ?>/admin/pesanSaranHapus/<?= $ps['id_ps']; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus Pesan"> <i class="fas fa-trash"></i></a></td>
                                        <td><?= $ps['id_ps']; ?></td>
                                        <td><?= $ps['NIS']; ?></td>
                                        <td><?= $ps['pesan']; ?></td>
                                    </tr>
                                <?php } ?>
                                </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="form-text">&nbsp;<i class="fas fa-info-circle"></i> Pesan diatas berisi saran saran dari user mengenai aplikasi eabsen.</div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<script type="text/javascript">
    function pilih_akun(pilih_akun) {
        checkboxes = document.getElementsByName('pilihan_akun[]')
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = pilih_akun.checked;
        }
    }
</script>

<?php echo $this->endSection(); ?>