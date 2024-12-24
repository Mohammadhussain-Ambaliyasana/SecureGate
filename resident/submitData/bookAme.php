<?php

include ('../../assets/inc/conn.php');

session_start();

if(empty($_SESSION['residentlogin']) || $_SESSION['residentlogin'] == ''){
    header("location: ../login.php");
}

if(isset($_POST['submitAmeBtn'])){
    $resiName = $_POST['resName'];
    $resiHouse = $_POST['resHouse'];
    $resiMobile = $_POST['resMobile'];
    $resiEmail = $_POST['resEmail'];
    $name = $_POST['amenities_name'];
    $date = $_POST['ameDate'];
    $time = $_POST['ameTime'];
    $status = "Pending";

    // Sanitize the input
    $resi_name = mysqli_real_escape_string($conn, $resiName);
    $resi_house = mysqli_real_escape_string($conn, $resiHouse);
    $resi_mobile = mysqli_real_escape_string($conn, $resiMobile);
    $resi_email = mysqli_real_escape_string($conn, $resiEmail);
    $ame_name = mysqli_real_escape_string($conn, $name);
    $ame_date = mysqli_real_escape_string($conn, $date);
    $ame_time = mysqli_real_escape_string($conn, $time);

    // Prepare an SQL statement
    $addqry = mysqli_prepare($conn, "INSERT INTO `gated_amenities_booking`(`name`, `house`, `mobile`, `email`, `amenity`, `date`, `time`, `status`) VALUES (?,?,?,?,?,?,?,?)");

    // Bind the parameters
    mysqli_stmt_bind_param($addqry, "ssssssss", $resi_name, $resi_house, $resi_mobile, $resi_email, $ame_name, $ame_date, $ame_time, $status);

    if(mysqli_stmt_execute($addqry)){
        // Close the statement
        mysqli_stmt_close($addqry);
        header('location:../amenities.php');
    }
}


?>