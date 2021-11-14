<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title><?php echo $title ?></title>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="/assets/css/font-awesome.css">

    <link rel="stylesheet" href="/assets/css/templatemo-training-studio.css">
    <link rel="stylesheet" href="css/fontAweskills.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="shortcut icon" href="/img/logo.png" type="image/ico">

</head>

<style>
    .header-area .main-nav .nav li:hover a,
    .header-area .main-nav .nav li a.active {
        color: #17a2b8 !important;
        opacity: 1;
    }

    .section-heading h2 em {
        font-style: normal;
        color: #17a2b8;
    }

    .contact-form button:hover {
        background-color: #23282c;
    }

    .login:hover {
        background-color: #23282c;
    }

    .logo {
        width: 150px;
        height: 60px;
        margin-top: 10px;
        opacity: 0.4;
    }

    .video-overlay {
        height: 100vh;
    }

    .main-button a {
        background-color: #17a2b8;
        border-radius: 5px;
    }

    .bg1 {
        height: 100vh;
        opacity: 0.7;
        width: 100%;
    }

    .main-button a:hover {
        background-color: #23282c;
    }

    .contact-form input,
    .contact-form textarea {
        padding: 10px 10px;
        line-height: 20px;
    }

    @media screen and (max-width: 480px) {
        .caption h5 {
            font-size: 12px;
        }

        .bg1 {
            height: 100vh;
            opacity: 0.7;
            width: 200%;
            position: relative;
            left: -50%;
            top: 70px;
        }
    }
</style>

<body>

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
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <img src="/img/logo-eabsen-text.png" alt="" class="logo">
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Beranda</a></li>
                            <li class="scroll-to-section"><a href="#features">Tentang</a></li>

                            <li class="scroll-to-section"><a href="#contact-us">Kontak</a></li>
                            <li class="main-button" style="display: none;"><a href="#">Sign Up</a></li>
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

    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner" id="top">
        <img src="/assets/images/background-4.jpg" class="bg1">
        <div class="video-overlay header-text">
            <div class="caption">
                <h5>Absen dengan mudah menggunakan Eabsen </h5>
                <h2 style="font-size: 5vw;"> presence is one part of <em style="color: #23282c;">success</em></h2>
                <p id="jam" style="color: white;"></p>
                <div class="main-button scroll-to-section">
                    <a href="/auth/login">Login</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Features Item Start ***** -->
    <section class="section" id="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>Penggunaan <em> Eabsen </em></h2>
                        <p style="opacity: 0.8; padding-top: 10px; padding-bottom: 10px;">Eabsen adalah sebuah aplikasi berbasis website yang menyediakan sebuah fitur absen berbasis barcode atau qr-code yang memudahkan siswa untuk mengisi kehadiran.</p>
                        <img src="/assets/images/line-dec.png" alt="waves">

                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="features-items">
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="/assets/images/buka web.jpg" alt="First One" style="width: 100px; height: 100px; border-radius: 10px; box-shadow: 1px 1px 5px rgb(255,0,0);">
                            </div>
                            <div class="right-content">
                                <h4>1. Buka website Eabsen</h4>
                                <p>Anda dapat mengakses di hp , ipad , atau laptop anda dengan tautan berikut : <a href="#">http://xxxxxx</a> </p>
                            </div>
                        </li>
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="/assets/images/user login.jpg" alt="second one" style="width: 100px; height: 100px; border-radius: 10px; box-shadow: 1px 1px 5px rgb(255,0,0);">
                            </div>
                            <div class="right-content">
                                <h4>2. Login</h4>
                                <p>Login bisa di akses 2 user , bisa menggunakan NIS untuk siswa dan NIP untuk untuk guru</p>
                            </div>
                        </li>
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="/assets/images/profil.jpg" alt="third gym training" style="width: 100px; height: 100px; border-radius: 10px; box-shadow: 1px 1px 5px rgb(255,0,0);">
                            </div>
                            <div class="right-content">
                                <h4>3. Isi profil</h4>
                                <p>Bagi pengguna yang baru menggunakan website ini , setelah login anda harus mengisi profil dahulu untuk menjalankan fitur absen otomatis</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <ul class="features-items">
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="/assets/images/user absen.jpg" alt="fourth muscle" style="width: 100px; height: 100px; border-radius: 10px; box-shadow: 1px 1px 5px rgb(255,0,0);">
                            </div>
                            <div class="right-content">
                                <h4>4. Absen</h4>
                                <p>Jika kalian sudah mengisi profil maka fitur absen otomatis sudah berjalan , hanya tinggal scan qr-code menggunakan scanner</p>
                            </div>
                        </li>
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="/assets/images/ceklis.png" alt="training fifth" style="width: 100px; height: 100px; border-radius: 10px; box-shadow: 1px 1px 5px rgb(255,0,0);">
                            </div>
                            <div class="right-content">
                                <h4>5. Selesai</h4>
                                <p>Absen anda telah berhasil ( batas waktu absen jam 10 pagi)</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Item End ***** -->


    <!-- ***** Contact Us Area Starts ***** -->
    <section class="section" id="contact-us">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div id="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.9972997187824!2d107.55607371397743!3d-6.890925069344825!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6bd6aaaaaab%3A0xf843088e2b5bf838!2sSMK%20Negeri%2011%20Bandung!5e0!3m2!1sid!2sid!4v1613640336251!5m2!1sid!2sid" width="100%" height="600px" frameborder="0" style="border:0" allowfullscreen></iframe>

                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="contact-form">
                        <h4 style="margin-bottom: 10px; color: white;">Jika ada kesalahan atau kesulitan silahkan mengisi kotak saran dibawah </h4>
                        <form id="contact">
                            <div class="col-lg-12">
                                <fieldset>
                                    <label for="NIS">Atas nama :</label>
                                    <input type="text" name="NIS" id="NIS" placeholder="NIS" minlength="10" maxlength="10" required="required">
                                    <textarea name="pesan" rows="6" id="message" placeholder="Pesan" required="required"></textarea>
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <button type="submit" name="submit" id="form-submit" class="main-button" style="background-color: #17a2b8;"> Kirim Pesan</button>
                                </fieldset> <br>
                                <p>SMK Negeri 11 Bandung merupakan salah satu Lembaga Pendidikan Menengah Kejuruan di Kota Bandung, Jawa Barat </p> <br>

                                <p>Jl. Budhi Cilember, Bandung, Jawa Barat, Indonesia</p> <br>

                                <p><i class="fas fa-phone-alt"></i>&nbsp; 022-6652442 (telp) </p> <br>

                                <p> <i class="fas fa-envelope"></i> &nbsp; smkn11bdg@gmail.com </p> <br>

                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- ***** Contact Us Area Ends ***** -->

    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; 2021

                        - Designed by <a href="#">BlackPunk</a></p>

                    <!-- You shall support us a little via PayPal to info@templatemo.com -->

                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="/assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="/assets/js/popper.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="/assets/js/scrollreveal.min.js"></script>
    <script src="/assets/js/waypoints.min.js"></script>
    <script src="/assets/js/jquery.counterup.min.js"></script>
    <script src="/assets/js/imgfix.min.js"></script>
    <script src="/assets/js/mixitup.js"></script>
    <script src="/assets/js/accordions.js"></script>

    <!-- Global Init -->
    <script src="/assets/js/custom.js"></script>

    <!-- javascript sendiri -->
    <script src="/js/script.js"></script>
</body>

</html>