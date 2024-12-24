<?php

session_start();

if(empty($_SESSION['residentlogin']) || $_SESSION['residentlogin'] == ''){
  header("location: login.php");
}

if(isset($_POST['resident_logout'])){
    unset($_SESSION['residentlogin']);
    unset($_SESSION['residentId']);
    unset($_SESSION['residentName']);
    unset($_SESSION['residentEmail']);
    unset($_SESSION['residentMobile']);
    unset($_SESSION['residentMembers']);
    unset($_SESSION['residentFourWheeler']);
    unset($_SESSION['residentTwoWheeler']);
    unset($_SESSION['residentStatus']);
    unset($_SESSION['residentBlock']);
    unset($_SESSION['residentHouseNum']);
    unset($_SESSION['residentDateTime']);
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
                        <?php
                        if($_SESSION['residentBlock'] == "NA"){
                            echo "<span>".$_SESSION['residentHouseNum']."</span>";
                        }else{
                            echo "<span>".$_SESSION['residentBlock']." - ".$_SESSION['residentHouseNum']."</span>";
                        }
                        ?>
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
                            <button type="submit" name="resident_logout" class="user-icon">
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

            <!-- advertisement section start -->
            <div class="advertisement-section full-center">
                <div id="carouselExampleAutoplaying" class="carousel slide full-cover" data-bs-ride="carousel">
                    <div class="carousel-inner full-cover">
                      <div class="carousel-item active full-cover">
                        <img src="../assets/pics/ads/add.jpg" class="d-block w-100 advertisement-img full-cover" alt="Advertisement">
                      </div>
                      <div class="carousel-item full-cover">
                        <img src="../assets/pics/ads/add.jpg" class="d-block w-100 advertisement-img full-cover" alt="Advertisement">
                      </div>
                      <div class="carousel-item full-cover">
                        <img src="../assets/pics/ads/add.jpg" class="d-block w-100 advertisement-img full-cover" alt="Advertisement">
                      </div>
                    </div>
                    <button class="carousel-control-prev carousel-nav-btn" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next carousel-nav-btn" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
            </div>
            <!-- advertisement section ends -->

            <!-- All Functions start -->
            <div class="container text-center body-grid-container">
                <div class="row body-grid-row">
                    <div class="col-6 full-center">
                        <a class="function-section full-center" href="invite.php">
                            Invite Someone
                        </a>
                    </div>
                    <div class="col-6 full-center">
                        <a class="function-section full-center" href="amenities.php">
                            Book Amenities
                        </a>
                    </div>
                    <div class="col-6 full-center">
                        <a class="function-section full-center" href="queries.php">
                            Have Query
                        </a>
                    </div>
                    <div class="col-6 full-center">
                        <a class="function-section full-center" href="repSer.php">
                            Repair Services
                        </a>
                    </div>
                    <div class="col-6 full-center">
                        <a class="function-section full-center" href="noticeBoard.php">
                            Notice Board
                        </a>
                    </div>
                    <!-- <div class="col-6 full-center">
                        <a class="function-section full-center" href="#">
                            Family Members
                        </a>
                    </div> -->
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