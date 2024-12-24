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
    <link rel="stylesheet" href="assets/css/queries.css">
    <link rel="icon" href="../assets/pics/logo/logobg.png" type="image/x-icon">

    <title>Queries Details</title>
</head>

<body>

    <!-- Nav Bar Start -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <span class="navText">Queries Details</span>
            <!-- Button trigger modal -->
            <button type="button" class="addQueryBtn" data-bs-toggle="modal" data-bs-target="#add-Query-modal">
                <i class="fa fa-plus" aria-hidden="true"></i> Add Query
            </button>
        </div>
    </nav>

    <!-- Add Queries Details Modal Starts-->
    <div class="modal fade" id="add-Query-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Queries Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="submitData/newQuery.php">
                        <div class="mb-3">
                            <label for="queriesSubject" class="form-label">Subject</label>
                            <textarea name="queriesSubject" class="form-control" id="queriesSubject" rows="2" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="queriesBody" class="form-label">Notice</label>
                            <textarea name="queriesBody" class="form-control" id="queriesBody" rows="5" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="name" value="<?php echo $_SESSION['residentName'];?>">
                            <input type="hidden" name="house" value="<?php echo $block_house;?>">
                            <input type="hidden" name="email" value="<?php echo $_SESSION['residentEmail'];?>">
                            <input type="hidden" name="mobile" value="<?php echo $_SESSION['residentMobile'];?>">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="submitQueryBtn" class="submitQueryBtn" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Repair Services Modal Ends -->

    <!-- Nav Bar Ends -->

    <!-- Search Bar Start -->
     <div class="container searchBar">
         <input type="text" id="searchQryInput" class="search-input" placeholder="Search by Subject, Date, or Body...">
     </div>
    <!-- Search Bar Ends -->

    <!-- Body Start -->
    <div class="container-fluid all-queries-data-container">

    <?php

    $queriesData = mysqli_query($conn , "SELECT * FROM `gated_inquiries` WHERE `house` = '$block_house' ORDER BY `id` DESC");

    while($queriesRow = mysqli_fetch_assoc($queriesData)){

        ?>

        <div class="card allQueriesCard" id="searchItems">
            <h3 class="card-header"><?php echo $queriesRow['subject'];?></h3>
            <div class="card-body">
                <h5 class="card-title card-name-section"><?php echo date('d M Y, h:i A', strtotime($queriesRow['date_time']));?></h5>
                <p class="card-text">
                    <?php echo $queriesRow['body'];?>
                </p>
                <div class="operationBtn">
                    <form action="submitData/deleteQuery.php" method="POST">
                        <input type="hidden" name="qryId" value="<?php echo $queriesRow['id'];?>">
                        <button type="submit" name="deleteQryBtn" class="btn btn-danger btn-delete-query"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
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
        const searchQryInput = document.getElementById('searchQryInput');
        const qryCards = document.getElementsByClassName('allQueriesCard');

        // Add event listener for keyup event (search as you type)
        searchQryInput.addEventListener('keyup', function() {
            const filter = searchQryInput.value.toLowerCase();

            // Loop through all the cards
            for (let i = 0; i < qryCards.length; i++) {
                const card = qryCards[i];
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