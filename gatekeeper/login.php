<?php

session_start();

include("../assets/inc/conn.php");

if (isset($_SESSION['stafflogin']) && $_SESSION['stafflogin'] == "GatedStaffLoggedin") {
    header("location: index.php");
    exit(); // Add exit() to ensure the script stops executing after redirection
}


$fail = "false";
$msg ="";
if (isset($_POST['submitcheck'])) {
    $inputemail = $_POST['uemail'];
    $input_password = $_POST['pass']; // This is the password entered by the user

    // Sanitize email input
    $email = mysqli_real_escape_string($conn, $inputemail);

    // Prepare an SQL statement to fetch the user's details from the database
    $stmt = mysqli_prepare($conn, "SELECT `id`, `name`, `email`, `mobile`, `pass`, `role` FROM `gated_staff` WHERE email = ?");
    
    if ($stmt === false) {
        die("Prepare failed: " . mysqli_error($conn));
    }

    // Bind the email parameter
    mysqli_stmt_bind_param($stmt, "s", $email);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Bind the result variables (make sure to bind all the necessary fields)
    mysqli_stmt_bind_result($stmt, $id, $name, $email, $mobile, $pass, $role);

    // Fetch the result from the statement
    if (mysqli_stmt_fetch($stmt)) {
        // Compare the user-entered password with the hashed password from the database
        if (password_verify($input_password, $pass)) {
            // Password is correct, store details in session
            session_start();  // Start the session if not already started
            $_SESSION['staffId'] = $id;
            $_SESSION['staffName'] = $name;
            $_SESSION['staffEmail'] = $email;
            $_SESSION['staffMobile'] = $mobile;
            $_SESSION['staffRole'] = $role;
            $_SESSION['stafflogin'] = "GatedStaffLoggedin";  // Use this for checking if the user is logged in

            // Redirect to the index page
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="shortcut icon" href="../assets/pics/logo/logobg.png" type="image/x-icon">
    <title>Staff Login</title>
    <link rel="stylesheet" href="assets/css/login.css">

</head>

<body>

<div class="container-fluid">
	<div class="screen">
		<div class="screen__content">
                <form class="login" method="POST">
                    <div class="logodiv">
                        <img src="../assets/pics/logo/logodown.png" alt="Logo" class="logo">
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="email" class="login__input" name="uemail" placeholder="Email" required>
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" class="login__input" name="pass" placeholder="Password" required>
                        <p></p>
                    </div>
                    <?php
                    if($fail == "true"){
                        echo "<p class='message'>.$msg.</p>";
                        $fail = "false";
                    }
                    ?>
                    <button class="button login__submit" name="submitcheck">
                        <span class="button__text">Log In Now</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>				
                </form>
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>



<script src="assets/js/script.js"></script>

</body>

</html>