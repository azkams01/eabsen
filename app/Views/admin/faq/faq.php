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
                document.location.href = '<?= base_url() ?>/admin/faq'
            }
            document.location.href = '<?= base_url() ?>/admin/faq'
        })
    </script>
<?php } ?>

<div class="container-fluid">
    <div class="row">
        <a href="<?= base_url() ?>/admin/tambahFaq" class="btn btn-warning btn-sm" type="submit"><i class="fas fa-plus-square"></i> Tambah </a>
    </div>
    <div class="row mt-2">
        <div class="col">
            <?php foreach ($faq as $f) { ?>
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <?php if ($f['faq'] == "Scanner Tidak Muncul ?") { ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse<?= $f["id_faq"] ?>" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    <?php echo $f['faq']; ?>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapse<?= $f["id_faq"] ?>" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">
                                    <div class="container-fluid text-center">
                                        <div class="row">
                                            <div class="col">
                                                <div class="card" style="width: 100%; border:none;">
                                                    <img src="<?= base_url() ?>/img/1 google.jpg" class="card-img-top" alt="...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">1</h5>
                                                        <p class="card-text">Error seperti gambar diatas ( Biasanya jika anda membuka web eabsen di chrome ).</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card" style="width: 100%; border:none;">
                                                    <img src="<?= base_url() ?>/img/2 google.jpg" class="card-img-top" alt="...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">2</h5>
                                                        <p class="card-text">Klik gambar titik 3 di pojok kanan.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card" style="width: 100%; border:none;">
                                                    <img src="<?= base_url() ?>/img/3 google.jpg" class="card-img-top" alt="...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">3</h5>
                                                        <p class="card-text">Kemudian cari setting / pengaturan.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card" style="width: 100%; border:none;">
                                                    <img src="<?= base_url() ?>/img/4 google.jpg" class="card-img-top" alt="...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">4</h5>
                                                        <p class="card-text">Scroll ke bawah cari setelan situs.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="card" style="width: 100%; border:none;">
                                                    <img src="<?= base_url() ?>/img/5 google.jpg" class="card-img-top" alt="...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">5</h5>
                                                        <p class="card-text">Pilih kamera.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card" style="width: 100%; border:none;">
                                                    <img src="<?= base_url() ?>/img/6 google.jpg" class="card-img-top" alt="...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">6</h5>
                                                        <p class="card-text">Pastikan perizinan kamera sudah di aktifkan , dan dibagian izinkan terdapat perizininan dari web eabsen.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card" style="width: 100%; border:none;">
                                                    <img src="<?= base_url() ?>/img/7 google.jpg" class="card-img-top" alt="...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">7</h5>
                                                        <p class="card-text">Klik url eabsen , dan klik izinkan , Kemudian coba absen kembali ( Jika masih error , coba buka menggunakan uc browser atau aplikasi lain , jika tetap error kemungkinan hp anda tidak support , Maaf :D ).</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col p-3 text-start">
                                                    <a href="<?= base_url() ?>/admin/hapusFaq?id=<?= $f['id_faq']; ?>" class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash"></i></a>
                                                    <a href="<?= base_url() ?>/admin/editFaq?id=<?= $f['id_faq']; ?>" class="btn btn-primary btn-sm disabled" type="submit"><i class="fas fa-pencil-alt"></i></a>
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
    <?php } else { ?>
        <div class="accordion-item">
            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse<?= $f["id_faq"] ?>" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                    <?php echo $f['faq']; ?>
                </button>
            </h2>
            <div id="panelsStayOpen-collapse<?= $f["id_faq"] ?>" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                <div class="accordion-body">
                    <?php echo $f['isi_faq']; ?>
                    <div class="row">
                        <div class="col mt-3 text-start">
                            <a href="<?= base_url() ?>/admin/hapusFaq?id=<?= $f['id_faq']; ?>" class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash"></i></a>
                            <a href="<?= base_url() ?>/admin/editFaq?id=<?= $f['id_faq']; ?>" class="btn btn-primary btn-sm" type="submit"><i class="fas fa-pencil-alt"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div> <br>
<?php }
                } ?>
    </div>
</div>
</div>

<?php echo $this->endSection(); ?>