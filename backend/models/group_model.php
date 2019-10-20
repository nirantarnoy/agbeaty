<?php
function findGroupAll($connect)
{
    $query = "SELECT * FROM product_group";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

    return $result;
}
function getGroupName($id, $connect)
{
    $query = '';
    $query .= "SELECT * FROM product_group WHERE id='$id'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        return $row['name'];
    }
    return '';
}

function insertGroupData($data, $connect){
   if(count($data)){
       $cdate = time();
       $uid = 1;
       $name = $data[0]["name"];
       $desc = $data[0]["desc"];
       $status = $data[0]["status"];
       $query = "INSERT INTO product_group(name,description,status,created_at,created_by)
                 VALUES('$name','$desc','$status','$cdate','$uid')";
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
function updateGroupData($id,$data, $connect){
    if(count($data) && $id){
        $cdate = time();
        $uid = 1;
        $name = $data[0]["name"];
        $desc = $data[0]["desc"];
        $status = $data[0]["status"];
        $query = "UPDATE product_group SET name='$name',description='$desc',status='$status',updated_at='$cdate',created_by=1 WHERE id='$id'";
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
function deleteGroupData($id, $connect){
    if($id){
        $query = "DELETE FROM product_group WHERE id='$id'";
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
