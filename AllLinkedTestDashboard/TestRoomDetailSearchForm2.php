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
                <li class="highlight"><a href="TestRoomDetailDashBoard.php"><i class="fa-solid fa-hotel" style="margin-right: 10px;"></i>Room Detail</a></li>
                <li><a href="reservation.html"><i class="fa-solid fa-user" style="margin-right: 10px;"></i>Reservation</a></li>
                <li><a href="guest.html"><i class="fa-solid fa-book" style="margin-right: 10px;"></i>Guest Information</a></li>
                <li><a href="payment.html"><i class="fa-brands fa-paypal" style="margin-right: 10px;"></i>Payment</a></li>
                <li><a href="TestMethodDashboard.php"><i class="fa-solid fa-coins" style="margin-right: 10px;"></i>Payment Method</a></li>
                <li><a href="TestPromotionDashboard.php"><i class="fa-solid fa-desktop" style="margin-right: 10px;"></i>Promotion</a></li>
            </ul>
        </div>
        <div class="right">
            <div style="display: flex; justify-content: space-between; color: white;">
                <h1>Room Information</h1>
                <div>
                <form method="GET" action="TestRoomSearchForm2.php">
                        <p>Search</p>
                        <input type="text" name="search" id="search" style="background-color: white; border: 1px solid black; border-radius: 10px; padding: 5px; height: 30px;">
                        <button type="submit" style="background-color: #00868D; color: white; border: none; border-radius: 5px; padding: 5px 10px;">Search</button>
                    </form>
                </div>
            </div>
            <div style="margin-top: 20px; border-radius: 10px; background-color: white; padding: 20px; min-height: 500px; height: 100%;">
            <?php
// Establishing connection to MySQL database
$con = mysqli_connect("localhost", "root", "", "hot_as_hell");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Retrieving user input from the form field
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Constructing the SQL query to search only from the input in the search box
$query = "SELECT * FROM room_details WHERE RoomType LIKE '%$search%' OR 
          RoomDetail LIKE '%$search%' OR 
          RoomPrice LIKE '%$search%'";

$query .= " ORDER BY RoomType ASC";

// Executing the SQL query
$result = mysqli_query($con, $query);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    // Displaying the fetched data in a table format
    echo "<table class='table' style='font-size: 20px;'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>No</th>";
    echo "<th>Room Type</th>";
    echo "<th>Room Detail</th>";
    echo "<th>Room Price</th>";
    echo "<th>Actions</th>"; // New column for actions
    echo "</tr>";
    echo "</thead>";
    
    $rowNum = 1; // Initialize row number
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $rowNum++ . "</td>";
        echo "<td>" . $row["RoomType"] . "</td>";
        echo "<td>" . $row["RoomDetail"] . "</td>";
        echo "<td>" . $row["RoomPrice"] . "</td>";
        echo "<td>";                        
        echo "<a href='TestRoomDetailEditForm.php?type=" . $row["RoomType"] . "'><button style='color: white; border-radius: 5px; background-color: #00868D; padding: 5px; border: none;'>Edit</button></a> ";
        echo "<a href='TestRoomDetailDeleteForm.php?type=" . $row["RoomType"] . "'><button style='color: white; border-radius: 5px; background-color: #DC3545; padding: 5px; border: none;'>Delete</button></a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='color: red; text-align: center;'>No room details found matching the criteria.</p>";
}

// Closing the database connection
mysqli_close($con);
?>

            </div>
            <div style="width: 100%; display: flex;">
                <a href="TestRoomDetailDashboard.php" style="text-decoration: none;">
                <button style="color: white; border-radius: 10px; background-color: #00868D; padding: 10px; width: 102px; margin-top: 20px; border: none; margin-left: auto;">Back</button>
                </a>
            </div>
        </div>
    </div>
</body>
</html>

