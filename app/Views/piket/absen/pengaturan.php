<?php echo $this->extend('/layout/tamplate_piket'); ?>

<?php echo $this->section('content'); ?>

<?php if (session()->getFlashdata('pesan')) { ?>
    <script>
        Swal.fire(
            'Good job !!',
            '<?= session()->getFlashdata('pesan'); ?>',
            'success'
        ).then((result) => {
            if (result.value == true) {
                document.location.href = '<?= base_url() ?>/piket/pengaturan'
            }
            document.location.href = '<?= base_url() ?>/piket/pengaturan'
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
                document.location.href = '<?= base_url() ?>/piket/pengaturan'
            }
            document.location.href = '<?= base_url() ?>/piket/pengaturan'
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
                document.location.href = '<?= base_url() ?>/piket/restartAbsen'
            }
        })
    </script>
<?php } elseif (session()->getFlashdata('formLibur')) { ?>
    <script>
        Swal.fire({
            title: '<?= id_libur() ?>',
            html: '<form action="<?= base_url() ?>/piket/aturLiburProses" method="post"><br> <input type="text" name="keterangan" placeholder="Masukan keterangan libur" class="form-control p-2 text-center" required="required" autofocus> <br> <input type="date" name = "tgl_libur" class="form-control p-2 text-center" required="required"><div class="form-text">&nbsp;<i class="fas fa-info-circle"></i> Sesuaikan tanggal dengan keterangan libur.</div> <br> <button type = "submit" class="btn btn-sm btn-primary" >Kirim</button> </form > ',
            showCloseButton: true,
            showConfirmButton: false
        })
    </script>
<?php } elseif (session()->getFlashdata('formTenggat')) { ?>
    <script>
        Swal.fire({
            title: '<?= id_ta() ?>',
            html: '<form action="<?= base_url() ?>/piket/aturTenggatProses" method="post"><br> <input type="date" name = "tgl_absen" class="form-control p-2 text-center" required="required"><div class="form-text">&nbsp;<i class="fas fa-info-circle"></i> Tentukan tanggal yang ingin menggunakan tenggat absen yang baru.</div><br> <h5>Tenggat Masuk</h5> <br> <div class="container"><div class="row"><div class="col"><input type="text" class="form-control p-2 text-center" placeholder="06:00:00" minlength="8" maxlength="8" name="batas_masuk_awal" required="required"></div><div class="col">-</div><div class="col"><input type="text" class="form-control p-2 text-center" placeholder="08:00:00" minlength="8" maxlength="8" name="batas_masuk_akhir" required="required"></div></div></div><br> <h5>Tenggat Pulang</h5> <br> <div class="container"><div class="row"><div class="col"><input type="text" class="form-control p-2 text-center" placeholder="10:00:00" minlength="8" maxlength="8" name="batas_pulang_awal" required="required"></div><div class="col">-</div><div class="col"><input type="text" class="form-control p-2 text-center" placeholder="12:00:00" minlength="8" maxlength="8" name="batas_pulang_akhir" required="required"></div></div></div><div class="form-text">&nbsp;<i class="fas fa-info-circle"></i> Masukan tenggat absen dengan benar sesuai contoh didalam kurung supaya sistem dapat membacanya.</div> <br> <button type = "submit" class="btn btn-sm btn-primary" name = "submit"" >Kirim</button> </form > ',
            showCloseButton: true,
            showConfirmButton: false
        })
    </script>
<?php } ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card mt-2">
                <div class="card-header" style="border-top: 4px solid darkcyan;">
                    <div class="row">
                        <div class="col-sm-10"><input type="text" readonly class="form-control-plaintext" value="Pemberitahuan"></div>
                        <div class="col-sm-2" style="padding-top: 4px;"><a href="<?= base_url() ?>/piket/pemberitahuanTambah" class="btn btn-warning btn-sm" style="position: relative; z-index: 2; float: right;">Tambah</a></div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="table-container">
                        <table class="table table-borderless" style="margin: -10px; opacity: 0.9; font-size: 15px;">
                            <thead style="border-bottom: 1px solid darkcyan;">
                                <tr>
                                    <th>Aksi</th>
                                    <th>No</th>
                                    <th>Id Pb</th>
                                    <th>Informasi</th>
                                    <th>Narasumber</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($pemberitahuan as $pb) { ?>
                                    <tr>
                                        <td class="col-sm-2"><a href="<?= base_url() ?>/piket/pemberitahuanEdit/<?= $pb['id_pemberitahuan']; ?>" class="btn btn-primary btn-sm">Edit</a> | <a href="<?= base_url() ?>/piket/pemberitahuanHapus/<?= $pb['id_pemberitahuan']; ?>" class="btn btn-danger btn-sm">Hapus</a></td>
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
<div class="container mt-4">
    <div class="row">
        <div class="col">
            <a href="<?= base_url() ?>/piket/konfirmasiRestart" class="btn btn-success btn-sm" style="width: 100%;">Restart Absen</a>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-sm-6">
            <a href="<?= base_url() ?>/piket/matikanQr" class="btn btn-danger btn-sm" style="width: 100%;">Matikan qr-generator</a>
        </div>
        <div class="col-sm-6">
            <a href="<?= base_url() ?>/piket/nyalakanQr" class="btn btn-info btn-sm" style="width: 100%;">Nyalakan qr-generator</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="card mt-2">
                <div class="card-header" style="border-top: 4px solid darkcyan;">
                    <div class="row">
                        <div class="col-sm-10"><input type="text" readonly class="form-control-plaintext" value="Atur Tenggat Absen"></div>
                        <div class="col-sm-2" style="padding-top: 4px;"><a href="<?= base_url() ?>/piket/aturTenggatTambah" class="btn btn-warning btn-sm" style="position: relative; z-index: 2; float: right;">Tambah</a></div>
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
                                <?php $no = 1; ?>
                                <?php foreach ($tenggatAbsen as $ta) { ?>
                                    <tr>
                                        <td class="col-sm-2"><a href="<?= base_url() ?>/piket/aturTenggatHapus/<?= $ta['id_ta']; ?>" class="btn btn-danger btn-sm"> <i class="fas fa-trash"></i> Hapus</a></td>
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
        <div class="col">
            <div class="card mt-2">
                <div class="card-header" style="border-top: 4px solid darkcyan;">
                    <div class="row">
                        <div class="col-sm-10"><input type="text" readonly class="form-control-plaintext" value="Atur Tanggal Libur"></div>
                        <div class="col-sm-2" style="padding-top: 4px;"><a href="<?= base_url() ?>/piket/aturLiburTambah" class="btn btn-warning btn-sm" style="position: relative; z-index: 2; float: right;">Tambah</a></div>
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
                                <?php $no = 1; ?>
                                <?php foreach ($tanggalLibur as $tl) { ?>
                                    <tr>
                                        <td class="col-sm-2"><a href="<?= base_url() ?>/piket/aturLiburHapus/<?= $tl['id_libur']; ?>" class="btn btn-danger btn-sm"> <i class="fas fa-trash"></i> Hapus</a></td>
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
    </div>
</div>

<?php echo $this->endSection(); ?>