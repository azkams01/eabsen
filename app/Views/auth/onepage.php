<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <title><?= $title ?></title>
  <!-- logo web -->
  <link rel="shortcut icon" href="<?= base_url() ?>/img/logo.png" type="image/ico">

  <!-- Bootstrap core CSS -->
  <link href="<?= base_url() ?>/onepage/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="<?= base_url() ?>/onepage/assets/css/fontawesome.css">
  <link rel="stylesheet" href="<?= base_url() ?>/onepage/assets/css/templatemo-digimedia-v3.css">
  <link rel="stylesheet" href="<?= base_url() ?>/onepage/assets/css/animated.css">
  <link rel="stylesheet" href="<?= base_url() ?>/onepage/assets/css/owl.css">
  <script src="<?= base_url() ?>/js/sweetalert2.all.min.js"></script>
  <!--

TemplateMo 568 DigiMedia

https://templatemo.com/tm-568-digimedia

-->
</head>

<body>

  <?php if (session()->getFlashdata('error')) { ?>
    <script>
      Swal.fire(
        'Maaf !!',
        '<?= session()->getFlashdata('error'); ?>',
        'error'
      ).then((result) => {
        if (result.value == true) {
          document.location.href = '<?= base_url() ?>/auth/onepage'
        }
        document.location.href = '<?= base_url() ?>/auth/onepage'
      })
    </script>
  <?php } elseif (session()->getFlashdata('success')) { ?>
    <script>
      Swal.fire(
        'Terimakasih :)',
        '<?= session()->getFlashdata('success'); ?>',
        'success'
      ).then((result) => {
        if (result.value == true) {
          document.location.href = '<?= base_url() ?>/auth/onepage'
        }
        document.location.href = '<?= base_url() ?>/auth/onepage'
      })
    </script>
  <?php } ?>


  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="index.html" class="logo">
              <img src="<?= base_url() ?>/onepage/assets/images/logo-v3.png" alt="">
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li class="scroll-to-section"><a href="#top" class="active">Beranda</a></li>
              <li class="scroll-to-section"><a href="#services">Penggunaan</a></li>
              <li class="scroll-to-section"><a href="#contact">Kontak</a></li>
            </ul>
            <a class='menu-trigger'>
              <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->

  <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-6 align-self-center">
              <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
                <div class="row">
                  <div class="col-lg-12">
                    <h6>absensi berbasis qr-code</h6>
                    <div class="col-lg-6">
                      <div class="right-image wow fadeInRight mode-hp" data-wow-duration="1s" data-wow-delay="0.5s">
                        <img src="<?= base_url() ?>/onepage/assets/images/Waktu.png" alt="">
                      </div>
                    </div>
                    <h2 style="opacity: 0.9;">Presence is one part of success</h2>
                    <h8>Eabsen atau absensi elektronik adalah sebuah aplikasi berbasis website statis yang memudahkan siswa untuk mengisi kehadiran , rekap nilai , dan memantau kehadiran siswanya disekolah . dilakukan melalui smartphone maupun desktop dengan me - scan QR-Code yang telah disediakan.</h8>
                  </div>
                  <div class="col-lg-12 mt-4">
                    <div class="border-first-button scroll-to-section">
                      <a href="<?= base_url() ?>/auth/login">
                        Login
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="right-image wow fadeInRight mode-dekstop" data-wow-duration="1s" data-wow-delay="0.5s">
                <img src="<?= base_url() ?>/onepage/assets/images/Waktu.png" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="services" class="services section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
            <h6>click a number</h6>
            <h4>Cara <em>absen QR-Code</em></h4>
            <div class="line-dec"></div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="naccs">
            <div class="grid">
              <div class="row">
                <div class="col-lg-12">
                  <div class="menu">
                    <div class="first-thumb active">
                      <div class="thumb">
                        <span class="icon"><img src="<?= base_url() ?>/onepage/assets/images/service-icon-01.png" alt=""></span>

                      </div>
                    </div>
                    <div>
                      <div class="thumb">
                        <span class="icon"><img src="<?= base_url() ?>/onepage/assets/images/service-icon-02.png" alt=""></span>

                      </div>
                    </div>
                    <div>
                      <div class="thumb">
                        <span class="icon"><img src="<?= base_url() ?>/onepage/assets/images/service-icon-03.png" alt=""></span>

                      </div>
                    </div>
                    <div>
                      <div class="thumb">
                        <span class="icon"><img src="<?= base_url() ?>/onepage/assets/images/service-icon-04.png" alt=""></span>

                      </div>
                    </div>
                    <div class="last-thumb">
                      <div class="thumb">
                        <span class="icon"><img src="<?= base_url() ?>/onepage/assets/images/service-icon-05.png" alt=""></span>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <ul class="nacc">
                    <li class="active">
                      <div>
                        <div class="thumb">
                          <div class="row">
                            <div class="col-lg-6 align-self-center">
                              <div class="left-text">
                                <h4>Akses Website eabsen</h4>
                                <p>Website eabsen dapat diakses dengan browser ( disarankan chrome ) menggunakan device hp , ipad , laptop , pc , dll. (ios belum support untuk fitur scan QR-Code) . </p>
                              </div>
                            </div>
                            <div class="col-lg-6 align-self-center">
                              <div class="right-image">
                                <img src="<?= base_url() ?>/onepage/assets/images/langkah-1.png" alt="">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div>
                        <div class="thumb">
                          <div class="row">
                            <div class="col-lg-6 align-self-center">
                              <div class="left-text">
                                <h4>Login Sebagai Siswa</h4>
                                <p>Login menggunakan NIS dan juga Password ( Pastikan sebelumnya data anda telah terdaftar , karena eabsen tidak menyediakan menu registrasi ). Dan demi keamanan anda setelah login kami memaksa anda untuk mengubah password akun anda untuk sekali ubah password , jika ada kesalahan silahkan hubungi admin .</p>
                              </div>
                            </div>
                            <div class="col-lg-6 align-self-center">
                              <div class="right-image">
                                <img src="<?= base_url() ?>/onepage/assets/images/langkah-2.png" alt="">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div>
                        <div class="thumb">
                          <div class="row">
                            <div class="col-lg-6 align-self-center">
                              <div class="left-text">
                                <h4>Isi Profil</h4>
                                <p>Syarat siswa bisa absen salah satunya dengan isi profil , karena data yang dimuat nanti diambil dari profil anda . Isi profil hanya dilakukan saat pertama kali membuat akun , pastikan data yang anda masukan benar ya kidss .</p>
                              </div>
                            </div>
                            <div class="col-lg-6 align-self-center">
                              <div class="right-image">
                                <img src="<?= base_url() ?>/onepage/assets/images/langkah-3.png" alt="">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div>
                        <div class="thumb">
                          <div class="row">
                            <div class="col-lg-6 align-self-center">
                              <div class="left-text">
                                <h4>Absen</h4>
                                <p>Nahhh jika kalian telah mengikuti urutan dengan tepat , kalian tinggal absen dengan membuka menu absen kemudian pilih opsi absen->absen masuk untuk absen masuk , absen->absen pulang untuk pulang , jika sakit atau izin dapat memilih opsi keterangan lain . Untuk waktu default absennya dari jam 06:00 - 07:15 untuk absen masuk , dan 10:30 - 15:00 untuk absen pulang .</p>
                              </div>
                            </div>
                            <div class="col-lg-6 align-self-center">
                              <div class="right-image">
                                <img src="<?= base_url() ?>/onepage/assets/images/langkah-4.png" alt="">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div>
                        <div class="thumb">
                          <div class="row">
                            <div class="col-lg-6 align-self-center">
                              <div class="left-text">
                                <h4>Selesai</h4>
                                <p>Setelah absen selesai , anda dapat melihat history anda di dashboard->data riwayat , untuk info lebih luas tentang eabsen bisa anda lihat di menu faq , Terimakasih .</p>
                              </div>
                            </div>
                            <div class="col-lg-6 align-self-center">
                              <div class="right-image">
                                <img src="<?= base_url() ?>/onepage/assets/images/langkah-5.png" alt="">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="contact" class="contact-us section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="section-heading wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
            <h6>give us advice</h6>
            <h4>Kontak <em>Kami</em></h4>
            <div class="line-dec"></div>
          </div>
        </div>
        <div class="col-lg-12 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.25s">
          <form id="contact" action="<?= base_url() ?>/auth/pesan" method="post">
            <div class="row">
              <div class="col-lg-12">
                <div class="contact-dec">
                  <img src="<?= base_url() ?>/onepage/assets/images/contact-dec-v3.png" alt="">
                </div>
              </div>
              <div class="col-lg-5">
                <div id="map">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.9972997187824!2d107.55607371397743!3d-6.890925069344825!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6bd6aaaaaab%3A0xf843088e2b5bf838!2sSMK%20Negeri%2011%20Bandung!5e0!3m2!1sid!2sid!4v1613640336251!5m2!1sid!2sid" width="100%" height="600px" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
              </div>
              <div class="col-lg-7">
                <div class="fill-form">
                  <div class="row">
                    <h5 style="opacity: 0.7;">Jika ada kesalahan atau kesulitan silahkan isi form saran dibawah .</h5>
                    <div class="col-lg-6">
                      <fieldset>
                        <input type="text" name="id_ps" id="id_ps" value="<?= $kode ?>" style="background-color: gray; opacity: 0.5;" readonly>
                      </fieldset>
                      <fieldset>
                        <input type="text" name="NIS" id="NIS" minlength="10" maxlength="10" placeholder="NIS" autocomplete="on" required>
                      </fieldset>
                      <fieldset>
                        <input type="Email" name="email" id="subject" pattern="[^ @]*@[^ @]*" placeholder="Email Anda" autocomplete="on" required>
                      </fieldset>
                    </div>
                    <div class="col-lg-6">
                      <fieldset>
                        <textarea name="pesan" type="text" class="form-control" id="pesan" placeholder="Pesan" required=""></textarea>
                      </fieldset>
                    </div>
                    <div class="col-lg-12">
                      <fieldset>
                        <button type="submit" id="form-submit" class="main-button ">Kirim Saran</button>
                      </fieldset> <br> <br>
                      <div class="konten-saran" style="text-align:left">
                        <p>SMK Negeri 11 Bandung merupakan salah satu Lembaga Pendidikan Menengah Kejuruan di Kota Bandung, Jawa Barat </p> <br>

                        <p>Jl. Budhi Cilember, Bandung, Jawa Barat, Indonesia</p> <br>

                        <p><i class="fas fa-phone-alt"></i>&nbsp; 022-6652442 (telp) </p> <br>

                        <p> <i class="fas fa-envelope"></i> &nbsp; smkn11bdg@gmail.com </p> <br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p>Copyright © 2022 Designed by Kelompok 1
            <!-- <br>Design onepage: <a href="https://templatemo.com" target="_parent" title="free css templates">TemplateMo</a> -->
          </p>
        </div>
      </div>
    </div>
  </footer>


  <!-- Scripts -->
  <script src="<?= base_url() ?>/onepage/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url() ?>/onepage/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>/onepage/assets/js/owl-carousel.js"></script>
  <script src="<?= base_url() ?>/onepage/assets/js/animation.js"></script>
  <script src="<?= base_url() ?>/onepage/assets/js/imagesloaded.js"></script>
  <script src="<?= base_url() ?>/onepage/assets/js/custom.js"></script>

</body>

</html>