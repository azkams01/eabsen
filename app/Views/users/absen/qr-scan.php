<?php echo $this->extend('/layout/tamplate'); ?>

<?php echo $this->section('content'); ?>
<?php if (session()->getFlashdata('pesan')) { ?>
    <script>
        Swal.fire(
            'Eitss !!',
            '<?= session()->getFlashdata('pesan'); ?>',
            'error'
        ).then((result) => {
            if (result.value == true) {
                document.location.href = '<?= base_url() ?>/users/qrscan?keterangan=<?= $keteranganAbsen ?>'
            }
            document.location.href = '<?= base_url() ?>/users/qrscan?keterangan=<?= $keteranganAbsen ?>'
        })
    </script>
<?php } elseif (session()->get('terlambat')) { ?>
    <script>
        Swal.fire({
            title: ' Masukan Alasan Terlambat',
            html: '<form action="<?= base_url() ?>/users/absenProses" method="post"><input type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>"><br> <input type="hidden" name="keterangan" value="Masuk"> <textarea name="deskripsi" class="form-control" autofocus></textarea> <br> <br> <button type = "submit" class="btn btn-sm btn-primary" name="submit" >Kirim</button > </form>',
            showConfirmButton: false
        }).then((result) => {
            if (result.value == true) {
                document.location.href = '<?= base_url() ?>/users/absen'
            }
            document.location.href = '<?= base_url() ?>/users/qrscan'
        })
    </script>
<?php }  ?>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-5">
            <div class="card-header bg-transparent mb-0">
                <h5 class="text-center"><span class="font-weight-bold text-primary">QR-SCAN</span></h5>
            </div>
            <div class="card-body text-center">
                <video id="preview" width="100%" height="300"></video>
                <img src="<?= base_url() ?>/img/border-scan.png" alt="" width="60%" height="60%" class="border-scan" style="position: relative; z-index: 100; margin-top: -340px;">
                <div class="card-body text-center">
                    <a href="<?= base_url() ?>/users/absen"><button type="button" class="btn btn-sm btn-primary">Kembali</button></a>
                </div>
                <div class="form-group">
                    <form action="">
                        <input type="text" id="kode_qr" value="<?= md5($tanggal . '|' . $keteranganAbsen) ?>" name="kode_qr" hidden>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function myFunction(x) {
            if (x.matches) { // If media query matches
                let scanner = new Instascan.Scanner({
                    video: document.getElementById('preview'),
                    mirror: false
                });
                scanner.addListener('scan', function(content) {
                    // belum ketemu masalahnya
                    // var keterangan = $('#qrcode').val(content);
                    // var nis = $('#NIS').val();
                    // var nama = $('#Nama').val();
                    // var kelas = $('#Kelas').val();
                    var kode_qr = $('#kode_qr').val();
                    // var jam_absen = $('#jam_absen').val();
                    // var hari_absen = $('#hari_absen').val();
                    if (content == kode_qr) {
                        window.location = "<?= base_url() ?>/users/absenProses?keterangan=<?= $keteranganAbsen ?>";
                    } else {
                        window.location = "<?= base_url() ?>/users/absenGagal?keterangan=<?= $keteranganAbsen ?>";
                    }
                });
                Instascan.Camera.getCameras().then(function(cameras) {
                    if (cameras.length > 0) {
                        scanner.start(cameras[1]);
                    } else {
                        console.error('No Cameras Found');
                    }
                }).catch(function(e) {
                    console.error(e);
                });
            } else {
                let scanner = new Instascan.Scanner({
                    video: document.getElementById('preview'),
                    mirror: true
                });
                scanner.addListener('scan', function(content) {
                    // belum ketemu masalahnya
                    // var keterangan = $('#qrcode').val(content);
                    // var nis = $('#NIS').val();
                    // var nama = $('#Nama').val();
                    // var kelas = $('#Kelas').val();
                    var kode_qr = $('#kode_qr').val();
                    // var jam_absen = $('#jam_absen').val();
                    // var hari_absen = $('#hari_absen').val();
                    if (content == kode_qr) {
                        window.location = "<?= base_url() ?>/users/absenProses?keterangan=<?= $keteranganAbsen ?>";
                    } else {
                        window.location = "<?= base_url() ?>/users/absenGagal?keterangan=<?= $keteranganAbsen ?>";
                    }
                });
                Instascan.Camera.getCameras().then(function(cameras) {
                    if (cameras.length > 0) {
                        scanner.start(cameras[0]);
                    } else {
                        console.error('No Cameras Found');
                    }
                }).catch(function(e) {
                    console.error(e);
                });
            }
        }

        var x = window.matchMedia("(max-width: 420px)")
        myFunction(x) // Call listener function at run time
        x.addListener(myFunction) // Attach listener function on state changes
    </script>

    <?php echo $this->endSection(); ?>