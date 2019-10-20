<?php
if (session_id() == '') session_start();
include("checklogin.php");
include("layouts/header.php");
include("layouts/sidebar.php");

$uid = 0;
$message = '';
if (isset($_SESSION['userid'])) {
    $uid = $_SESSION['userid'];
}

if (isset($_SESSION['msg_err'])) {
    $message = $_SESSION['msg_err'];
    unset($_SESSION['msg_err']);
}

?>
<div class="main">
    <div class="main-content">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4"></div>
            <div class="col-lg-4"></div>
        </div>
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4"><h2>Chage your password</h2></div>
            <div class="col-lg-4"></div>
        </div>
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <div class="alert alert-danger show-error"><?= $message ?></div>
            </div>
            <div class="col-lg-4"></div>
        </div>
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="models/change_pwd_model.php" method="post" id="form-change">
                            <input type="hidden" name="uid" value="<?=$uid?>">
                            <div class="form-group">
                                <label>Old Password</label>
                                <input type="password" class="form-control old-password" name="old_password"
                                       placeholder="old password">
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" class="form-control new-password" name="new_password"
                                       placeholder="new password">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control confirm-password" name="confirm_password"
                                       placeholder="confirm password">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" id="btn-submit" value="chage password">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
</div>
<script>
    $(function () {

        $(".show-error").hide();
        var msg = $(".show-error").html();
        if (typeof msg === 'undefined') {
        } else {
            $(".show-error").show();
            setTimeout(function () {
                $(".show-error").html('');
                $(".show-error").hide();
            }, 7000);
        }
        if(msg == ''){ $(".show-error").hide();}
        $("#btn-submit").click(function (e) {
            e.preventDefault();
            var oldpwd = $(".old-password").val();
            var newpwd = $(".new-password").val();
            var confirmpwd = $(".confirm-password").val();

            if (oldpwd == '') {
                $(".show-error").html('กรุณากรอกข้อมูลให้ครบ');
                $(".show-error").show();
                setTimeout(function () {
                    $(".show-error").html('');
                    $(".show-error").hide();
                }, 5000);
                return false;
            }

            if (newpwd != confirmpwd) {
                $(".show-error").html('รหัสยืนยันไม่ตรงกัน');
                $(".show-error").show();
                setTimeout(function () {
                    $(".show-error").html('');
                    $(".show-error").hide();
                }, 5000);
                return false;
            }
            $("#form-change").submit();
        });
    })
</script>
