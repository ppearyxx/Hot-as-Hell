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
    <script>
        function deleteRow(button) {
            // Find the row containing the button and remove it
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
    </script>
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
                <li><a href="index.html"><i class="fa-solid fa-user" style="margin-right: 10px;"></i>Employee</a></li>
                <li><a href="TestPositionDashboard.php"><i class="fa-solid fa-briefcase" style="margin-right: 10px;"></i>Employee Position</a></li>
                <li><a href="TestRoomDashBoard.php"><i class="fa-solid fa-bed" style="margin-right: 10px;"></i>Room</a></li>
                <li><a href="TestRoomDetailDashBoard.php"><i class="fa-solid fa-hotel" style="margin-right: 10px;"></i>Room Detail</a></li>
                <li><a href="reservation.html"><i class="fa-solid fa-user" style="margin-right: 10px;"></i>Reservation</a></li>
                <li><a href="guest.html"><i class="fa-solid fa-book" style="margin-right: 10px;"></i>Guest Information</a></li>
                <li><a href="payment.html"><i class="fa-brands fa-paypal" style="margin-right: 10px;"></i>Payment</a></li>
                <li class="highlight"><a href="TestMethodDashboard.php"><i class="fa-solid fa-coins" style="margin-right: 10px;"></i>Payment Method</a></li>
                <li><a href="TestPromotionDashboard.php"><i class="fa-solid fa-desktop" style="margin-right: 10px;"></i>Promotion</a></li>
            </ul>
        </div>
        <div class="right">
            <div style="display: flex; justify-content: space-between; color: white;">
                <h1>Search for Payment Methods</h1>
            </div>
            <div style="margin-top: 20px; border-radius: 10px; background-color: white; padding: 20px; min-height: 500px; height: 100%;">
                <?php
                // Establishing connection to MySQL database
                $con=mysqli_connect("localhost","root","","hot_as_hell");

                // Check connection
                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    exit();
                }

                // Retrieving user input from the form fields and handling empty inputs
                $PaymentMethodID = isset($_POST['payment_method_id']) ? $_POST['payment_method_id'] : '';
                $PaymentMethodName = isset($_POST['payment_method_name']) ? $_POST['payment_method_name'] : '';

                // Check if all inputs are empty
                if (empty($PaymentMethodID) && empty($PaymentMethodName)) {
                    echo "<p style='color: red; text-align: center;'>Please fill in at least one field to search.</p>";
                } else {
                    // Counter for numbering rows
                    $r = 1;

                    // Constructing the SQL query based on user input
                    $query = "SELECT * FROM payment_method WHERE PaymentMethodID LIKE '%$PaymentMethodID%' 
                              AND PaymentMethodName LIKE '%$PaymentMethodName%'";

                    $query .= " ORDER BY PaymentMethodID ASC";

                    // Executing the SQL query
                    $result = mysqli_query($con, $query);

                    // Check if there are any results
                    if (mysqli_num_rows($result) > 0) {
                        // Displaying the fetched data in a table format
                        echo "<table class='table table-hover'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>No</th>";
                        echo "<th>Payment Method ID</th>";
                        echo "<th>Payment Method Name</th>";
                        echo "<th>Actions</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";

                        foreach ($result as $row) {
                            echo "<tr>";
                            echo "<td>" . $r++ . "</td>";
                            echo "<td>" . $row["PaymentMethodID"] . "</td>";
                            echo "<td>" . $row["PaymentMethodName"] . "</td>";
                            echo "<td>";
                            echo "<a href='TestMethodEditForm.php?type=" . $row["PaymentMethodID"] . "'><button style='color: white; border-radius: 5px; background-color: #00868D; padding: 5px; border: none;'>Edit</button></a> ";
                            echo "<a href='TestMethodDeleteForm.php?id=".$row["PaymentMethodID"]."'><button style='color: white; border-radius: 5px; background-color: #DC3545; padding: 5px; border: none;'>Delete</button></a>";
                            echo "</td>";
                            echo "</td>";
                            echo "</tr>";
                        }

                        echo "</tbody>";
                        echo "</table>";
                    } else {
                        echo "<p style='color: red; text-align: center;'>No payment methods found matching the criteria.</p>";
                    }
                }

                // Closing the database connection
                mysqli_close($con);
                ?>

                <!-- Forms for other actions -->
                <div style="width: 100%; display: flex; justify-content: flex-end; margin-top: 20px;">
                    <a href="TestMethodInsertForm.php">
                        <button class="btn-custom">Insert New Payment Method</button>
                    </a>
                    <form name="inpfrm" method="post" action="TestMethodDashboard.php" style="margin-left: 10px;">
                        <button type="submit" class="btn-custom">View All Payment Methods</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
