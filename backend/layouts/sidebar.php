<?php
$url = explode('/',$_SERVER['REQUEST_URI']);
$count_arr = count($url);
$xurl = explode('.',$url[$count_arr -1]);

?>
<input type="hidden" id="cur_url" value="<?=$xurl[0]?>">
<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <br />
        <nav>
            <ul class="nav" id="my-menu">

                <li><a href="user.php" class="user"><i class="fa fa-users"></i> <span>ผู้ใช้งาน</span></a></li>
                <li><a href="productgroup.php" class="productgroup"><i class="fa fa-cubes"></i> <span>กลุ่มสินค้า</span></a></li>
                <li><a href="brand.php" class="brand"><i class="fa fa-tags"></i> <span>แบรนด์สินค้า</span></a></li>
                <li><a href="product.php" class="product"><i class="fa fa-cube"></i> <span>สินค้า</span></a></li>

            </ul>
        </nav>
    </div>
</div>

<script>
   var c_url = $("#cur_url").val();

   $("ul#my-menu li").each(function(){
       var child_attr = $(this).children().attr("class");
       if(child_attr == c_url){
           $(this).children().addClass('active');
       }
      // alert($(this).class());
   });
</script>
<!-- END LEFT SIDEBAR -->
