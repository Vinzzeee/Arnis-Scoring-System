<?php

include ("dbh-inc.php");

// Get the user information from the form
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$middlename = $_POST["middlename"];
$birthday = $_POST["birthday"];
$age = $_POST["age"];
$gender = $_POST["gender"];
$contact_number = $_POST["contact_number"];
$height = $_POST["height"];
$weight = $_POST["weight"];
$weight_class = $_POST["weight_class"];
$barangay = $_POST["barangay"];
$street_name = $_POST["street_name"];
$father_name = $_POST["father_name"];
$mother_name = $_POST["mother_name"];
$legal_guardian = $_POST["legal_guardian"];
$parentguardian_contact_number = $_POST["parentguardian_contact_number"];
$email = $_POST["email"];


$role = '(PLAYER)';
$password = 'N/A';



// Query the database to check if the user with the given email already exists
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

// Check if there is already a user with the given email
if (mysqli_num_rows($result) > 0) {
  // User with the given email already exists, display an error message
  echo "User with the given email already exists";
  exit();
}

// Retrieve the file and move it to a desired location on the server
$file_name = $_FILES['file']['name'];
$file_tmp_name = $_FILES['file']['tmp_name'];
$file_destination = '../../uploads/' . $file_name;
move_uploaded_file($file_tmp_name, $file_destination);


// Define the allowed file types
$allowed_types = array('jpg', 'jpeg', 'png', 'gif', 'pdf');

// Get the file extension
$file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

// Check if the file type is allowed
if (!in_array($file_ext, $allowed_types)) {
  // File type not allowed, display an error message
  echo "File type not allowed";
  exit();
}

// Define the maximum file size (in bytes)
$max_file_size = 1000000; // 1 MB

// Check if the file size is within the allowed limit
if ($_FILES['file']['size'] > $max_file_size) {
  // File size too large, display an error message
  echo "File size too large";
  exit();
}

// Insert the user information into the database with 'Pending' status
$sql = "INSERT INTO users (role, firstname, lastname, middlename, birthday, age, gender, contact_number, height, weight, weight_class, barangay, street_name, father_name, mother_name, legal_guardian, parentguardian_contact_number, email, password, attachment, status) VALUES ('$role', '$firstname', '$lastname', '$middlename', '$birthday', '$age', '$gender', '$contact_number', '$height', '$weight', '$weight_class', '$barangay', '$street_name', '$father_name', '$mother_name', '$legal_guardian', '$parentguardian_contact_number', '$email', '$password', '$file_name', 'Pending')";

if (mysqli_query($conn, $sql)) {
    // User added successfully, display a message to the user that they need to wait for approval
    header("Location: ../../signup/confirmation.html");
} else {
  // Error inserting user information, display an error message
  echo "Error inserting user information: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>