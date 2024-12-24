<?php

session_start();

include("../../assets/inc/conn.php");

if(empty($_SESSION['sgadminlogin']) || $_SESSION['sgadminlogin'] == ''){
  header("location: ../login.php");
}

if(isset($_POST['deleteStaffBtn'])){
    $id = $_POST['staffId'];
    $staffImg = $_POST['staffImg'];
    $staffDocImg = $_POST['staffDocImg'];

    $deleteqry = mysqli_query($conn, "DELETE FROM `gated_staff` WHERE `id` = $id");

    if($deleteqry){
      unlink("../../assets/pics/staff/".$staffImg);
      unlink("../../assets/picsstaff/staffDocs/".$staffDocImg);
      header('location:../staffDetails.php');
    }
}

?>