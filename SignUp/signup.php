<?php
$con=mysqli_connect("localhost","root","","hot_as_hell");
//Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

    // Define the characters to be used for generating the unique string
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    // Add null character to the list of characters
    $characters .= chr(0);

    // Shuffle the characters to randomize their order
    $shuffled_characters = str_shuffle($characters);

    // Generate a random string of desired length (e.g., 10 characters)
    $unique_string = '';

    for ($i = 0; $i < 4; $i++) {
        // Randomly select a character from the shuffled list
        $unique_string .= $shuffled_characters[rand(0, strlen($shuffled_characters) - 1)];
    }

    $unique_number =  rand(0, 999);

    
    $first_name = mysqli_real_escape_string($con, $_POST['firstname']);
    $last_name = mysqli_real_escape_string($con, $_POST['lastname']);
    $guest_id = 'G' . substr($first_name, 0, 1) . substr($last_name, 0, 1) . $unique_string . $unique_number;
    $telephone = mysqli_real_escape_string($con, $_POST['telephoneNo']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $national_id = mysqli_real_escape_string($con, $_POST['nationalID']);
    $passport_no = mysqli_real_escape_string($con, $_POST['passportNo']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);

    // Map the gender value to "M" or "F"
    if ($gender == 'M') {
        $gender = 'M';
    } elseif ($gender == 'F') {
        $gender = 'F';
    }


    $sql="INSERT INTO guest (GuestID, FirstName, LastName, Telephone, Email, Password, NationalID, PassportNo, DOB, Gender)
    VALUES ('$guest_id', '$first_name', '$last_name', '$telephone', '$email', '$password', '$national_id', '$passport_no', '$dob', '$gender')";
    if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
    }
    echo "Success" ;

mysqli_close($con);
?>