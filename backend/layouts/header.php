<?php
if(session_id() == ''){
    session_start();
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AG</title>
    <link rel="shortcut icon" href="/img/icon/ag.ico" type="image/x-icon" />

    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../vendor/linearicons/style.css">
    <link rel="stylesheet" href="../vendor/chartist/css/chartist-custom.css">
    <link rel="stylesheet" href="layouts/dist/css/kv-widgets.css">
    <link rel="stylesheet" href="layouts/dist/css/main.css">
    <link rel="stylesheet" href="layouts/dist/css/demo.css">
    <link rel="stylesheet" href="layouts/dist/css/sweetalert.css">
    <link rel="stylesheet" href="dist/css/jquery.toast.css">

    <link rel="stylesheet" type="text/css" href="layouts/dist/css/dataTables.bootstrap.min.css"/>


    <script src="../vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="layouts/dist/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="layouts/dist/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="layouts/dist/js/klorofil-common.js"></script>
    <script src="layouts/dist/js/sweetalert.min.js"></script>
    <script src="dist/js/jquery.toast.js"></script>


</head>
<body>
<div id="wrapper">
    <!-- NAVBAR -->
    <nav id="nav-program" class="navbar navbar-default navbar-fixed-top">
        <div class="brand" style="padding: 20px; 20px;background-color: #FFF;width: 250px;">
            <a href="index.php?r=site/index"><img src="../res/logo/ag_logo_hori_custome.jpg" style="width: 50%;text-align: left;right: 0px" alt="AG" class="img-responsive logo"></a>
        </div>
        <div class="container-fluid" style="margin-left: 5px;">
            <div class="navbar-btn">
                <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
            </div>
            <form class="navbar-form navbar-left">
                <div class="input-group" style="box-shadow: none">
                    <input type="text" value="" class="form-control" placeholder="ค้นหา">
                    <span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span>
                </div>
            </form>

            <div id="navbar-menu">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                            <i class="lnr lnr-alarm"></i>

<!--                            <span class="badge bg-danger">2</span>-->

                        </a>
                    </li>
<!--                    <li class="dropdown">-->
<!--                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-question-circle"></i> <span>Help</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>-->
<!--                        <ul class="dropdown-menu">-->
<!--                            <li><a href="#">Basic Use</a></li>-->
<!--                            <li><a href="#">Working With Data</a></li>-->
<!--                            <li><a href="#">Security</a></li>-->
<!--                            <li><a href="#">Troubleshooting</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span><?=isset($_SESSION['userlogin'])?$_SESSION['userlogin']:''?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <!--                            <li><a href="#"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>-->
                            <!--                            <li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>-->
                            <!--                            <li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li>-->
                            <li><a href="changepass.php"><i class="fa fa-refresh"></i> <span>เปลี่ยนรหัสผ่าน</span></a></li>
                            <li><a href="logout.php"><i class="lnr lnr-exit"></i> <span>ออกจากระบบ</span></a></li>
                        </ul>
                    </li>
                    <!-- <li>
                        <a class="update-pro" href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- END NAVBAR -->
   <script>
        $(function () {
            var msg = $("#message").val();
          //  alert(msg);
            if(typeof msg === 'undefined'){}else{
                if(msg != ''){
                    //   if(typeof msg == 'undefined'){
                    $.toast({
                        text : msg,
                        heading: 'แจ้งการทำงาน',
                        // showHideTransition: 'slide',
                        bgColor : 'green',              // Background color for toast
                        textColor : '#eee',            // text color
                        position: 'bottom-right',
                        stack : 5,                     // `fakse` to show one stack at a time count showing the number of toasts that can be shown at once
                        textAlign : 'left',            // Alignment of text i.e. left, right, center
                        hideAfter : 5000
                    })
                }
            }

        })
    </script>
