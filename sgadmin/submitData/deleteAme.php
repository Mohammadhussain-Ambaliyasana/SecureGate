<?php

session_start();

include("../../assets/inc/conn.php");

if(empty($_SESSION['sgadminlogin']) || $_SESSION['sgadminlogin'] == ''){
  header("location: ../login.php");
}

if(isset($_POST['deleteAmeBtn'])){
    $id = $_POST['ameId'];

    $deleteqry = mysqli_query($conn, "DELETE FROM `gated_amenities` WHERE `id` = $id");

    if($deleteqry){
      header('location:../amenities.php');
    }
}

?>