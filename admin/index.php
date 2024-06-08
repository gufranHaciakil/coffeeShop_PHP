<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COFFEE SHOP</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
<script>
    function confirmFunc(text, value, id, tb) {
        if (confirm(text) == true) {
            window.location.href = "?action=" + value + "&id=" + id + "&tb=" + tb;
        }
    }
</script>

<body>

</body>

</html>
<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'new_cafe');
$test = 'juu';

function login_form()
{
    if (!isset($_GET['login']) || ($_GET['login'] == 'false')) {
        echo '
      <div class="modal is-open">
        <div class="modal-container">
          <div class="modal-left">
            <h1 class="modal-title">Welcome!</h1>
            ';
        if (isset($_GET['login']) && $_GET['login'] == 'false') {
            echo '<p class="msg">Invalid email or password</p>';
        }
        echo '
            <form action="?value=login" method="post">
            <div class="input-block">
              <input type="email" name="email" id="email" placeholder="Email">
            </div>
            <div class="input-block">
              <input type="password" name="password" id="password" placeholder="Password">
            </div>
            <div class="modal-buttons">
              <button class="input-button" name="submit">Login</button>
              </form>
            </div>
          </div>
          <div class="modal-right">
            <img src="https://images.unsplash.com/photo-1512486130939-2c4f79935e4f?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=dfd2ec5a01006fd8c4d7592a381d3776&auto=format&fit=crop&w=1000&q=80" alt="">
          </div>
          <button class="icon-button close-button">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
          <path d="M 25 3 C 12.86158 3 3 12.86158 3 25 C 3 37.13842 12.86158 47 25 47 C 37.13842 47 47 37.13842 47 25 C 47 12.86158 37.13842 3 25 3 z M 25 5 C 36.05754 5 45 13.94246 45 25 C 45 36.05754 36.05754 45 25 45 C 13.94246 45 5 36.05754 5 25 C 5 13.94246 13.94246 5 25 5 z M 16.990234 15.990234 A 1.0001 1.0001 0 0 0 16.292969 17.707031 L 23.585938 25 L 16.292969 32.292969 A 1.0001 1.0001 0 1 0 17.707031 33.707031 L 25 26.414062 L 32.292969 33.707031 A 1.0001 1.0001 0 1 0 33.707031 32.292969 L 26.414062 25 L 33.707031 17.707031 A 1.0001 1.0001 0 0 0 32.980469 15.990234 A 1.0001 1.0001 0 0 0 32.292969 16.292969 L 25 23.585938 L 17.707031 16.292969 A 1.0001 1.0001 0 0 0 16.990234 15.990234 z"></path>
           </svg>
            </button>
        </div>
        <button class="modal-button">Click here to login</button>
      </div>';
    }
}
function login()
{
    if (isset($_POST['submit'])) {
        global $con;
        $email = $_POST['email'];
        $password = md5(md5($_POST['password']));
        $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $state = $row['state'];
            if ($state == 'admin') {
                $_SESSION['email'] = $email;
                echo '<script>window.location.href = "?login=true"</script>';
            } else {
                echo '<script>window.location.href = "?login=false"</script>';
            }
        } else {
            echo '<script>window.location.href = "?login=false"</script>';
        }
    }
}

