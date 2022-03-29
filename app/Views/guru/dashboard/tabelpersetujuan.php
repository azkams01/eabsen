<?php echo $this->extend('/layout/tamplate_guru'); ?>

<?php echo $this->section('content'); ?>

<?php if (session()->getFlashdata('pesan')) { ?>
    <script>
        Swal.fire(
            'Good job !!',
            '<?= session()->getFlashdata('pesan'); ?>',
            'success'
        ).then((result) => {
            if (result.value == true) {
                document.location.href = '<?= base_url() ?>/guru/tabelPersetujuan'
            }
            document.location.href = '<?= base_url() ?>/guru/tabelPersetujuan'
        })
    </script>
<?php } elseif (session()->getFlashdata('gagal')) { ?>
    <script>
        Swal.fire(
            'Woopss ..',
            '<?= session()->getFlashdata('gagal'); ?>',
            'error'
        ).then((result) => {
            if (result.value == true) {
                document.location.href = '<?= base_url() ?>/guru/tabelPersetujuan'
            }
            document.location.href = '<?= base_url() ?>/guru/tabelPersetujuan'
        })
    </script>
<?php } ?>

<div class="container">
    <div class="row mt-3">
        <div class="col-md-3">
            <form action="" method="post">
                <div class="input-group flex-nowrap">
                    <input class="form-control " type="search" placeholder="Nama/Tanggal" aria-label="Search" name="keyword" style="opacity: 0.8;">
                    <button type="submit" class="tmbps input-group-text btn btn-info" id="addon-wrapping" data-toggle="tooltip" title="Cari Berdasarkan Nama atau Tanggal"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
        <div class="col text-end">
            <form action="<?= base_url() ?>/guru/setujuCheck" method="post">
                <button type="submit" class="btn btn-warning" data-toggle="tooltip" title="Setujui checklist"><i class="fa-solid fa-list-check"></i></button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="table-container">
                <table class="table mt-2 text-center table-striped" style="vertical-align: middle;">
                    <thead style="background-color: aliceblue; border-top: 2px solid black;">
                        <tr>
                            <th scope="col"><input class="form-check-input" type="checkbox" onclick="pilih_akun(this)" value="" id="flexCheckDefault"></th>
                            <th scope="col">Aksi</th>
                            <th scope="col">No.</th>
                            <th scope="col">NIS</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 + (50 * ($currentPage - 1)); ?>
                        <?php foreach ($data as $ds) { ?>
                            <tr>
                                <td><input class="form-check-input" type="checkbox" name='pilihan_akun[]' value="<?= $ds['id_absensi']; ?>|<?= $ds['keterangan_absen'] ?>" id="flexCheckDefault"></td>
                                <td><a href="<?= base_url() ?>/guru/setujuKeterangan?id=<?= $ds['id_absensi'] ?>&keterangan=<?= $ds['keterangan_absen'] ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Setuju"><i class="fa-solid fa-check"></i></a> | <a href="<?= base_url() ?>/guru/tolakPersetujuan?id=<?= $ds['id_absensi'] ?>&keterangan=<?= $ds['keterangan_absen'] ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Tidak Setuju"><i class="fa-solid fa-xmark"></i></a></td>
                                <td><?= $no++; ?></td>
                                <td><?= $ds['NIS']; ?></td>
                                <td><?= $ds['Nama_siswa']; ?></td>
                                <td><?= $ds['keterangan_absen']; ?></td>
                                <td>
                                    Meminta persetujuan Wali Kelas
                                </td>
                            </tr>
                        <?php } ?>
                        </form>
                    </tbody>
                </table>
            </div>
            <?= $pager->links('absensi', 'absen_pagination'); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    function pilih_akun(pilih_akun) {
        checkboxes = document.getElementsByName('pilihan_akun[]')
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = pilih_akun.checked;
        }
    }
</script>

<?php echo $this->endSection(); ?>