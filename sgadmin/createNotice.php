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
    <link rel="stylesheet" href="assets/css/createNotice.css">
    <link rel="icon" href="../assets/pics/logo/logobg.png" type="image/x-icon">

    <title>Create Notices</title>
</head>

<body>

    <!-- Nav Bar Start -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <span class="navText">Notice Board</span>
            <!-- Button trigger modal -->
            <button type="button" class="addNoticeBtn" data-bs-toggle="modal" data-bs-target="#create-notice-modal">
                <i class="fa fa-plus" aria-hidden="true"></i> Create Notice
            </button>
        </div>
    </nav>

    <!-- Add Staff Modal Starts-->
    <div class="modal fade" id="create-notice-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Notice</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="submitData/newNotice.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="noticeSubject" class="form-label">Subject</label>
                            <textarea name="noticeSubject" class="form-control" id="noticeSubject" rows="2" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="noticeBody" class="form-label">Notice</label>
                            <textarea name="noticeBody" class="form-control" id="noticeBody" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="noticeImage" class="form-label">Upload Image, PDF or DOX only</label>
                            <input type="file" name="noticeImage" class="form-control" id="noticeImage">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="submitNoticeBtn" class="submitNoticeBtn" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Staff Modal Ends -->

    <!-- Nav Bar Ends -->

    <!-- Search Bar Start -->
     <div class="container searchBar">
         <input type="text" id="searchNotInput" class="search-input" placeholder="Search by Subject or Date...">
     </div>
    <!-- Search Bar Ends -->

    <!-- Body Start -->
    <div class="container-fluid all-notice-data-container">

    <?php

    $noticeData = mysqli_query($conn , "SELECT * FROM `gated_notice` ORDER BY `id` DESC");

    while($noticeRow = mysqli_fetch_assoc($noticeData)){

        ?>

        <div class="card allNoticeCard" id="searchItems">
            <h3 class="card-header"><?php echo date('d M Y, h:i A', strtotime($noticeRow['date_time']));?></h3>
            <div class="card-body">
                <h4 class="card-title card-name-section"><?php echo $noticeRow['subject'];?></h4>
                <p class="card-text">
                    Notice : <br> <?php echo $noticeRow['body'];?> <br><br>
                </p>
                <div class="operationBtn">
                    <form action="submitData/deleteNotice.php" method="POST">
                        <input type="hidden" name="noticeId" value="<?php echo $noticeRow['id'];?>">
                        <input type="hidden" name="noticeDoc" value="<?php echo $noticeRow['doc_img'];?>">
                        <button type="submit" name="deleteNoticeBtn" class="btn btn-danger btn-delete-staff"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                    </form>
                    <?php
                    if($noticeRow['doc_img'] != ""){
                        ?>
                            <a href="../assets/pics/notice/<?php echo $noticeRow['doc_img'];?>" class="btn btn-secondary" target="_blank">View Document</a>
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

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="assets/js/script.js"></script>

</body>

</html>