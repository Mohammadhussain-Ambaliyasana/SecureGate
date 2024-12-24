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
    <link rel="stylesheet" href="assets/css/amenities.css">
    <link rel="icon" href="../assets/pics/logo/logobg.png" type="image/x-icon">

    <title>Book Amenities</title>
</head>

<body>

    <!-- Nav Bar Start -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <span class="navText">Book Amenities</span>
            <!-- Button trigger modal -->
            <button type="button" class="bookAmaBtn" data-bs-toggle="modal" data-bs-target="#book-ama-modal">
                <i class="fa fa-plus" aria-hidden="true"></i> Book Amenities
            </button>
        </div>
    </nav>

    <!-- Book Amenities Modal Starts-->
    <div class="modal fade" id="book-ama-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Book Amenities</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="submitData/bookAme.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="repSerName" class="form-label">Select Amenities</label>
                            <select name="amenities_name" class="form-select" id="" required>
                                <option value="">Select Any Amenity</option>
                                <?php
                                
                                $ameData = mysqli_query($conn , "SELECT * FROM `gated_amenities` ORDER BY `id` DESC");

                                while($ameRow = mysqli_fetch_assoc($ameData)){
                        
                                ?>
                                    <option value="<?php echo $ameRow['name'];?>"><?php echo $ameRow['name'];?></option> 
                                <?php
                                }
                        
                                ?>

                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="ameDate" class="form-label">Date</label>
                            <input type="date" class="form-control" name="ameDate" id="ameDate" min="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="ameTime" class="form-label">Time</label>
                            <input type="time" class="form-control" name="ameTime" id="ameTime" min="<?php echo date('H:i'); ?>" required>
                            <span class="note">* Please select 15 minutes prior time.</span>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="resName" value="<?php echo $_SESSION['residentName'];?>">
                            <input type="hidden" name="resHouse" value="<?php echo $block_house;?>">
                            <input type="hidden" name="resMobile" value="<?php echo $_SESSION['residentMobile'];?>">
                            <input type="hidden" name="resEmail" value="<?php echo $_SESSION['residentEmail'];?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="submitAmeBtn" class="submitAmeBtn" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Book Amenities Modal Ends -->

    <!-- Nav Bar Ends -->

    <!-- Search Bar Start -->
     <div class="container searchBar">
         <input type="text" id="searchBookAmeInput" class="search-input" placeholder="Search by Name, Email, or Role...">
     </div>
    <!-- Search Bar Ends -->

    <!-- Body Start -->
    <div class="container-fluid all-rep-ser-data-container">

    <?php


    $ameBookData = mysqli_query($conn , "SELECT * FROM `gated_amenities_booking` WHERE `house` = '$block_house' ORDER BY `id` DESC");

    while($ameBookRow = mysqli_fetch_assoc($ameBookData)){

        ?>

        <div class="card allBookAmeCard" id="searchItems">
            <h3 class="card-header"><?php echo $ameBookRow['amenity'];?></h3>
            <div class="card-body">
                <h4 class="card-title card-name-section">Status: <?php echo $ameBookRow['status'];?></h4>
                <p class="card-text">
                <?php
                    $dateString = $ameBookRow['date'];
                    $timeString = $ameBookRow['time'];

                    $fullDateTimeString = $dateString . ' ' . $timeString;

                    $dateTime = new DateTime($fullDateTimeString);

                    $formattedDate = $dateTime->format('j F Y, l');
                    $formattedTime = $dateTime->format('g:i A');
                ?>
                    Date : <?php echo $formattedDate;?><br>
                    Time : <?php echo $formattedTime;?>
                </p>
                <div class="operationBtn">
                    <form action="submitData/deleteBookAme.php" method="POST">
                        <input type="hidden" name="bookAmeId" value="<?php echo $ameBookRow['id'];?>">
                        <?php
                        if($ameBookRow['status'] == "Pending"){
                            ?>
                                <button type="submit" name="deleteBookAme" class="btn btn-danger btn-delete-staff"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                            <?php
                        }
                        ?>
                    </form>
                </div>
            </div>
            <div class="card-footer text-body-secondary">
                <?php
                    $bookeddateTime = new DateTime($ameBookRow['date_time']);
                    $bookedformattedDate = $bookeddateTime->format('j F Y, l (g:i A)');
                ?>
                <?php echo $bookedformattedDate;?>
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
        const searchBookAmeInput = document.getElementById('searchBookAmeInput');
        const bookAmeCards = document.getElementsByClassName('allBookAmeCard');

        // Add event listener for keyup event (search as you type)
        searchBookAmeInput.addEventListener('keyup', function() {
            const filter = searchBookAmeInput.value.toLowerCase();

            // Loop through all the cards
            for (let i = 0; i < bookAmeCards.length; i++) {
                const card = bookAmeCards[i];
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
        document.getElementById('ameDate').setAttribute('min', currentDate);


       // Get the date and time inputs and add event listeners to them
        var dateInput = document.getElementById('ameDate');
        var timeInput = document.getElementById('ameTime');

        dateInput.addEventListener('change', function() {
            var selectedDate = new Date(dateInput.value);
            var today = new Date();

            if (selectedDate.toDateString() === today.toDateString()) {
                // Add 15 minutes to the current time
                today.setMinutes(today.getMinutes() + 15);

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