<?php
include("checklogin.php");
include("layouts/header.php");
include("layouts/sidebar.php");

include("../common/dbcon.php");
include("models/group_model.php");

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
                    <span style="font-weight: bold">ข้อมูล Brand</span>
                    <span class="pull-right"><div class="btn btn-success btn-add"><i class="fa fa-plus"></i> สร้างข้อมูล</div></span>
                </div>
                <div class="panel-body">

                    <table class="table table-striped table-bordered table-hover" id="brand_data">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
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
<div id="brandModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="user_form_group" action="models/brand_action_model.php">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-plus-circle my-icon"></i> <span
                                id="my-title">Add New Brand</span></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action_type" class="action-type" value="insert">
                    <input type="hidden" name="brandid" class="brand-id" value="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name.</label><!--<span id="error_INV_BB" class="text-danger"></span>-->
                                <input type="text" name="brandname" id="brandname" class="form-control" required
                                       maxlength="50"/>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" id="description" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>สถานะ</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <p>มีสินค้ากลุ่มดังนี้</p>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6">
                            <?php foreach ($group_data as $value): ?>
                                <?php if ($value['id'] % 2 != 0): ?>
                                    <input style="width: 20px; height: 20px;" id="<?=$value['id']?>" type="checkbox" name="productgroup[]"
                                           value="<?= $value['id'] ?>"> <?= $value['name'] ?> <br>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="col-lg-6">
                            <?php foreach ($group_data as $value): ?>
                                <?php if ($value['id'] % 2 == 0): ?>
                                    <input style="width: 20px; height: 20px;" id="<?=$value['id']?>" type="checkbox" name="productgroup[]"
                                           value="<?= $value['id'] ?>"> <?= $value['name'] ?> <br>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <input type="hidden" name="INV_BB_PK" id="INV_BB_PK"/>
                    <input type="hidden" name="btn_action" id="btn_action"/>
                    <input type="submit" name="action" id="action" class="btn btn-info" value="Add New Brand"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>

    </div>
</div>
<script>
    $(document).ready(function () {
        // $('.js-example-basic-single').select2();
        var userdataTable = $('#brand_data').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "bFilter": true,
            "ajax": {
                url: "brand_fetch.php",
                type: "POST"
            },
            "columnDefs": [
                {
                    "targets": [0, 4], // array column to disable sort arrow
                    "orderable": false,
                }
            ],
            "pageLength": 10
        });
        $(".btn-add").click(function () {
            $("#brandname").val('');
            $("#description").val('');
            $("#status").val(1);
            $("#brandModal").modal("show");
        });
    });

    function getupdate(e) {
        var ids = e.attr("id");
        var has_group = e.closest("tr").find(".has-group").val();
        var group_list = has_group.split(',');
        group_list.sort();
        $('input[type="checkbox"]').each(function(){
           // alert($(this).attr('id'));
            $(this).prop('checked','');
            for(var i=0;i<=group_list.length-1;i++){
                if(group_list[i] == $(this).attr('id')){
                    $(this).prop('checked','checked');
                }
            }
        });

        $.ajax({
            method: "post",
            dataType: "json",
            url: "models/brand_action_model.php",
            data: {"action_type": "getid", "id": ids},
            success: function (data) {
                //alert(data);
                // alert(data[0]['name']);
                $("#brandname").val(data[0]['name']);
                $("#description").val(data[0]['desc']);
                $("#status").val(data[0]['status']);
                $("#my-title").html('Edit Brand')
                $(".my-icon").removeClass('fa-plus-circle');
                $(".my-icon").addClass('fa-pencil');
                $(".action-type").val('update');
                $(".brand-id").val(ids);
                $("#brandModal").modal("show");
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
                url: "models/brand_action_model.php",
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
