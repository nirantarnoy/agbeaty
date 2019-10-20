<?php
if(session_id() == ''){
    session_start();
}
if(!isset($_SESSION['userlogin'])){
    header('location: login.php');
}
?>
