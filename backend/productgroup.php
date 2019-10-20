<?php
include("checklogin.php");
include("layouts/header.php");
include("layouts/sidebar.php");
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
                    <span style="font-weight: bold">ข้อมูลกลุ่มสินค้า</span>
                    <span class="pull-right"><div class="btn btn-success btn-add"><i class="fa fa-plus"></i> สร้างข้อมูล</div></span>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover" id="group_data">
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

<div id="groupModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="user_form_group" action="models/group_action_model.php">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-plus-circle my-icon"></i> <span
                                id="my-title">Add New Group</span></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action_type" class="action-type" value="insert">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name.</label><!--<span id="error_INV_BB" class="text-danger"></span>-->
                                <input type="text" name="groupname" id="groupname" class="form-control" required
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


                </div>

                <div class="modal-footer">
                    <input type="hidden" name="INV_BB_PK" id="INV_BB_PK"/>
                    <input type="hidden" name="btn_action" id="btn_action"/>
                    <input type="submit" name="action" id="action" class="btn btn-info" value="Add New Group"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>

    </div>
</div>

<script>
    $(document).ready(function () {
        // $('.js-example-basic-single').select2();
        var userdataTable = $('#group_data').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "bFilter": true,
            "ajax": {
                url: "product_group_fetch.php",
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
            $("#groupname").val('');
            $("#description").val('');
            $("#status").val(1);
            $("#groupModal").modal("show");
        });
    });

    function getupdate(e) {
        var ids = e.attr("id");

        $.ajax({
            method: "post",
            dataType: "json",
            url: "models/group_action_model.php",
            data: {"action_type": "getid", "id": ids},
            success: function (data) {
                //alert(data);
                // alert(data[0]['name']);
                $("#groupname").val(data[0]['name']);
                $("#description").val(data[0]['desc']);
                $("#status").val(data[0]['status']);
                $("#my-title").html('Edit Group')
                $(".my-icon").removeClass('fa-plus-circle');
                $(".my-icon").addClass('fa-pencil');
                $(".action-type").val('update');
                $("#groupModal").modal("show");
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
                url: "models/group_action_model.php",
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
