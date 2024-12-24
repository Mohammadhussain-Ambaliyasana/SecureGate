<?php

session_start();

include("../../assets/inc/conn.php");

if(empty($_SESSION['residentlogin']) || $_SESSION['residentlogin'] == ''){
    header("location: ../login.php");
}

if(isset($_POST['deleteInviteBtn'])){
    $id = $_POST['inviteId'];

    $deleteqry = mysqli_query($conn, "DELETE FROM `gated_visitors` WHERE `id` = $id");

    if($deleteqry){
      header('location:../invite.php');
    }
}

?>