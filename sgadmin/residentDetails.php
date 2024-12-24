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
    <link rel="stylesheet" href="assets/css/residentDetails.css">
    <link rel="icon" href="../assets/pics/logo/logobg.png" type="image/x-icon">

    <title>Resident Details</title>
</head>

<body>

    <!-- Nav Bar Start -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <span class="navText">Resident Details</span>
            <!-- Button trigger modal -->
            <button type="button" class="addResidentBtn" data-bs-toggle="modal" data-bs-target="#add-resident-modal">
                <i class="fa fa-plus" aria-hidden="true"></i> Add
            </button>
        </div>
    </nav>

    <!-- Add Resident Modal Starts-->
    <div class="modal fade" id="add-resident-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Resident</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="submitData/newResident.php">
                        <div class="mb-3">
                            <label for="residentName" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="residentName" placeholder="Enter Full Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="residentEmail" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="residentEmail"
                                aria-describedby="emailHelp" placeholder="Enter Email" required>
                        </div>
                        <div class="mb-3">
                            <label for="residentMobile" class="form-label">Mobile</label>
                            <input type="number" name="mobile" min="1111111111" max="9999999999" maxlength="10" class="form-control" id="residentMobile" placeholder="Enter Mobile Number" required>
                        </div>
                        <div class="mb-3">
                            <label for="totalMembers" class="form-label">Total Members</label>
                            <input type="number" name="members" class="form-control" id="totalMembers" placeholder="Enter Total Members" required>
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
                            <div class="houseDetails full-cover">
                                <div class="statusDetails full-cover">
                                    <label for="" class="form-label">Status</label>
                                    <div class="statusDetailsOwner">
                                        <input type="radio" name="status" value="Owner" id="statusOwner" required>
                                        <label for="statusOwner" class="form-label">Owner</label>
                                    </div>
                                    <div class="statusDetailsRent">
                                        <input type="radio" name="status" value="Rent" id="statusRent" required>
                                        <label for="statusRent" class="form-label">Rent</label>
                                    </div>
                                </div>
                                <div class="addressDetails full-cover">
                                    <label for="" class="form-label">House Number</label>
                                    <div class="addressDetailsBlock full-center">
                                        <input type="text" name="block" style="width: 40%;" class="form-control" placeholder="Block">
                                        -
                                        <input type="number" name="houseNumber" style="width: 60%;" class="form-control" placeholder="House No." required>
                                    </div>
                                    <span class="note">* If NO Block then leave it empty.</span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="submitResidentBtn" class="submitResidentBtn" value="Submit">
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

        $checkBlock = mysqli_query($conn , "SELECT `block` FROM `gated_resident` LIMIT 1");
        if ($checkBlock) {
            // Fetch the first row
            $rowBlock = mysqli_fetch_assoc($checkBlock);
            
            if ($rowBlock) {
                // Get the value of 'block'
                if ($rowBlock['block'] == "NA"){

                    $residentData = mysqli_query($conn , "SELECT * FROM `gated_resident` ORDER BY `housenum` ASC");

                    while($residentRow = mysqli_fetch_assoc($residentData)){

                        ?>

                        <div class="card allResidentCard" id="searchItems">
                            <h4 class="card-header"><?php echo $residentRow['housenum'];?></h4>
                            <div class="card-body">
                                <h3 class="card-title card-name-section"><?php echo $residentRow['name'];?></h3>
                                <p class="card-text">
                                    Email : <?php echo $residentRow['email'];?> <br> 
                                    Mobile : <?php echo $residentRow['mobile'];?> <br>
                                    Members : <?php echo $residentRow['members'];?> <br>
                                    4 Wheelers : <?php echo $residentRow['fourwheeler'];?> <br>
                                    2 Wheelers : <?php echo $residentRow['twowheeler'];?> <br>
                                    Status : <?php echo $residentRow['status'];?> <br>
                                </p>
                                <div class="operationBtn">
                                    <button type="button" class="btn btn-edit-resident" data-bs-toggle="modal" data-bs-target="#edit-resident-modal-<?php echo $residentRow['id'];?>">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form action="submitData/deleteResident.php" method="POST">
                                        <input type="hidden" name="residentId" value="<?php echo $residentRow['id'];?>">
                                        <button type="submit" name="deleteResidentBtn" class="btn btn-danger btn-delete-resident"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                    </form>
                                </div>
                                <!-- Edit Modal Start -->
                                <div class="modal fade" id="edit-resident-modal-<?php echo $residentRow['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Resident</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="submitData/updateResidentBtn.php">
                                                    <input type="hidden" name="residentId" value="<?php echo $residentRow['id'];?>">
                                                    <div class="mb-3">
                                                        <label for="residentName" class="form-label">Name</label>
                                                        <input type="text" name="name" class="form-control" id="residentName" placeholder="Enter Full Name" value="<?php echo $residentRow['name'];?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="residentEmail" class="form-label">Email</label>
                                                        <input type="email" name="email" class="form-control" id="residentEmail"
                                                            aria-describedby="emailHelp" placeholder="Enter Email" value="<?php echo $residentRow['email'];?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="residentMobile" class="form-label">Mobile</label>
                                                        <input type="number" name="mobile" min="1111111111" max="9999999999" maxlength="10" class="form-control" id="residentMobile" placeholder="Enter Mobile Number" value="<?php echo $residentRow['mobile'];?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="totalMembers" class="form-label">Total Members</label>
                                                        <input type="number" name="members" class="form-control" id="totalMembers" placeholder="Enter Total Members" value="<?php echo $residentRow['members'];?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Total Vehicle Details</label>
                                                        <div class="vehicleDetails full-cover">
                                                            <div class="vehicleDetailsCar">
                                                                <label for="total4wheeler" class="form-label">4 Wheeler</label>
                                                                <input type="number" name="fourWheeler" style="width: 80%;" class="form-control" id="total4wheeler" placeholder="Total 4 Wheeler" value="<?php echo $residentRow['fourwheeler'];?>" required>
                                                            </div>
                                                            <div class="vehicleDetailsBike">
                                                                <label for="total2wheeler" class="form-label">2 Wheeler</label>
                                                                <input type="number" name="twoWheeler" style="width: 80%;" class="form-control" id="total2wheeler" placeholder="Total 2 Wheeler" value="<?php echo $residentRow['twowheeler'];?>" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="houseDetails full-cover">
                                                            <div class="statusDetails full-cover">
                                                                <label for="" class="form-label">Status</label>
                                                                <?php
                                                                
                                                                if($residentRow['status'] == "Owner"){
                                                                    ?>
                                                                        <div class="statusDetailsOwner">
                                                                            <input type="radio" name="status" value="Owner" id="statusOwner" checked required>
                                                                            <label for="statusOwner" class="form-label">Owner</label>
                                                                        </div>
                                                                        <div class="statusDetailsRent">
                                                                            <input type="radio" name="status" value="Rent" id="statusRent" required>
                                                                            <label for="statusRent" class="form-label">Rent</label>
                                                                        </div>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                        <div class="statusDetailsOwner">
                                                                            <input type="radio" name="status" value="Owner" id="statusOwner" required>
                                                                            <label for="statusOwner" class="form-label">Owner</label>
                                                                        </div>
                                                                        <div class="statusDetailsRent">
                                                                            <input type="radio" name="status" value="Rent" id="statusRent" checked required>
                                                                            <label for="statusRent" class="form-label">Rent</label>
                                                                        </div>
                                                                    <?php
                                                                }

                                                                ?>
                                                            </div>
                                                            <div class="addressDetails full-cover">
                                                                <label for="" class="form-label">House Number</label>
                                                                <div class="addressDetailsBlock full-center">
                                                                    <input type="text" name="block" style="width: 40%;" class="form-control" placeholder="Block">
                                                                    -
                                                                    <input type="number" name="houseNumber" style="width: 60%;" class="form-control" placeholder="House No." value="<?php echo $residentRow['housenum'];?>" required>
                                                                </div>
                                                                <span class="note">* If NO Block then leave it empty.</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <input type="submit" name="updateResidentBtn" class="submitResidentBtn" value="Update">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Edit Modal Ends -->
                            </div>
                        </div>

                        <?php
                    }
                } else {
                    $residentData = mysqli_query($conn , "SELECT * FROM `gated_resident` ORDER BY `block` ASC");

                    while($residentRow = mysqli_fetch_assoc($residentData)){

                        ?>

                            <div class="card allResidentCard">
                                <h5 class="card-header"><?php echo $residentRow['block']." - ".$residentRow['housenum'];?></h5>
                                <div class="card-body">
                                    <h3 class="card-title card-name-section"><?php echo $residentRow['name'];?></h3>
                                    <p class="card-text">
                                        Email : <?php echo $residentRow['email'];?> <br> 
                                        Mobile : <?php echo $residentRow['mobile'];?> <br>
                                        Members : <?php echo $residentRow['members'];?> <br>
                                        4 Wheelers : <?php echo $residentRow['fourwheeler'];?> <br>
                                        2 Wheelers : <?php echo $residentRow['twowheeler'];?> <br>
                                        Status : <?php echo $residentRow['status'];?> <br>
                                    </p>
                                    <div class="operationBtn">
                                        <button type="button" class="btn btn-edit-resident" data-bs-toggle="modal" data-bs-target="#edit-resident-modal<?php echo $residentRow['id'];?>">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <form action="submitData/deleteResident.php" method="POST">
                                            <input type="hidden" name="residentId" value="<?php echo $residentRow['id'];?>">
                                            <button type="submit" name="deleteResidentBtn" class="btn btn-danger btn-delete-resident">Delete</button>
                                        </form>
                                    </div>
                                    <!-- Edit Modal Start -->
                                    <div class="modal fade" id="edit-resident-modal<?php echo $residentRow['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Resident</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="submitData/updateResidentBtn.php">
                                                        <input type="hidden" name="residentId" value="<?php echo $residentRow['id'];?>">
                                                        <div class="mb-3">
                                                            <label for="residentName" class="form-label">Name</label>
                                                            <input type="text" name="name" class="form-control" id="residentName" placeholder="Enter Full Name" value="<?php echo $residentRow['name'];?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="residentEmail" class="form-label">Email</label>
                                                            <input type="email" name="email" class="form-control" id="residentEmail"
                                                                aria-describedby="emailHelp" placeholder="Enter Email" value="<?php echo $residentRow['email'];?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="residentMobile" class="form-label">Mobile</label>
                                                            <input type="number" name="mobile" min="1111111111" max="9999999999" maxlength="10" class="form-control" id="residentMobile" placeholder="Enter Mobile Number" value="<?php echo $residentRow['mobile'];?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="totalMembers" class="form-label">Total Members</label>
                                                            <input type="number" name="members" class="form-control" id="totalMembers" placeholder="Enter Total Members" value="<?php echo $residentRow['members'];?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Total Vehicle Details</label>
                                                            <div class="vehicleDetails full-cover">
                                                                <div class="vehicleDetailsCar">
                                                                    <label for="total4wheeler" class="form-label">4 Wheeler</label>
                                                                    <input type="number" name="fourWheeler" style="width: 80%;" class="form-control" id="total4wheeler" placeholder="Total 4 Wheeler" value="<?php echo $residentRow['fourwheeler'];?>" required>
                                                                </div>
                                                                <div class="vehicleDetailsBike">
                                                                    <label for="total2wheeler" class="form-label">2 Wheeler</label>
                                                                    <input type="number" name="twoWheeler" style="width: 80%;" class="form-control" id="total2wheeler" placeholder="Total 2 Wheeler" value="<?php echo $residentRow['twowheeler'];?>" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="houseDetails full-cover">
                                                                <div class="statusDetails full-cover">
                                                                    <label for="" class="form-label">Status</label>
                                                                    <?php
                                                                    
                                                                    if($residentRow['status'] == "Owner"){
                                                                        ?>
                                                                            <div class="statusDetailsOwner">
                                                                                <input type="radio" name="status" value="Owner" id="statusOwner" checked required>
                                                                                <label for="statusOwner" class="form-label">Owner</label>
                                                                            </div>
                                                                            <div class="statusDetailsRent">
                                                                                <input type="radio" name="status" value="Rent" id="statusRent" required>
                                                                                <label for="statusRent" class="form-label">Rent</label>
                                                                            </div>
                                                                        <?php
                                                                    }else{
                                                                        ?>
                                                                            <div class="statusDetailsOwner">
                                                                                <input type="radio" name="status" value="Owner" id="statusOwner" required>
                                                                                <label for="statusOwner" class="form-label">Owner</label>
                                                                            </div>
                                                                            <div class="statusDetailsRent">
                                                                                <input type="radio" name="status" value="Rent" id="statusRent" checked required>
                                                                                <label for="statusRent" class="form-label">Rent</label>
                                                                            </div>
                                                                        <?php
                                                                    }

                                                                    ?>
                                                                </div>
                                                                <div class="addressDetails full-cover">
                                                                    <label for="" class="form-label">House Number</label>
                                                                    <div class="addressDetailsBlock full-center">
                                                                        <input type="text" name="block" style="width: 40%;" class="form-control" placeholder="Block" value="<?php echo $residentRow['block'];?>">
                                                                        -
                                                                        <input type="number" name="houseNumber" style="width: 60%;" class="form-control" placeholder="House No." value="<?php echo $residentRow['housenum'];?>" required>
                                                                    </div>
                                                                    <span class="note">* If NO Block then leave it empty.</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <input type="submit" name="updateResidentBtn" class="submitResidentBtn" value="Update">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit Modal Ends -->
                                </div>
                            </div>

                        <?php
                    }
                }
            }
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

    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="assets/js/script.js"></script>

</body>

</html>