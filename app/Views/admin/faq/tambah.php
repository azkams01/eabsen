<?php echo $this->extend('/layout/tamplate_admin'); ?>

<?php echo $this->section('content'); ?>

<div class="container mt-2">
    <div class="row">
        <div class="col">
            <form action="<?= base_url() ?>/admin/tambahFaqProses" method="post">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                        <div class="accordion-body">
                            <input type="text" class="form-control" name="faq" id="exampleFormControlInput1" placeholder="Masukan Judul Faq">
                        </div>
                    </h2>
                    <div class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                        <div class="accordion-body">
                            <textarea class="form-control" name="isi_faq" id="exampleFormControlTextarea1" rows="3" placeholder="Masukan Isi Faq"></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary w-100">Tambah</button>
            </form>
        </div>
    </div>
</div>

<?php echo $this->endSection(); ?>