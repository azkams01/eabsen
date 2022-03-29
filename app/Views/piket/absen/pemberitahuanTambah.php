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
<?php } ?>

<div class="container">
    <div class="row">
        <div class="col">
            <form action="<?= base_url() ?>/piket/pemberitahuanTambahProses" method="post">
                <input type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
                <div class="card mt-2">
                    <div class="card-header" style="border-top: 4px solid darkcyan;">
                        <div class="row">
                            <div class="col-sm-10"><input type="text" readonly class="form-control-plaintext" value="<?= id_pemberitahuan() ?>"></div>
                            <div class="col-sm-2"><input type="text" readonly class="form-control-plaintext text-end" value="<?= $tanggal; ?>"></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label for="inputNarasumber" class="col-sm-2 col-form-label"><strong>Narasumber :</strong></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="inputNarasumber" name="narasumber" autofocus required="required">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-3 mb-3">
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="informasi" rows="3" required="required" placeholder="Masukan Informasi Disini ."></textarea>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="d-grid col-11 mx-auto">
                                <button class="btn btn-primary" type="submit">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php echo $this->endSection(); ?>