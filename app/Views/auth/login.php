<?php echo $this->extend('/layout/header'); ?>

<?php echo $this->section('style'); ?>

<style>
    .tombol {
        background-color: rgb(31, 218, 218);
        float: right;
        margin-top: 10px;
    }

    .tombol:hover {
        background-color: darkcyan;
    }
</style>

<?php echo $this->endSection(); ?>

<?php echo $this->section('content'); ?>

<?php if (session()->getFlashdata('error')) { ?>
    <div class="alert alert-danger text-center" role="alert">
        Username atau Password Salah
    </div>
<?php } ?>

<div class="card tampilan-login">
    <img src="<?= base_url() ?>/img/header-login.jpg" class="card-img-top" alt="..." />
    <div class="card-body">
        <form method="POST" action="<?= base_url() ?>/auth/loginProcess">
            <input type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
            <p class="text-center" style="color: #008b8b;"> <strong> Silahkan Masukan </strong></p>
            <div class="col-auto">
                <div class="input-group">
                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                    <input type="text" class="form-control" style="opacity: 0.8;" id="autoSizingInputGroup" name="username" placeholder="NIS / NIP" />
                </div>
            </div>
            <div class="input-group" style="padding-top: 10px;">
                <div class="input-group-text"><i class="fas fa-unlock"></i></div>
                <input type="password" class="form-control" style="opacity: 0.8;" id="autoSizingInputGroup" name="Password" placeholder="Password" />
            </div>
            <button type="submit" class="tombol btn text-white"><strong>Masuk</strong></button>
        </form>
    </div>
    <a class="text-center" href="<?= base_url() ?>/auth/onepage" style="margin-top: 20px; font-size: 12px; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; opacity: 0.6;">Kembali ke Onepage</a>
    <p class="text-center" style="font-size: 12px; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; opacity: 0.6;">2021© Absensi Qr-Code Online v.2.0</p>
</div>
<?php echo $this->endSection(); ?>