<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hot As Hell</title>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="shortcut icon" href="/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        .btn-custom {
            color: white;
            background-color: #00868D;
            border: none;
            border-radius: 10px;
            padding: 10px;
        }
        .btn-secondary-custom {
            background-color: grey;
            border: none;
            border-radius: 10px;
            padding: 10px;
            color: white;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <nav>
        <img src="images/logo.png" alt="" id="logo" style="width: 80px; height: 80px;">
        <div style="display: flex;">
            <img src="images/boy.png" alt="" id="person" style="width: 80px; height: 80px;">
            <p id="name">E0001234</p>
        </div>
    </nav>
    <div class="main">
        <div class="left">
            <ul>
                <li class="highlight"><a href="employee.php"><i class="fa-solid fa-user" style="margin-right: 10px;"></i>Employee</a></li>
                <li><a href="TestPositionDashboard.php"><i class="fa-solid fa-briefcase" style="margin-right: 10px;"></i>Employee Position</a></li>
                <li><a href="TestRoomDashBoard.php"><i class="fa-solid fa-bed" style="margin-right: 10px;"></i>Room</a></li>
                <li><a href="TestRoomDetailDashBoard.php"><i class="fa-solid fa-hotel" style="margin-right: 10px;"></i>Room Detail</a></li>
                <li><a href="reservation.html"><i class="fa-solid fa-user" style="margin-right: 10px;"></i>Reservation</a></li>
                <li><a href="guest.html"><i class="fa-solid fa-book" style="margin-right: 10px;"></i>Guest Information</a></li>
                <li><a href="payment.html"><i class="fa-brands fa-paypal" style="margin-right: 10px;"></i>Payment</a></li>
                <li><a href="TestMethodDashboard.php"><i class="fa-solid fa-coins" style="margin-right: 10px;"></i>Payment Method</a></li>                
                <li><a href="TestPromotionDashboard.php"><i class="fa-solid fa-desktop" style="margin-right: 10px;"></i>Promotion</a></li>
            </ul>
        </div>
        <div class="right">
            <div style="display: flex; justify-content: space-between; color: white;">
                <h1>Update Guest</h1>
                <div>
                    <p>Search</p>
                    <input type="text" name="search" id="search" style="background-color: white; border: 1px solid black; border-radius: 10px; padding: 5px; height: 30px;">
                </div>
            </div>
            <div style="margin-top: 20px; border-radius: 10px; background-color: white; padding: 20px; min-height: 500px; height: 100%;">
                
                <?php include 'GuestEdit.php'; ?>

                <?php if ($GuestID): ?>
                <form method="post">
                    <div class="mb-3 row">
                        <label for="FirstName" class="col-sm-2 col-form-label text-end">First Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="FirstName" name="FirstName" value="<?php echo $FirstName; ?>">
                        </div>
                    </div>                    
                    <div class="mb-3 row">
                        <label for="LastName" class="col-sm-2 col-form-label text-end">LastName:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="LastName" name="LastName" value="<?php echo $LastName; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="Telephone" class="col-sm-2 col-form-label text-end">Telephone:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Telephone" name="Telephone" value="<?php echo $Telephone; ?>">
                        </div>
                    </div>  
                    <div class="mb-3 row">
                        <label for="Email" class="col-sm-2 col-form-label text-end">Email:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Email" name="Email" value="<?php echo $Email; ?>">
                        </div>
                    </div>  
                    <div class="mb-3 row">
                        <label for="Password" class="col-sm-2 col-form-label text-end">Password:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Password" name="Password" value="<?php echo $Password; ?>">
                        </div>
                    </div>  
                    <div class="mb-3 row">
                        <label for="NationalID" class="col-sm-2 col-form-label text-end">NationalID:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="NationalID" name="NationalID" value="<?php echo $NationalID; ?>">
                        </div>
                    </div>  
                    <div class="mb-3 row">
                        <label for="PassportNo" class="col-sm-2 col-form-label text-end">PassportNo:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="PassportNo" name="PassportNo" value="<?php echo $PassportNo; ?>">
                        </div>
                    </div>  
                    <div class="mb-3 row">
                        <label for="DOB" class="col-sm-2 col-form-label text-end">DOB:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="DOB" name="DOB" value="<?php echo $DOB; ?>">
                        </div>
                    </div>  
                    <div class="mb-3 row">
                        <label for="Gender" class="col-sm-2 col-form-label text-end">Gender:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="Gender" name="Gender" value="<?php echo $Gender; ?>">
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col text-end">
                            <button type="submit" class="btn-custom" herf = "GuestInfo.php">Update</button>
                            <a href="GuestFB.php" class="btn btn-secondary-custom">Back</a>
                        </div>
                    </div>
                </form>
                <?php endif; ?>
                
            </div>
        </div>
    </div>

    <?php
    // Check if success message is set in session and display it
    if (isset($_SESSION['success_message'])) {
        echo "<script>
        $(document).ready(function() {
            Swal.fire({
                title: 'Success!',
                text: 'Guest details updated successfully!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(function() {
                window.location = 'GuestFB.php';
            });
        });
        </script>";
        unset($_SESSION['success_message']); // Remove the message from session after displaying
    }
    ?>

</body>
</html>
