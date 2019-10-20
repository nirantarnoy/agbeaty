<?php
session_start();
$err_message = '';
if(isset($_SESSION['use_to_login'])){
    if(isset($_SESSION['login_err'])){
        $err_message = $_SESSION['login_err'];
    }
    unset($_SESSION['use_to_login']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>AG Beauty</title>
    <link rel="shortcut icon" type="image/ico" href="res/icons/icon32.ico"/>
    <script src="vendor/jquery/jquery.min.js"></script>
    <!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="vendor/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="vendor/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">
    <script src="vendor/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!--<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
    <!--<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>-->
    <!--    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>-->

    <!-- Custom styles for this template -->
    <link href="css/business-frontpage.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4" style="text-align: center;">
            <img src="../res/logo/ag_logo_hori-1.jpg" style="width: 80%" alt="">
        </div>
        <div class="col-lg-4"></div>
    </div>
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4" style="text-align: center;">
            <h2 style="font-weight: bold">Login</h2>
        </div>
        <div class="col-lg-4"></div>
    </div>
    <form id="login-form" action="login_model.php" method="post">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4" style="text-align: left;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-danger show-error"><?=$err_message?></div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control username" name="username" placeholder="username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control password" name="password" placeholder="password">
                </div>
                <div class="form-group">
                    <input type="checkbox" name="rememberme"> จำฉันไว้ในระบบ
                </div>
                <div class="form-group">
                    <input type="submit" id="form-submit" value="Login" class="btn btn-primary">
                </div>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </form>
</div>

<script>
    $(function () {
        $(".show-error").hide();
        if($(".show-error").html() != ''){
            $(".show-error").show();
        }
       $("#form-submit").click(function (e) {
           e.preventDefault();

           if($(".username").val() == '' && $(".password").val() == ''){
               $(".show-error").html('กรุณากรอก username และ password');
               $(".show-error").show();
               setTimeout(function () {
                   $(".show-error").hide();
               }, 10000);
               return false;
           }
           if($(".username").val() == ''){
               $(".show-error").html('กรุณากรอก username');
               $(".show-error").show();
               setTimeout(function () {
                   $(".show-error").hide();
               }, 10000);
               return false;
           }
           if($(".password").val() == ''){
               $(".show-error").html('กรุณากรอก password');
               $(".show-error").show();
               setTimeout(function () {
                   $(".show-error").hide();
               }, 10000);
               return false;
           }
           $("#login-form").submit();
       });
    })
</script>
</body>
</html>
