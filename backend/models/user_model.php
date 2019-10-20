<?php

function findUserAll($connect)
{
    $query = "SELECT * FROM user";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

    return $result;
}
function userLogin($name,$pwd,$connect)
{
    $newpwd = md5($pwd);
    $query = "SELECT * FROM user WHERE username='$name' and password='$newpwd'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

    return $result;
}
function getUserName($id, $connect)
{
    $query = '';
    $query .= "SELECT * FROM user WHERE id='$id'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        return $row['username'];
    }

    return '';
}
function insertUserData($data, $connect){
    if(count($data)){
        $cdate = time();
        $uid = 1;
        $username = $data[0]["username"];
        $fname = $data[0]["first_name"];
        $lname = $data[0]["last_name"];
        $pwd = $data[0]["password"];
        $status = $data[0]["status"];
        $group = $data[0]["group"];

        $newpwd = md5($pwd);

        $query = "INSERT INTO user(username,password,first_name,last_name,group_id,status,created_at,created_by)
                 VALUES('$username','$newpwd','$fname','$lname','$group','$status','$cdate','$uid')";
        $result = $connect->query($query);

        //return $query;
        if($result){
            return 1;
        }else{
            return 0;
        }
    }else{
        return 0;
    }
}
function updateUserData($id,$data, $connect){
    if(count($data) && $id){
        $cdate = time();
        $uid = 1;
        $username = $data[0]["username"];
        $fname = $data[0]["first_name"];
        $lname = $data[0]["last_name"];
        $pwd = $data[0]["password"];
        $status = $data[0]["status"];
        $group = $data[0]["group"];

        $newpwd = md5($pwd);

        $query = "UPDATE user SET username='$username',first_name='$fname',last_name='$lname',group_id='$group',status='$status',updated_at='$cdate',updated_by=$uid WHERE id='$id'";
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
function deleteUserData($id, $connect){
    if($id){
        $query = "DELETE FROM user WHERE id='$id'";
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
