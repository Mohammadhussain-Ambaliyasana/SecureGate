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
    <link rel="stylesheet" href="assets/css/inquiries.css">
    <link rel="icon" href="../assets/pics/logo/logobg.png" type="image/x-icon">

    <title>Resident Inquiries</title>
</head>

<body>

    <!-- Nav Bar Start -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <span class="navText">Resident Inquiries</span>
        </div>
    </nav>
    <!-- Nav Bar Ends -->

    <!-- Search Bar Start -->
     <div class="container searchBar">
         <input type="text" id="searchInqInput" class="search-input" placeholder="Search by Name, Email, or Role...">
     </div>
    <!-- Search Bar Ends -->

    <!-- Body Start -->

    <!-- <p class="d-inline-flex gap-1">
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Button with data-bs-target
        </button>
    </p>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
        </div>
    </div> -->


    <div class="container-fluid all-inq-data-container">

    <?php

    // $inqData = mysqli_query($conn , "SELECT * FROM `gated_inquiries` ORDER BY `id` DESC");
    $inqData = mysqli_query($conn , "SELECT * FROM `gated_inquiries` ORDER BY `id` DESC");

    while($inqRow = mysqli_fetch_assoc($inqData)){

        ?>

        <div class="card allInqCard" id="searchItems">

            <p class="d-inline-flex gap-1 expandBtn">
                <button class="btn btn-secondary card-header full-cover" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $inqRow['id'];?>" aria-expanded="false" aria-controls="collapse<?php echo $inqRow['id'];?>">
                    <p class='full-cover noticeBtn'><?php echo $inqRow['name']."(".$inqRow['house'].")";?><br><span class='date'><?php echo date('d M Y, h:i A', strtotime($inqRow['date_time']));?></span><br><i class="fa fa-angle-down" aria-hidden="true"></i></p>
                </button>
            </p>
            <div class="collapse" id="collapse<?php echo $inqRow['id'];?>">
                <div class="card card-body">
                    <h4 class="card-title card-name-section"><?php echo $inqRow['subject'];?></h4>
                    <p class="card-text">
                        Message : <br> <?php echo $inqRow['body'];?>
                    </p>
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
        const searchInqInput = document.getElementById('searchInqInput');
        const inqCards = document.getElementsByClassName('allInqCard');

        // Add event listener for keyup event (search as you type)
        searchInqInput.addEventListener('keyup', function() {
            const filter = searchInqInput.value.toLowerCase();

            // Loop through all the cards
            for (let i = 0; i < inqCards.length; i++) {
                const card = inqCards[i];
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