<?php

session_start();

include("../../assets/inc/conn.php");

if(empty($_SESSION['sgadminlogin']) || $_SESSION['sgadminlogin'] == ''){
  header("location: ../login.php");
}



if (isset($_POST['updateResidentBtn'])) {

    $id = $_POST['residentId'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $members = $_POST['members'];
    $fourWheeler = $_POST['fourWheeler'];
    $twoWheeler = $_POST['twoWheeler'];
    $status = $_POST['status'];
    $block = $_POST['block'];
    $houseNumber = $_POST['houseNumber'];

    if($block == ""){
        $block = "NA";
    }

    // Sanitize the input
    $user_name = mysqli_real_escape_string($conn, $name);
    $user_email = mysqli_real_escape_string($conn, $email);
    $user_mobile = mysqli_real_escape_string($conn, $mobile);
    $user_members = mysqli_real_escape_string($conn, $members);
    $user_fourWheeler = mysqli_real_escape_string($conn, $fourWheeler);
    $user_twoWheeler = mysqli_real_escape_string($conn, $twoWheeler);
    $user_status = mysqli_real_escape_string($conn, $status);
    $user_block = mysqli_real_escape_string($conn, $block);
    $user_houseNumber = mysqli_real_escape_string($conn, $houseNumber);

    
        // Prepare an SQL statement
        $updateqry = mysqli_prepare($conn, "UPDATE `gated_resident` SET `name`= ? ,`email`= ? ,`mobile`= ? ,`members`= ? ,`fourwheeler`= ? ,`twowheeler`= ? ,`status`= ?,`block` = ?,`housenum` = ? WHERE `id` = $id");

        // Bind the parameters
        mysqli_stmt_bind_param($updateqry, "sssssssss", $user_name, $user_email, $user_mobile, $user_members, $user_fourWheeler, $user_twoWheeler, $user_status, $user_block, $user_houseNumber);

        // Execute the prepared statement
        if(mysqli_stmt_execute($updateqry)){
            // Close the statement
            mysqli_stmt_close($updateqry);
            header('location:../residentDetails.php');
        }

}

?>