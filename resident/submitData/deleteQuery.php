<?php

session_start();

include("../../assets/inc/conn.php");

if(empty($_SESSION['residentlogin']) || $_SESSION['residentlogin'] == ''){
    header("location: ../login.php");
}

if(isset($_POST['deleteQryBtn'])){
    $id = $_POST['qryId'];

    $deleteqry = mysqli_query($conn, "DELETE FROM `gated_inquiries` WHERE `id` = $id");

    if($deleteqry){
      header('location:../queries.php');
    }
}

?>