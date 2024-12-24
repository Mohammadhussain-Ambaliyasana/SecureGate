<?php

session_start();

include("../../assets/inc/conn.php");

if(empty($_SESSION['residentlogin']) || $_SESSION['residentlogin'] == ''){
    header("location: ../login.php");
  }



if (isset($_POST['submitInviteBtn'])) {

    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $members = $_POST['members'];
    $date = $_POST['invDate'];
    $time = $_POST['invTime'];
    $fourWheeler = $_POST['fourWheeler'];
    $twoWheeler = $_POST['twoWheeler'];

    $resname = $_POST['resName'];
    $reshouse = $_POST['resHouse'];
    $resMobile = $_POST['resMobile'];
    $resEmail = $_POST['resEmail'];


    // Sanitize the input
    $user_name = mysqli_real_escape_string($conn, $name);
    $user_mobile = mysqli_real_escape_string($conn, $mobile);
    $user_members = mysqli_real_escape_string($conn, $members);
    $user_date = mysqli_real_escape_string($conn, $date);
    $user_time = mysqli_real_escape_string($conn, $time);
    $user_fourWheeler = mysqli_real_escape_string($conn, $fourWheeler);
    $user_twoWheeler = mysqli_real_escape_string($conn, $twoWheeler);
    $res_name = mysqli_real_escape_string($conn, $resname);
    $res_house = mysqli_real_escape_string($conn, $reshouse);
    $res_mobile = mysqli_real_escape_string($conn, $resMobile);
    $res_email = mysqli_real_escape_string($conn, $resEmail);

    $status = 0;

    // Generate a random 6-digit number
    $verificationCode = rand(000000, 999999);

    
        // Prepare an SQL statement
        $addqry = mysqli_prepare($conn, "INSERT INTO `gated_visitors`(`status`, `name`, `mobile`, `members`, `date`, `time`, `fourWheeler`, `twoWheeler`, `verification_code`, `res_name`, `res_house`, `res_mobile`, `res_email`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");

        // Bind the parameters
        mysqli_stmt_bind_param($addqry, "sssssssssssss", $status, $user_name, $user_mobile, $user_members, $user_date, $user_time, $user_fourWheeler, $user_twoWheeler, $verificationCode, $res_name, $res_house, $res_mobile, $res_email);

        // Execute the prepared statement
        if(mysqli_stmt_execute($addqry)){
            // Close the statement
            mysqli_stmt_close($addqry);
            header('location:../invite.php');
        }
    }

?>