<?php
ob_start();
if (session_id() == '') session_start();
include("../../common/dbcon.php");
include("group_model.php");
include("product_model.php");
include("brand_model.php");

$code = '';
$name = '';
$id = 0;
$product_id = 0;
$desc = '';
$group = 0;
$brand = 0;
$photoname = '';
$status = 1;
$isbest = '';
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
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
}
if (isset($_POST['code'])) {
    $code = $_POST['code'];
}
if (isset($_POST['productname'])) {
    $name = $_POST['productname'];
}
if (isset($_POST['description'])) {
    $desc = $_POST['description'];
}
if (isset($_POST['group'])) {
    $group = $_POST['group'];
}
if (isset($_POST['brand'])) {
    $brand = $_POST['brand'];
}
if (isset($_POST['is_best'])) {
    $isbest = $_POST['is_best'];
}

if ($action_type != 'getid') {
    $res_folder = "../../res";
    $folder_store = trim(getBrandName($brand, $connect));
    if (!file_exists($res_folder . '/product_photo/' . $folder_store)) {
        mkdir($res_folder . '/product_photo/' . $folder_store, 0777, true);
    }

    $target_dir = $res_folder . '/product_photo/' . $folder_store . '/';
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

    $photoname = basename($_FILES["photo"]['name']);
    // echo $isbest;return;

// manage photo
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES["photo"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["photo"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }


// end photo

}


if ($action_type == 'insert') {

    if ($name != '') {
        $is_best = 0;
        if ($isbest == 'on') {
            $is_best = 1;
        }
        array_push($data, ['code' => $code, 'name' => $name, 'desc' => $desc, 'group' => $group, 'brand' => $brand, 'photo' => $photoname, 'is_best' => $is_best, 'status' => 1]);
        $res = insertProductData($data, $connect);
        if ($res) {
            $_SESSION['msg_ok'] = 'บันทึกรายการเรียบร้อยแล้ว';
            header("location: http://localhost/ag/backend/product.php");
        }
    }
}
if ($action_type == 'update') {
    if ($name != '' && $product_id != 0) {
        $phoduct_data = getProductDetail($product_id, $connect);
        $product_old_photo = $phoduct_data['photo'];
        $is_best = 0;
        if ($isbest == 'on') {
            $is_best = 1;
        }
        array_push($data, ['code' => $code, 'name' => $name, 'desc' => $desc, 'group' => $group, 'brand' => $brand, 'photo' => $photoname, 'is_best' => $is_best, 'status' => 1]);
        //echo $data[0]['name'];return;
        $res = updateProductData($product_id, $data, $connect);
        //echo $res;return;
        if ($res) {
            if ($product_old_photo != '' && $photoname != '') {
                //  echo "update";return;
                $dir = getBrandName($phoduct_data['brand_id'], $connect);
                $photo = $dir . '/' . $product_old_photo;

                unlink($res_folder . '/product_photo/' . $photo);
            }
            $_SESSION['msg_ok'] = 'บันทึกรายการเรียบร้อยแล้ว';
            header("location: http://localhost/ag/backend/product.php");
        }
    }
}
if ($action_type == 'delete') {
    if ($id != 0) {
        $phoduct_data = getProductDetail($id, $connect);
        $product_old_photo = $phoduct_data['photo'];

        $res = deleteProductData($id, $connect);
        if ($res) {
            if ($product_old_photo != '') {
                $dir = getBrandName($phoduct_data['brand_id'], $connect);
                $photo = $dir . '/' . $product_old_photo;

                unlink($res_folder . '/product_photo/' . $photo);
            }
            $_SESSION['msg_ok'] = 'ทำรายการเรียบร้อยแล้ว';
            // header("location: http://localhost/ag/backend/productgroup.php");
        }
    }
}
if ($action_type == 'getid') {

    if ($id) {

        $query = "SELECT * FROM product WHERE id='$id'";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $data = [];

        foreach ($result as $row) {
            $dir = getBrandName($row['brand_id'], $connect);
            $photo = $dir . '/' . $row['photo'];
            array_push($data, ['code' => $row['code'], 'name' => $row['name'], 'desc' => $row['description'], 'group' => $row['product_group_id'], 'brand' => $row['brand_id'], 'photo' => $photo, 'is_best' => $row['is_best'], 'status' => $row['status']]);
        }
        echo json_encode($data);
    }
}


?>
