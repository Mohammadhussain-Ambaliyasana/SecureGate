<?php

session_start();

include("../../assets/inc/conn.php");

if(empty($_SESSION['sgadminlogin']) || $_SESSION['sgadminlogin'] == ''){
  header("location: ../login.php");
}



if (isset($_POST['submitStaffBtn'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $role = $_POST['role'];
    $address = $_POST['address'];
    $staffImg_name = $_FILES['staffImg']['name'];
    $staffImg_type = $_FILES['staffImg']['type'];
    $staffImg_temp_loc = $_FILES['staffImg']['tmp_name'];
    $staffImg_save_loc = "../../assets/pics/staff/".$staffImg_name;
    $staffDocImg_name = $_FILES['staffDocImg']['name'];
    $staffDocImg_type = $_FILES['staffDocImg']['type'];
    $staffDocImg_temp_loc = $_FILES['staffDocImg']['tmp_name'];
    $staffDocImg_save_loc = "../../assets/pics/staff/staffDocs/".$staffDocImg_name;

    $default_pass = '$2y$10$rxEGzx.M/GHx3l4fADjrAukqSvNmSuKxvN.fkNt5/SseA/7bLk1E.';

    // Sanitize the input
    $staff_name = mysqli_real_escape_string($conn, $name);
    $staff_email = mysqli_real_escape_string($conn, $email);
    $staff_mobile = mysqli_real_escape_string($conn, $mobile);
    $staff_role = mysqli_real_escape_string($conn, $role);
    $staff_address = mysqli_real_escape_string($conn, $address);


    if(($staffImg_type=="image/png" || $staffImg_type=="image/jpg" || $staffImg_type=="image/jpeg")&& ($staffDocImg_type=="image/png" || $staffDocImg_type=="image/jpg" || $staffDocImg_type=="image/jpeg")) {
      $upl_staff_img = move_uploaded_file($staffImg_temp_loc, $staffImg_save_loc);
      $upl_staff_doc = move_uploaded_file($staffDocImg_temp_loc, $staffDocImg_save_loc);

      if(($upl_staff_img) && ($upl_staff_doc)){

          // Prepare an SQL statement
          $addqry = mysqli_prepare($conn, "INSERT INTO `gated_staff`(`name`, `email`, `mobile`, `pass`, `role`, `address`, `img`, `doc_img`) VALUES (?,?,?,?,?,?,?,?)");

          // Bind the parameters
          mysqli_stmt_bind_param($addqry, "ssssssss", $staff_name, $staff_email, $staff_mobile,$default_pass, $staff_role, $staff_address, $staffImg_name, $staffDocImg_name);

          if(mysqli_stmt_execute($addqry)){
              // Close the statement
              mysqli_stmt_close($addqry);
              header('location:../staffDetails.php');
          }

      }else{
          ?>
              <script>
                alert('Error in Uploading');
                window.location.href = "../staffDetails.php";
              </script>
          <?php
      }
    }else{
      ?>
          <script>
              alert ("Please Uploade File Which Is Image Only With Extention Of PNG,JPG,JPEG");
              window.location.href = "../staffDetails.php";
          </script>
      <?php
    }

}

?>