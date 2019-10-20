<?php
ob_start();
if(session_id() == '')session_start();
include("../../common/dbcon.php");
include("user_model.php");

$username = '';
$id = 0;
$userid = 0;
$fname = '';
$lname = '';
$group = 0;
$password = '';
$status = 1;
$data = [];

$action_type = 'getid';

//array_push($data,['name'=>'niran']);
//echo json_encode($data);

if (isset($_POST['action_type'])) {
    $action_type = $_POST['action_type'];
}
if (isset($_POST['id'])) {
    $id = $_POST['id'];
}
if (isset($_POST['status'])) {
    $status = $_POST['status'];
}
if (isset($_POST['userid'])) {
    $userid = $_POST['userid'];
}

if (isset($_POST['username'])) {
    $username = $_POST['username'];
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
}
if (isset($_POST['fname'])) {
    $fname = $_POST['fname'];
}
if (isset($_POST['lname'])) {
    $lname = $_POST['lname'];
}
if (isset($_POST['usergroup'])) {
    $group = $_POST['usergroup'];
}
if ($action_type == 'insert') {
    if ($username != '') {
        array_push($data, ['username' => $username, 'password' => $password,'first_name'=>$fname,'last_name'=>$lname, 'status' => $status, 'group' => $group]);
      // print_r($data);return;
        $res = insertUserData($data, $connect);
        //echo $res;return;
        if ($res) {
            $_SESSION['msg_ok'] = 'บันทึกรายการเรียบร้อยแล้ว';
            header("location: http://localhost/ag/backend/user.php");
        }
    }
}
if ($action_type == 'update') {

    if ($username != '' && $userid != 0) {
       // print_r($productgroup);
        array_push($data, ['username' => $username, 'password' => $password,'first_name'=>$fname,'last_name'=>$lname, 'status' => $status, 'group' => $group]);
        //echo $data[0]['name'];return;
        $res = updateUserData($userid, $data, $connect);
        if ($res) {
            $_SESSION['msg_ok'] = 'บันทึกรายการเรียบร้อยแล้ว';
            header("location: http://localhost/ag/backend/user.php");
        }
    }
}
if ($action_type == 'delete') {
    //echo "OK";
    if ($id != 0) {
        $res = deleteUserData($id, $connect);
        if ($res) {
            $_SESSION['msg_ok'] = 'ทำรายการเรียบร้อยแล้ว';
            // header("location: http://localhost/ag/backend/productgroup.php");
        }
    }
}
if ($action_type == 'getid') {

    if ($id) {

        $query = "SELECT * FROM user WHERE id='$id'";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $data = [];

        foreach ($result as $row) {
            array_push($data, ['username' => $row['username'], 'first_name' => $row['first_name'],'last_name'=>$row['last_name'],
                'groupid'=>$row['group_id'], 'status' => $row['status']]);
        }
        echo json_encode($data);
    }
}


?>
