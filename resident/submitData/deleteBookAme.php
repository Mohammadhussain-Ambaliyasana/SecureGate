<?php

session_start();

include("../../assets/inc/conn.php");

if(empty($_SESSION['residentlogin']) || $_SESSION['residentlogin'] == ''){
    header("location: ../login.php");
}

if(isset($_POST['deleteBookAme'])){
    $id = $_POST['bookAmeId'];

    $deleteqry = mysqli_query($conn, "DELETE FROM `gated_amenities_booking` WHERE `id` = $id");

    if($deleteqry){
      header('location:../amenities.php');
    }
}

?>