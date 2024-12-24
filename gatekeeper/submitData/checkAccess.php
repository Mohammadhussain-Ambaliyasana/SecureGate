<?php

include ('../../assets/inc/conn.php');
session_start();

if(empty($_SESSION['stafflogin']) || $_SESSION['stafflogin'] == ''){
    header("location: login.php");
    exit();
}

$fail = true; // Default flag to show failure message
$invId = $invName = $invMobile = $invMember = $invDate = $invTime = $invFourWheeler = $invTwoWheeler = $residentName = $residentHouse = $residentMobile = "";

if(isset($_POST['checkAccess'])) {
    // Sanitize the code input from the form
    $code = mysqli_real_escape_string($conn, $_POST['code']);

    // Prepare the SQL statement
    $stmt = mysqli_prepare($conn, "SELECT id, status, name, mobile, members, date, time, fourWheeler, twoWheeler, verification_code, res_name, res_house, res_mobile FROM gated_visitors WHERE verification_code = ? AND status = 0");

    if ($stmt === false) {
        die("Prepare failed: " . mysqli_error($conn));
    }

    // Bind the parameter and execute
    mysqli_stmt_bind_param($stmt, "s", $code);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $status, $name, $mobile, $members, $date, $time, $fourwheeler, $twowheeler, $verificationCode, $resName, $resHouse, $resMobile);

    // Fetch the result
    if (mysqli_stmt_fetch($stmt)) {
        // Verify the code and ensure the status is 0
        if($status == 0 && $code == $verificationCode) {
            // Store details in variables for display
            $invId = $id;
            $invName = $name;
            $invMobile = $mobile;
            $invMember = $members;
            $invDate = $date;
            $invTime = $time;
            $invFourWheeler = $fourwheeler;
            $invTwoWheeler = $twowheeler;
            $residentName = $resName;
            $residentHouse = $resHouse;
            $residentMobile = $resMobile;

            // Update the visitor status in the database
            // $updQry = mysqli_query($conn, "UPDATE `gated_visitors` SET `status`= 1 WHERE `id` = '$id'");
            
            // if(!$updQry) {
            //     die("Update query failed: " . mysqli_error($conn));
            // }
            
            // Mark the operation as successful
            $fail = false;

            // Optionally redirect after success or simply display success
            // header("location: index.php");
            // exit();
        } else {
            // Invalid code or status is not 0
            $fail = true;
        }
    } else {
        // No record found for the provided code
        $fail = true;
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}




if(isset($_POST['approve'])){
    $invitedId = $_POST['id'];
    // Prepare the SQL statement
    $approve = mysqli_query($conn, "UPDATE `gated_visitors` SET `status`= 1 WHERE `id` = '$invitedId'");
    
    if($approve){
        header('location: ../index.php');
    }
}

?>


<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="../../assets/pics/logo/logobg.png" type="image/x-icon">
    <title>Verify Entry</title>
    <link rel="stylesheet" href="../assets/css/checkAccess.css">
</head>
<body>
    <div class="container-fluid super-container full-center">
        <?php
        if($fail == false){
            ?>
            <div class="card">
                <div class="card-header">
                    <?php echo $resHouse;?>
                </div>
                <div class="card-body">
                    <h4 class="card-title"><?php echo $invName;?></h4>
                    <p class="card-text">
                        Members : <?php echo $invMember;?><br>
                        Date : <?php echo $invDate;?><br>
                        Time : <?php echo $invTime;?><br>
                        2 Wheeler : <?php echo $invTwoWheeler;?><br>
                        4 Wheeler : <?php echo $invFourWheeler;?><br>
                        Mobile : <?php echo $invMobile;?>
                    </p>
                    <p class="card-text">
                        Resident Name : <?php echo $residentName;?><br>
                        Resident Mobile : <?php echo $residentMobile;?>
                    </p>
                    <form action="" method="POST">
                        <div class="operation">
                            <input type="hidden" name="id" value="<?php echo $invId;?>">
                            <button type="submit" name="approve" class="btn btn-success">Approve</button>
                            <a href="../index.php" class="btn btn-danger">Reject</a>
                        </div>
                    </form>
                </div>
            </div>
            <?php
        }else{
            ?>
                <div class="card text-center mb-3" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title note"><b>Invalid Code</b></h5>
                        <p class="card-text">Please Provide Correct Code</p>
                        <p class="card-text note"><i class="fa fa-times fa-2x" aria-hidden="true"></i></p>
                        <a href="../index.php" class="btn btn-primary">Back</a>
                    </div>
                </div>
            <?php
        }
        ?>
    </div>

    <script src="assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>