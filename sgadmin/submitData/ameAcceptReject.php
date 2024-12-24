<?php

session_start();

include("../../assets/inc/conn.php");

if(empty($_SESSION['sgadminlogin']) || $_SESSION['sgadminlogin'] == ''){
  header("location: ../login.php");
}

// If Accepted
if(isset($_POST['acceptBtn'])){
    $id = $_POST['ameBookId'];
    $status = "Accepted";

    $statusUpdQry = mysqli_query($conn, "UPDATE `gated_amenities_booking` SET `status`='$status' WHERE `id` = '$id'");

    if($statusUpdQry){
      header('location:../amenities.php');
    }
}


// If Rejected
if(isset($_POST['rejectBtn'])){
  $id = $_POST['ameBookId'];
  $status = "Rejected";

  $statusUpdQry = mysqli_query($conn, "UPDATE `gated_amenities_booking` SET `status`='$status' WHERE `id` = '$id'");

  if($statusUpdQry){
    header('location:../amenities.php');
  }
}

?>