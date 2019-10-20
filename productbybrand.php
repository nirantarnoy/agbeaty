<?php
include("header.php");
include("common/dbcon.php");
include("backend/models/product_model.php");
//include("backend/models/brand_model.php");
//include("backend/models/group_model.php");

$brand = 0;
$cat = 0;

if (isset($_GET['brandid'])) {
    $brand = $_GET['brandid'];
}
if (isset($_GET['catid'])) {
    $cat = $_GET['catid'];
}

$product_data = getProductByType($brand, $cat, $connect);
$brand_data = findBrandAll($connect);
$cur_group = getGroupName($cat, $connect);
$brand_name = getBrandName($brand, $connect);
?>

<style>
    .list-item:hover{
        /*box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);*/
        transform: scale(1.05);
    }
</style>
<!--<div class="row">-->
<!--    <div class="col-lg-12">-->
<!--        <image src="res/images/banner/Budapest.jpg" style="width: 100%;"></image>-->
<!--    </div>-->
<!--</div>-->

<div class="container" style="margin-top: 110px;">
    <div class="row">
        <div class="col-lg-12">
            <h2 style="font-weight: bold">
                <?= $cur_group . ' : ' . $brand_name ?>
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <button class="collapsiblex" style="font-weight: bold">BRAND</button>
            <div class="contentx">
                <div class="sidenav">
                    <?php foreach ($brand_data as $value): ?>
                        <a href="productbybrand.php?brandid=<?= $value['id'] ?>&catid=<?= $cat ?>"><?= $value['name'] ?></a>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-12">
                    <div class="btn-group pull-right">
                        <div class="btn btn-default btn-list"><i class="fa fa-th-list"></i></div>
                        <div class="btn btn-default btn-grid"><i class="fa fa-th-large"></i></div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row grid-view">
                <div class="col-lg-12">
                    <?php if (count($product_data)): ?>
                        <ul style="float: left;list-style-type:none;">
                            <?php foreach ($product_data as $val): ?>
                                <?php
                                $dir = getBrandName($val['brand_id'], $connect);
                                $photo = $dir . '/' . $val['photo'];
                                ?>
                                <li style="float: left">
                                    <a href="productdetail.php?productid=<?= $val['id'] ?>"
                                       style="text-decoration: none;color: #3c3c3c">
                                        <div class="my-card">
                                            <img class="" src="res/product_photo/<?= $photo ?>" style="width: 100%;"
                                                 alt="">
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
                        </ul>
                    <?php else: ?>
                        <div style="text-align: center">
                            <h2><span style="color: #333333">No Item</span></h2>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row table-view">
                <div class="col-lg-1"></div>
                <div class="col-lg-10" style="padding: 10px;">

                    <?php if (count($product_data)): ?>

                        <?php foreach ($product_data as $val): ?>
                            <?php
                            $dir = getBrandName($val['brand_id'], $connect);
                            $photo = $dir . '/' . $val['photo'];
                            ?>


                            <div class="row list-item">
                                <a href="productdetail.php?productid=<?= $val['id'] ?>" style="color: #333333">
                                    <div class="col-lg-3" style="text-align: center">
                                        <div class="my-card">
                                            <img class="" src="res/product_photo/<?= $photo ?>" style="width: 100%;"
                                                 alt="">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div style="padding: 20px;background-color: #FFFFFF">
                                            <p class="name" style="font-size: 18px;"><span style="font-weight: bold">SKU: </span> <?= $val['code'] ?></p>
                                            <p class="name" style="font-size: 18px;"><span style="font-weight: bold">NAME: </span> <?= $val['name'] ?></p>
                                        </div>

                                    </div>
                                </a>
                            </div>


                        <?php endforeach; ?>

                    <?php else: ?>
                        <div style="text-align: center">
                            <h2><span style="color: #333333">No Item</span></h2>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
    <br>
</div>
<?php include("footerpage.php"); ?>

<!--<script src="vendor/jquery/jquery.min.js"></script>-->
<!--<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>-->
<script>
    $(function () {
       //alert('');
        $(".table-view").hide();
        $(".grid-view").show();
        $(".btn-grid").css({'background-color':'black','color':'white'});
        $(".btn-list").css({'background-color':'white','color':'black'});

        $(".collapsiblex").trigger('click');

        $(".btn-list").click(function () {
            $(".table-view").show();
            $(".grid-view").hide();
            $(this).css({'background-color':'black','color':'white'});
            $(".btn-grid").css({'background-color':'white','color':'black'});
        });
        $(".btn-grid").click(function () {
            $(".table-view").hide();
            $(".grid-view").show();
            $(this).css({'background-color':'black','color':'white'});
            $(".btn-list").css({'background-color':'white','color':'black'});
        });
    });

    function scrollFunction() {
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            document.getElementById("myBtn").style.display = "block";

        } else {
            document.getElementById("myBtn").style.display = "none";
        }
    }

    function topFunction() {
        //  document.body.scrollTop = 0;
        //  document.documentElement.scrollTop = 0;
        var aid = ".site-index"
        // alert(aid);
        $('html,body').animate({scrollTop: $(aid).offset().top - 100}, 'slow');
    }
</script>
<script>
    var coll = document.getElementsByClassName("collapsiblex");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.maxHeight) {
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
            }
        });
    }
</script>
<?php include("footer.php") ?>
