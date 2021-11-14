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
                document.location.href = '/users/profil'
            }
            document.location.href = '/users/profil'
        })
    </script>
    ";
<?php } ?>

<!-- Pemberitahuan -->
<div class="container-fluid p-3">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Pemberitahuan
                </div>
                <div class="card-body">
                    <p class="card-text text-center" style="opacity: 0.5;">Tidak Ada Pemberitahuan</p>
                </div>
                <div class="card-footer text-muted text-center">
                    2 days ago
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">

    <!-- Mode Laptop -->
    <div class="row">
        <div class="col p-3 card-mode-laptop">
            <div class="card card-1-users">
                <img src="/img/head-hadir.png" class="card-img-top" alt="...">
                <div class="card-img-overlay">
                    <p class="card-title" style="opacity: 0.7;">0</p>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Data Kehadiran</h5>
                    <p class="card-text">Berikut adalah data siswa yang telah absen di kelas XII RPL 1</p>
                    <a href="/users/dataHadir" class="btn btn-primary" style="position: relative; z-index: 2;">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col p-3 card-mode-laptop">
            <div class="card card-2-users">
                <img src="/img/head-history.png" class="card-img-top" alt="...">
                <div class="card-img-overlay">
                    <p class="card-title" style="opacity: 0.7; ">0</p>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Riwayat Absen</h5>
                    <p class="card-text">Berikut adalah data riwayat absen selama bulan Oktober</p>
                    <a href="/users/dataRiwayat" class="btn btn-primary" style="position: relative; z-index: 2;">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col card-3-users">

        </div>
    </div>

    <!-- Mode Hp -->
    <div class="row">
        <div class="col p-3 card-mode-hp">
            <div class="card card-1-users">
                <img src="/img/head-hadir.png" class="card-img-top" alt="...">
                <div class="card-img-overlay">
                    <p class="card-title" style="opacity: 0.7;">0</p>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Data Kehadiran</h5>
                    <p class="card-text">Berikut adalah data siswa yang telah absen di kelas XII RPL 1</p>
                    <a href="/users/dataHadir" class="btn btn-primary" style="position: relative; z-index: 2;">Lihat</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col p-3 card-mode-hp">
            <div class="card card-2-users">
                <img src="/img/head-history.png" class="card-img-top" alt="...">
                <div class="card-img-overlay">
                    <p class="card-title" style="opacity: 0.7; ">0</p>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Riwayat Absen</h5>
                    <p class="card-text">Berikut adalah data riwayat absen selama bulan Oktober</p>
                    <a href="/users/dataRiwayat" class="btn btn-primary" style="position: relative; z-index: 2;">Lihat</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $this->endSection(); ?>