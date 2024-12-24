<?php

include ('../assets/inc/conn.php');

session_start();

if(empty($_SESSION['sgadminlogin']) || $_SESSION['sgadminlogin'] == ''){
    header("location: login.php");
}

// Families Count
$totalResident = mysqli_query($conn, "SELECT COUNT(*) AS total_resident FROM `gated_resident`");
$totalResidentCount = mysqli_fetch_assoc($totalResident);

// Members Count
$totalMembers = mysqli_query($conn, "SELECT SUM(members) AS total_members FROM `gated_resident`");
$totalMembersCount = mysqli_fetch_assoc($totalMembers);

// Total 4 Wheelers
$total4Wheelers = mysqli_query($conn, "SELECT SUM(fourwheeler) AS total_four_wheeler FROM `gated_resident`");
$total4WheelerCount = mysqli_fetch_assoc($total4Wheelers);

// Total 2 Wheelers
$total2Wheelers = mysqli_query($conn, "SELECT SUM(twowheeler) AS total_two_wheeler FROM `gated_resident`");
$total2WheelerCount = mysqli_fetch_assoc($total2Wheelers);

// Total Owners
$totalOwner = mysqli_query($conn, "SELECT COUNT(*) AS total_owner FROM `gated_resident` WHERE `status` = 'Owner'");
$totalOwnerCount = mysqli_fetch_assoc($totalOwner);

// Total Rent
$totalRent = mysqli_query($conn, "SELECT COUNT(*) AS total_rent FROM `gated_resident` WHERE `status` = 'Rent'");
$totalRentCount = mysqli_fetch_assoc($totalRent);

// Total Staff
$totalStaff = mysqli_query($conn, "SELECT COUNT(*) AS total_staff FROM `gated_staff`");
$totalStaffCount = mysqli_fetch_assoc($totalStaff);

// Total Visitors
$totalVisitors = mysqli_query($conn, "SELECT COUNT(*) AS total_visitors FROM `gated_visitors`");
$totalVisitorsCount = mysqli_fetch_assoc($totalVisitors);

// Total Amenities
$totalAmenities = mysqli_query($conn, "SELECT COUNT(*) AS total_amenities FROM `gated_amenities`");
$totalAmenitiesCount = mysqli_fetch_assoc($totalAmenities);

// Total Notice
$totalNotice = mysqli_query($conn, "SELECT COUNT(*) AS total_notice FROM `gated_notice`");
$totalNoticeCount = mysqli_fetch_assoc($totalNotice);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/profile.css">
    <link rel="icon" href="../assets/pics/logo/logobg.png" type="image/x-icon">

    <title>Admin Profile</title>
</head>

<body>

    <!-- Nav Bar Start -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <span class="navText">Admin Profile</span>
        </div>
    </nav>
    <!-- Nav Bar Ends -->

   <!-- Search Bar Start -->
   <!-- <div class="container searchBar">
         <input type="text" id="searchRepSerInput" class="search-input" placeholder="Search by Name, Number, or Role...">
     </div> -->
    <!-- Search Bar Ends -->

    <!-- Body Start -->
    <h2 class="welcome">Welcome Admin</h1>
    <div class="container-fluid all-rep-ser-data-container">

        <!-- Table of Contents Starts -->
        <table class="table table-striped main-table">
            <tbody>
                <tr>
                    <th class="table-content-data" scope="row">
                        Total Families <br><span class="main-data"><?php echo $totalResidentCount['total_resident'];?></span>
                    </th>
                    <th class="table-content-data" scope="row">
                        Total Members <br><span class="main-data"><?php echo $totalMembersCount['total_members'];?></span>
                    </th>
                </tr>
                <tr>
                    <th class="table-content-data" scope="row">
                        4 Wheelers <br><span class="main-data"><?php echo $total4WheelerCount['total_four_wheeler'];?></span>
                    </th>
                    <th class="table-content-data" scope="row">
                        2 Wheelers <br><span class="main-data"><?php echo $total2WheelerCount['total_two_wheeler'];?></span>
                    </th>
                </tr>
                <tr>
                    <th class="table-content-data" scope="row">
                        Total Owners <br><span class="main-data"><?php echo $totalOwnerCount['total_owner'];?></span>
                    </th>
                    <th class="table-content-data" scope="row">
                        Total Rent <br><span class="main-data"><?php echo $totalRentCount['total_rent'];?></span>
                    </th>
                </tr>
                <tr>
                    <th class="table-content-data" scope="row">
                        Total Staff <br><span class="main-data"><?php echo $totalStaffCount['total_staff'];?></span>
                    </th>
                    <th class="table-content-data" scope="row">
                        Total Visitors <br><span class="main-data"><?php echo $totalVisitorsCount['total_visitors'];?></span>
                    </th>
                </tr>
                <tr>
                    <th class="table-content-data" scope="row">
                        Total Amenities <br><span class="main-data"><?php echo $totalAmenitiesCount['total_amenities'];?></span>
                    </th>
                    <th class="table-content-data" scope="row">
                        Total Notice <br><span class="main-data"><?php echo $totalNoticeCount['total_notice'];?></span>
                    </th>
                </tr>
            </tbody>
        </table>
        <!-- Table of Contents Ends -->

        <!-- Change Password Section Starts -->
        <div class="changePass">
            <p class="d-inline-flex gap-1">
                <button class="btn changePassBtn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseChangePass" aria-expanded="false" aria-controls="collapseChangePass">
                  Change Password
                </button>
              </p>
              <div class="collapse" id="collapseChangePass">
                <div class="card card-body">
                    <form method="POST" action="submitData/changePass.php">
                        <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label"><b>Enter New Password</b></label>
                          <input type="password" class="form-control" name="newPass" id="exampleInputPassword1" placeholder="Enter New Password">
                        </div>
                        <button type="submit" name="changePass" class="btn changePassSubmitBtn">Submit</button>
                      </form>
                </div>
              </div>
        </div>
        <!-- Change Password Section Ends -->

    </div>
    <!-- Body Ends -->



    <!-- Footer Section Starts -->
    <footer>
        <div class="container-fluid g-0 footer-container full-cover">
            <div class="row g-0 footer-row full-cover">
                <div class="col col-6 footer-col">
                    <a class="footer-home footer-nav full-cover full-center" href="index.php">
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






    <!-- <script>
        // Search Bar

        // Get the search input and the cards
        const searchNotInput = document.getElementById('searchNotInput');
        const notCards = document.getElementsByClassName('allNoticeCard');

        // Add event listener for keyup event (search as you type)
        searchNotInput.addEventListener('keyup', function() {
            const filter = searchNotInput.value.toLowerCase();

            // Loop through all the cards
            for (let i = 0; i < notCards.length; i++) {
                const card = notCards[i];
                const cardText = card.innerText.toLowerCase(); // Get all the text content of the card

                // Check if the card text matches the search query
                if (cardText.indexOf(filter) > -1) {
                    card.style.display = ''; // Show the card if match is found
                } else {
                    card.style.display = 'none'; // Hide the card if no match is found
                }
            }
        });

    </script> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="assets/js/script.js"></script>

</body>

</html>