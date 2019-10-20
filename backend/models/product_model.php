<?php
function getProductAll($connect)
{
    $query = '';
    $query .= "SELECT * FROM product";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    return $result;
}
function getProductDetail($id, $connect)
{
    $query = '';
    $query .= "SELECT * FROM product WHERE id='$id'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $data = [];
    foreach ($result as $row){
        $data['code'] = $row['code'];
        $data['brand_id'] = $row['brand_id'];
        $data['name'] = $row['name'];
        $data['desc'] = $row['description'];
        $data['photo'] = $row['photo'];
    }
    return $data;
}
function getProductByType($brandid,$catid,$connect)
{
    $query = '';
    $query .= "SELECT * FROM product WHERE brand_id='$brandid' AND product_group_id='$catid'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    return $result;
}
function getProductName($id, $connect)
{
    $query = '';
    $query .= "SELECT * FROM product WHERE id='$id'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        return $row['name'];
    }

    return '';
}
function insertProductData($data, $connect){
    if(count($data)){
        $cdate = time();
        $uid = 1;
        $code = $data[0]["code"];
        $name = $data[0]["name"];
        $desc = $data[0]["desc"];
        $group = $data[0]["group"];
        $brand = $data[0]["brand"];
        $photo = $data[0]["photo"];
        $is_best = $data[0]["is_best"];
        $status = $data[0]["status"];
        $query = "INSERT INTO product(code,name,description,product_group_id,brand_id,photo,is_best,status,created_at,created_by)
                 VALUES('$code','$name','$desc','$group','$brand','$photo','$is_best','$status','$cdate','$uid')";
        $result = $connect->query($query);
        if($result){
            return 1;
        }else{
            return 0;
        }
    }else{
        return 0;
    }
}
function updateProductData($id,$data, $connect){
    if(count($data) && $id){
        $cdate = time();
        $uid = 1;
        $code = $data[0]["code"];
        $name = $data[0]["name"];
        $desc = $data[0]["desc"];
        $group = $data[0]["group"];
        $brand = $data[0]["brand"];
        $photo = $data[0]["photo"];
        $is_best = $data[0]["is_best"];
        $status = $data[0]["status"];
        $query = '';
        if($photo==''){
            $query = "UPDATE product SET code='$code', name='$name',description='$desc',product_group_id='$group',brand_id='$brand',is_best='$is_best',status='$status',updated_at='$cdate',updated_by='$uid' WHERE id='$id'";
        }else{
            $query = "UPDATE product SET code='$code', name='$name',description='$desc',product_group_id='$group',brand_id='$brand',photo='$photo',is_best='$is_best',status='$status',updated_at='$cdate',updated_by='$uid' WHERE id='$id'";
        }

        $result = $connect->query($query);
        if($result){
            return 1;
        }else{
            return 0;
        }
    }else{
        return 0;
    }
}
function deleteProductData($id, $connect){
    if($id){
        $query = "DELETE FROM product WHERE id='$id'";
        $result = $connect->query($query);
        if($result){
            return 1;
        }else{
            return 0;
        }
    }else{
        return 0;
    }
}
?>
