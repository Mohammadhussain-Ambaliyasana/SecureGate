<?php

session_start();

include("../../assets/inc/conn.php");

if(empty($_SESSION['sgadminlogin']) || $_SESSION['sgadminlogin'] == ''){
  header("location: ../login.php");
}

if(isset($_POST['changePass'])){
    $id = $_SESSION['adminId'];
    $pass = $_POST['newPass'];
    $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

    $changeqry = mysqli_query($conn, "UPDATE `gated_admin` SET `pass`='$hashedPass' WHERE `id` = 1");

    if($changeqry){
      header('location:../profile.php');
    }
}

?>