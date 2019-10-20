<?php
session_start();
ob_start();
include("../common/dbcon.php");
include('models/user_model.php');

$usename = '';
$password = '';
$remember = '';

if (isset($_POST['username'])) {
    $usename = $_POST['username'];
}

if (isset($_POST['password'])) {
    $password = $_POST['password'];
}
if (isset($_POST['rememberme'])) {
    $remember = $_POST['rememberme'];
}

if(isset($_SESSION['login_err'])){
    unset($_SESSION['login_err']);
}

//echo $remember;return;

if($usename !='' && $password != ''){
    $res = userLogin($usename,$password,$connect);
    if(count($res)){
        foreach ($res as $value){
           $_SESSION['userid'] = $value['id'];
           $_SESSION['userlogin'] = $value['username'];

        }
        if($remember == 'on'){
            $days = 30;
            $value = $_SESSION['userid'];
            setcookie ("rememberme",$value,time()+ ($days * 24 * 60 * 60 * 1000));
        }
        header("location: product.php");
    }else{
        $_SESSION['use_to_login'] = 1;
        $_SESSION['login_err'] = 'ชื่อหรือรหัสผ่านไม่ถูกต้อง';
        header("location:login.php");
    }
}

?>
