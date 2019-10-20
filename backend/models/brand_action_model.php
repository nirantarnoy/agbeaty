<?php
ob_start();
if(session_id() == '')session_start();
include("../../common/dbcon.php");
include("brand_model.php");

$name = '';
$id = 0;
$brandid = 0;
$desc = '';
$status = 1;
$data = [];
$productgroup = null;
$action_type = 'getid';

//array_push($data,['name'=>'niran']);
//echo json_encode($data);

if (isset($_POST['action_type'])) {
    $action_type = $_POST['action_type'];
}
if (isset($_POST['id'])) {
    $id = $_POST['id'];
}
if (isset($_POST['brandid'])) {
    $brandid = $_POST['brandid'];
}

if (isset($_POST['brandname'])) {
    $name = $_POST['brandname'];
}
if (isset($_POST['description'])) {
    $desc = $_POST['description'];
}
if (isset($_POST['productgroup'])) {
    $productgroup = $_POST['productgroup'];
}
if ($action_type == 'insert') {
    if ($name != '') {
        array_push($data, ['name' => $name, 'desc' => $desc, 'status' => 1, 'productgroup' => $productgroup]);
        //echo $data[0]['name'];return;
        $res = insertBrandData($data, $connect);
        if ($res) {
            $_SESSION['msg_ok'] = 'บันทึกรายการเรียบร้อยแล้ว';
            header("location: http://localhost/ag/backend/brand.php");
        }
    }
}
if ($action_type == 'update') {

    if ($name != '' && $brandid != 0) {
        print_r($productgroup);
        array_push($data, ['name' => $name, 'desc' => $desc, 'status' => 1, 'productgroup' => $productgroup]);
        //echo $data[0]['name'];return;
        $res = updateBrandData($brandid, $data, $connect);
        if ($res) {
            $_SESSION['msg_ok'] = 'บันทึกรายการเรียบร้อยแล้ว';
            header("location: http://localhost/ag/backend/brand.php");
        }
    }
}
if ($action_type == 'delete') {
    //echo "OK";
    if ($id != 0) {
        $res = deleteBrandData($id, $connect);
        if ($res) {
            $_SESSION['msg_ok'] = 'ทำรายการเรียบร้อยแล้ว';
            // header("location: http://localhost/ag/backend/productgroup.php");
        }
    }
}
if ($action_type == 'getid') {

    if ($id) {

        $query = "SELECT * FROM product_brand WHERE id='$id'";
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
