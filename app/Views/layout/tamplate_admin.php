<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <!--<title> Drop Down Sidebar Menu | CodingLab </title>-->
    <link rel="stylesheet" href="<?= base_url() ?>/css/style.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/8f0393d68d.js" crossorigin="anonymous"></script>
    <!-- logo web -->
    <link rel="shortcut icon" href="<?= base_url() ?>/img/logo.png" type="image/ico">
    <!-- Manggil Sweeralert -->
    <script src="<?= base_url() ?>/js/sweetalert2.all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <title><?php echo $title; ?></title>
</head>

<?php echo $this->renderSection('style'); ?>

<body>
    <div class="bungkus-load">
        <div class="loading">
        </div>
    </div>
    <div class="sidebar close">
        <div class="logo-details" style="border-bottom: 2px solid darkcyan;">
            <img src="<?= base_url() ?>/img/logo.png" alt="" style="width: 50px; height: 50px; margin-left: 13px;">
            <span class="logo_name" style="margin-left: 15px;">Eabsen</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="<?= base_url() ?>/admin/dashboard">
                    <i class="fas fa-home"></i>
                    <span class="link_name">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="<?= base_url() ?>/admin/dashboard">Dashboard</a></li>
                </ul>
            </li>
            <li>
                <a href="<?= base_url() ?>/admin/datasiswa">
                    <i class="fas fa-table"></i>
                    <span class="link_name">Data Siswa</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="<?= base_url() ?>/admin/datasiswa">Data Siswa</a></li>
                </ul>
            </li>
            <li>
                <a href="<?= base_url() ?>/admin/dataguru">
                    <i class="fas fa-users"></i>
                    <span class="link_name">Data Guru</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="<?= base_url() ?>/admin/dataguru">Data Guru</a></li>
                </ul>
            </li>
            <li>
                <a href="<?= base_url() ?>/admin/FAQ">
                    <i class="fas fa-question-circle"></i>
                    <span class="link_name">FAQ</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="<?= base_url() ?>/admin/FAQ">FAQ</a></li>
                </ul>
            </li>
            <li>
                <a href="<?= base_url() ?>/admin/report">
                    <i class="fas fa-file-download"></i>
                    <span class="link_name">Report</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="<?= base_url() ?>/admin/report">Report</a></li>
                </ul>
            </li>
            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <img src="<?= base_url() ?>/img/profile.png">
                    </div>
                    <div class="name-job">
                        <div class="profile_name text-truncate" style="max-width: 100px;">Admin</div>
                        <div class="job"></div>
                    </div>
                    <a href="<?= base_url() ?>/admin/logout">
                        <i class='bx bx-log-out'></i>
                    </a>
                </div>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
                            <a class="nav-link" aria-current="page" href="<?= base_url() ?>/admin/dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>/admin/datasiswa">Data Siswa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>/admin/dataguru">Data Guru</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>/admin/faq">Faq</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>/admin/report">Report</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>/admin/logout">logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>



        <?php echo $this->renderSection('content'); ?>


    </section>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
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

        function myFunction(x) {
            if (x.matches) { // If media query matches
                sidebar.classList.add("close");
            }
        }

        var x = window.matchMedia("(max-width: 420px)")
        myFunction(x) // Call listener function at run time
        x.addListener(myFunction) // Attach listener function on state changes
    </script>
    <script src="<?= base_url() ?>/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>/js/script.js"></script>
</body>

</html>