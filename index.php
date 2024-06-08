<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>COFFEE - SHOP</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
<script>
    function confirmFunc(text, value) {
        if (confirm(text) == true) {
            window.location.href = "?value=" + value
        }
    }
</script>
<style>
    .img-scale:hover {
        scale: 1.9;
        transition: 0.3s;
    }

    .num-input {
        padding: 2px 5px;
        font-size: 20px;
        border: 1px solid #dedcd9;
        border-radius: 11px;
        width: 60px;
    }

    .time {
        font-size: 10px;
        margin-top: 2px;
    }

    .opacity-animation {
        animation: opacity 1s
    }

    @keyframes opacity {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    .hemenIste {
        text-align: center;
        font-weight: bold;
    }

    .card {
        border: none;
        background-color: transparent;
    }

    .cardContainer {
        width: 50%;
        border: 1.5px solid #ccc;
        border-radius: 10px;

    }

    .cardContainer img {
        width: 10%;
        border-radius: 20%;
    }

    .saat {
        font-size: 10px;
    }
</style>

<body class="opacity-animation">
    <div></div>
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

<?php

session_start();
include 'connect.php';

if (isset($_SESSION['pas_state'])) {
    if ($_SESSION['pas_state'] != 2) {
        if (isset($_GET['value']) && $_GET['value'] != 'change_password') {
            echo '<script>window.location="?value=change_password"</script>';
        } else if (!isset($_GET['value'])) {
            echo '<script>window.location="?value=change_password"</script>';
        }
    }
}

print_r($_SESSION);
function main_page()
{
    if (isset($_SESSION['user_id'])) {
        global $con;
        $sql = "SELECT count(id) as satir_sayisi FROM sepet where user_id=" . $_SESSION['user_id'];
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $satir_sayisi = $row['satir_sayisi'];
    } else {
        $satir_sayisi = '';
    }
    echo '
        <!-- Navbar Start -->
        <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3 -mt-4">
            <a href="index.php" class="navbar-brand px-lg-4 m-0">
                <h1 class="m-0 display-4 text-uppercase text-white">COFFEE</h1>
                
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse visible justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto p-4">
                </details>
                    <a href="index.php" class="nav-item nav-link active">Home</a>
                    <a href="?value=card" class="nav-item nav-link">Card (' . $satir_sayisi . ')</a>
                    <a href="service.php" class="nav-item nav-link">Service</a>
                    <a href="menu.php" class="nav-item nav-link">Menu</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu text-capitalize">
                            <a href="testimonial.php" class="dropdown-item">Testimonial</a>
                            <a href="?value=rezervasyon_page" class="dropdown-item">Rezervasyonlarim</a>
                        </div>
                    </div>
                    <a href="contact.php" class="nav-item nav-link">Contact</a>
    ';
    if (isset($_SESSION['user_email'])) {
        echo '<button onClick="confirmFunc(`Çıkış Yapacaginizdan Eminmisiniz??`,`cikis`)" class="nav-item nav-link">Logout</button>';
    } else {
        echo '
                <button data-modal-target="authentication-modal2" data-modal-toggle="authentication-modal2" type="button" class="btn text-primary btn-xs font-weight-bold" data-toggle="modal" data-target=".bs-example-modal-sm">Üye Ol</button>
                <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" type="button" class="btn text-primary btn-xs font-weight-bold">Giriş Yap</button>
                ';
    }
    echo '
                  </div>
                    </div>
                      </nav>
                     </div>
                <!-- login Modal  -->
            <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="opacity-animation hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full opacity-animation">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Login
                        </h3>
                        <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                        <form class="space-y-4" method="post" action="?value=login">
                            <div>
                                <input type="email" name="email" id="emaill" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required>
                            </div>
                            <div>
                                <input type="password" name="password" id="passwordd" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            </div>
                            <div class="flex justify-between">
                                <a href="#" class="text-sm text-blue-700 item-end hover:underline dark:text-blue-500">Lost Password?</a>
                            </div>
                            <button type="submit" name="login" class="w-full text-white bg-primary hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login to your account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- login modal end -->
        <!-- register modal -->
        <div id="authentication-modal2" tabindex="-1" aria-hidden="true" class="opacity-animation hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Kayıt Ol
                        </h3>
                        <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal2">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                    <form class="space-y-4" method="post" action="?value=register">
                    <div>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Name:" required>
                    </div>
                    <div>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required>
                    </div>
                    <div>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div>
                        <textarea name="adres" id="adres" placeholder="Adres" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required></textarea>
                    </div>
                    <div class="flex justify-between">
                    </div>
                    <button type="submit" name="register" class="w-full text-white bg-primary hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register</button>
                </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- register modal end -->
        <!-- Navbar End -->
        <!-- Carousel Start -->
        <div class="container-fluid p-0 mb-5">
            <div id="blog-carousel" class="carousel slide overlay-bottom" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="w-100" src="img/carousel-1.jpg" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <h2 class="text-primary font-weight-medium m-0">We Have Been Serving</h2>
                            <h1 class="display-1 text-white m-0">COFFEE</h1>
                            <h2 class="text-white m-0">* SINCE 1950 *</h2>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="w-100" src="img/carousel-2.jpg" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <h2 class="text-primary font-weight-medium m-0">We Have Been Serving</h2>
                            <h1 class="display-1 text-white m-0">COFFEE</h1>
                            <h2 class="text-white m-0">* SINCE 1950 *</h2>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#blog-carousel" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#blog-carousel" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>
        <!-- Carousel End -->
        <!-- About Start -->
        <div class="container-fluid py-5">
            <div class="container">
                <div class="section-title">
                    <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">About Us</h4>
                    <h1 class="display-4">1950"den Beri Hizmet Veriyoruz</h1>
                </div>
                <div class="row">
                    <div class="col-lg-4 py-0 py-lg-5">
                        <h1 class="mb-3">Hakkımızda</h1>
                        <h5 class="mb-3">Eos kasd eos dolor vero vero, lorem stet diam rebum. Ipsum amet sed vero dolor sea</h5>
                        <p>Takimata sed vero vero no sit sed, justo clita duo no duo amet et, nonumy kasd sed dolor eos diam lorem eirmod. Amet sit amet amet no. Est nonumy sed labore eirmod sit magna. Erat at est justo sit ut. Labor diam sed ipsum et eirmod</p>
                        <a href="" class="btn btn-secondary font-weight-bold py-2 px-4 mt-2">Learn More</a>
                    </div>
                    <div class="col-lg-4 py-5 py-lg-0" style="min-height: 500px;">
                        <div class="position-relative h-100">
                            <img class="position-absolute w-100 h-100" src="img/about.png" style="object-fit: cover;">
                        </div>
                    </div>
                    <div class="col-lg-4 py-0 py-lg-5">
                        <h1 class="mb-3">Our Vision</h1>
                        <p>Invidunt lorem justo sanctus clita. Erat lorem labore ea, justo dolor lorem ipsum ut sed eos, ipsum et dolor kasd sit ea justo. Erat justo sed sed diam. Ea et erat ut sed diam sea ipsum est dolor</p>
                        <h5 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>Lorem ipsum dolor sit amet</h5>
                        <h5 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>Lorem ipsum dolor sit amet</h5>
                        <h5 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>Lorem ipsum dolor sit amet</h5>
                        <a href="" class="btn btn-primary font-weight-bold py-2 px-4 mt-2">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->
        <!-- Service Start -->
        <div class="container-fluid pt-5">
            <div class="container">
                <div class="section-title">
                    <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Our Services</h4>
                    <h1 class="display-4">Fresh & Organic Beans</h1>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-5">
                        <div class="row align-items-center">
                            <div class="col-sm-5">
                                <img class="img-fluid mb-3 mb-sm-0" src="img/service-1.jpg" alt="">
                            </div>
                            <div class="col-sm-7">
                                <h4><i class="fa fa-truck service-icon"></i>Fastest Door Delivery</h4>
                                <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo. Guberg sea et et lorem dolor sed est sit
                                    invidunt, dolore tempor diam ipsum takima erat tempor</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <div class="row align-items-center">
                            <div class="col-sm-5">
                                <img class="img-fluid mb-3 mb-sm-0" src="img/service-2.jpg" alt="">
                            </div>
                            <div class="col-sm-7">
                                <h4><i class="fa fa-coffee service-icon"></i>Fresh Coffee Beans</h4>
                                <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo. Guberg sea et et lorem dolor sed est sit
                                    invidunt, dolore tempor diam ipsum takima erat tempor</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <div class="row align-items-center">
                            <div class="col-sm-5">
                                <img class="img-fluid mb-3 mb-sm-0" src="img/service-3.jpg" alt="">
                            </div>
                            <div class="col-sm-7">
                                <h4><i class="fa fa-award service-icon"></i>Best Quality Coffee</h4>
                                <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo. Guberg sea et et lorem dolor sed est sit
                                    invidunt, dolore tempor diam ipsum takima erat tempor</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <div class="row align-items-center">
                            <div class="col-sm-5">
                                <img class="img-fluid mb-3 mb-sm-0" src="img/service-4.jpg" alt="">
                            </div>
                            <div class="col-sm-7">
                                <h4><i class="fa fa-table service-icon"></i>Online Table Booking</h4>
                                <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo. Guberg sea et et lorem dolor sed est sit
                                    invidunt, dolore tempor diam ipsum takima erat tempor</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service End -->
        <!-- Offer Start -->
        <div class="offer container-fluid my-5 py-5 text-center position-relative overlay-top overlay-bottom">
            <div class="container py-5">
                <h1 class="display-3 text-primary mt-3">50% OFF</h1>
                <h1 class="text-white mb-3">Sunday Special Offer</h1>
                <h4 class="text-white font-weight-normal mb-4 pb-3">Only for Sunday from 1st Jan to 30th Jan 2045</h4>
                <form class="form-inline justify-content-center mb-4">
                    <div class="input-group">
                        <input type="text" class="form-control p-4" placeholder="Your Email" style="height: 60px;">
                        <div class="input-group-append">
                            <button class="btn btn-primary font-weight-bold px-4" type="submit">Sign Up</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Offer End -->
        <!-- Menu Start -->
        <div class="container-fluid pt-5">
            <div class="container">
                <div class="section-title">
                    <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Menu & Pricing</h4>
                    <h1 class="display-4">Competitive Pricing</h1>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <h1 class="mb-5">Hot Coffee</h1>
                        <div class="row align-items-center mb-5">
                            <div class="col-4 col-sm-3">
                                <img class="w-100 rounded-circle mb-3 mb-sm-0" src="sql_img/menu-1.jpg" alt="">
                                <h5 class="menu-price">$5</h5>
                            </div>
                            <div class="col-8 col-sm-9">
                                <h4>Black Coffee</h4>
                                <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo guberg sea et et lorem dolor</p>
                            </div>
                        </div>
                        <div class="row align-items-center mb-5">
                            <div class="col-4 col-sm-3">
                                <img class="w-100 rounded-circle mb-3 mb-sm-0" src="sql_img/menu-2.jpg" alt="">
                                <h5 class="menu-price">$7</h5>
                            </div>
                            <div class="col-8 col-sm-9">
                                <h4>Chocolete Coffee</h4>
                                <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo guberg sea et et lorem dolor</p>
                            </div>
                        </div>
                        <div class="row align-items-center mb-5">
                            <div class="col-4 col-sm-3">
                                <img class="w-100 rounded-circle mb-3 mb-sm-0" src="sql_img/menu-3.jpg" alt="">
                                <h5 class="menu-price">$9</h5>
                            </div>
                            <div class="col-8 col-sm-9">
                                <h4>Coffee With Milk</h4>
                                <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo guberg sea et et lorem dolor</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h1 class="mb-5">Cold Coffee</h1>
                        <div class="row align-items-center mb-5">
                            <div class="col-4 col-sm-3">
                                <img class="w-100 rounded-circle mb-3 mb-sm-0" src="sql_img/menu-1.jpg" alt="">
                                <h5 class="menu-price">$5</h5>
                            </div>
                            <div class="col-8 col-sm-9">
                                <h4>Black Coffee</h4>
                                <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo guberg sea et et lorem dolor</p>
                            </div>
                        </div>
                        <div class="row align-items-center mb-5">
                            <div class="col-4 col-sm-3">
                                <img class="w-100 rounded-circle mb-3 mb-sm-0" src="sql_img/menu-2.jpg" alt="">
                                <h5 class="menu-price">$7</h5>
                            </div>
                            <div class="col-8 col-sm-9">
                                <h4>Chocolete Coffee</h4>
                                <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo guberg sea et et lorem dolor</p>
                            </div>
                        </div>
                        <div class="row align-items-center mb-5">
                            <div class="col-4 col-sm-3">
                                <img class="w-100 rounded-circle mb-3 mb-sm-0" src="sql_img/menu-3.jpg" alt="">
                                <h5 class="menu-price">$9</h5>
                            </div>
                            <div class="col-8 col-sm-9">
                                <h4>Coffee With Milk</h4>
                                <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo guberg sea et et lorem dolor</p>
                            </div>
                        </div>
                    </div>
                     <div class="hemenIste w-full md:text-end">
                     <a href="menu.php">  Hemen Iste -></a>
                    
                      </div>
    
                </div>
            </div>
        </div>
        <!-- Menu End -->
        <!-- Reservation Start -->
        <div class="container-fluid my-5">
            <div class="container">
                <div class="reservation position-relative overlay-top overlay-bottom">
                    <div class="row align-items-center">
                        <div class="col-lg-6 my-5 my-lg-0">
                            <div class="p-5">
                                <div class="mb-4">
                                    <h1 class="text-white">Online Rezervasyonda</h1>
                                    <h1 class="display-3 text-primary">%30 İNDİRİM</h1>
                                </div>
                                <p class="text-white">Lorem justo clita erat lorem labore ea, justo dolor lorem ipsum ut sed eos,
                                    ipsum et dolor kasd sit ea justo. Erat justo sed sed diam. Ea et erat ut sed diam sea</p>
                                <ul class="list-inline text-white m-0">
                                    <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Lorem ipsum dolor sit amet</li>
                                    <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Lorem ipsum dolor sit amet</li>
                                    <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Lorem ipsum dolor sit amet</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="text-center" style="background: rgba(51, 33, 29, .8);">
                                <a href="?value=rezerAl_page" class="text-white mb-4 mt-1 py-3 block">Book Your Table -></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Reservation End -->
        <!-- Testimonial Start -->
        <div class="container-fluid py-5">
            <div class="container">
                <div class="section-title">
                    <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Testimonial</h4>
                    <h1 class="display-4">Our Clients Say</h1>
                </div>
                <div class="owl-carousel testimonial-carousel">
                    <div class="testimonial-item">
                        <div class="d-flex align-items-center mb-3">
                            <img class="img-fluid" src="img/testimonial-1.jpg" alt="">
                            <div class="ml-3">
                                <h4>Client Name</h4>
                                <i>Profession</i>
                            </div>
                        </div>
                        <p class="m-0">Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr eirmod clita lorem. Dolor tempor ipsum sanct clita</p>
                    </div>
                    <div class="testimonial-item">
                        <div class="d-flex align-items-center mb-3">
                            <img class="img-fluid" src="img/testimonial-2.jpg" alt="">
                            <div class="ml-3">
                                <h4>Client Name</h4>
                                <i>Profession</i>
                            </div>
                        </div>
                        <p class="m-0">Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr eirmod clita lorem. Dolor tempor ipsum sanct clita</p>
                    </div>
                    <div class="testimonial-item">
                        <div class="d-flex align-items-center mb-3">
                            <img class="img-fluid" src="img/testimonial-3.jpg" alt="">
                            <div class="ml-3">
                                <h4>Client Name</h4>
                                <i>Profession</i>
                            </div>
                        </div>
                        <p class="m-0">Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr eirmod clita lorem. Dolor tempor ipsum sanct clita</p>
                    </div>
                    <div class="testimonial-item">
                        <div class="d-flex align-items-center mb-3">
                            <img class="img-fluid" src="img/testimonial-4.jpg" alt="">
                            <div class="ml-3">
                                <h4>Client Name</h4>
                                <i>Profession</i>
                            </div>
                        </div>
                        <p class="m-0">Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr eirmod clita lorem. Dolor tempor ipsum sanct clita</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->';
    include_once("footer.php");
}

function kayit()
{
    global $con;
    if (isset($_POST['register'])) {
        $ad = $_POST['name'];
        $email = $_POST['email'];
        $adres = $_POST['adres'];
        $password = md5(md5($_POST['password']));
        $sql = "INSERT into user (name,email,password,adres,password_state) values('$ad','$email','$password','$adres',2)";
        $sql2 = "SELECT email from user where email='$email'";
        $res2 = mysqli_query($con, $sql2);
        $row = mysqli_num_rows($res2);
        if ($row > 0) {
            echo '<script>alert("bu emaille daha once kayit yaplimis!");window.location.href="?"</script>';
        } else {
            $res = mysqli_query($con, $sql);
            if ($res) {
                echo '<script>alert("donee")</script>';
                echo "<script> window.location.href='?'</script>";
            } else {
                echo '<script>alert("errorr!!")</script>';
            }
        }
    }
}

function giris()
{
    global $con;
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = md5(md5($_POST['password']));
        $sql = "SELECT * from user where email='$email' and password='$password'";
        $res = mysqli_query($con, $sql);
        $row = mysqli_num_rows($res);
        if ($row > 0) {
            $row = mysqli_fetch_assoc($res);
            $name = $row['name'];
            $state = $row['state'];
            $email = $row['email'];
            $password_state = $row['password_state'];
            $id = $row['id'];
            $_SESSION['name'] = $name;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_id'] = $id;
            $_SESSION['user_state'] = $state;
            $_SESSION['pas_state'] = $password_state;
            echo "<script>alert('WELCOME ♥  $name')</script>";
            if ($password_state == 1) {
                echo "<script>window.location.href='?value=change_password'</script>";
            } else {
                echo "<script>window.location.href='?'</script>";
            }
        } else {
            echo '<script>alert("kullanici bulunmamaktadir!")</script>';
            // echo '<script>window.location.href="?"</script>';
        }
    } else {
        echo "login";
        exit();
    }
}
function cikis()
{
    session_unset();
    session_destroy();
    echo "<script> window.location.href='?'</script>";
}
function rezer_tut()
{
    global $con;
    if (isset($_POST["rezer_tut"])) {
        if (isset($_SESSION['user_email'])) {
            $name = $_POST["name"];
            $email = $_SESSION['user_email'];
            $date = $_POST["date"];
            $time = $_POST["time"];
            $person = $_POST["person"];
            $query = "INSERT INTO rezervasyon (name, email, date, time, person) VALUES ('$name', '$email', '$date', '$time', '$person')";
            $result = mysqli_query($con, $query);
            if ($result) {
                echo "<script>alert('Rezervasyonunuz alınmıştır.')</script>";
                echo "<script>window.location.href='?value=rezervasyon_page'</script>";
            } else {
                echo "<script>alert('Rezervasyonunuz alınamadı.')</script>";
                echo "<script>window.location.href=index.php</script>";
            }
        } else {
            echo "<script>alert('Rezervasyon yapabilmek için giriş yapmanız gerekmektedir.!')</script>";
            echo "<script>window.location.href='?'</script>";
        }
    }
}
function rezerAl_page()
{
    echo '
    <!-- Navbar Start -->
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
            <a href="index.php" class="navbar-brand px-lg-4 m-0">
                <h1 class="m-0 display-4 text-uppercase text-white">KOFFEE</h1>
            </a> 
        </nav>
    </div>
    <!-- Navbar End -->
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Reservation</h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="?">Home</a></p>
                <p class="m-0 text-white px-2">/</p>
                <a class="m-0 text-white" href="?value=rezervasyon_page">Reservation</a>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
    <!-- Reservation Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="reservation position-relative overlay-top overlay-bottom">
                <div class="row align-items-center">
                    <div class="col-lg-6 my-5 my-lg-0">
                        <div class="p-5">
                            <div class="mb-4">
                                <h1 class="display-3 text-primary">30% OFF</h1>
                                <h1 class="text-white">For Online Reservation</h1>
                            </div>
                            <p class="text-white">Lorem justo clita erat lorem labore ea, justo dolor lorem ipsum ut sed eos,
                                ipsum et dolor kasd sit ea justo. Erat justo sed sed diam. Ea et erat ut sed diam sea</p>
                            <ul class="list-inline text-white m-0">
                                <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Lorem ipsum dolor sit amet</li>
                                <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Lorem ipsum dolor sit amet</li>
                                <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Lorem ipsum dolor sit amet</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-center p-5" style="background: rgba(51, 33, 29, .8);">
                            <h1 class="text-white mb-4 mt-5">Book Your Table</h1>
                            <form class="mb-5" action="?value=rezervasyon" method="POST">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control bg-transparent border-primary p-4" placeholder="Name"
                                        required="required" />
                                </div>
                                <div class="form-group">
                                    <div class="date" id="date" data-target-input="nearest">
                                        <input type="text" name="date" class="form-control bg-transparent border-primary p-4 datetimepicker-input" placeholder="Date" data-target="#date" data-toggle="datetimepicker"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="time" id="time" name="time" data-target-input="nearest">
                                        <input type="text" name="time" class="form-control bg-transparent border-primary p-4 datetimepicker-input" placeholder="Time" data-target="#time" data-toggle="datetimepicker"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select name="person" class="custom-select bg-transparent border-primary px-4" style="height: 49px;">
                                        <option selected>Person</option>
                                        <option value="1">Person 1</option>
                                        <option value="2">Person 2</option>
                                        <option value="3">Person 3</option>
                                        <option value="3">Person 4</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <button name="rezer_tut" class="btn btn-primary btn-block font-weight-bold py-3" type="submit">Book Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Reservation End -->';
    include_once("footer.php");
    echo '
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    
    ';
}
function rezervasyon_page()
{
    echo '
        <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
        <a href="index.php" class="navbar-brand px-lg-4 m-0">
            <h1 class="m-0 display-4 text-uppercase text-white">COFFEE</h1>
        </a>
        </nav>
        </div>
        <!-- Navbar End -->
        <!-- Page Header Start -->
        <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
        <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Rezervasyonlar</h1>
        <div class="d-inline-flex mb-lg-5">
            <p class="m-0 text-white"><a class="text-white" href="?">Home</a></p>
            <p class="m-0 text-white px-2">/</p>
            <p class="m-0 text-white">About Us</p>
        </div>
        </div>
        </div>
        <!-- Page Header End -->
        <!-- About Start -->
        <div class="container-fluid py-5">
        <div class="container">
        <div class="row justify-evenly">
            <div class="col-lg-5 py-0 py-lg-4 border border-1">';
    global $con;
    if (isset($_SESSION['user_email'])) {
        $email = $_SESSION['user_email'];
        $sql = "SELECT * from rezervasyon where email='$email'";
        $res = mysqli_query($con, $sql);
        if (mysqli_num_rows($res) == 0) {
            echo '<p class="">Rezervasyonunuz bulunmamaktadir.</p>';
        } else {
            while ($row = mysqli_fetch_assoc($res)) {
                $name = $row['name'];
                $date = $row['date'];
                $time = $row['time'];
                $person = $row['person'];
                $idisi = $row['id'];
                echo '
            <hr>
             <div class="flex items-center">
             <div class="w-full">
              <div class="flex gap-6 items-center pt-2"> 
              <h1 class="uppercase">' . $name . '</h1>
              <span class="text-xs">' . $date . '</span>
              <span class="time">' . $time . '</span>
              </div>
              
              <p class="pb-2">Kişi sayısı: ' . $person . '</p>
              </div>
              <button class="p-2 rounded-full hover:bg-gray-400 focus:outline-none" onClick="confirmFunc(`silmek istediginizden eminmisiniz??`,`delete&id=' . $idisi . '`)"><svg class="w-6 h-6 text-gray-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
              <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
            </svg>
            </button>
          </div>
          <div class="text-end">
          <a href="?value=rezerAl_page" class="mt-10 block w-52 pl-2 hover: text-gray-200 hover:text-white bg-primary text-end ">Yeni Rezervasyon</a>
          </div>
          ';
            }
        }
    } else {
        echo '<p>Rezervasyonlarinizi görebilmek için giriş yapmanız gerekmektedir.</p>';
    }
    echo '
        </div>
            <div class="col-lg-4 py-5 py-lg-0" style="min-height: 500px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100" src="img/about.png" style="object-fit: cover;">
                </div>
            </div>
        </div>
        </div>
        </div>
        <!-- About End -->';
    include_once("footer.php");
    echo '
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>
        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/tempusdominus/js/moment.min.js"></script>
        <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Contact Javascript File -->
        <script src="mail/jqBootstrapValidation.min.js"></script>
        <script src="mail/contact.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>';
}
function rezer_sil()
{
    global $con;
    $id = $_GET['id'];
    $sql = "DELETE from rezervasyon where id='$id'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        echo '<script>alert("silme islemi basarili")</script>';
        echo '<script>window.location.href="?value=rezervasyon_page"</script>';
    } else {
        echo '<script>alert("silme islemi basarisiz")</script>';
        echo '<script>window.location.href="?value=rezervasyon_page"</script>';
    }
}
function cardPage()
{
    if (!isset($_SESSION['user_id'])) {
        echo '<script>alert("lutfen giriş yapınız")</script>';
        echo '<script>window.location.href="?"</script>';
    } else {
        echo '
    <!-- Navbar Start -->
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
            <a href="index.php" class="navbar-brand px-lg-4 m-0">
                <h1 class="m-0 display-4 text-uppercase text-white">COFFEE</h1>
            </a>
        </nav>
    </div>
    <!-- Navbar End -->
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Your Card </h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="?">Home</a></p>
                <p class="m-0 text-white px-2">/</p>';
        if (!isset($_GET['action'])) {
            echo '<p class="m-0 text-white"><a class="text-white" href="menu.php">Menu</a></p>';
        } else {
            echo '<p class="m-0 text-white"><a class="text-white" href="?value=card">Sepete Dön</a></p>';
        }
        echo '
            </div>
        </div>
    </div>
    <!-- Page Header End -->
    <!-- card page Start -->
    <div class="card">
      <div class="container cardContainer">
      ';
        if (!isset($_GET['action'])) {
            global $con;
            $sql = "SELECT * from sepet where user_id='" . $_SESSION['user_id'] . "'";
            $res = mysqli_query($con, $sql);
            if (mysqli_num_rows($res) == 0) {
                echo '<h1 class="text-center p-16">Sepetinizde ürün bulunmamaktadır.</h1>';
            } else {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $cofe_id = $row['coffe_id'];
                    $price = $row['fiyat'];
                    $adet = $row['adet'];
                    $sonuc = $price * $adet;
                    $saat = $row['date'];
                    $durum = $row['durum'];
                    $sql2 = "SELECT * from cafe where id='$cofe_id'";
                    $res2 = mysqli_query($con, $sql2);
                    $row2 = mysqli_fetch_assoc($res2);
                    $title = $row2['coffe_adi'];
                    $coffe_turu = $row2['coffe_turu'];
                    $img = $row2['coffe_img'];
                    echo '
            <div class="item flex items-start justify-center mb-1 pt-2 pb-1 border-b items-center justify-around flex"> 
                <img class="img-scale mr-3" src="sql_img/' . $img . '" width="100px" >
             <div class="card-title w-2/4  ">
             <details class="">
             <summary class="">' . $title . '</summary>
             <p class="text-xs text-gray-500 my-2">adet: <input type="number" id="number_input" onchange="change_adet(' . $id . ',event)" class="num-input" value="' . $adet . '" /></p>
             <p class="text-xs text-gray-500">' . $coffe_turu . '</p>
             <p class="text-xs mt-1 text-gray-400 saat">' . $saat . '</p>
             </details>'
?>
                    <script>
                        function change_adet(id, event) {
                            var value = event.target.value;
                            var adet = value;
                            var id = id;
                            if (adet <= 0) {
                                adet = 1;
                                event.target.value = 1;
                                return;
                            } else {
                                window.location = "?value=change_adet&id=" + id + "&adet=" + adet;
                            }
                        }
                    </script>
<?php
                    echo '
                </div>
                <p>$' . $sonuc . '</p>
               <div class="flex flex-col justify-between gap-4">
                 <button onClick="confirmFunc(`silmek istediginizden eminmisiniz??`,`deleteCard&id=' . $id . '`)">Delete</button>
               </div>

            </div>';
                }
                $sql3 = 'SELECT sum(fiyat*adet) as toplam from sepet where user_id="' . $_SESSION['user_id'] . '"';
                $res3 = mysqli_query($con, $sql3);
                $row3 = mysqli_fetch_assoc($res3);
                $toplam = $row3['toplam'];
                echo '
            <div class="flex items-center mb-3 justify-around">
            <p>Toplam: <b class="text-orange-600">$' . $toplam . '</b></p>
            <button class="bg-primary text-white px-3 py-1 rounded-xl " onClick="confirmFunc(`Siparişi onaylamak istediğinizden emin misiniz?`,`card&action=siparis_onayla`)"
            >Ödeme Yap</button>
            </div>
            </div>
           </div>';
            }
        } else {
            if (isset($_GET['action'])) {
                echo 'odeme onaylaa';
            }
        }
        echo '
        </div>
        <!-- Menu End -->';
        include_once("footer.php");
        echo '
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    ';
    }
}
function deleteCard()
{
    if (isset($_SESSION['user_id'])) {
        global $con;
        $id = $_GET['id'];
        $sql = "DELETE from sepet where id='$id'";
        $res = mysqli_query($con, $sql);
        if ($res) {
            echo '<script>alert("silme islemi basarili")</script>';
            echo '<script>window.location.href="?value=card"</script>';
        } else {
            echo '<script>alert("silme islemi basarisiz")</script>';
            echo '<script>window.location.href="?value=card"</script>';
        }
    }
}
function change_adet()
{
    if (isset($_SESSION['user_id'])) {
        global $con;
        $adet = $_GET['adet'];
        $id = $_GET['id'];
        $sql = "UPDATE sepet set adet='$adet' where id='$id'";
        $res = mysqli_query($con, $sql);
        $row = mysqli_affected_rows($con);
        if ($row) {
            echo '<script>window.location.href="?value=card"</script>';
        } else {
            echo '<script>alert("adet degisikligi basarisiz")</script>';
            echo '<script>window.location.href="?value=card"</script>';
        }
    }
}
function change_password()
{
    global $con;
    if (isset($_POST['change_password'])) {
        $email = $_SESSION['user_email'];
        $new_password = md5(md5($_POST['new_password']));
        $sql2 = "UPDATE user set password='$new_password' , password_state = 2 where email='$email'";
        $res2 = mysqli_query($con, $sql2);
        if ($res2) {
            $_SESSION['pas_state'] = 2;
            echo '<script>alert("sifre degisikligi basarili")</script>';
            echo '<script>window.location.href="?"</script>';
        } else {
            echo '<script>alert("sifre degisikligi basarisiz")</script>';
            echo '<script>window.location.href="?value=change_password"</script>';
        }
    } else {
        //change password page
        echo '
        <!-- Navbar Start -->
        <div class="container-fluid p-0 nav-bar">
            <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
                <a href="index.php" class="navbar-brand px-lg-4 m-0">
                    <h1 class="m-0 display-4 text-uppercase text-white">COFFEE</h1>
                </a>
            </nav>
        </div>
        <!-- Navbar End -->
        <!-- Page Header Start -->
        <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
            <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
                <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Change Password</h1>
                <div class="d-inline-flex mb-lg-5">
                    <p class="m-0 text-white"><a class="text-white
                    " href="?">Home</a></p>
                    <p class="m-0 text-white px-2">/</p>
                    <p class="m-0 text-white">Change Password</p>
                </div>
            </div>
        </div>
        <!-- Page Header End -->
        <!-- About Start -->
        <div class="container-fluid py-5">
            <div class="container">
                <div class="row justify-evenly">
                    <div class="col-lg-5 py-0 py-lg-4 border border-1">
                        <form action="?value=change_password" method="POST">
                         
                            <div class="form-group
                            ">
                                <input type="password" name="new_password" class="form-control bg-transparent border-primary p-4" placeholder="New Password" required="required" />
                            </div>
                            <div>
                                <button name="change_password" class="btn btn-primary btn-block font-weight-bold py-3" type="submit">Change Password</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4 py-5 py-lg-0" style="min-height: 500px;">
                        <div class="position-relative h-100">
                            <img class="position-absolute w-100 h-100" src="img/about.png" style="object-fit: cover;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->
                    ';
    }
}
 
