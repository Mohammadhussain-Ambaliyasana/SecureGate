<?php

session_start();

if(empty($_SESSION['sgadminlogin']) || $_SESSION['sgadminlogin'] == ''){
  header("location: login.php");
}

if(isset($_POST['sgadmin_logout'])){
    unset($_SESSION['sgadminlogin']);
    unset($_SESSION['adminId']);
    header("location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="../assets/pics/logo/logobg.png" type="image/x-icon">

    <title>Resident Home</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="container-fluid super-container">

    <!-- Nav bar starts -->
     <nav>
        <div class="container-fluid g-0 nav-container full-cover">
            <div class="row g-0 nav-row full-cover">
                <div class="col col-3 nav-col">
                    <div class="nav-flat-number full-cover full-center">
                        <span>Admin</span>
                    </div>
                </div>
                <div class="col col-7 nav-col">
                    <div class="nav-center-logo full-cover full-center">
                        <img src="../assets/pics/logo/logosidewhite.png" alt="Logo">
                    </div>
                </div>
                <div class="col col-2 nav-col">
                    <div class="nav-user full-cover full-center">
                        <form action="" method="POST">
                            <button type="submit" name="sgadmin_logout" class="user-icon">
                                <i class="fas fa-sign-out-alt full-center"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
     </nav>
    <!-- Nav bar ends -->

    <!-- Main content starts -->

    <div class="container-fluid body-container full-center full-cover">

        <div class="container body-child-container full-cover">

            <!-- All Functions start -->
            <div class="container text-center body-grid-container">
                <div class="row body-grid-row">
                    <div class="col-6 full-center">
                        <a class="function-section full-center" href="residentDetails.php">
                            Resident Details
                        </a>
                    </div>
                    <div class="col-6 full-center">
                        <a class="function-section full-center" href="staffDetails.php">
                            Staff Details
                        </a>
                    </div>
                    <div class="col-6 full-center">
                        <a class="function-section full-center" href="createNotice.php">
                            Create Notices
                        </a>
                    </div>
                    <div class="col-6 full-center">
                        <a class="function-section full-center" href="inquiries.php">
                            Resident Inquiries
                        </a>
                    </div>
                    <div class="col-6 full-center">
                        <a class="function-section full-center" href="amenities.php">
                            Amenities Details
                        </a>
                    </div>
                    <div class="col-6 full-center">
                        <a class="function-section full-center" href="repairServices.php">
                            Repair Services
                        </a>
                    </div>
                </div>
            </div>
            <!-- All Functions ends -->

        </div>

    </div>

    <!-- Main content ends -->

    <!-- Footer Section Starts -->
     <footer>
        <div class="container-fluid g-0 footer-container full-cover">
            <div class="row g-0 footer-row full-cover">
                <div class="col col-6 footer-col">
                    <a class="footer-home footer-nav full-cover full-center" href="#">
                        <i class="fa fa-home" aria-hidden="true"></i>&nbsp;
                        <span>&nbsp;Home</span>
                    </a>
                </div>
                <div class="col col-6 footer-col">
                    <a class="footer-activities footer-nav full-cover full-center" href="profile.php">
                        <i class="fa fa-user" aria-hidden="true"></i>&nbsp;
                        <span>&nbsp;Profile</span>
                    </a>
                </div>
            </div>
        </div>
     </footer>
    <!-- Footer Section Ends -->





























    </div>
    <!-- <div class="container">
        <h1>Visitor Code Generator</h1>
        <p>Click the button below to generate a random code for your visitor.</p>
        <button id="generateBtn" class="btn">Generate Code</button>
        <div id="codeDisplay" class="code-display"></div>
    </div> -->

    <script src="assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>