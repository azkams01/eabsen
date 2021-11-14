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

<div class="card" style="width: 23rem; height: 350px; position: absolute; margin: auto; left: 0; right: 0; top: 0; bottom: 0; font-family: 'Zen Kurenaido', sans-serif; box-shadow: -1px -1px 15px rgb(206, 206, 206); border-radius: 15px;">
    <img src="/img/header-login.jpg" class="card-img-top" alt="..." />
    <div class="card-body">
        <form method="POST" action="/auth/loginProcess">
            <input type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
            <p class="text-center" style="color: rgb(31, 218, 218);"> <strong> Silahkan Masukan </strong></p>
            <div class="col-auto">
                <div class="input-group">
                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                    <input type="text" class="form-control" style="opacity: 0.8;" id="autoSizingInputGroup" name="NIS/NIP" placeholder="NIS / NIP" />
                </div>
            </div>
            <div class="input-group" style="padding-top: 10px;">
                <div class="input-group-text"><i class="fas fa-unlock"></i></div>
                <input type="password" class="form-control" style="opacity: 0.8;" id="autoSizingInputGroup" name="Password" placeholder="Password" />
            </div>
            <button type="submit" class="tombol btn text-white"><strong>Masuk</strong></button>
        </form>
    </div>
    <p class="text-center" style="margin-top: 20px; font-size: 12px; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; opacity: 0.6;">2021© Absensi Qr-Code Online v.2.0</p>
</div>
<?php echo $this->endSection(); ?>