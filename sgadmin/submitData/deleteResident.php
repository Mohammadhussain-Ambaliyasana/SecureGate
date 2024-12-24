<?php

session_start();

include("../../assets/inc/conn.php");

if(empty($_SESSION['sgadminlogin']) || $_SESSION['sgadminlogin'] == ''){
  header("location: ../login.php");
}

if(isset($_POST['deleteResidentBtn'])){
    $id = $_POST['residentId'];

    $deleteqry = mysqli_query($conn, "DELETE FROM `gated_resident` WHERE `id` = $id");

    if($deleteqry){
        header('location:../residentDetails.php');
    }
}
?>