function main_page()
{
    if (isset($_SESSION['email'])) {
        global $login;
        echo '
<head>
<meta charset="utf-8">
<title>COFFEE - Coffee Shop HTML Template</title>
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
</head>
<body>
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
<div class="container-fluid page-header xx mb-5 position-relative overlay-bottom">
    <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
    </div>
</div>
<!-- Page Header End -->
<!-- admin menu start -->

<div class="menu-container">
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
           <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500" data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" role="tablist">
            ';
        if (isset($_GET['action'])) {
            echo '
                <li class="me-2" role="presentation">
                <button class="focus:outline-none border-b border-orange-300 inline-block p-4 border-b-2 rounded-t-lg"  onclick="window.location.href=\'?login=true\'" id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile" aria-selected="false"><- Back</button>
                </li>
                ';
        }
        echo '
            <li class="me-2" role="presentation">
                <button class="focus:outline-none inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Users</button>
            </li>
            <li class="me-2" role="presentation">
                <button class="focus:outline-none inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Menu</button>
            </li>
            <li class="me-2" role="presentation">
                <button class="focus:outline-none inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-styled-tab" data-tabs-target="#styled-settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Kullanıcı Sepeti</button>
            </li>
            <li role="presentation">
                <button class="focus:outline-none inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="contacts-styled-tab" data-tabs-target="#styled-contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">Reservasyonlar</button>
            </li>
        </ul>
    </div>
    ';
        if (!isset($_GET['action'])) {
            echo '
    <div id="default-styled-tab-content">
        <div class="hidden p-4 rounded-lg  dark:bg-gray-800" id="styled-profile" role="tabpanel" aria-labelledby="profile-tab">
            ';
            global $con;
            $sql = "SELECT * FROM user";
            $result = mysqli_query($con, $sql);
            echo '
        
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Adres</th>
                        <th scope="col">State</th>
                        <th scope="col">Işlem</th>
                    </tr>
                </thead>
                <tbody>';
            while ($row = mysqli_fetch_assoc($result)) {
                if ($login == 'true') {
                    $id = $row['id'];
                    echo '
                <tr>
                    <th scope="row">' . $row['id'] . '</th>
                    <td><Label class="">' . $row['name'] . '</Label></td>
                    <td><Label class="">' . $row['email'] . '</Label></td>
                    <td><Label class="">' . $row['adres'] . '</Label></td>
                    <td><Label class="">' . $row['state'] . '</Label></td>
                    <td> 
                    <button class="btn block" onclick="window.location=`?login=true&action=update_user&id=' . $id . '`">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" 
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 
                    0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 
                    2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 
                    5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03
                     0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z"
                      clip-rule="evenodd"/>
                    </svg>
                    </button>
                    <button class="btn" onclick="confirmFunc(\'silmek istediginizden eminmisiniz?\',\'delete\',' . $id . ',\'user\') ">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                     width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0
                     1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 
                    1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1
                     0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" 
                    clip-rule="evenodd"/>
                    </svg>
                    </button>
                    </td>
                </tr>
                ';
                }
            }
            echo '
                </tbody>
            </table>';
            echo '
        <a href="?login=true&action=add_user" class=" bg-blue-400 py-1 px-2 text-gray-300 hover:text-gray-700">kullanıcı ekle  +</a>
            </div>
            <!-- Menu -->   
        <div class="hidden p-4 rounded-lg  dark:bg-gray-800" id="styled-dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
        ';
            $sql = "SELECT * FROM cafe";
            $result = mysqli_query($con, $sql);
            echo '
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Coffe Type </th>
                    <th scope="col">Coffe description </th>
                    <th scope="col">Işlem</th>
                </tr>
            </thead>
            <tbody>';
            while ($row = mysqli_fetch_assoc($result)) {
                if ($login == 'true') {
                    $id = $row['id'];
                    echo '
                <tr>
                    <th scope="row">' . $row['id'] . '</th>
                    <td><Label class="">' . $row['coffe_adi'] . '</Label></td>
                    <td><Label class="">$' . $row['coffe_fiyat'] . '</Label></td>
                    <td><Label class="">' . $row['coffe_turu'] . '</Label></td>
                    <td><Label class="">' . $row['coffe_desc'] . '</Label></td>
                    <td> 
                    <button class="btn block" onclick="window.location=`?login=true&action=update_cofe&id=' . $id . '`">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" 
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 
                    0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 
                    2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 
                    5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03
                     0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z"
                      clip-rule="evenodd"/>
                    </svg>
                    </button>
                    <button class="btn" onclick="confirmFunc(\'silmek istediginizden eminmisiniz?\',\'delete\',' . $id . ',\'cafe\') ">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                     width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0
                        1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1
                        1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1
                        0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                        clip-rule="evenodd"/>
                    </svg>
                    </button>
                    </td>
                </tr>
                ';
                }
            }
            echo '
            </tbody>
        </table>';
            echo '
            <a href="?login=true&action=add_cafe" class=" bg-blue-400 py-1 px-2 text-gray-300 mt-2 hover:text-gray-700">Coffe ekle  + </a>
        </div>
        <div class="hidden p-4 rounded-lg  dark:bg-gray-800" id="styled-settings" role="tabpanel" aria-labelledby="settings-tab">
        ';
            $sql = "SELECT name,coffe_adi,sepet.date,adres,adet,sepet.id FROM user,sepet,cafe WHERE user.id=sepet.user_id AND cafe.id=sepet.coffe_id";
            $result = mysqli_query($con, $sql);
            echo '
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Username</th>
                <th scope="col">Coffe Name</th>
                <th scope="col">Date</th>
                <th scope="col">Adres </th>
                <th scope="col">Adet </th>
                <th scope="col">Işlem</th>
            </tr>
        </thead>
        <tbody>';
            while ($row = mysqli_fetch_assoc($result)) {
                if ($login == 'true') {
                    $id = $row['id'];
                    echo '
                    <tr>
                <th><Label class="">' . $row['name'] . '</Label></th>
                <td><Label class="">' . $row['coffe_adi'] . '</Label></td>
                <td><Label class="">' . $row['date'] . '</Label></td>
                <td><Label class="">' . $row['adres'] . '</Label></td>
                <td><Label class="">' . $row['adet'] . '</Label></td>
                <td> 
             <button class="btn block" onclick="window.location=`?login=true&action=update_userCard&id=' . $id . '`">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" 
                 xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                 <path fill-rule="evenodd" d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 
                 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 
                 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 
                 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03
                 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z"
                  clip-rule="evenodd"/>
                 </svg>
              </button>
                <button class="btn" onclick="confirmFunc(\'silmek istediginizden eminmisiniz?\',\'delete\',' . $id . ',\'sepet\') ">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                 width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0
                    1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1
                    1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1
                    0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                    clip-rule="evenodd"/>
                </svg>
                </button>
                </td>
            </tr>
            ';
                }
            }
            echo '
        </tbody>
    </table>';
            echo '
        </div>
        <div class="hidden p-4 rounded-lg  dark:bg-gray-800" id="styled-contacts" role="tabpanel" aria-labelledby="contacts-tab">
        ';
            $sql = "SELECT * FROM REZERVASYON";
            $result = mysqli_query($con, $sql);
            echo '
                 <table class="table table-striped">
                  <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time </th>
                        <th scope="col">Kişi Sayısı  </th>
                        <th scope="col">Işlem</th>
                 </tr>
                </thead>
                <tbody>';
            while ($row = mysqli_fetch_assoc($result)) {
                if ($login == 'true') {
                    $id = $row['id'];
                    echo '
                      <tr>
                        <th><Label class="">' . $row['name'] . '</Label></th>
                        <td><Label class="">' . $row['email'] . '</Label></td>
                        <td><Label class="">' . $row['date'] . '</Label></td>
                        <td><Label class="">' . $row['time'] . '</Label></td>
                        <td><Label class="">' . $row['person'] . '</Label></td>
                        <td> 
                        <button class="btn block" onclick="window.location=`?login=true&action=update_reservasyon&id=' . $id . '`">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" 
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 
                        0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 
                        2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 
                        5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03
                         0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z"
                          clip-rule="evenodd"/>
                        </svg>
                        </button>
                        <button class="btn" onclick="confirmFunc(\'silmek istediginizden eminmisiniz?\',\'delete\',' . $id . ',\'rezervasyon\') ">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0
                            1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1
                            1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1
                            0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                            clip-rule="evenodd"/>
                        </svg>
                        </button>
                        </td>
                         </tr>
                            ';
                }
            }
            echo '</div></div></div>

<!-- admin menu end -->

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

</html>
    ';
        } else {
            if ((isset($_GET['action']))) {
                if ($_GET['action'] == 'add_user') {
                    add_UserForm();
                } else if ($_GET['action'] == 'add_cafe') {
                    add_CafeForm();
                } else if ($_GET['action'] == 'update_user') {
                    update_user();
                } else if ($_GET['action'] == 'update_reservasyon') {
                    update_reservasyon();
                }
            }
        }
    } else {
        echo '<script>window.location.href = "?login=false"</script>';
    }
}
function delete()
{
    if (isset($_GET['id']) && isset($_GET['tb'])) {
        $table = $_GET['tb'];
        global $con;
        $id = $_GET['id'];
        $sql = "DELETE FROM " . $table . " WHERE id = '$id'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo '<script>
            alert("Başarıyla silindi");
            window.location.href = "?login=true";
            </script>';
        } else {
            echo '<script>
            alert("Basarisizz");
            window.location.href = "?login=true";
            </script>';
        }
    } else {
        echo '<script>
        alert("not found id");
        window.location.href = "?login=true";
        </script>';
    }
}
function add_UserForm()
{
    // add user form
    echo '
    <div class="container pl-4 ml-0">
    <form action="?value=add_User" method="post" class=" form">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label
            ">Name</label>
            <input type="text" class="form-control" required id="exampleInputEmail1" name="name" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label
            ">Email</label>
            <input type="email" class="form-control" required id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label
            ">Password</label>
            <input type="password" class="form-control" required id="exampleInputEmail1" name="password" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label
            ">Adres</label>
            <textarea class="form-control" required id="exampleFormControlTextarea1" name="adres" rows="3"></textarea>
        </div>
        <div class="mb-3">
        <select name="state" class="pr-8 pl-2">
            <option value="0">choose a State</option>
            <option value="admin">admin</option>
            <option value="user">user</option>
        </select>
        <select name="password_state" class="pr-8 pl-2">
        <option value="0">choose a password State</option>
        <option selected value="1">1</option>
        <option  value="2">2</option>
         </select>
        </div>
        ';
    echo '
        <button type="submit" name="u_ekle" class="btn btn-primary">Submit</button>
    </form>
    </div>
    ';
}

