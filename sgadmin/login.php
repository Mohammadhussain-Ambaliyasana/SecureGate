<?php

session_start();

include("../assets/inc/conn.php");

if (isset($_SESSION['sgadminlogin']) && $_SESSION['sgadminlogin'] == "GatedAdminLoggedin") {
    header("location: index.php");
    exit(); // Add exit() to ensure the script stops executing after redirection
}

$fail = "false";
$msg ="";
if (isset($_POST['submitcheck'])){
    $inputuname = $_POST['uname'];
    $input_password = $_POST['pass']; // This is the password entered by the user

    $uname = mysqli_real_escape_string($conn, $inputuname);
  
    // Prepare an SQL statement to fetch the hashed password from the database
    $stmt = mysqli_prepare($conn, "SELECT `id`, `pass` FROM gated_admin WHERE email = ?");
    if ($stmt === false) {
        die("Prepare failed: " . mysqli_error($conn));
    }

    // Bind the email parameter
    mysqli_stmt_bind_param($stmt, "s", $uname);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Bind the result to the $hashed_password variable (which stores the hash in the database)
    mysqli_stmt_bind_result($stmt, $id, $hashed_password);

    // Fetch the result from the statement
    if(mysqli_stmt_fetch($stmt)){
        // Now compare the user-entered password with the hashed password from the database
        if (password_verify($input_password, $hashed_password)) {
            // Password is correct
            $_SESSION['adminId'] = $id;
            $_SESSION['sgadminlogin'] = "GatedAdminLoggedin";
            header("location: index.php");
            exit(); // Ensure the script stops executing after the redirection
        } else {
            // Password is incorrect
            $msg = "Invalid password!";
            $fail = "true";
        }
    } else {
        // Email not found or query failed
        $msg = "Invalid Email!";
        $fail = "true";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}


?>

<!doctype html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/pics/logo/logobg.png" type="image/x-icon">
    <title>Admin Login</title>
    <link rel="stylesheet" href="assets/css/login.css">

</head>

<body> <!-- partial:index.partial.html -->

    <section> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span>

        <div class="signin">
            <div class="content">
                <h2>Secure Gate Admin</h2>
                <form class="form" method="POST">
                    <div class="inputBox">
                        <input type="email" name="uname" required> <i>Email</i>
                    </div>
                    <div class="inputBox">
                        <input type="password" name="pass" required> <i>Password</i>
                    </div>
                    <?php
                    if($fail == "true"){
                        echo "<div class='inputBox wrongidpass'>
                                <p>.$msg.</p>
                             </div>";
                             $fail = "true";
                    }
                    ?>
                    
                    <!-- <div class="links"> 
                        <a href="#">Forgot Password ?</a>
                    </div> -->
                    <div class="inputBox">
                        <input type="submit" name="submitcheck" value="Login">
                    </div>
                </form>
            </div>
        </div>

    </section> <!-- partial -->


    <script src="assets/js/script.js"></script>

</body>

</html>