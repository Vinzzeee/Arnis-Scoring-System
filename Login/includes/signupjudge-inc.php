<?php

include ("dbh-inc.php");

// Get the user information from the form
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$middlename = $_POST["middlename"];
$age = $_POST["age"];
$contact_number = $_POST["contact_number"];
$barangay = $_POST["barangay"];
$street_name = $_POST["street_name"];
$email = $_POST["email"];
$gender = $_POST["gender"];


$role = '(JUDGE)';
$birthday = 'N/A';
$height = 'N/A';
$weight = 'N/A';
$weight_class = 'N/A';
$father_name = 'N/A';
$mother_name = 'N/A';
$legal_guardian = 'N/A';
$parentguardian_contact_number = 'N/A';
$file_name = '';
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