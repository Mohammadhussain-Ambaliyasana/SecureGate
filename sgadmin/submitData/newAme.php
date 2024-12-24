<?php

session_start();

include("../../assets/inc/conn.php");

if(empty($_SESSION['sgadminlogin']) || $_SESSION['sgadminlogin'] == ''){
  header("location: ../login.php");
}



if (isset($_POST['submitAmeBtn'])) {

    $name = $_POST['anaName'];

    // Sanitize the input
    $ame_name = mysqli_real_escape_string($conn, $name);

    // Prepare an SQL statement
    $addqry = mysqli_prepare($conn, "INSERT INTO `gated_amenities`(`name`) VALUES (?)");

    // Bind the parameters
    mysqli_stmt_bind_param($addqry, "ss", $ame_name);

    if(mysqli_stmt_execute($addqry)){
        // Close the statement
        mysqli_stmt_close($addqry);
        header('location:../amenities.php');
    }
}

?>