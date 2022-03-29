<?php echo $this->extend('/layout/tamplate'); ?>

<?php echo $this->section('content'); ?>

<?php if (session()->getFlashdata('pesan')) { ?>
    <script>
        Swal.fire(
            'Baguss !!',
            'Password Berhasi Diubah , Langsung Isi Profil Ya Kids :)',
            'success'
        ).then((result) => {
            if (result.value == true) {
                document.location.href = '<?= base_url() ?>/users/profil'
            }
            document.location.href = '<?= base_url() ?>/users/profil'
        })
    </script>
<?php } ?>

<!-- Pemberitahuan -->
<div class="container-fluid p-3">
    <div class="row">
        <div class="col">
            <div class="card mt-2">
                <div class="card-header" style="border-top: 4px solid darkcyan;">
                    <div class="row">
                        <div class="col-sm-10"><input type="text" readonly class="form-control-plaintext" value="Pemberitahuan"></div>
                        <div class="col-sm-2"><input type="text" readonly class="form-control-plaintext text-end" value="<?= $tanggal; ?>"></div>
                    </div>
                </div>
                <?php if ($pemberitahuan) { ?>
                    <div class="card-body p-4">
                        <div class="table-container">
                            <table class="table table-borderless" style="margin: -10px; opacity: 0.9; font-size: 15px;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Informasi</th>
                                        <th>Narasumber</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($pemberitahuan as $pb) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $pb['informasi']; ?></td>
                                            <td><?= $pb['narasumber']; ?></td>
                                            <td><?= $pb['tgl_info']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="card-body text-center">
                        <p style="opacity: 0.4; margin-top: 10px;">Tidak ada pemberitahuan</p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">

    <!-- Mode Laptop -->
    <div class="row">
        <!-- <div class="col p-3 card-mode-laptop">
            <div class="card card-1-users">
                <img src="/img/head-hadir.png" class="card-img-top" alt="...">
                <div class="card-img-overlay">
                    <p class="card-title" style="opacity: 0.7;">0</p>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Data Kehadiran</h5>
                    <p class="card-text">Berikut adalah data siswa yang telah absen di kelas XII RPL 1</p>
                    <a href="<?= base_url() ?>/users/dataHadir" class="btn btn-primary" style="position: relative; z-index: 2;">Lihat</a>
                </div>
            </div>
        </div> -->
        <div class="col p-3 card-mode-laptop">
            <div class="card card-2-users">
                <img src="<?= base_url() ?>/img/head-history.png" class="card-img-top" alt="...">
                <div class="card-img-overlay">
                    <p class="card-title" style="opacity: 0.7; "><?= $ambil_data_baris ?></p>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Riwayat Absen</h5>
                    <p class="card-text">Berikut adalah data riwayat absen selama satu semester</p>
                    <a href="<?= base_url() ?>/users/dataRiwayat/<?= akunSiswa()->NIS ?>" class="btn btn-primary" style="position: relative; z-index: 2;">Lihat</a>
                </div>
            </div>
        </div>
        <!-- <div class="col card-3-users">

        </div> -->
    </div>

    <!-- Mode Hp -->
    <!-- <div class="row">
        <div class="col p-3 card-mode-hp">
            <div class="card card-1-users">
                <img src="/img/head-hadir.png" class="card-img-top" alt="...">
                <div class="card-img-overlay">
                    <p class="card-title" style="opacity: 0.7;">0</p>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Data Kehadiran</h5>
                    <p class="card-text">Berikut adalah data siswa yang telah absen di kelas XII RPL 1</p>
                    <a href="<?= base_url() ?>/users/dataHadir" class="btn btn-primary" style="position: relative; z-index: 2;">Lihat</a>
                </div>
            </div>
        </div>
    </div> -->
    <div class="row">
        <div class="col p-3 card-mode-hp">
            <div class="card card-2-users">
                <img src="<?= base_url() ?>/img/head-history.png" class="card-img-top" alt="...">
                <div class="card-img-overlay">
                    <p class="card-title" style="opacity: 0.7; "><?= $ambil_data_baris ?></p>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Riwayat Absen</h5>
                    <p class="card-text">Berikut adalah data riwayat absen selama bulan Oktober</p>
                    <a href="<?= base_url() ?>/users/dataRiwayat/<?= akunSiswa()->NIS ?>" class="btn btn-primary" style="position: relative; z-index: 2;">Lihat</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $this->endSection(); ?>