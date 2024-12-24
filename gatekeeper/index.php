<?php

include ('../assets/inc/conn.php');

session_start();

if(empty($_SESSION['stafflogin']) || $_SESSION['stafflogin'] == ''){
    header("location: login.php");
}

if(isset($_POST['staff_logout'])){
    unset($_SESSION['stafflogin']);
    header("location: login.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="../assets/pics/logo/logobg.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Secure Gate - Gatekeeper</title>
</head>
<body>
<div class="container-fluid super-container">

    <!-- Nav bar starts -->
     <nav>
        <div class="container-fluid g-0 nav-container full-cover">
            <div class="row g-0 nav-row full-cover">
                <div class="col col-10 nav-col">
                    <div class="nav-center-logo full-cover">
                        <img src="../assets/pics/logo/logosidewhite.png" alt="Logo">
                    </div>
                </div>
                <div class="col col-2 nav-col">
                    <div class="nav-user full-cover full-center">
                        <form action="" method="POST">
                            <button type="submit" name="staff_logout" class="user-icon">
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
                    <div class="container btnContainer">
                        <h2>Enter the code</h2>
                        <form action="submitData/checkAccess.php" method="POST">
                            <input type="text" class="display" name="code" id="display" readonly>
                            <div class="buttons">
                                <button type="button" class="number clickbtn" onclick="appendNumber(1)">1</button>
                                <button type="button" class="number clickbtn" onclick="appendNumber(2)">2</button>
                                <button type="button" class="number clickbtn" onclick="appendNumber(3)">3</button>
                                <button type="button" class="number clickbtn" onclick="appendNumber(4)">4</button>
                                <button type="button" class="number clickbtn" onclick="appendNumber(5)">5</button>
                                <button type="button" class="number clickbtn" onclick="appendNumber(6)">6</button>
                                <button type="button" class="number clickbtn" onclick="appendNumber(7)">7</button>
                                <button type="button" class="number clickbtn" onclick="appendNumber(8)">8</button>
                                <button type="button" class="number clickbtn" onclick="appendNumber(9)">9</button>
                                <button type="button" class="backspace clickbtn" onclick="backspace()"><i class="fas fa-backspace"></i></button>
                                <button type="button" class="number clickbtn" onclick="appendNumber(0)">0</button>
                                <button type="submit" name="checkAccess" class="submit clickbtn"><i class="fa fa-check" aria-hidden="true"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- All Functions ends -->

        </div>

    </div>

    <!-- Main content ends -->
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>