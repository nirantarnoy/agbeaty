<?php
include("header.php");
include("common/dbcon.php");
include("backend/models/product_model.php");
//include("backend/models/brand_model.php");
//include("backend/models/group_model.php");

$productid = 0;

if(isset($_GET['productid'])){
    $productid = $_GET['productid'];
}

$product_data = getProductDetail($productid, $connect);
//$brand_data = findBrandAll($connect);
//$cur_group = getGroupName($cat, $connect);

$dir = getBrandName($product_data['brand_id'], $connect);
$photo = $dir.'/'.$product_data['photo'];


?>

<!--<div class="row">-->
<!--    <div class="col-lg-12">-->
<!--        <image src="res/images/banner/Budapest.jpg" style="width: 100%;"></image>-->
<!--    </div>-->
<!--</div>-->
<br>
<div class="container" style="margin-top: 150px;">
    <div class="row">
        <div class="col-lg-12">
            <h1><?=$product_data['code'].' '.$product_data['name']?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="my-card" style="max-width: 400px">
                <div class="card" style="border: none">
                    <img class="card-img-top img-std" style="width: 100%" src="res/product_photo/<?=$photo?>" alt="">
                    <div class="card-body">
                        <h4 class="card-title text-secondary service-title"></h4>
                        <p class="card-text">&nbsp;&nbsp</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-6"><h3 style="font-weight: bold">Product Detail</h3></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos et repellendus sit!
                        Accusantium ad, at deleniti eos facere minus provident quo reiciendis sapiente sunt. Et impedit
                        iusto nesciunt quidem quisquam.

                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6"><h5 style="font-weight: bold">SKU <span><?=$product_data['code']?></span></h5></div>
            </div>
            <div class="row">
                <div class="col-lg-6"><h5 style="font-weight: bold">Brand <span><?=getBrandName($product_data['brand_id'], $connect)?></span></h5></div>
            </div>
<!--            <div class="row">-->
<!--                <div class="col-lg-6">-->
<!--                    <div class="input-group">-->
<!--                        <input type="number" class="form-control" style="text-align: center" name="quantity" min="1" max="5">-->
<!--                        <span class="input-group-btn">-->
<!--                             <button class="btn btn-secondary" type="button">Add To Cart</button>-->
<!--                        </span>-->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!--            </div>-->
        </div>
    </div>


</div>
<?php include("footerpage.php");?>

<!-- Footer -->
<!--<footer class="py-5 bg-dark">-->
<!--    <div class="container">-->
<!--        <p class="m-0 text-center text-white">Copyright &copy; agbeauty 2019</p>-->
<!--    </div>-->
    <!-- /.container -->
<!--</footer>-->

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
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
    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
</script>
<?php include("footer.php");?>
