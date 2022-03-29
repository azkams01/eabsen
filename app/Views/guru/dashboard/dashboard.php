<?php echo $this->extend('/layout/tamplate_guru'); ?>

<?php echo $this->section('content'); ?>

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
                    <p class="card-text">Berikut adalah data siswa <?= akunGuru()->walikelas ?> yang hadir hari ini</p>
                    <a href="<?= base_url() ?>/guru/keteranganAbsen?keterangan=Hadir" data-toggle="tooltip" title="Lihat Data Siswa Hadir" class="btn btn-primary" style="position: relative; z-index: 2;"><i class="far fa-eye"></i></a>
                </div>
            </div>
        </div>
        <div class="col mt-2">
            <div class="card card-2-users">
                <img src="<?= base_url() ?>/img/head-belum-absen.png" class="card-img-top" alt="...">
                <div class="card-img-overlay">
                    <p class="card-title" style="opacity: 0.7; "><?= $data_pending ?></p>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Meminta Persetujuan</h5>
                    <p class="card-text">Siswa yang meminta persetujuan sakit atau izin.</p>
                    <a href="<?= base_url() ?>/guru/tabelPersetujuan" data-toggle="tooltip" title="Lihat Tabel Persetujuan" class="btn btn-primary" style="position: relative; z-index: 2;"><i class="far fa-eye"></i></a>
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
                    <p class="card-text">Berikut adalah data siswa <?= akunGuru()->walikelas ?> yang Sakit hari ini</p>
                    <a href="<?= base_url() ?>/guru/keteranganAbsen?keterangan=Sakit" data-toggle="tooltip" title="Lihat Data Siswa Sakit " class="btn btn-primary" style="position: relative; z-index: 2;"><i class="far fa-eye"></i></a>
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
                    <p class="card-text">Berikut adalah data siswa <?= akunGuru()->walikelas ?> yang Izin hari ini</p>
                    <a href="<?= base_url() ?>/guru/keteranganAbsen?keterangan=Izin" data-toggle="tooltip" title="Lihat Data Siswa Izin " class="btn btn-primary" style="position: relative; z-index: 2;"><i class="far fa-eye"></i></a>
                </div>
            </div>
        </div>
        <div class="form-text">&nbsp;<i class="fas fa-info-circle"></i> Jumlah siswa <?= akunGuru()->walikelas ?> yang belum absen hari ini : <?= $data_belum_absen ?> siswa.</div>
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