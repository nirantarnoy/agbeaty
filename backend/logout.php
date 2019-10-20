<?php
session_start();
//unset($_SESSION['userid']);
if(isset($_SESSION['userid']) && isset($_SESSION['userlogin'])){
    unset($_SESSION['userid']);
    unset($_SESSION['userlogin']);
    setcookie('rememberme','',time()-1);
    header("location: login.php");
}else{
    header("location: login.php");
}
?>
