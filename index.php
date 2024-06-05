<?php 
    session_start();

    include "constants.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?php echo APP_NAME; ?></title>      

        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/vendor/bootstrap.css">
        <link rel="stylesheet" href="assets/vendor/metismenu/dist/metisMenu.css">
        <link rel="stylesheet" href="assets/vendor/switchery-npm/index.css">
        <link rel="stylesheet" href="assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
        <link rel="stylesheet" href="assets/css/icons/line-awesome.min.css">
        <link rel="stylesheet" href="assets/css/icons/dripicons.min.css">
        <link rel="stylesheet" href="assets/css/icons/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="assets/css/common/main.bundle.css">
        <link rel="stylesheet" href="assets/css/layouts/vertical/core/main.css">
        <link rel="stylesheet" href="assets/css/layouts/vertical/menu-type/default.css">
        <link rel="stylesheet" href="assets/css/layouts/vertical/themes/theme-a.css">
        <link rel="stylesheet" href="assets/css/custom.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
        <style type="text/css">
            body, .sign-in-heading, .jq-toast-single h2, .jq-toast-single {
                font-family: 'Quicksand', sans-serif !important;
            }
            .btn-primary {
                background-color: #ff3f6c;
                border-color: #ff3f6c;
            }
            .btn-primary:hover,.btn-primary:focus {
                background-color: #ff3f6c !important;
                border-color: #ff3f6c !important;
            }
            input {
                border-color: #efefef !important;
            }
            a {
                color: #ff3f6c !important;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <form class="sign-in-form" action="submit_signin.php" method="post" autocomplete="off">
                <div class="card">
                    <div class="card-body">
                        <h5 class="sign-in-heading text-center m-b-20"><?php echo APP_NAME; ?></h5>
                        <div class="form-group">
                            <label for="inputEmail" class="sr-only">Email</label>
                            <input type="text" id="username" name="username" class="form-control" placeholder="Mobile No." required="" autofocus="">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="sr-only">Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
                        </div>
                        <button class="btn btn-primary btn-rounded btn-floating btn-lg btn-block" type="submit">Sign In</button>
                        <br><br><center><small>Don't have an account? <a href="signup.php">Make Account</a></small></center>
                        <?php
                            if(isset($_SESSION['error']))
                            {
                                echo '<br><br><center><span class="badge badge-danger">'.$_SESSION['error'].'</span></center><br>';
                                unset($_SESSION['error']);
                            }
                        ?>
                    </div>
                </div>
            </form>
        </div>
        <script src="assets/vendor/modernizr/modernizr.custom.js"></script>
        <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
        <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/js-storage/js.storage.js"></script>
        <script src="assets/vendor/js-cookie/src/js.cookie.js"></script>
        <script src="assets/vendor/pace/pace.js"></script>
        <script src="assets/vendor/metismenu/dist/metisMenu.js"></script>
        <script src="assets/vendor/switchery-npm/index.js"></script>
        <script src="assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="assets/js/global/app.js"></script>        
        <script src="assets/js/nicescroll.js"></script>
        <script src="assets/js/jquery.validate.js"></script>
        <script src="assets/js/methods.js"></script>
        <script src="assets/js/login.js"></script>
    </body>
</html>