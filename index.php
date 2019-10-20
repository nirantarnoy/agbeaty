<?php

include("header.php");
include("backend/models/product_model.php");

$product_data = getProductAll($connect);

?>

<style>
    #owl-demo .item img {
        display: block;
        width: 100%;
        height: auto;
    }

    .main-content {
        position: relative;



    .custom-nav {
        position: absolute;
        top: 20%;
        left: 0;
        right: 0;

    .owl-prev, .owl-next {
        position: absolute;
        height: 100px;
        color: inherit;
        background: none;
        border: none;
        z-index: 100;

    i {
        font-size: 2.5rem;
        color: #cecece;
    }

    }

    .owl-prev {
        left: 0;
    }

    .owl-next {
        right: 0;
    }

    }

    }
</style>

<div class="row">
    <div class="col-lg-12">
        <div id="owl-demo" class="owl-carousel owl-theme" style="margin-top: 85px;">

            <div class="item">
                <image src="res/images/slide/slideshow_3.jpg" style="width: 100%;">
            </div>
            <div class="item">
                <image src="res/images/slide/slideshow_2.jpg" style="width: 100%;">
            </div>
            <div class="item">
                <image src="res/images/slide/slideshow_3.jpg" style="width: 100%;">
            </div>

        </div>

    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 mb-5">
            <h2 style="font-weight: bold">Hot items</h2>
            <hr>
            <!--<p style="font-size: 22px"> <span class="text-info" style="font-weight: bold">&nbsp;&nbsp;Ag beauty</span> </p>-->
            <!--<a class="btn btn-primary btn-lg" href="#">Call to Action &raquo;</a>-->
        </div>

    </div>

    <div id="hotitem-carousel" class="owl-carousel owl-theme">
        <?php foreach ($product_data as $val): ?>
            <?php
            $dir = getBrandName($val['brand_id'], $connect);
            $photo = $dir . '/' . $val['photo'];
            ?>
            <a href="productdetail.php?productid=<?= $val['id'] ?>" style="color: #333333">
                <div class="item" style="margin-right: 1px;margin-left: 1px;width: 250px;">
                    <div class="col-md-12 mb-5 my-card">
                        <div class="card h-100" style="border: none">
                            <img class="card-img-top img-std" src="res/product_photo/<?= $photo ?>" alt="">
                            <div class="card-body">
                                <h4 class="card-title text-secondary service-title"><?= $val['name'] ?></h4>
                                <p class="card-text">&nbsp;&nbsp</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>


    </div>
    <div class="main-content">
        <div class="owl-carousel owl-theme">
            <div class="item">
                <img src="https://images.unsplash.com/photo-1510797215324-95aa89f43c33?fit=crop&fm=jpg&h=800&q=80&w=1200" alt="Picture 1">
            </div>
            <div class="item">
                <img src="https://images.unsplash.com/photo-1513836279014-a89f7a76ae86?fit=crop&fm=jpg&h=800&q=80&w=1200" alt="Picture 2">
            </div>
            <div class="item">
                <img src="https://images.unsplash.com/photo-1509149037-37dc57ccbd13?fit=crop&fm=jpg&h=800&q=80&w=1200" alt="Picture 3">
            </div>
            <div class="item">
                <img src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?fit=crop&fm=jpg&h=800&q=80&w=1200" alt="Picture 4">
            </div>
        </div>
<!--        <div class="owl-theme">-->
<!--            <div class="owl-controls">-->
<!--                <div class="custom-nav owl-nav">       </div>-->
<!--            </div>-->
<!--        </div>-->
    </div>


    <div class="row">
        <div class="col-md-12 mb-5">
            <h2 style="font-weight: bold">All Products</h2>
            <hr>
            <!--<p style="font-size: 22px"> <span class="text-info" style="font-weight: bold">&nbsp;&nbsp;Ag beauty</span> </p>-->
            <!--<a class="btn btn-primary btn-lg" href="#">Call to Action &raquo;</a>-->
        </div>

    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <ul style="float: left;list-style-type:none;">


                <?php if (count($product_data)): ?>
                    <?php foreach ($product_data as $val): ?>
                        <?php
                        $dir = getBrandName($val['brand_id'], $connect);
                        $photo = $dir . '/' . $val['photo'];
                        ?>
                        <li style="float: left">
                            <a href="productdetail.php?productid=<?= $val['id'] ?>"
                               style="text-decoration: none;color: #3c3c3c">
                                <div class="my-card">
                                    <img class="" src="res/product_photo/<?= $photo ?>" style="width: 100%;" alt="">
                                    <p></p>
                                    <p class="name" style="font-size: 18px;"><?= $val['name'] ?></p>
                                    <!--                                <p class="name">$19.99</p>-->
                                    <!--                                <p>Some text about the jeans..</p>-->
                                    <!--                                <p>-->
                                    <!--                                    <button>Add to Cart</button>-->
                                    <!--                                </p>-->
                                </div>
                            </a>
                        </li>


                    <?php endforeach; ?>
                <?php else: ?>
                    <div style="text-align: center">
                        <h2><span style="color: #333333">No Item</span></h2>
                    </div>
                <?php endif; ?>
            </ul>
        </div>
    </div>


</div>
<br>
<br>
<br>
<?php include("footerpage.php"); ?>
<!---->

<script>
    $(function () {
        window.onscroll = function () {
            // scrollFunction()
        };

        // main corousel
        $("#carouselExampleControls").carousel({
            interval: 2000
        });

        // slide main
        $("#owl-demo").owlCarousel({
            loop: true,
            //navigation: true, // Show next and prev buttons
            nav: true,
            navText: [
                '<i class="fa fa-angle-left" aria-hidden="true"></i>',
                '<i class="fa fa-angle-right" aria-hidden="true"></i>'
            ],
            navContainer: '.custom-nav',
            slideSpeed: 300,
            paginationSpeed: 400,
            items: 1,
            itemsDesktop: false,
            itemsDesktopSmall: false,
            itemsTablet: false,
            itemsMobile: false,
            autoWidth: true,
            autoplay: true,

        });

        // slide hot item
        var owl = $('#hotitem-carousel');
        owl.owlCarousel({
            loop: true,
            stagePadding: 10,
            margin: 0,
            autoWidth: true,
            autoplay: true,
            nav: false,
            dots: false,
            // pagination: false,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,

        });
        // Go to the next item
        $('.owl-next').click(function () {
            owl.trigger('next.owl.carousel');
        })
        // Go to the previous item
        $('.owl-prev').click(function () {
            // With optional speed parameter
            // Parameters has to be in square bracket '[]'
            owl.trigger('prev.owl.carousel', [300]);
        })


    });

    // function scrollFunction() {
    //     if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
    //         document.getElementById("myBtn").style.display = "block";
    //
    //     } else {
    //         document.getElementById("myBtn").style.display = "none";
    //
    //     }
    // }

    function topFunction() {
        //  document.body.scrollTop = 0;
        //  document.documentElement.scrollTop = 0;
        var aid = ".site-index"
        // alert(aid);
        $('html,body').animate({scrollTop: $(aid).offset().top - 100}, 'slow');
    }
</script>
<script>
    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
</script>

<?php include("footer.php") ?>
