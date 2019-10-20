<?php
include("common/dbcon.php");
include("backend/models/brand_model.php");
include("backend/models/group_model.php");
$brand_data = findBrandAll($connect);

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

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vendor/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="vendor/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">

<!--    <script src="vendor/jquery/jquery.min.js"></script>-->
<!--    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>-->

    <script src="vendor/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!--<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
<!--    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>-->
    <!--    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>-->

    <!-- Custom styles for this template -->
    <link href="css/business-frontpage.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <style>
        @font-face {
            font-family: 'Cloud-Light';
            src: url('res/fonts/Cloud-Light.ttf') format('truetype');
            /* src: url('../fonts/thsarabunnew-webfont.eot?#iefix') format('embedded-opentype'),
                  url('../fonts/thsarabunnew-webfont.woff') format('woff'),
                  url('../fonts/EkkamaiStandard-Light.ttf') format('truetype');*/
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Cloud-Bold';
            src: url('res/fonts/Cloud-Bold.ttf') format('truetype');
            /* src: url('../fonts/thsarabunnew-webfont.eot?#iefix') format('embedded-opentype'),
                  url('../fonts/thsarabunnew-webfont.woff') format('woff'),
                  url('../fonts/EkkamaiStandard-Light.ttf') format('truetype');*/
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'Cloud-Light';
        }

        .btn-on-top {
            position: fixed;
            right: 10px;
            bottom: 10px;

        }

        .menu-main {
            font-size: 16px;
            font-weight: bold;
        }

        .img-std {
            /*opacity: 0.5;*/
        }

        .img-std:hover {
            opacity: 1;
            /*-webkit-transform: scale(1.3);*/
            /*-ms-transform: scale(1.3);*/
            /*transform: scale(1.1);*/
        }


        /*.my-card {*/
           /*// box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);*/
            /*transition: 0.3s;*/
            /*width: 200px;*/
        /*}*/
        /*.my-card:hover {*/
            /*-webkit-transform: scale(1.3);*/
            /*-ms-transform: scale(1.3);*/
            /*transform: scale(1.1);*/
            /*!*box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);*!*/
        /*}*/
        /*.my-card.container {*/
            /*padding: 2px 16px;*/
        /*}*/

        .my-card {
            /*box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);*/
            max-width: 150px;
            margin: auto;
            text-align: center;
            font-family: arial;
            margin: 5px;
        }

        .my-card:hover {
            /*box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);*/
            transform: scale(1.1);
        }
        .my-card.name {
            color: grey;
            font-size: 12px;
        }

        .my-card button {
            border: none;
            outline: 0;
            padding: 12px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }

        .my-card button:hover {
            opacity: 0.7;
        }


        .carousel-indicators li {
            display: inline-block;
            width: 30px;
            height: 5px;
            /*margin: 1px;*/
            /*text-indent: -999px;*/
            /*cursor: pointer;*/
            background-color: #ececf6; \9;
            /*background-color: rgba(255, 255, 255, 100);*/
            /*border: 1px solid #000000;*/
            /*border-radius: 10px;*/
        }

        .carousel-indicators .active {
            background-color: #17a2b8;
        }

        /*my-sub-bar*/

        ul.my-sub-nav {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #1b1e21;
            vertical-align: middle;
            font-size: 10px;
        }

        ul.my-sub-nav li {
            float: left;
            vertical-align: middle;
        }

        ul.my-sub-nav li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        /* Change the link color to #111 (black) on hover */
        ul.my-sub-nav li a:hover {
            background-color: #6c757d;
        }

        .topnav {
            margin-top: 20px;
            overflow: hidden;
            background-color: #333;
        }

        .topnav a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 14px;
        }

        .topnav .active {
            background-color: #4CAF50;
            color: white;
        }

        .topnav .icon {
            display: none;
        }

        .dropdownx {
            float: left;
            overflow: hidden;
        }

        .dropdownx .dropbtn {
            font-size: 13px;
            border: none;
            outline: none;
            color: white;
            padding: 10px 5px;
            background-color: inherit;
            font-family: inherit;
            margin: 0;
            text-transform: uppercase;
        }

        .dropdownx-content {
            display: none;
            padding: 10px;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 500px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdownx-content a {
            float: none;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .topnav a:hover, .dropdownx:hover .dropbtn {
            background-color: #555;
            color: white;
        }

        .dropdownx-content a:hover {
            background-color: #ddd;
            color: black;
        }

        .dropdownx:hover .dropdownx-content {
            display: block;
        }

        @media screen and (max-width: 600px) {
            .topnav a:not(:first-child), .dropdownx .dropbtn {
                display: none;
            }

            .topnav a.icon {
                float: right;
                display: block;
            }
        }

        @media screen and (max-width: 600px) {
            .topnav.responsive {
                position: relative;
            }

            .topnav.responsive .icon {
                position: absolute;
                right: 0;
                top: 0;
            }

            .topnav.responsive a {
                float: none;
                display: block;
                text-align: left;
            }

            .topnav.responsive .dropdownx {
                float: none;
            }

            .topnav.responsive .dropdownx-content {
                position: relative;
            }

            .topnav.responsive .dropdownx .dropbtn {
                display: block;
                width: 100%;
                text-align: left;
            }
        }
    </style>
    <style>
        .example1 {
            height: 20px;
            overflow: hidden;
            position: relative;
        }

        .example1 p {
            font-size: 14px;
            color: white;
            position: absolute;
            width: 100%;
            height: 100%;
            margin: 0;
            line-height: 25px;
            text-align: center;
            /* Starting position */
            -moz-transform: translateX(100%);
            -webkit-transform: translateX(100%);
            transform: translateX(100%);
            /* Apply animation to this element */
            -moz-animation: example1 40s linear infinite;
            -webkit-animation: example1 40s linear infinite;
            animation: example1 40s linear infinite;
        }

        /* Move it (define the animation) */
        @-moz-keyframes example1 {
            0% {
                -moz-transform: translateX(100%);
            }
            100% {
                -moz-transform: translateX(-100%);
            }
        }

        @-webkit-keyframes example1 {
            0% {
                -webkit-transform: translateX(100%);
            }
            100% {
                -webkit-transform: translateX(-100%);
            }
        }

        @keyframes example1 {
            0% {
                -moz-transform: translateX(100%); /* Firefox bug fix */
                -webkit-transform: translateX(100%); /* Firefox bug fix */
                transform: translateX(100%);
            }
            100% {
                -moz-transform: translateX(-100%); /* Firefox bug fix */
                -webkit-transform: translateX(-100%); /* Firefox bug fix */
                transform: translateX(-100%);
            }
        }
    </style>

    <style>
        .sidenav {
            width: 100%;
            /*position: fixed;*/
            z-index: 1;
            top: 20px;
            left: 10px;
            background: #eee;
            overflow-x: hidden;
            padding: 8px 0;
        }

        .sidenav a {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 20px;
            color: black;
            display: block;
        }

        .sidenav a:hover {
            color: #064579;
        }

        .main {
            margin-left: 140px; /* Same width as the sidebar + left position in px */
            font-size: 28px; /* Increased text to enable scrolling */
            padding: 0px 10px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }
        .collapsiblex {
            background-color: #777;
            color: white;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 18px;
        }
        .collapsiblex:after {
            content: '\002B';
            color: white;
            font-weight: bold;
            float: right;
            margin-left: 5px;
        }

        .collapsiblex.active:after {
            content: "\2212";
        }
        .collapsiblex:hover, .collapsiblex.active {
            background-color: black;
        }
        .contentx {
            padding: 0 18px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;
            background-color: #f1f1f1;
        }
        #footer {
            /*position:relative;*/
            bottom:0;
            width:100%;
            height:160px;   /* Height of the footer */
            background:#3c3c3c;
        }

    </style>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" style="background-color: white">
    <div class="container">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header" style="width: 50%">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php" style="padding: 10px;">
                    <img src="res/logo/ag_logo_hori-1.jpg" style="width: 25%;" alt="">
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<!--                <ul class="nav navbar-nav">-->
<!--                    <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>-->
<!--                    <li><a href="#">Link</a></li>-->
<!--                    <li class="dropdown">-->
<!--                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>-->
<!--                        <ul class="dropdown-menu">-->
<!--                            <li><a href="#">Action</a></li>-->
<!--                            <li><a href="#">Another action</a></li>-->
<!--                            <li><a href="#">Something else here</a></li>-->
<!--                            <li role="separator" class="divider"></li>-->
<!--                            <li><a href="#">Separated link</a></li>-->
<!--                            <li role="separator" class="divider"></li>-->
<!--                            <li><a href="#">One more separated link</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                </ul>-->

                <ul class="nav navbar-nav navbar-right"  style="margin-top: 10px;">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span><img src="res/flag/united-kingdom-flag-icon-32.png" alt=""></span> ภาษา <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><span><img src="res/flag/thailand-flag-icon-16.png" alt=""></span> ไทย</a></li>
                            <li><a href="#"><span><img src="res/flag/united-kingdom-flag-icon-16.png" alt=""></span> English</a></li>
                        </ul>
                    </li>
                    <form class="navbar-form navbar-left">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default" style="background-color: #3c3c3c;color: white">Search</button>
                    </form>
                </ul>

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="topnav" id="myTopnav">
        <div class="container" style="text-transform: uppercase;">
            <div class="dropdownx">
                <a href="index.php" class="dropbtn">Home</a>
            </div>
            <?php foreach ($brand_data as $value): ?>
                <?php
                $group_list = explode(',',$value['has_group']);

                ?>
                <div class="dropdownx">
                    <button class="dropbtn"><?=$value['name']?></button>
                    <div class="dropdownx-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row" style="width: 100%">
                                    <div class="col-lg-6">
                                        <?php for($i=0;$i<=count($group_list)-1;$i++): ?>
                                            <?php if ($group_list[$i] % 2 != 0): ?>
                                                <a href="productbybrand.php?brandid=<?=$value['id']?>&catid=<?=$group_list[$i]?>">
                                                    <?=getGroupName($group_list[$i], $connect)?>
                                                </a>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                    <div class="col-lg-6">
                                        <?php for($i=0;$i<=count($group_list)-1;$i++): ?>
                                            <?php if ($group_list[$i] % 2 == 0): ?>
                                                <a href="productbybrand.php?brandid=<?=$value['id']?>&catid=<?=$group_list[$i]?>">
                                                    <?=getGroupName($group_list[$i], $connect)?>
                                                </a>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            <?php endforeach;?>

            <div class="dropdownx">
                <button class="dropbtn">Best Sellers</button>
            </div>
            <div class="dropdownx">
                <button class="dropbtn">Special Set</button>
            </div>
            <div class="dropdownx">
                <button class="dropbtn">Promotions&Sale</button>
            </div>
            <div class="dropdownx">
                <button class="dropbtn">Skillcaretool</button>
            </div>
            <div class="dropdownx">
                <button class="dropbtn">Contact Us</button>
            </div>
            <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
        </div>
    </div>
    <div class="example1" style="height: 25px;background-color: black;width: 100%;color: white">
        <a href="#">
            <p style="font-weight: bold; vertical-align: middle">
                SALE!! Hot Promotion only this month.
            </p>
        </a>
    </div>
</nav>



