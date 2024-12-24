<?php

include ('../assets/inc/conn.php');

session_start();

if(empty($_SESSION['residentlogin']) || $_SESSION['residentlogin'] == ''){
    header("location: login.php");
}

$block_house = ($_SESSION['residentBlock'] == "NA") ? $_SESSION['residentHouseNum'] : $_SESSION['residentBlock']." - ".$_SESSION['residentHouseNum'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/invite.css">
    <link rel="icon" href="../assets/pics/logo/logobg.png" type="image/x-icon">

    <title>Invite Someone</title>
</head>

<body>

    <!-- Nav Bar Start -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <span class="navText">Invite Someone</span>
            <!-- Button trigger modal -->
            <button type="button" class="inviteSomeoneBtn" data-bs-toggle="modal" data-bs-target="#invite-someone-modal">
                <i class="fa fa-plus" aria-hidden="true"></i> Invite
            </button>
        </div>
    </nav>

    <!-- Add Resident Modal Starts-->
    <div class="modal fade" id="invite-someone-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Invite Someone</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="submitData/inviteSomeone.php">
                        <div class="mb-3">
                            <label for="guestName" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="guestName" placeholder="Enter Full Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="guestMobile" class="form-label">Mobile</label>
                            <input type="number" name="mobile" min="1111111111" max="9999999999" maxlength="10" class="form-control" id="guestMobile" placeholder="Enter Mobile Number" required>
                        </div>
                        <div class="mb-3">
                            <label for="totalMembers" class="form-label">Total Members</label>
                            <input type="number" name="members" class="form-control" id="totalMembers" placeholder="Enter Total Members" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Date and Time</label>
                            <div class="dateTimeDetails full-cover">
                                <div class="dateDetails date-time">
                                    <label for="invDate" class="form-label">Date</label>
                                    <input type="date" class="form-control" name="invDate" id="invDate" style="width: 80%;" min="<?php echo date('Y-m-d'); ?>" required>
                                </div>
                                <div class="timeDetails date-time">
                                    <label for="invTime" class="form-label">Time</label>
                                    <input type="time" class="form-control" name="invTime" id="invTime" style="width: 80%;" min="<?php echo date('H:i'); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Total Vehicle Details</label>
                            <div class="vehicleDetails full-cover">
                                <div class="vehicleDetailsCar">
                                    <label for="total4wheeler" class="form-label">4 Wheeler</label>
                                    <input type="number" name="fourWheeler" style="width: 80%;" class="form-control" id="total4wheeler" placeholder="Total 4 Wheeler" required>
                                </div>
                                <div class="vehicleDetailsBike">
                                    <label for="total2wheeler" class="form-label">2 Wheeler</label>
                                    <input type="number" name="twoWheeler" style="width: 80%;" class="form-control" id="total2wheeler" placeholder="Total 2 Wheeler" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="resName" value="<?php echo $_SESSION['residentName'];?>">
                            <input type="hidden" name="resHouse" value="<?php echo $block_house;?>">
                            <input type="hidden" name="resMobile" value="<?php echo $_SESSION['residentMobile'];?>">
                            <input type="hidden" name="resEmail" value="<?php echo $_SESSION['residentEmail'];?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="submitInviteBtn" class="submitInviteBtn" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Resident Modal Ends -->

    <!-- Nav Bar Ends -->

    <!-- Search Bar Start -->
     <div class="container searchBar">
         <input type="text" id="searchResidentInput" class="search-input" placeholder="Search by Name, Email, or House Number...">
     </div>
    <!-- Search Bar Ends -->

    <!-- Body Start -->
    <div class="container-fluid all-resident-data-container">

    <?php


                    $inviteData = mysqli_query($conn , "SELECT * FROM `gated_visitors` WHERE `res_house` = '$block_house' ORDER BY `id` DESC");

                    while($inviteRow = mysqli_fetch_assoc($inviteData)){

                        ?>

                        <div class="card allResidentCard" id="searchItems">
                            <h4 class="card-header"><?php echo $inviteRow['name'];?></h4>
                            <div class="card-body">
                                <h3 class="card-title card-name-section">Code : <?php echo $inviteRow['verification_code'];?></h3>
                                <p class="card-text">
                                    Mobile : <?php echo $inviteRow['mobile'];?> <br> 
                                    Members : <?php echo $inviteRow['members'];?> <br>
                                    4 Wheelers : <?php echo $inviteRow['fourWheeler'];?> <br>
                                    2 Wheelers : <?php echo $inviteRow['twoWheeler'];?> <br>
                                    <?php
                                    if($inviteRow['status'] == 0){
                                        ?>
                                            Status : Not Arrived <br>
                                        <?php
                                    }else{
                                        ?>
                                            Status : Arrived <br>
                                        <?php
                                    }
                                    ?>
                                </p>
                                <div class="operationBtn">
                                    <?php
                                    if($inviteRow['status'] == 0){
                                        ?>
                                            <div class="shareBtn">

                                            </div>
                                            <form action="submitData/deleteInvite.php" method="POST">
                                                <input type="hidden" name="inviteId" value="<?php echo $inviteRow['id'];?>">
                                                <button type="submit" name="deleteInviteBtn" class="btn btn-danger btn-delete-resident"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
    ?>

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





    <script>
        // Search Bar

        // Get the search input and the cards
        const searchResidentInput = document.getElementById('searchResidentInput');
        const residentCards = document.getElementsByClassName('allResidentCard');

        // Add event listener for keyup event (search as you type)
        searchResidentInput.addEventListener('keyup', function() {
            const filter = searchResidentInput.value.toLowerCase();

            // Loop through all the cards
            for (let i = 0; i < residentCards.length; i++) {
                const card = residentCards[i];
                const cardText = card.innerText.toLowerCase(); // Get all the text content of the card

                // Check if the card text matches the search query
                if (cardText.indexOf(filter) > -1) {
                    card.style.display = ''; // Show the card if match is found
                } else {
                    card.style.display = 'none'; // Hide the card if no match is found
                }
            }
        });




        // Get today's date in the format YYYY-MM-DD
        var today = new Date();
        var year = today.getFullYear();
        var month = ('0' + (today.getMonth() + 1)).slice(-2); // Add leading zero to month if needed
        var day = ('0' + today.getDate()).slice(-2); // Add leading zero to day if needed
        
        var currentDate = year + '-' + month + '-' + day;
        
        // Set the min attribute of the date input to today's date
        document.getElementById('invDate').setAttribute('min', currentDate);


       // Get the date and time inputs and add event listeners to them
        var dateInput = document.getElementById('invDate');
        var timeInput = document.getElementById('invTime');

        dateInput.addEventListener('change', function() {
            var selectedDate = new Date(dateInput.value);
            var today = new Date();

            if (selectedDate.toDateString() === today.toDateString()) {
                // Add 15 minutes to the current time
                today.setMinutes(today.getMinutes());

                // Get the current hours and minutes after adding the buffer
                var hours = ('0' + today.getHours()).slice(-2);
                var minutes = ('0' + today.getMinutes()).slice(-2);

                // Set the min time with a 15-minute buffer
                timeInput.min = hours + ':' + minutes;
            } else {
                // Reset min time if another date is selected
                timeInput.removeAttribute('min');
            }
        });

    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="assets/js/script.js"></script>

</body>

</html>