function add_User()
{
    if (isset($_POST['u_ekle'])) {
        global $con;
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = md5(md5($_POST['password']));
        $adres = $_POST['adres'];
        $state = $_POST['state'];
        $password_state = $_POST['password_state'];
        $sql = "INSERT INTO user (name,email,password,adres,state,password_state) VALUES ('$name','$email','$password','$adres','$state',$password_state)";
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo '<script>
            alert("Başarıyla eklendi");
            window.location.href = "?login=true";
            </script>';
        } else {
            echo '<script>
            alert("Basarisizz");
            window.location.href = "?login=true";
            </script>';
        }
    }
}
function update_user()
{
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = md5(md5($_POST['password']));
        $adres = $_POST['adres'];
        $state = $_POST['state'];
        $password_state = $_POST['password_state'];
        $sql = "UPDATE user SET name='$name',email='$email',password='$password',adres='$adres',state='$state', password_state=$password_state WHERE id=" . $_GET['id'];
        global $con;
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo '<script>
            alert("Başarıyla güncellendi");
            window.location.href = "?login=true";
            </script>';
        } else {
            echo '<script>
            alert("Basarisizz");
            window.location.href = "?login=true";
            </script>';
        }
    } else {
        if (isset($_GET['id'])) {
            $sql = "SELECT * FROM user WHERE id=" . $_GET['id'];
            global $con;
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);
            $id = $row['id'];
            $name = $row['name'];
            $email = $row['email'];
            $adres = $row['adres'];
            $state = $row['state'];
            $password = $row['password'];
            $password_state = $row['password_state'];
            echo '
        <div class="container pl-4 ml-0">
        <form action="?action=update_user&id=' . $_GET['id'] . '" method="post" class=" form">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label
                ">Name</label>
                <input type="text" class="form-control" required id="exampleInputEmail1" value="' . $name . '" name="name" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label
                ">Email</label>
                <input type="email" class="form-control" required id="exampleInputEmail1" value="' . $email . '" name="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label
                ">Password</label>
                <input type="text" class="form-control" required id="exampleInputEmail1" value="' . $password . '" name="password" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label
                ">Adres</label>
                <textarea class="form-control" required id="exampleFormControlTextarea1" value="" name="adres" rows="3">' . $adres . '</textarea>
            </div>
            <div class="mb-3">
            <select name="state" class="pr-8 pl-2">
                <option value="admin"
                ';
            if ($state == 'admin') {
                echo 'selected';
            }
            echo '
                >admin</option>
                <option value="user" 
                ';
            if ($state == 'user') {
                echo 'selected';
            }
            echo
            '>user</option>
            </select>
            <select name="password_state" class="pr-8 pl-2">
                <option selected value="0"> Password State</option>
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
            </div>
            ';
            echo '
            <button type="submit" name="update_user" class="btn btn-primary">Submit</button>
            </form>
            </div>';
        }
    }
}

