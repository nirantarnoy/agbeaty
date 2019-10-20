<?php
ob_start();
if (session_id() == '') session_start();
include("../../common/dbcon.php");

$old = '';
$id = 0;
$new = '';

if(isset($_POST['uid'])){
    $id = $_POST['uid'];
}
if(isset($_POST['old_password'])){
    $old = $_POST['old_password'];
}
if(isset($_POST['new_password'])){
    $new = $_POST['new_password'];
}

//echo check_pwd($id,$old,$connect);return;

if($new != ''){
   if(check_pwd($id,$old,$connect)){
       $newpwd = md5($new);
       $query = "UPDATE user SET password ='$newpwd' WHERE id='$id'";
       $result = $connect->query($query);
       if($result){
            header('location: http://localhost/ag/backend/logout.php');
       }
   }else{
        $_SESSION['msg_err'] = 'พบข้อผิดพลาดไม่สามารถทำการเปลี่ยนรหัสผ่านได้';
       header('location: http://localhost/ag/backend/changepass.php');
   }
}

function check_pwd($id,$pwd, $connect){
    $enpass = md5($pwd);
    $query = '';
    $query .= "SELECT * FROM user WHERE id='$id' AND password='$enpass'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    return count($result);
}

?>
