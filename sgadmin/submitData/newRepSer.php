<?php

session_start();

include("../../assets/inc/conn.php");

if(empty($_SESSION['sgadminlogin']) || $_SESSION['sgadminlogin'] == ''){
  header("location: ../login.php");
}



if (isset($_POST['submitRepSerBtn'])) {

    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $role = $_POST['role'];

    // Sanitize the input
    $staff_name = mysqli_real_escape_string($conn, $name);
    $staff_mobile = mysqli_real_escape_string($conn, $mobile);
    $staff_role = mysqli_real_escape_string($conn, $role);

    // Prepare an SQL statement
    $addqry = mysqli_prepare($conn, "INSERT INTO `gated_rep_ser`(`name`, `mobile`, `role`) VALUES (?,?,?)");

    // Bind the parameters
    mysqli_stmt_bind_param($addqry, "sss", $staff_name, $staff_mobile, $staff_role);

    if(mysqli_stmt_execute($addqry)){
        // Close the statement
        mysqli_stmt_close($addqry);
        header('location:../repairServices.php');
    }
}

?>