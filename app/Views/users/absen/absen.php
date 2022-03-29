<?php echo $this->extend('/layout/tamplate'); ?>

<?php echo $this->section('content'); ?>
<?php

if (akunSiswa()->Email_siswa == "") {
?>
  <script>
    Swal.fire(
      'Eitss !!',
      'Isi Data Profil Dulu Ya Kids :)',
      'error'
    ).then((result) => {
      if (result.value == true) {
        document.location.href = '<?= base_url() ?>/users/profil'
      }
      document.location.href = '<?= base_url() ?>/users/profil'
    })
  </script>
<?php
} elseif (session()->getFlashdata('pesan')) { ?>
  <script>
    Swal.fire(
      'Good job !!',
      '<?= session()->getFlashdata('pesan'); ?>',
      'success'
    ).then((result) => {
      if (result.value == true) {
        document.location.href = '<?= base_url() ?>/users/absen'
      }
      document.location.href = '<?= base_url() ?>/users/absen'
    })
  </script>
<?php } elseif (session()->getFlashdata('error')) { ?>
  <script>
    Swal.fire(
      'Woops ..',
      '<?= session()->getFlashdata('error'); ?>',
      'error'
    ).then((result) => {
      if (result.value == true) {
        document.location.href = '<?= base_url() ?>/users/absen'
      }
      document.location.href = '<?= base_url() ?>/users/absen'
    })
  </script>
<?php } elseif (session()->getFlashdata('errorKeterangan')) { ?>
  <script>
    Swal.fire(
      'Woops ..',
      '<?= $validation->getError('lampiran'); ?>',
      'error'
    ).then((result) => {
      if (result.value == true) {
        document.location.href = '<?= base_url() ?>/users/absen'
      }
      document.location.href = '<?= base_url() ?>/users/absen'
    })
  </script>
<?php } elseif (session()->getFlashdata('pesanKeteranganLampiran')) { ?>
  <script>
    Swal.fire(
      '<?= session()->getFlashdata('pesanKeteranganLampiran'); ?>',
      '<embed src="<?= base_url() ?>/doc/<?= session()->getFlashdata('pesanSebab') ?>" type="" style="width: 100%;">',
      'info'
    ).then((result) => {
      if (result.value == true) {
        document.location.href = '<?= base_url() ?>/users/absen'
      }
      document.location.href = '<?= base_url() ?>/users/absen'
    })
  </script>
<?php } elseif (session()->getFlashdata('pesanKeteranganHadir')) { ?>
  <script>
    Swal.fire(
      'Hadir',
      '<?= session()->getFlashdata('pesanKeteranganHadir'); ?>',
      'info'
    ).then((result) => {
      if (result.value == true) {
        document.location.href = '<?= base_url() ?>/users/absen'
      }
      document.location.href = '<?= base_url() ?>/users/absen'
    })
  </script>
<?php } elseif (session()->getFlashdata('keterangan')) { ?>
  <script>
    Swal.fire({
      title: ' Masukan Keterangan',
      html: '<form action="<?= base_url() ?>/users/absenKeteranganProses" method="post" enctype="multipart/form-data"><input type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>"><br><select required="required" name="keterangan" > <option value = "Sakit|Pending" name="keterangan" >Sakit</option><option value = "Izin|Pending" name="keterangan" >Izin</option></select> <br> <br> <input type="file" class="form-control" name="lampiran" required="required" style="opacity: 0.6;"><div class="form-text" style="font-size: 13px;">&nbsp;<i class="fas fa-info-circle"></i> Masukan lampiran surat dengan format gambar atau dokumen dengan ekstensi pdf (absen keterangan dapat diisi dari jam 06:00 - 10:00 pagi)</div> <br> <br> <button type = "submit" class="btn btn-sm btn-primary" name="submit" >Kirim</button > </form>',
      showConfirmButton: false
    })
  </script>
<?php } ?>

