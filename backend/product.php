<?php
include("checklogin.php");
include("layouts/header.php");
include("layouts/sidebar.php");

include("../common/dbcon.php");
include('models/brand_model.php');
include('models/group_model.php');

$brand_data = findBrandAll($connect);
$group_data = findGroupAll($connect);

$message = '';
if(isset($_SESSION['msg_ok'])){
    $message = $_SESSION['msg_ok'];
    unset($_SESSION['msg_ok']);
}

?>

<div class="main">

    <div class="main-content">
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <input type="hidden" id="message" value="<?=$message?>">
                    <span style="font-weight: bold">ข้อมูล Product</span>
                    <span class="pull-right"><div class="btn btn-success btn-add"><i class="fa fa-plus"></i> สร้างข้อมูล</div></span>
                </div>
                <div class="panel-body">
                    <?php //$group_data = findGroupAll($connect);?>
                    <table class="table table-striped table-bordered table-hover" id="product_data">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Sku</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Group</th>
                            <th>Brand</th>
                            <th>Status</th>
                            <th>-</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<div id="productModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="user_form_group" action="models/product_action_model.php" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-plus-circle my-icon"></i> <span
                                id="my-title">Add New Product</span></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action_type" class="action-type" value="insert">
                    <input type="hidden" name="product_id" class="product-id" value="">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Sku.</label><!--<span id="error_INV_BB" class="text-danger"></span>-->
                                <input type="text" name="code" id="code" class="form-control" required
                                       maxlength="50"/>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Name.</label><!--<span id="error_INV_BB" class="text-danger"></span>-->
                                <input type="text" name="productname" id="productname" class="form-control" required
                                       maxlength="50"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" id="description" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Category</label><!--<span id="error_INV_BB" class="text-danger"></span>-->
                                <select name="group" id="group" class="form-control">
                                    <?php foreach ($group_data as $row): ?>
                                        <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Brand</label><!--<span id="error_INV_BB" class="text-danger"></span>-->
                                <select name="brand" id="brand" class="form-control">
                                    <?php foreach ($brand_data as $row): ?>
                                        <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Best Saller</label>
                                <input type="checkbox" id="is-best" style="width: 50px;" name="is_best">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Product photo</label><!--<span id="error_INV_BB" class="text-danger"></span>-->
                                <input type="file" class="form-controlx" name="photo">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12" style="text-align: center">
                            <div class="form-group">
                                <img src="" name="product_photo" style="width: 50%" id="product-photo" alt="">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <input type="hidden" name="INV_BB_PK" id="INV_BB_PK"/>
                    <input type="hidden" name="btn_action" id="btn_action"/>
                    <input type="submit" name="action" id="action" class="btn btn-info btn-save" value="Save"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>

    </div>
</div>
<script>
    $(document).ready(function () {
        // $('.js-example-basic-single').select2();
        var userdataTable = $('#product_data').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "bFilter": true,
            "ajax": {
                url: "product_fetch.php",
                type: "POST"
            },
            "columnDefs": [
                {
                    "targets": [0, 7], // array column to disable sort arrow
                    "orderable": false,
                }
            ],
            "pageLength": 10
        });
        $(".btn-add").click(function () {
            // alert('');
            $("#code").val('');
            $("#productname").val('');
            $("#description").val('');
            $("#group").val(1);
            $("#brand").val(1);
            $("#status").val(1);
            $("#productModal").modal("show");
        });
    });

    function getupdate(e) {
        var ids = e.attr("id");
        $.ajax({
            method: "post",
            dataType: "json",
            url: "models/product_action_model.php",
            data: {"action_type": "getid", "id": ids},
            success: function (data) {
                //alert(data);
                // alert(data[0]['name']);
                $("#code").val(data[0]['code']);
                $("#productname").val(data[0]['name']);
                $("#description").val(data[0]['desc']);
                $("#group").val(data[0]['group']);
                $("#brand").val(data[0]['brand']);
                $("#status").val(data[0]['status']);

                $("#product-photo").attr('src',"../res/product_photo/"+data[0]['photo']);
                $("#my-title").html('Edit Product')
                $(".my-icon").removeClass('fa-plus-circle');
                $(".my-icon").addClass('fa-pencil');
                $("#btn-save").val('Update Product');
                $(".action-type").val('update');
                $(".product-id").val(ids);

                if(data[0]['is_best'] == 1){
                    $("#is-best").prop('checked','checked');
                }else{
                    $("#is-best").prop('checked','');
                }

                $("#productModal").modal("show");
            },
            error: function (data) {
                alert("ERROR");
            }
        });
        // alert(ids);
    }

    function getdelete(e) {
        var ids = e.attr("id");
        var url = e.attr("data-url");
        swal({
            title: "ต้องการลบรายการนี้ใช่หรือไม่",
            text: "",
            type: "error",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function () {
            // e.attr("href",url);
            // e.trigger("click");
            $.ajax({
                method: "post",
                dataType: "html",
                url: "models/product_action_model.php",
                data: {"action_type": "delete", "id": ids},
                success: function (data) {
                    //alert(data);
                    location.reload(true);
                },
                error: function (data) {
                    alert("ERROR");
                }
            });
        });

    }
</script>
<?php include("layouts/footer.php"); ?>
