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
    <link rel="stylesheet" href="assets/css/staffDetails.css">
    <link rel="icon" href="../assets/pics/logo/logobg.png" type="image/x-icon">

    <title>Staff Details</title>
</head>

<body>

    <!-- Nav Bar Start -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <span class="navText">Staff Details</span>
            <!-- Button trigger modal -->
            <button type="button" class="addStaffBtn" data-bs-toggle="modal" data-bs-target="#add-Staff-modal">
                <i class="fa fa-plus" aria-hidden="true"></i> Add
            </button>
        </div>
    </nav>

    <!-- Add Staff Modal Starts-->
    <div class="modal fade" id="add-Staff-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Staff</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="submitData/newStaff.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="staffName" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="staffName" placeholder="Enter Full Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="staffEmail" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="staffEmail"
                                aria-describedby="emailHelp" placeholder="Enter Email" required>
                        </div>
                        <div class="mb-3">
                            <label for="staffMobile" class="form-label">Mobile</label>
                            <input type="number" name="mobile" min="1111111111" max="9999999999" maxlength="10" class="form-control" id="staffMobile" placeholder="Enter Mobile Number" required>
                        </div>
                        <div class="mb-3">
                            <label for="staffRole" class="form-label">Role</label>
                            <input type="text" name="role" class="form-control" id="staffRole" placeholder="Enter Role of Staff" required>
                        </div>
                        <div class="mb-3">
                            <label for="staffAddress" class="form-label">Address</label>
                            <textarea name="address" class="form-control" id="staffAddress" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="staffImage" class="form-label">Upload Image of the Staff</label>
                            <input type="file" name="staffImg" class="form-control" id="staffImage" required>
                        </div>
                        <div class="mb-3">
                            <label for="staffDocImage" class="form-label">Upload Image Document of the Staff</label>
                            <input type="file" name="staffDocImg" class="form-control" id="staffDocImage" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="submitStaffBtn" class="submitStaffBtn" value="Submit">
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
         <input type="text" id="searchStaffInput" class="search-input" placeholder="Search by Name, Email, or Role...">
     </div>
    <!-- Search Bar Ends -->

    <!-- Body Start -->
    <div class="container-fluid all-staff-data-container">

    <?php

    $staffData = mysqli_query($conn , "SELECT * FROM `gated_staff` ORDER BY `id` ASC");

    while($staffRow = mysqli_fetch_assoc($staffData)){

        ?>

        <div class="card allStaffCard" id="searchItems">
            <h3 class="card-header"><?php echo $staffRow['name'];?></h3>
            <div class="card-body">
                <h4 class="card-title card-name-section"><?php echo $staffRow['role'];?></h4>
                <p class="card-text">
                    Email : <?php echo $staffRow['email'];?> <br><br>
                    Mobile : <?php echo $staffRow['mobile'];?> <br><br>
                    Address : <br> <?php echo $staffRow['address'];?>
                </p>
                <div class="operationBtn">
                    <form action="submitData/deleteStaff.php" method="POST">
                        <input type="hidden" name="staffId" value="<?php echo $staffRow['id'];?>">
                        <input type="hidden" name="staffImg" value="<?php echo $staffRow['img'];?>">
                        <input type="hidden" name="staffDocImg" value="<?php echo $staffRow['doc_img'];?>">
                        <button type="submit" name="deleteStaffBtn" class="btn btn-danger btn-delete-staff"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                    </form>
                    <a href="assets/img/staff/<?php echo $staffRow['img'];?>" class="btn btn-secondary" target="_blank">View Photo</a>
                    <a href="assets/img/staff/staffDocs/<?php echo $staffRow['doc_img'];?>" class="btn btn-secondary" target="_blank">View Document</a>
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
        const searchStaffInput = document.getElementById('searchStaffInput');
        const staffCards = document.getElementsByClassName('allStaffCard');

        // Add event listener for keyup event (search as you type)
        searchStaffInput.addEventListener('keyup', function() {
            const filter = searchStaffInput.value.toLowerCase();

            // Loop through all the cards
            for (let i = 0; i < staffCards.length; i++) {
                const card = staffCards[i];
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