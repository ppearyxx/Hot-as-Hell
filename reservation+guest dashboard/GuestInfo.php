<?php
// Assuming you have already established a database connection
$servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "hotas_hell";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM guest"; 
$result = mysqli_query($conn, $sql);

// Check if query executed successfully
if ($result) {
    // Loop through the data and populate the table rows
    echo "<table border='1'>";
    echo "<tr><th>Guest ID</th><th>Firstname</th><th>Lastname</th><th>Telephone</th><th>Email</th><th>Password</th><th>National ID</th><th>Passport No</th><th>DOB</th><th>Gender</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['guestid'] . "</td>";
        echo "<td>" . $row['fname'] . "</td>";
        echo "<td>" . $row['lname'] . "</td>";
        echo "<td>" . $row['tel'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['gpassword'] . "</td>";
        echo "<td>" . $row['nationalid'] . "</td>";
        echo "<td>" . $row['passportno'] . "</td>";
        echo "<td>" . $row['dateofbirth'] . "</td>";
        echo "<td>" . $row['gender'] . "</td>";
        echo "<td><a href='#'>Options</a></td>";
        echo "</tr>";
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>
