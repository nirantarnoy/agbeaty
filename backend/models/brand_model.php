<?php

function findBrandAll($connect)
{
    $query = "SELECT * FROM product_brand";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

    return $result;
}
function getBrandName($id, $connect)
{
    $query = '';
    $query .= "SELECT * FROM product_brand WHERE id='$id'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        return $row['name'];
    }

    return '';
}
function insertBrandData($data, $connect){
    if(count($data)){
        $cdate = time();
        $uid = 1;
        $name = $data[0]["name"];
        $desc = $data[0]["desc"];
        $status = $data[0]["status"];
        $productgroup = $data[0]["productgroup"];
        $grouplist = '';

        if(count($productgroup)){
          for($i=0;$i<=count($productgroup)-1;$i++){
              $grouplist = $grouplist.$productgroup[$i].',';
          }
        }

        $query = "INSERT INTO product_brand(name,description,status,has_group,created_at,created_by)
                 VALUES('$name','$desc','$status','$grouplist','$cdate','$uid')";
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
function updateBrandData($id,$data, $connect){
    if(count($data) && $id){
        $cdate = time();
        $uid = 1;
        $name = $data[0]["name"];
        $desc = $data[0]["desc"];
        $status = $data[0]["status"];

        $productgroup = $data[0]["productgroup"];
        $grouplist = '';

        if(count($productgroup)){
            for($i=0;$i<=count($productgroup)-1;$i++){
                $grouplist = $grouplist.$productgroup[$i].',';
            }
        }

        $query = "UPDATE product_brand SET name='$name',description='$desc',status='$status',has_group='$grouplist',updated_at='$cdate',created_by=1 WHERE id='$id'";
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
function deleteBrandData($id, $connect){
    if($id){
        $query = "DELETE FROM product_brand WHERE id='$id'";
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
