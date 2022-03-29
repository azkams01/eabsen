<?php echo $this->extend('/layout/tamplate_piket'); ?>

<?php echo $this->section('content'); ?>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-5">
            <div class="card-header bg-transparent mb-0">
                <h5 class="text-center"><span class="font-weight-bold text-primary">QR-GENERATOR</span></h5>
            </div>
            <div class=" card-body text-center">
                <?php
                if (isset(tenggat_absen()->tgl_tenggat)) {
                    if ($waktu >= tenggat_absen()->bm_awal and $waktu <= tenggat_absen()->bm_akhir) {
                        $kode = md5($tanggal . "|Masuk");
                        require_once('phpqrcode/qrlib.php');
                        QRcode::png("$kode", "eabsen-qr" . ".png", "M", 13, 0);
                ?>
                        <?php if (session()->get('matikan')) { ?>
                            <p style="padding-top: 20px; margin-bottom: 20px; color: rgb(0,0,0, 0.5);"><i class="fas fa-user-slash" style="font-size: 26px;"></i> <br> <?= session()->get('matikan') ?></p>
                        <?php } else { ?>
                            <img src="<?= base_url() ?>/eabsen-qr.png" alt="" style="padding-top: 20px; margin-bottom: 20px;">
                        <?php }
                    } elseif ($waktu >= tenggat_absen()->bp_awal and $waktu <= tenggat_absen()->bp_akhir) {
                        $kode = md5($tanggal . "|Pulang");
                        require_once('phpqrcode/qrlib.php');
                        QRcode::png("$kode", "eabsen-qr" . ".png", "M", 13, 0);
                        ?>
                        <?php if (session()->get('matikan')) { ?>
                            <p style="padding-top: 20px; margin-bottom: 20px; color: rgb(0,0,0, 0.5);"><i class="fas fa-user-slash" style="font-size: 26px;"></i> <br> <?= session()->get('matikan') ?></p>
                        <?php } else { ?>
                            <img src="<?= base_url() ?>/eabsen-qr.png" alt="" style="padding-top: 20px; margin-bottom: 20px;">
                        <?php }
                    } else {
                        $kode = "test";
                        require_once('phpqrcode/qrlib.php');
                        QRcode::png("$kode", "eabsen-qr" . ".png", "M", 13, 0);
                        ?>
                        <p style="padding-top: 20px; margin-bottom: 20px; color: rgb(0,0,0, 0.5);"><i class="fas fa-user-slash" style="font-size: 26px;"></i> <br> <br> QR-Code tidak dapat muncul diluar jam absen</p>
                    <?php }
                } elseif ($waktu < "10:00:00" and $waktu > "05:00:00") {
                    $kode = md5($tanggal . "|Masuk");
                    require_once('phpqrcode/qrlib.php');
                    QRcode::png("$kode", "eabsen-qr" . ".png", "M", 13, 0);
                    ?>
                    <?php if (session()->get('matikan')) { ?>
                        <p style="padding-top: 20px; margin-bottom: 20px; color: rgb(0,0,0, 0.5);"><i class="fas fa-user-slash" style="font-size: 26px;"></i> <br> <?= session()->get('matikan') ?></p>
                    <?php } else { ?>
                        <img src="<?= base_url() ?>/eabsen-qr.png" alt="" style="padding-top: 20px; margin-bottom: 20px;">
                    <?php }
                } elseif ($waktu > "10:00:00" and $waktu < "15:00:00") {
                    $kode = md5($tanggal . "|Pulang");
                    require_once('phpqrcode/qrlib.php');
                    QRcode::png("$kode", "eabsen-qr" . ".png", "M", 13, 0);
                    ?>
                    <?php if (session()->get('matikan')) { ?>
                        <p style="padding-top: 20px; margin-bottom: 20px; color: rgb(0,0,0, 0.5);"><i class="fas fa-user-slash" style="font-size: 26px;"></i> <br> <?= session()->get('matikan') ?></p>
                    <?php } else { ?>
                        <img src="<?= base_url() ?>/eabsen-qr.png" alt="" style="padding-top: 20px; margin-bottom: 20px;">
                    <?php }
                } else {
                    $kode = "test";
                    require_once('phpqrcode/qrlib.php');
                    QRcode::png("$kode", "eabsen-qr" . ".png", "M", 13, 0);
                    ?>
                    <p style="padding-top: 20px; margin-bottom: 20px; color: rgb(0,0,0, 0.5);"><i class="fas fa-user-slash" style="font-size: 26px;"></i> <br> <br> QR-Code tidak dapat muncul diluar jam sekolah</p>
                <?php } ?>
            </div>
            <div class="card-body text-center">
                <a href="<?= base_url() ?>/piket/pengaturan"><button type="button" class="btn btn-sm btn-secondary"><i class="fas fa-cog"></i> Pengaturan</button></a>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>