function add_CafeForm()
{
    echo '
    <div class="container pl-4 ml-0">
    <form action="?value=add_Cafe" method="post" class=" form" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label
            ">Coffe Name</label>
            <input type="text" class="form-control" required id="exampleInputEmail1" name="coffe_adi" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label
            ">Coffe Price</label>
            <input type="number" class="form-control" required id="exampleInputEmail1" name="coffe_fiyat" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label
            ">Coffe Description</label>
            <textarea class="form-control" required id="exampleFormControlTextarea1" name="coffe_desc" rows="3"></textarea>
        </div>
        <div class="mb-3">
        <select name="coffe_turu" class="bg-transparent border-none mb-4 hover">
        <option value="0">Choose Coffe Type</option>
        <option value="soguk">Soğuk</option>
        <option value="sicak">Sıcak</option>
        </select>
    </div>
        <div class="mb-8 flex flex-col">
            <label for="img" class="form-label hover">Coffe Image</label>
            <input type="file" class="" required id="img" name="coffe_img"></input>
        </div>
        ';
    echo '
        <button type="submit" name="c_ekle" class="btn btn-primary">Submit</button>
        </form>
          </div>
    ';
}

function add_Cafe()
{
    if (isset($_POST['c_ekle'])) {
        global $con;
        $coffe_adi = $_POST['coffe_adi'];
        $coffe_fiyat = $_POST['coffe_fiyat'];
        $coffe_turu = $_POST['coffe_turu'];
        $coffe_desc = $_POST['coffe_desc'];
        $img_tmp = $_FILES['coffe_img']['tmp_name'];
        $img_name = $_FILES['coffe_img']['name'];
        $img_target = "../sql_img/$img_name";
        $img_up = @move_uploaded_file($img_tmp, $img_target);
        if ($img_up) {
            $sql = "INSERT INTO cafe (coffe_adi,coffe_fiyat,coffe_turu,coffe_desc,coffe_img) VALUES ('$coffe_adi','$coffe_fiyat','$coffe_turu','$coffe_desc','$img_target')";
            $result = mysqli_query($con, $sql);
            if ($result) {
                echo '<script>
                alert("Başarıyla eklendi");
                window.location.href = "?login=true";
                </script>';
            } else {
                echo '<script>
                alert("Basarisizz");
                window.location.href = "?login=true";
                </script>';
            }
        }
    }
}