function yorumEkle()
{
    global $con;
    if (isset($_POST["yorum"]) && isset($_SESSION["name"])) {
        $yorum = $_POST["yorum"];
        $name = $_SESSION["name"];
        $user_id = $_SESSION["user_id"];
        $sql = "INSERT into yorumlar (name,yorum,user_id) values ('$name','$yorum',$user_id)";
        $res = mysqli_query($con, $sql);
        if ($res) {
            echo '<script>alert("yorumunuz basarili bir sekilde eklendi")</script>';
            echo '<script>window.location.href="?"</script>';
        } else {
            echo '<script>alert("yorumunuz eklenemedi")</script>';
            echo '<script>window.location.href="?"</script>';
        }
    } else {
        echo '<script>alert("lutfen giriş yapınız")</script>';
        echo '<script>window.location.href="?"</script>';
    }
}


if (isset($_GET['value'])) {
    $value = $_GET['value'];
} else {
    $value = '';
}

switch ($value) {
    case 'login':
        giris();
        break;
    case 'change_password':
        change_password();
        break;
    case "cikis":
        cikis();
        break;
    case 'rezervasyon':
        rezer_tut();
        break;
    case "rezervasyon_page";
        rezervasyon_page();
        break;
    case "delete":
        rezer_sil();
        break;
    case "rezerAl_page";
        rezerAl_page();
        break;
    case "card";
        cardPage();
        break;
    case "deleteCard";
        deleteCard();
        break;
    case "change_adet";
        change_adet();
        break;
    case "yorumEkle":
        yorumEkle();
        break;
    case "register":
        kayit();
        break;
    default:
        main_page();
        break;
}



?>

</html>