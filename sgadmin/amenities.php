<?php

include ('../assets/inc/conn.php');

session_start();

if(empty($_SESSION['sgadminlogin']) || $_SESSION['sgadminlogin'] == ''){
  header("location: login.php");
}


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

    <title>Amenities Details</title>
</head>

<body>

    <!-- Nav Bar Start -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <span class="navText">Amenities Details</span>
            <!-- Button trigger modal -->
            <button type="button" class="addAmeBtn" data-bs-toggle="modal" data-bs-target="#add-Ame-modal">
                <i class="fa fa-plus" aria-hidden="true"></i> Add Amenity
            </button>
        </div>
    </nav>

    <!-- Add Repair Services Modal Starts-->
    <div class="modal fade" id="add-Ame-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Amenity</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="submitData/newAme.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="ameName" class="form-label">Amenity Name</label>
                            <input type="text" name="anaName" class="form-control" id="ameName" placeholder="Enter Amenity Name" required>
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
    <!-- Add Repair Services Modal Ends -->

    <!-- Nav Bar Ends -->

    <!-- All Amenities Section Starts -->
    <div class="container-fluid all-ame-data-container">

        <div class="card">
            <ul class="list-group list-group-flush">
        <?php

        $ameData = mysqli_query($conn , "SELECT * FROM `gated_amenities` ORDER BY `id` DESC");

        while($ameRow = mysqli_fetch_assoc($ameData)){

        ?>

                <li class="list-group-item allAmeCard">
                    <h4 class="card-title card-ame-name-section"><?php echo $ameRow['name'];?></h4>
                    <div class="operationBtn">
                        <form action="submitData/deleteAme.php" method="POST">
                            <input type="hidden" name="ameId" value="<?php echo $ameRow['id'];?>">
                            <button type="submit" name="deleteAmeBtn" class="btn btn-danger btn-delete-ame"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                        </form>
                    </div>
                </li>
                
                <?php
        }

        ?>
            </ul>
        </div>
        * Scroll to view all amenities
    </div>
    <!-- All Amenities Section Ends -->

    <!-- Search Bar Start -->
     <div class="container searchBar">
         <input type="text" id="searchRepSerInput" class="search-input" placeholder="Search by Name, Email, or Role...">
     </div>
    <!-- Search Bar Ends -->

    <!-- Body Start -->
    <div class="container-fluid all-book-ame-data-container">
    <?php

    $bookAmeData = mysqli_query($conn , "SELECT * FROM `gated_amenities_booking` ORDER BY `id` DESC");

    while($bookAmeRow = mysqli_fetch_assoc($bookAmeData)){

        ?>
                
        <div class="card" id="searchItems">
            <h3 class="card-header"><?php echo $bookAmeRow['name'];?></h3>
            <div class="card-body">
                <h4 class="card-title card-book-ame-name-section"><?php echo $bookAmeRow['house'];?></h4>
                <p class="card-text">
                    Mobile : <?php echo $bookAmeRow['mobile'];?><br>
                    Email : <?php echo $bookAmeRow['email'];?><br>
                    Amenity : <?php echo $bookAmeRow['amenity'];?><br>
                    <?php
                    $dateString = $bookAmeRow['date'];
                    $timeString = $bookAmeRow['time'];

                    $fullDateTimeString = $dateString . ' ' . $timeString;

                    $dateTime = new DateTime($fullDateTimeString);

                    $formattedDate = $dateTime->format('j F Y, l');
                    $formattedTime = $dateTime->format('g:i A');
                ?>
                    Date : <?php echo $formattedDate;?><br>
                    Time : <?php echo $formattedTime;?><br>
                    Status : <?php echo $bookAmeRow['status'];?><br>
                </p>
                <div class="operationBtn">
                    <form action="submitData/ameAcceptReject.php" method="POST">
                        <input type="hidden" name="ameBookId" value="<?php echo $bookAmeRow['id'];?>">
                        <?php
                        if($bookAmeRow['status'] == "Pending"){
                            ?>
                                <button type="submit" name="acceptBtn" class="btn btn-success btn-delete-staff"><i class="fa fa-check" aria-hidden="true"></i> Accept</button>
                                <button type="submit" name="rejectBtn" class="btn btn-danger btn-delete-staff"><i class="fa fa-times" aria-hidden="true"></i> Reject</button>
                            <?php
                        }
                        ?>
                    </form>
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
                    <a class="footer-activities footer-nav full-cover full-center" href="#">
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
        const searchRepSerInput = document.getElementById('searchRepSerInput');
        const repSerCards = document.getElementsByClassName('allRepSerCard');

        // Add event listener for keyup event (search as you type)
        searchRepSerInput.addEventListener('keyup', function() {
            const filter = searchRepSerInput.value.toLowerCase();

            // Loop through all the cards
            for (let i = 0; i < repSerCards.length; i++) {
                const card = repSerCards[i];
                const cardText = card.innerText.toLowerCase(); // Get all the text content of the card

                // Check if the card text matches the search query
                if (cardText.indexOf(filter) > -1) {
                    card.style.display = ''; // Show the card if match is found
                } else {
                    card.style.display = 'none'; // Hide the card if no match is found
                }
            }
        });

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="assets/js/script.js"></script>

</body>

</html>