function update_cofe()
{
    if (isset($_POST['update_c'])) {
        $id = $_GET['id'];
        global $con;
        $coffe_adi = $_POST['coffe_adi'];
        $coffe_fiyat = $_POST['coffe_fiyat'];
        $coffe_turu = $_POST['coffe_turu'];
        $coffe_desc = $_POST['coffe_desc'];
        $img_tmp = $_FILES['coffe_img']['tmp_name'];
        $img_name = $_FILES['coffe_img']['name'];
        $img_target = "../sql_img/$img_name";
        $img_up = @move_uploaded_file($img_tmp, $img_target);
        if ($img_up) {
            $sql = "UPDATE CAFE SET coffe_adi='$coffe_adi' , coffe_fiyat='$coffe_fiyat' , coffe_turu='$coffe_turu' , coffe_desc='$coffe_desc', coffe_img='$img_target' where id=$id";
            $result = mysqli_query($con, $sql);
            if ($result) {
                echo '<script>
                alert("Başarıyla guncellendi");
                window.location.href = "?login=true";
                </script>';
            } else {
                echo '<script>
                alert("Basarisizz");
                window.location.href = "?login=true";
                </script>';
            }
        }
    } else {
        if (isset($_GET['id'])) {
            global $con;
            $id = $_GET['id'];
            $sql = 'SELECT * FROM CAFE where id=' . $id;
            $res = mysqli_query($con, $sql);
            $data = mysqli_fetch_assoc($res);
            echo '
        <div class="container pl-4 ml-0">
        <form action="?value=update_coffe&id=' . $id . '" method="post" class=" form" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label
                ">Coffe Name</label>
                <input type="text" class="form-control" required id="exampleInputEmail1" value="' . $data['coffe_adi'] . '" name="coffe_adi" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label
                ">Coffe Price</label>
                <input type="number" class="form-control" required id="exampleInputEmail1" value="' . $data['coffe_fiyat'] . '" name="coffe_fiyat" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label
                ">Coffe Description</label>
                <textarea class="form-control" required id="exampleFormControlTextarea1" name="coffe_desc" rows="3">' . $data['coffe_desc'] . '</textarea>
            </div>
            <div class="mb-3">
            <select name="coffe_turu" class="bg-transparent border-none mb-4 hover">
            <option value="0">Choose Coffe Type</option>
            <option value="soguk">Soğuk</option>
            <option value="sicak">Sıcak</option>
            </select>
        </div>
            <div class="mb-8 flex flex-col">
                <label for="img" class="form-label hover">Coffe Image</label>
                <input type="file" class="" required id="img" name="coffe_img"></input>
            </div>
            ';
            echo '
            <button type="submit" name="update_c" class="btn btn-primary">Submit</button>
            </form>
              </div>
        ';
        }
    }
}

