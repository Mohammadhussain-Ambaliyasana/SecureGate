<?php

session_start();

include("../../assets/inc/conn.php");

if(empty($_SESSION['sgadminlogin']) || $_SESSION['sgadminlogin'] == ''){
  header("location: ../login.php");
}

if(isset($_POST['deleteNoticeBtn'])){
    $id = $_POST['noticeId'];
    $noticeDoc = $_POST['noticeDoc'];

    $deleteqry = mysqli_query($conn, "DELETE FROM `gated_notice` WHERE `id` = $id");

    if($deleteqry){
      unlink("../../assets/pics/notice/".$noticeDoc);
      header('location:../createNotice.php');
    }
}

?>