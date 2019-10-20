<?php
    include("checklogin.php");
    include("layouts/header.php");
    include("layouts/sidebar.php");
    include("../common/dbcon.php");
    include("models/group_model.php");
    include("helpers/UserGroup.php");


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
                   <span style="font-weight: bold">ข้อมูล User</span>
                    <span class="pull-right"><div class="btn btn-success btn-add"><i class="fa fa-plus"></i> สร้างข้อมูล</div></span>
                </div>
                <div class="panel-body">
<?php //if(isset($_SESSION['userid'])){echo "ok";}?>
                    <table class="table table-striped table-bordered table-hover" id="user_data">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Group</th>
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
<div id="userModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="user_form_group" action="models/user_action_model.php">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-plus-circle my-icon"></i> <span
                            id="my-title">Add New User</span></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action_type" class="action-type" value="insert">
                    <input type="hidden" name="userid" class="user-id" value="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>UserName</label><!--<span id="error_INV_BB" class="text-danger"></span>-->
                                <input type="text" name="username" id="username" class="form-control" required
                                       maxlength="50"/>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" id="password" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="fname" id="fname" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="lname" id="lname" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Group</label>
                                <select name="usergroup" id="usergroup" class="form-control">
                                    <?php
                                       $usergroup = UserGroup::asArrayObject();
                                    ?>
                                    <?php foreach ($usergroup as $val):?>
                                        <option value="<?=$val['id']?>"><?=$val['name']?></option>
                                    <?php endforeach;?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label>สถานะ</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="btn btn-default">Reset Password</div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <input type="submit" name="action" id="action" class="btn btn-info" value="Save"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>

    </div>
</div>
<script>
    $(document).ready(function () {
        // $('.js-example-basic-single').select2();
        var userdataTable = $('#user_data').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "bFilter": true,
            "ajax": {
                url: "user_fetch.php",
                type: "POST"
            },
            "columnDefs": [
                {
                    "targets": [0, 6], // array column to disable sort arrow
                    "orderable": false,
                }
            ],
            "pageLength": 10
        });
        $(".btn-add").click(function () {
            $("#username").val('');
            $("#password").val('');
            $("#fname").val('');
            $("#lname").val('');
            $("#usergroup").val(1);
            $("#status").val(1);
            $("#userModal").modal("show");
        });
    });

    function getupdate(e) {
        var ids = e.attr("id");

        $.ajax({
            method: "post",
            dataType: "json",
            url: "models/user_action_model.php",
            data: {"action_type": "getid", "id": ids},
            success: function (data) {
                //alert(data);
                // alert(data[0]['name']);
                $("#username").val(data[0]['username']);
                $("#fname").val(data[0]['first_name']);
                $("#lname").val(data[0]['last_name']);
                $("#usergroup").val(data[0]['groupid']);
                $("#status").val(data[0]['status']);
                $("#my-title").html('Edit User')
                $(".my-icon").removeClass('fa-plus-circle');
                $(".my-icon").addClass('fa-pencil');
                $(".action-type").val('update');
                $(".user-id").val(ids);
                $("#userModal").modal("show");
            },
            error: function (data) {
                alert("ERROR");
            }
        });
        // alert(ids);
    }

    function getdelete(e) {
        var ids = e.attr("id");
        //alert(ids);
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
                url: "models/user_action_model.php",
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