<div class="container">
  <div class="row">
    <div class="col p-3">
      <div class="invalid-feedback">
      </div>
      <div class="table-container">
        <table class="table table-bordered text-center table-striped" style="vertical-align: middle;">
          <thead style="background-color: aliceblue;">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Hari</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Tenggat Absen</th>
              <th scope="col">Jam Masuk</th>
              <th scope="col">Jam Pulang</th>
              <th scope="col">Keterangan</th>
            </tr>
          </thead>
          <tbody>
            <!-- history jika NIS Tidak ada di database -->

            <?php $no = 1; ?>
            <?php if (!isset(absenPulang()->keterangan_absen) and !isset(absenSakit()->keterangan_absen) and !isset(absenIzin()->keterangan_absen) and !isset(pendingSakit()->keterangan_absen) and !isset(pendingIzin()->keterangan_absen)) { ?>
              <tr style="border: 1px solid black;">
                <th scope="row"><i class="fas fa-circle lingkaran-absen"></i></th>
                <td><?= hari_ini() ?></td>
                <td><?= $tanggal ?></td>
                <td>
                  <?php if (isset(tenggat_absen()->tgl_tenggat)) { ?>
                    <font class="tenggat-absen">Masuk : <?= substr(tenggat_absen()->bm_awal, 0, 5) ?> - <?= substr(tenggat_absen()->bm_akhir, 0, 5) ?> <br> Pulang : <?= substr(tenggat_absen()->bp_awal, 0, 5) ?> - <?= substr(tenggat_absen()->bp_akhir, 0, 5) ?> </font class="tenggat-absen"><br>
                    <div class="form-text" style="font-size: 10px;">&nbsp;<i class="fas fa-info-circle"></i> Tenggat absen hari ini diubah, jangan telat ya :)</div>
                  <?php } else { ?>
                    <?php if ($waktu >= "06:00:00" and $waktu <= "07:00:00") { ?>
                      Masuk | 06:00 - 07:00
                    <?php } elseif ($waktu >= "10:00:00" and $waktu <= "15:00:00") { ?>
                      Pulang | 10:00 - 15:00
                    <?php } else { ?>
                      Jam Absen Ditutup
                  <?php }
                  } ?>
                </td>
                <td>
                  <?php if (isset(absenMasuk()->jam_masuk)) { ?>
                    <?= absenMasuk()->jam_masuk; ?>
                  <?php } else { ?>
                    -
                  <?php } ?>
                </td>
                <td>-</td>
                <td>
                  <div class="btn-group">
                    <li class="dropdown" style="list-style: none;">
                      <a class="btn btn-sm btn-primary text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Absen
                      </a>
                      <ul class="dropdown-menu">
                        <?php if (!isset(absenMasuk()->keterangan_absen)) { ?>
                          <li><a class="dropdown-item" href="<?= base_url() ?>/users/qrscan?keterangan=Masuk">Absen Masuk</a></li>
                          <li><a class="dropdown-item disabled" href="<?= base_url() ?>/users/qrscan?keterangan=Pulang">Absen Pulang</a></li>
                        <?php } elseif (isset(absenMasuk()->keterangan_absen)) { ?>
                          <li><a class="dropdown-item disabled" href="<?= base_url() ?>/users/qrscan?keterangan=Masuk">Absen Masuk</a></li>
                          <li><a class="dropdown-item" href="<?= base_url() ?>/users/qrscan?keterangan=Pulang">Absen Pulang</a></li>
                        <?php } elseif (isset(absenMasuk()->keterangan_absen) and isset(absenPulang()->keterangan_absen)) { ?>
                          <li><a class="dropdown-item disabled" href="<?= base_url() ?>/users/qrscan?keterangan=Masuk">Absen Masuk</a></li>
                          <li><a class="dropdown-item disabled" href="<?= base_url() ?>/users/qrscan?keterangan=Pulang">Absen Pulang</a></li>
                        <?php } ?>
                      </ul>
                    </li>
                  </div>
                  <!-- Example single danger button -->
                  <a href="<?= base_url() ?>/users/absenKeterangan"><button type="button" class="btn btn-sm btn-secondary">
                      Keterangan lain
                    </button></a>
                </td>
              </tr>
              <?php foreach ($absen as $hs) { ?>
                <tr>
                  <th scope="row"><?= $no++ ?></th>
                  <td><?= $hs['hari_absen']; ?></td>
                  <td><?= $hs['tgl_absen']; ?></td>
                  <td>
                    <?php if ($hs['keterangan_absen'] == "Sakit|Pending" or $hs['keterangan_absen'] == "Izin|Pending") { ?>
                      <p>Menunggu acc dari wali kelas,<br>paling lambat seminggu setelah pengajuan.</p>
                    <?php } elseif ($hs['keterangan_absen'] == "Sakit" or $hs['keterangan_absen'] == "Izin") { ?>
                      -
                    <?php } elseif ($hs['keterangan_absen'] == "Hadir") { ?>
                      <?php if (isset(tenggat_absen()->tgl_tenggat)) { ?>
                        Masuk : <i class="far fa-check-circle"></i> | Pulang : <i class="far fa-check-circle"></i>
                      <?php } else { ?>
                        Masuk : <i class="far fa-check-circle"></i> | Pulang : <i class="far fa-check-circle"></i>
                      <?php } ?>
                    <?php } elseif ($hs['keterangan_absen'] == "Hadir|Masuk") { ?>
                      <?php if (isset(tenggat_absen()->tgl_tenggat)) { ?>
                        Masuk : <i class="far fa-check-circle"></i> | Pulang : <?= substr(tenggat_absen()->bp_awal, 0, 5) ?> - <?= substr(tenggat_absen()->bp_akhir, 0, 5) ?>
                      <?php } else { ?>
                        Masuk : <i class="far fa-check-circle"></i> | Pulang : 10:00 - 12:00
                      <?php } ?>
                    <?php } else { ?>
                      Masuk : 06:00 - 07:00 | Pulang : 10:00 - 12:00
                    <?php } ?>
                  </td>
                  <td>
                    <?php if ($hs['keterangan_absen'] == "Sakit|Pending" or $hs['keterangan_absen'] == "Izin|Pending" or $hs['keterangan_absen'] == "Sakit" or $hs['keterangan_absen'] == "Izin") { ?>
                      -
                    <?php } else { ?>
                      <?= $hs['jam_masuk']; ?>
                    <?php } ?>
                  </td>
                  <td> <?php if ($hs['keterangan_absen'] == "Sakit|Pending" or $hs['keterangan_absen'] == "Izin|Pending" or $hs['keterangan_absen'] == "Sakit" or $hs['keterangan_absen'] == "Izin") { ?>
                      -
                    <?php } else { ?>
                      <?= $hs['jam_pulang']; ?>
                    <?php } ?></td>
                  <td>
                    <?php if ($hs['keterangan_absen'] == "Hadir|Masuk") { ?>
                      <a href="<?= base_url() ?>/users/pesanKeteranganHadir" class="btn btn-sm btn-success disabled"> <?= $hs['keterangan_absen'] ?> </a>
                    <?php } elseif ($hs['keterangan_absen'] == "Sakit|Pending" or $hs['keterangan_absen'] == "Izin|Pending") { ?>
                      <a href="<?= base_url() ?>/users/pesanKeteranganHadir" class="btn btn-sm btn-warning disabled"> <?= $hs['keterangan_absen'] ?> </a>
                    <?php } elseif ($hs['keterangan_absen'] == "Sakit" or $hs['keterangan_absen'] == "Izin") { ?>
                      <a class="btn btn-sm btn-warning" href="<?= base_url() ?>/users/pesanKeteranganLampiran?tgl_absen=<?= $hs['tgl_absen']; ?>&keterangan=<?= $hs['keterangan_absen']; ?>&id=<?= $hs['id_absensi'] ?>"> <?= $hs['keterangan_absen']; ?> </a>
                    <?php } else { ?>
                      <a href="<?= base_url() ?>/users/pesanKeteranganHadir?tgl_absen=<?= $hs['tgl_absen']; ?>&keterangan=<?= $hs['keterangan_absen']; ?>&id=<?= $hs['id_absensi'] ?>" class="btn btn-sm btn-success"> <?= $hs['keterangan_absen'] ?> </a>
                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>
            <?php } else { ?>
              <?php foreach ($absen as $hs) { ?>
                <tr>
                  <th scope="row"><?= $no++ ?></th>
                  <td><?= $hs['hari_absen']; ?></td>
                  <td><?= $hs['tgl_absen']; ?></td>
                  <td>
                    <?php if ($hs['keterangan_absen'] == "Sakit|Pending" or $hs['keterangan_absen'] == "Izin|Pending") { ?>
                      <p>Menunggu acc dari wali kelas,<br>paling lambat seminggu setelah pengajuan.</p>
                    <?php } elseif ($hs['keterangan_absen'] == "Sakit" or $hs['keterangan_absen'] == "Izin") { ?>
                      -
                    <?php } elseif ($hs['keterangan_absen'] == "Hadir") { ?>
                      Masuk : <i class="far fa-check-circle"></i> | Pulang : <i class="far fa-check-circle"></i>
                    <?php } elseif ($hs['keterangan_absen'] == "Hadir|Masuk") { ?>
                      Masuk : <i class="far fa-check-circle"></i> | Pulang : 10:00 - 12:00
                    <?php } else { ?>
                      Masuk : 06:00 - 07:00 | Pulang : 10:00 - 12:00
                    <?php } ?>
                  </td>
                  <td>
                    <?php if ($hs['keterangan_absen'] == "Sakit|Pending" or $hs['keterangan_absen'] == "Izin|Pending" or $hs['keterangan_absen'] == "Sakit" or $hs['keterangan_absen'] == "Izin") { ?>
                      -
                    <?php } else { ?>
                      <?= $hs['jam_masuk']; ?>
                    <?php } ?>
                  </td>
                  <td> <?php if ($hs['keterangan_absen'] == "Sakit|Pending" or $hs['keterangan_absen'] == "Izin|Pending" or $hs['keterangan_absen'] == "Sakit" or $hs['keterangan_absen'] == "Izin") { ?>
                      -
                    <?php } else { ?>
                      <?= $hs['jam_pulang']; ?>
                    <?php } ?>
                  </td>
                  <td>
                    <?php if ($hs['keterangan_absen'] == "Hadir|Masuk") { ?>
                      <a href="<?= base_url() ?>/users/pesanKeteranganHadir" class="btn btn-sm btn-success disabled"> <?= $hs['keterangan_absen'] ?> </a>
                    <?php } elseif ($hs['keterangan_absen'] == "Sakit|Pending" or $hs['keterangan_absen'] == "Izin|Pending") { ?>
                      <a href="<?= base_url() ?>/users/pesanKeteranganHadir" class="btn btn-sm btn-warning disabled"> <?= $hs['keterangan_absen'] ?> </a>
                    <?php } elseif ($hs['keterangan_absen'] == "Sakit" or $hs['keterangan_absen'] == "Izin") { ?>
                      <a class="btn btn-sm btn-warning" href="<?= base_url() ?>/users/pesanKeteranganLampiran?tgl_absen=<?= $hs['tgl_absen']; ?>&keterangan=<?= $hs['keterangan_absen']; ?>&id=<?= $hs['id_absensi'] ?>"> <?= $hs['keterangan_absen']; ?> </a>
                    <?php } else { ?>
                      <a href="<?= base_url() ?>/users/pesanKeteranganHadir?tgl_absen=<?= $hs['tgl_absen']; ?>&keterangan=<?= $hs['keterangan_absen']; ?>&id=<?= $hs['id_absensi'] ?>" class="btn btn-sm btn-success"> <?= $hs['keterangan_absen'] ?> </a>
                    <?php } ?>
                  </td>
                </tr>
            <?php }
            } ?>
          </tbody>
        </table>
      </div>
      <a href="<?= base_url() ?>/users/faq?aktif=1" style="font-size: 13px;">Scanner Tidak Muncul ?</a>
      <div class="form-text">&nbsp;<i class="fas fa-info-circle"></i> Data History yang ditampilkan disini hanya 7 absen ter-update anda , untuk history lengkap nya silahkan cek di Dashboard > Riwayat , selain itu juga anda dapat meng-klik tombol status untuk mengetahui keterangan absen anda</div>
    </div>
  </div>
</div>

<?php echo $this->endSection(); ?>