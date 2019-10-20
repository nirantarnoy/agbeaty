<?php
ob_start();
if(session_id() == '')session_start();
include("../../common/dbcon.php");
include("group_model.php");

$name = '';
$id = 0;
$desc = '';
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

if (isset($_POST['groupname'])) {
    $name = $_POST['groupname'];
}
if (isset($_POST['description'])) {
    $desc = $_POST['description'];
}

if ($action_type == 'insert') {
    if ($name != '') {
        array_push($data, ['name' => $name, 'desc' => $desc, 'status' => 1]);
        //echo $data[0]['name'];return;
        $res = insertGroupData($data, $connect);
        if ($res) {
            $_SESSION['msg_ok'] = 'บันทึกรายการเรียบร้อยแล้ว';
            header("location: http://localhost/ag/backend/productgroup.php");
        }
    }
}
if ($action_type == 'update') {
    if ($name != '' && $id != 0) {
        array_push($data, ['name' => $name, 'desc' => $desc, 'status' => 1]);
        //echo $data[0]['name'];return;
        $res = updateGroupData($id, $data, $connect);
        if ($res) {
            $SESSION['msg_ok'] = 'บันทึกรายการเรียบร้อยแล้ว';
            header("location: http://localhost/ag/backend/productgroup.php");
        }
    }
}
if ($action_type == 'delete') {
    echo "OK";
    if ($id != 0) {
        $res = deleteGroupData($id, $connect);
        if ($res) {
            $_SESSION['msg_ok'] = 'ทำรายการเรียบร้อยแล้ว';
           // header("location: http://localhost/ag/backend/productgroup.php");
        }
    }
}
if ($action_type == 'getid') {

    if ($id) {

        $query = "SELECT * FROM product_group WHERE id='$id'";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $data = [];

        foreach ($result as $row) {
            array_push($data, ['name' => $row['name'], 'desc' => $row['description'], 'status' => $row['status']]);
        }
        echo json_encode($data);
    }
}


?>