function update_userCard()
{
    if (isset($_POST['u_userCard'])) {
        $id = $_GET['id'];
        global $con;
        $coffe_name = $_POST['coffe_name'];
        $coffe_date = $_POST['coffe_date'];
        $coffe_adres = $_POST['coffe_adres'];
        $coffe_adet = $_POST['coffe_adet'];
        $sql = "UPDATE sepet SET coffe_adi='$coffe_name',date='$coffe_date',adres='$coffe_adres',adet='$coffe_adet' where id=$id";
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo '<script>
            alert("Başarıyla guncellendi");
            window.location.href = "?login=true";
            </script>';
        } else {
            echo '<script>
            alert("Basarisizz");
            window.location.href = "?login=true";
            </script>';
        }
    } else {
        if (isset($_GET['id'])) {
            global $con;
            $id = $_GET['id'];
            $sql = "SELECT name,coffe_adi,sepet.date,adres,adet,sepet.id from user,sepet,cafe where user.id=sepet.user_id and cafe.id=sepet.coffe_id and sepet.id=$id";
            $res = mysqli_query($con, $sql);
            $data = mysqli_fetch_assoc($res);
            $coffe_name = $data['coffe_adi'];
            $coffe_date = $data['date'];
            $coffe_adres = $data['adres'];
            $coffe_adet = $data['adet'];
            $user_name = $data['name'];
            echo '
        <div class="container pl-4 ml-0">
        <form action="?value=update_userCard&id=' . $id . '" method="post" class="form">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label
                ">Coffe Name</label>
                <input type="text" class="form-control" required id="exampleInputEmail1" value="' . $coffe_name . '" name="coffe_name" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label
                ">Coffe Date</label>
                <input type="date" class="form-control" required value="' . $coffe_date . '" name="coffe_date" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label
                ">Coffe Adres</label>
                <textarea class="form-control" required name="coffe_adres" rows="3">' . $coffe_adres . '</textarea>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label
                ">Coffe Adet</label>
                <input type="number" class="form-control" required value="' . $coffe_adet . '" name="coffe_adet" aria-describedby="emailHelp">

        </div>
            ';
            echo '
            <button type="submit" name="u_userCard" class="btn btn-primary">Submit</button>
            </form>
              </div>
        ';
        }
    }
}

