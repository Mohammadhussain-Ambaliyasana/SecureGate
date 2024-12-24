<?php

session_start();

include("../../assets/inc/conn.php");

if(empty($_SESSION['sgadminlogin']) || $_SESSION['sgadminlogin'] == ''){
  header("location: ../login.php");
}



if (isset($_POST['submitNoticeBtn'])) {

    $subject = $_POST['noticeSubject'];
    $body = $_POST['noticeBody'];
    $noticeDoc_name = $_FILES['noticeImage']['name'];
    

    // Sanitize the input
    $notice_subject = mysqli_real_escape_string($conn, $subject);
    $notice_body = mysqli_real_escape_string($conn, $body);

    if($noticeDoc_name != ""){

        $staffDoc_type = $_FILES['noticeImage']['type'];
        $staffDoc_temp_loc = $_FILES['noticeImage']['tmp_name'];
        $staffDoc_save_loc = "../../assets/pics/notice/".$noticeDoc_name;


        if(($staffDoc_type=="image/png" || $staffDoc_type=="image/jpg" || $staffDoc_type=="image/jpeg" || $staffDoc_type=="application/pdf" || $staffDoc_type=="application/msword" || $staffDoc_type=="application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $staffDoc_type=="application/vnd.ms-powerpoint" || $staffDoc_type=="application/vnd.openxmlformats-officedocument.presentationml.presentation")) {
            $upl_notice_doc = move_uploaded_file($staffDoc_temp_loc, $staffDoc_save_loc);
      
            if($upl_notice_doc){
      
                // Prepare an SQL statement
                $addqry = mysqli_prepare($conn, "INSERT INTO `gated_notice`(`subject`, `body`, `doc_img`) VALUES (?,?,?)");
      
                // Bind the parameters
                mysqli_stmt_bind_param($addqry, "sss", $notice_subject, $notice_body, $noticeDoc_name);
      
                if(mysqli_stmt_execute($addqry)){
                    // Close the statement
                    mysqli_stmt_close($addqry);
                    header('location:../createNotice.php');
                }
      
            }else{
                ?>
                    <script>
                      alert('Error in Uploading');
                      window.location.href = "../createNotice.php";
                    </script>
                <?php
            }
          }else{
            ?>
                <script>
                    alert ("Please Uploade File Which Is Image Only With Extention Of PNG,JPG,JPEG OR PDF, PPT, PPTX, DOX, DOCX");
                    // window.location.href = "../createNotice.php";
                </script>
            <?php
          }


    }else{

         // Prepare an SQL statement
         $addqry = mysqli_prepare($conn, "INSERT INTO `gated_notice`(`subject`, `body`) VALUES (?,?)");
      
         // Bind the parameters
         mysqli_stmt_bind_param($addqry, "ss", $notice_subject, $notice_body);

         if(mysqli_stmt_execute($addqry)){
             // Close the statement
             mysqli_stmt_close($addqry);
             header('location:../createNotice.php');
         }

    }

}

?>