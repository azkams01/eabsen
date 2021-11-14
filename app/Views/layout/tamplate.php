<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <!--<title> Drop Down Sidebar Menu | CodingLab </title>-->
    <link rel="stylesheet" href="/css/style.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <!-- logo web -->
    <link rel="shortcut icon" href="/img/logo.png" type="image/ico">
    <!-- Manggil Sweeralert -->
    <script src="/js/sweetalert2.all.min.js"></script>

    <title><?php echo $title; ?></title>
</head>

<?php echo $this->renderSection('style'); ?>

<body>
    <?php if (akunSiswa()->Password == "12345678") { ?>
        <div class="overlay">
            <div class="form-password">
                <h3>Ubah Password</h3>
                <p>ubah password demi keamanan dan privasi data anda</p>
                <form action="/users/ubahPassword/<?= akunSiswa()->id ?>" method="post">
                    <input type="hidden" name="id" value="<?php akunSiswa()->id ?>">
                    <input type="password" name="Password" placeholder="Masukan Password Baru" autofocus autocomplete="off" minlength="8" maxlength="10" required="required"> <br>
                    <button type="submit" name="submit" class="btn btn-block btn-info" style="width: 30%; margin: auto; margin-top: 3%;">Simpan</button>
                </form>
            </div>
        </div>
    <?php } ?>
    <div class="bungkus-load ">
        <div class="spinner-border text-success loading" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="sidebar close">
        <div class="logo-details" style="border-bottom: 2px solid darkcyan;">
            <img src="/img/logo.png" alt="" style="width: 50px; height: 50px; margin-left: 13px;">
            <span class="logo_name" style="margin-left: 15px;">Eabsen</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="/users/dashboard">
                    <i class="fas fa-home"></i>
                    <span class="link_name">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/users/dashboard">Dashboard</a></li>
                </ul>
            </li>
            <li>
                <a href="/users/absen">
                    <i class="fas fa-qrcode"></i>
                    <span class="link_name">Absen</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/users/absen">Absen</a></li>
                </ul>
            </li>
            <li>
                <a href="/users/profil">
                    <i class="far fa-image"></i>
                    <span class="link_name">Profil</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/users/profil">Profil</a></li>
                </ul>
            </li>
            <li>
                <a href="/users/faq">
                    <i class="fas fa-question-circle"></i>
                    <span class="link_name">FAQ</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/users/faq">FAQ</a></li>
                </ul>
            </li>
            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <img src="/img/<?= akunSiswa()->Foto ?>">
                    </div>
                    <div class="name-job">
                        <div class="profile_name text-truncate" style="max-width: 100px;"><?php echo akunSiswa()->Nama ?></div>
                        <div class="job"><?php echo akunSiswa()->Kelas ?></div>
                    </div>
                    <a href="/auth/logout">
                        <i class='bx bx-log-out'></i>
                    </a>
                </div>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
            <div class="container-fluid">
                <i class='bx bx-menu'></i>
                <span class="text"><?php echo $header; ?></span>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <p style="position:absolute; right: 0; padding-top: 17px; padding-right: 20px;" id="jam"></p>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/users/dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/users/absen">Absen</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/users/profil">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/users/faq">Faq</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/auth/logout">logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <?php echo $this->renderSection('content'); ?>


    </section>
    <script>
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e) => {
                let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
                arrowParent.classList.toggle("showMenu");
            });
        }
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        console.log(sidebarBtn);
        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });

        // Untuk mengatur resposive dengan js

        function myFunction(x) {
            if (x.matches) { // If media query matches
                sidebar.classList.add("close");
            }
        }

        var x = window.matchMedia("(max-width: 420px)")
        myFunction(x) // Call listener function at run time
        x.addListener(myFunction) // Attach listener function on state changes

        // Untuk Melihat isi password di profil

        const lihatpassword = document.querySelector('.tmbps')
        const password = document.getElementById('inputPassword')
        lihatpassword.addEventListener('click', function() {
            if (password.getAttribute("type") === "password") {
                password.setAttribute('type', 'text')
            } else {
                password.setAttribute('type', 'password')
            }
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="/js/script.js"></script>
</body>

</html>