function update_reservasyon()
{
    if (isset($_POST['update_reservasyon'])) {
        $id = $_GET['id'];
        global $con;
        $name = $_POST['name'];
        $email = $_POST['email'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $person = $_POST['person'];
        $sql = "UPDATE rezervasyon SET name='$name',email='$email',date='$date',time='$time',person='$person' where id=$id";
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo '<script>
            alert("Başarıyla guncellendi");
            window.location.href = "?login=true";
            </script>';
        } else {
            echo '<script>
            alert("Basarisizz");
            window.location.href = "?login=true";
            </script>';
        }
    } else {
        if (isset($_GET['id'])) {
            global $con;
            $id = $_GET['id'];
            $sql = "SELECT * FROM rezervasyon where id=$id";
            $res = mysqli_query($con, $sql);
            $data = mysqli_fetch_assoc($res);
            $name = $data['name'];
            $email = $data['email'];
            $date = $data['date'];
            $time = $data['time'];
            $person = $data['person'];
            echo '
        <div class="container pl-4 ml-0">
        <form action="?value=update_reservasyon&id=' . $id . '" method="post" class=" form">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label
                ">Name</label>
                <input type="text" class="form-control" required id="exampleInputEmail1" value="' . $name . '" name="name" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label
                ">Email</label>
                <input type="email" class="form-control" required id="exampleInputEmail1" value="' . $email . '" name="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label
                ">Date</label>
                <input type="date" lang="en-EN" class="form-control" required value="' . $date . '" name="date" aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label
                ">Time</label>
                <input type="time" class="form-control" required value="' . $time . '" name="time" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label
                ">Person</label>
                <input type="number" class="form-control" required value="' . $person . '" name="person" aria-describedby="emailHelp">
            </div>
            ';
            echo '
            <button type="submit" name="update_reservasyon" class="btn btn-primary">Submit</button>
            </form>
              </div>
        ';
        }
    }
}

$data = basename($_SERVER['REQUEST_URI']);
$path = explode('/', $_SERVER['REQUEST_URI']);

if ($data == 'index.php' || $path[3] == '') {
    login_form();
    session_unset();
    session_destroy();
}




if (isset($_GET['login'])) {
    $login = $_GET['login'];
} else {
    $login = '';
}



switch ($login) {
    case 'true':
        main_page();
        break;
    case 'false':
        login_form();
        break;
    default:
        // main_page();
        break;
}


if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = '';
}

switch ($action) {
    case 'delete':
        delete();
        break;
    case 'update_user':
        update_user();
        break;
    case 'add_User':
        add_UserForm();
        break;
    case 'update_cofe':
        update_cofe();
        break;
    case 'update_userCard':
        update_userCard();
        break;
    default:
        break;
}

if (isset($_GET['value'])) {
    $value = $_GET['value'];
} else {
    $value = '';
}

switch ($value) {
    case 'login':
        login();
        break;
    case 'add_User':
        add_User();
        break;
    case 'add_Cafe':
        add_Cafe();
        break;
    case 'update_coffe':
        update_cofe();
        break;
    case 'update_userCard':
        update_userCard();
        break;
    case 'update_reservasyon':
        update_reservasyon();
        break;
    default:
        //login_form();
        break;
}


?>

<style>
    .msg {
        color: #ff000075;
    }

    .hover:hover {
        cursor: pointer;
    }

    <?php
    include_once './style.css';
    ?>
</style>

<script>
    const body = document.querySelector("body");
    const modal = document.querySelector(".modal");
    const modalButton = document.querySelector(".modal-button");
    const closeButton = document.querySelector(".close-button");
    const scrollDown = document.querySelector(".scroll-down");
    let isOpened = false;

    const openModal = () => {
        modal.classList.add("is-open");
        body.style.overflow = "hidden";
    };

    const closeModal = () => {
        modal.classList.remove("is-open");
        body.style.overflow = "initial";
    };

    window.addEventListener("scroll", () => {
        if (window.scrollY > window.innerHeight / 3 && !isOpened) {
            isOpened = true;
            scrollDown.style.display = "none";
            openModal();
        }
    });

    modalButton.addEventListener("click", openModal);
    closeButton.addEventListener("click", closeModal);

    document.onkeydown = evt => {
        evt = evt || window.event;
        evt.keyCode === 27 ? closeModal() : false;
    };
</script>