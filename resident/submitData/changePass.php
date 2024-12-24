<?php

session_start();

include("../../assets/inc/conn.php");

if(empty($_SESSION['residentlogin']) || $_SESSION['residentlogin'] == ''){
    header("location: ../login.php");
}

if(isset($_POST['changePass'])){
    $id = $_SESSION['residentId'];
    $pass = $_POST['newPass'];
    $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

    $changeqry = mysqli_query($conn, "UPDATE `gated_resident` SET `pass`='$hashedPass' WHERE `id` = '$id'");

    if($changeqry){
      header('location:../profile.php');
    }
}

?>