<?php echo $this->extend('/layout/tamplate'); ?>

<?php echo $this->section('content'); ?>

<div class="container-fluid p-3">
    <div class="row">
        <div class="col">
            <?php foreach ($faq as $f) { ?>
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse<?= $f["id"] ?>" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
                                <?php echo $f['keterangan']; ?>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapse<?= $f["id"] ?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body">
                                <?php echo $f['isi_keterangan']; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
        </div>
    </div>

    <?php echo $this->endSection(); ?>