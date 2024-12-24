<?php

session_start();

include("../../assets/inc/conn.php");

if(empty($_SESSION['sgadminlogin']) || $_SESSION['sgadminlogin'] == ''){
  header("location: ../login.php");
}



if (isset($_POST['submitResidentBtn'])) {

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

    $default_pass = '$2y$10$FNKtz4mAr19QYfENiuZ/JOsH/4gwOkPyaBnGm9c/JZgZPHIcZtLc6';

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

    // Check If User Exists

    $checkqry = mysqli_prepare($conn, "SELECT `block`, `housenum` FROM gated_resident WHERE block =? AND housenum =?");
    mysqli_stmt_bind_param($checkqry, "ss",$user_block, $user_houseNumber);
    mysqli_stmt_execute($checkqry);
    mysqli_stmt_store_result($checkqry);
    if (mysqli_stmt_num_rows($checkqry) > 0) {
      ?>
      <script>
        alert('Resident already exists with this block and house number!');
        window.location.href = "../residentDetails.php";
      </script>
      <?php
    } else {
        // Prepare an SQL statement
        $addqry = mysqli_prepare($conn, "INSERT INTO `gated_resident`(`name`, `email`, `mobile`, `pass`, `members`, `fourwheeler`, `twowheeler`, `status`, `block`, `housenum`) VALUES (?,?,?,?,?,?,?,?,?,?)");

        // Bind the parameters
        mysqli_stmt_bind_param($addqry, "ssssssssss", $user_name, $user_email, $user_mobile, $default_pass, $user_members, $user_fourWheeler, $user_twoWheeler, $user_status, $user_block, $user_houseNumber);

        // Execute the prepared statement
        if(mysqli_stmt_execute($addqry)){
            // Close the statement
            mysqli_stmt_close($addqry);
            header('location:../residentDetails.php');
        }
    }

    // Close the prepared statement
    mysqli_stmt_close($checkqry);

}

?>