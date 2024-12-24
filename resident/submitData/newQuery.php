<?php

session_start();

include("../../assets/inc/conn.php");

if(empty($_SESSION['residentlogin']) || $_SESSION['residentlogin'] == ''){
    header("location: ../login.php");
}


if (isset($_POST['submitQueryBtn'])) {

    $name = $_POST['name'];
    $house = $_POST['house'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $subject = $_POST['queriesSubject'];
    $body = $_POST['queriesBody'];

    // Sanitize the input
    $query_name = mysqli_real_escape_string($conn, $name);
    $query_house = mysqli_real_escape_string($conn, $house);
    $query_email = mysqli_real_escape_string($conn, $email);
    $query_mobile = mysqli_real_escape_string($conn, $mobile);
    $query_subject = mysqli_real_escape_string($conn, $subject);
    $query_body = mysqli_real_escape_string($conn, $body);

    // Prepare an SQL statement
    $addqry = mysqli_prepare($conn, "INSERT INTO `gated_inquiries`(`name`, `house`, `email`, `mobile`, `subject`, `body`) VALUES (?,?,?,?,?,?)");

    // Bind the parameters
    mysqli_stmt_bind_param($addqry, "ssssss", $query_name, $query_house, $query_email, $query_mobile, $query_subject, $query_body);

    if(mysqli_stmt_execute($addqry)){
        // Close the statement
        mysqli_stmt_close($addqry);
        header('location:../queries.php');
    }
}

?>