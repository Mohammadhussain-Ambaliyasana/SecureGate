<?php

session_start();

include("../../assets/inc/conn.php");

if(empty($_SESSION['sgadminlogin']) || $_SESSION['sgadminlogin'] == ''){
  header("location: ../login.php");
}

if(isset($_POST['deleteRepSerBtn'])){
    $id = $_POST['repSerId'];

    $deleteqry = mysqli_query($conn, "DELETE FROM `gated_rep_ser` WHERE `id` = $id");

    if($deleteqry){
      header('location:../repairServices.php');
    }
}

?>